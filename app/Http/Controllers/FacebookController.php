<?php

namespace App\Http\Controllers;

use App\Providers\FacebookRepository;
use Carbon\Carbon;
use Exception;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use App\Models\FacebookPage;
use Session;


class FacebookController extends Controller
{
    protected $facebook;

    public function __construct()
    {
        $this->facebook = new FacebookRepository();
    }

    public function redirectToFacebook()
    {
        $scopes = [
            'pages_show_list',
            'pages_manage_posts',
            'public_profile'
        ];

        return Socialite::driver('facebook')
            ->scopes($scopes)
            ->redirect();
    }


    public function handleFacebookCallback(Request $request)
    {
        // Extract authorization code from the request
        $authorizationCode = $request->query('code');
        if (!$authorizationCode) {
            // Handle missing authorization code
            return redirect()->route('account.connect')->with('error', 'Authorization code missing');
        }

        try {
            // Exchange authorization code for access token
            $response = Http::post('https://graph.facebook.com/v19.0/oauth/access_token', [
                'client_id' => config('services.facebook.client_id'),
                'client_secret' => config('services.facebook.client_secret'),
                'code' => $authorizationCode,
                'redirect_uri' => env('APP_URL') . '/auth/facebook/callback',
            ]);

            $response->throw(); // Throw exception for non-2xx response codes

            // Access token is present in the successful response JSON
            $accessToken = $response->json()['access_token'];
            $response = Http::get('https://graph.facebook.com/v19.0/me/accounts?fields=id,name&access_token=' . $accessToken);

            $pages = $response->json()['data'];

            foreach ($pages as $page) {
                $pageId = $page['id'];
                $pageName = $page['name'];

                // Create or update FacebookPage model instance
                $facebookPage = FacebookPage::updateOrCreate(
                    ['page_id' => $pageId],
                    [
                        'user_id' => Auth::id(), // Assuming you have user auth mechanism
                        'access_token' => $accessToken,
                        'page_name' => $pageName,
                        'expires_at' => Carbon::now()->addDays(55), // Example: Set expiration 55 days from now
                    ]
                );
            }
            // Store access token securely (e.g., user session or database)
            // You'll need to implement logic for secure storage based on your application
            // Redirect to the '/pages' route or desired location
            return redirect()->route('account.manage');

        } catch (ClientException $e) {
            // Handle Facebook response exceptions (e.g., invalid code, access denied)
            \Log::error('Error during Facebook callback: ' . $e->getMessage());
            return redirect()->route('account.connect')->with('error', 'An error occurred during Facebook callback');
        }
    }

    public function showPages()
    {
        // Retrieve access token and pages data from session
        $accessToken = session('access_token');
        $pages = session('pages');

        // Display the pages view with the retrieved data
        return view('account.manage', ['pages' => $pages]);
    }


}
