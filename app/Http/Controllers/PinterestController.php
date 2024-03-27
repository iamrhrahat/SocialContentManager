<?php

namespace App\Http\Controllers;

use App\Models\SocialID;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use WaleedAhmad\Pinterest\Facade\Pinterest;

class PinterestController extends Controller
{
    public function redirectToPinterest()
{
    $queryParams = [
        'client_id' => env('PINTEREST_CLIENT_ID'),
        'redirect_uri' => env('PINTEREST_REDIRECT_URI'),
        'response_type' => 'code',
        'scope' => 'boards:read,pins:read,user_accounts:read,boards:write', // Adjusted scopes as needed

    ];

    $url = 'https://www.pinterest.com/oauth/?' . http_build_query($queryParams);
    return redirect()->away($url);
}

public function handlePinterestCallback(Request $request)
{
    // Extract authorization code from the request
    $authorizationCode = $request->query('code');
    $client = new Client();
    $clientId = env('PINTEREST_CLIENT_ID');
    $clientSecret = env('PINTEREST_CLIENT_SECRET');
    $credentials = $clientId . ':' . $clientSecret;
    $base64Encoded = base64_encode($credentials);
    $response = $client->post('https://api.pinterest.com/v5/oauth/token', [
        'headers' => [
            'Authorization' => 'Basic ' . $base64Encoded, // Add a space after 'Basic'
            'Content-Type' => 'application/x-www-form-urlencoded'
        ],
        'form_params' => [
            'grant_type' => 'authorization_code',
            'code' => $authorizationCode, // Replace with the actual authorization code
            'redirect_uri' => env('PINTEREST_REDIRECT_URI')
        ]
    ]);

    // Handle the response as needed
    $body = $response->getBody();
    $data = json_decode($body, true);

    // Access token will be in $data array if request is successful
    $accessToken = $data['access_token'];
    $expiresIn = $data['expires_in']; // Expiration time in seconds
    $expirationTime = Carbon::now()->addSeconds($expiresIn);

    $boardsResponse = $client->get('https://api.pinterest.com/v5/boards', [
        'headers' => [
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type' => 'application/json'
        ]
    ]);

    // Decode the JSON response
    $boardsData = json_decode($boardsResponse->getBody(), true);


    // Check if 'items' key exists in the response
    if (isset($boardsData['items'])) {
        // Extract board names and IDs
        foreach ($boardsData['items'] as $board) {
            $boardId = $board['id'];
            $boardName = $board['name'];

            // Save board information to database
            SocialID::updateOrCreate(
                ['page_id' => $boardId],
                [
                    'user_id' => Auth::id(),
                    'social_id' => 3, // Assuming 3 represents Pinterest
                    'access_token' => $accessToken,
                    'page_name' => $boardName,
                    'expires_at' => $expirationTime, // Example: Set expiration 55 days from now
                ]
            );
        }
    } else {
        // Handle error if 'items' key is not found in the response
        return redirect()->route('account.connect')->response()->json(['error' => 'Unable to fetch boards data']);
    }

    // Redirect to account.manage or wherever needed
    return redirect()->route('account.manage');
    }
    // Retrieve user's boards



}
