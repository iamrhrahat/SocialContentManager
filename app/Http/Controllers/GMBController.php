<?php

namespace App\Http\Controllers;
use App\Models\SocialID;
use Exception;
use Google\Client;
use Google_Service_MyBusiness;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GMBController extends Controller
{
    public function redirectToGoogle()
{
    $client = new Client();
    $client->setClientId(env('GOOGLE_CLIENT_ID'));
    $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
    $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
    $client->addScope('https://www.googleapis.com/auth/business.manage');
    $client->setAccessType('offline');
    $client->setApprovalPrompt('force');

    return redirect($client->createAuthUrl());
}

public function handleGoogleCallback(Request $request)
{
    $client = new Client();
    $client->setClientId(env('GOOGLE_CLIENT_ID'));
    $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
    $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));

    $accessToken = $client->fetchAccessTokenWithAuthCode($request->get('code'));
dd($accessToken);
    // Save access token and refresh token in database for user
}

    //     $gmbService = new Google_Service_MyBusiness($client);

    //     try {
    //         // List locations for the account
    //         $locations = $gmbService->accounts->locations->list("accounts/[YOUR_ACCOUNT_ID]");

    //         // Check if locations exist
    //         if (empty($locations->getLocations())) {
    //             throw new \Exception('No locations found for this account.');
    //         }

    //         // Access the first location (consider handling multiple locations)
    //         $business = $locations->getLocations()[0];

    //         $gmbData = new SocialID();
    //         $gmbData->user_id = Auth::id();
    //         $gmbData->social_id = 5;
    //         $gmbData->access_token = $accessToken['access_token'];
    //         $gmbData->page_id = $business->getName(); // Use getName() for business ID
    //         $gmbData->page_name = $business->getLocationName();
    //         $gmbData->address = $business->getAddress()->getFormattedAddress();
    //         $gmbData->expires_at = $accessToken['expires_in'];
    //         $gmbData->save();

    //         return redirect('/manage-account');
    //     } catch (Exception $e) {
    //         // Handle errors (e.g., API call failures, missing locations)
    //         return redirect('/connect-account')->with('error', $e->getMessage());
    //     }
    // }

//    public function manageGMB()
//     {
//         $gmbData = SocialID::first(); // Fetch the first GMB data from the database
//         // Use $gmbData to interact with the GMB API
//     }

    // public function manageGMB()
    // {
    //     $client = $this->getClient();
    //     $client->setAccessToken(session('access_token'));
    //     $service = new Google_Service_MyBusiness($client);
    //     // Use $service to interact with the GMB API
    // }


}
