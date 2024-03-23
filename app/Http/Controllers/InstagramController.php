<?php

namespace App\Http\Controllers;

use App\Models\FacebookPage;
use App\Models\InstagramAccount;
use App\Models\SocialID;
use App\Providers\FacebookRepository;
use Carbon\Carbon;
use Facebook\Facebook;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class InstagramController extends Controller
{
    public function redirectToInstagram()
    {
        $appId = config('services.instagram.client_id');
        $redirectUri = env('INSTAGRAM_REDIRECT_URI');
        $scopes = [
          'instagram_basic',
          'instagram_content_publish', // Adjust scopes as needed
          'instagram_manage_comments',
          'instagram_manage_insights',
          'instagram_manage_messages',
          'pages_read_engagement',
          'attribution_read',
        ];

        $url = "https://www.facebook.com/v19.0/dialog/oauth?client_id=" . $appId . "&state=" . Str::random(40) . // Generate random state string
              "&response_type=code&redirect_uri=" . urlencode($redirectUri) . "&scope=" . urlencode(implode(',', $scopes));

        return redirect()->away($url);
      }


    public function handleProviderCallback(Request $request)
    {
        $authorizationCode = $request->query('code');

        if (!$authorizationCode) {
            // Handle missing authorization code
            return redirect()->route('account.connect')->with('error', 'Authorization code missing');
        }

        try {
            // Exchange authorization code for access token
            $response = Http::post('https://graph.facebook.com/v19.0/oauth/access_token', [
                'client_id' => env('INSTAGRAM_CLIENT_ID'),
                'client_secret' => env('INSTAGRAM_CLIENT_SECRET'),
                'code' => $authorizationCode,
                'redirect_uri' => env('APP_URL') . '/auth/instagram/callback',
            ]);

            $response->throw(); // Throw exception for non-2xx response codes
            $accessToken = $response->json()['access_token'];
            $response = Http::get('https://graph.facebook.com/v19.0/me/accounts?fields=id,name,instagram_business_account&access_token=' . $accessToken);
            $pages = $response->json()['data'];

            foreach ($pages as $page) {
                // Step 3: Extract Instagram business page details
                if (isset($page['instagram_business_account']['id'])) {
                    $instagramPageId = $page['instagram_business_account']['id'];

                    $url = "https://graph.facebook.com/v12.0/{$instagramPageId}?fields=username&access_token={$accessToken}";

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                    $response = curl_exec($ch);

                    if(curl_errno($ch)) {
                        echo 'Error: ' . curl_error($ch);
                    } else {
                        $instagramPage = json_decode($response, true);
                        $instagramPageName = isset($instagramPage['username']) ? $instagramPage['username'] : null;
                    }

                    // Store or update InstagramPage model instance
                    SocialID::updateOrCreate(
                        ['page_id' => $instagramPageId],
                        [
                            'user_id' => Auth::id(),
                            'social_id' => 2,
                            'access_token' => $accessToken,
                            'page_name' => $instagramPageName,
                            'expires_at' => Carbon::now()->addDays(55)
                        ]
                    );
                }
            }

            // Redirect or respond with success message
            return redirect()->route('account.manage');
        } catch (\Exception $e) {
            // Handle exceptions
            return redirect()->route('account.connect')->with('error', 'An error occurred during Instagram callback');

        }
        catch (ClientException $e) {
            // Handle Facebook response exceptions (e.g., invalid code, access denied)
            \Log::error('Error during Facebook callback: ' . $e->getMessage());
            return redirect()->route('account.connect')->with('error', 'An error occurred during Facebook callback');
        }
        // Redirect or return response
    }

}
