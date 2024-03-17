<?php

namespace App\Http\Controllers;

use App\Providers\FacebookRepository;
use Exception;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
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

    public function redirectToProvider()
    {
        return redirect($this->facebook->redirectTo());
    }

    public function handleProviderCallback()
    {
        if (request('error') == 'access_denied')
            //handle error

        $accessToken = $this->facebook->handleCallback();

        //use token to get facebook pages
    }

    public function redirectTo()
{
    $helper = $this->facebook->getRedirectLoginHelper();

    $permissions = [
        'pages_manage_posts',
        'pages_read_engagement'
    ];

    $redirectUri = config('app.url') . '/auth/facebook/callback';

    return $helper->getLoginUrl($redirectUri, $permissions);
}

private function getPages($accessToken)
{
    $pages = $this->facebook->get('/me/accounts', $accessToken);
    $pages = $pages->getGraphEdge()->asArray();

    return array_map(function ($item) {
        return [
            'access_token' => $item['access_token'],
            'id' => $item['id'],
            'name' => $item['name'],
            'image' => "https://graph.facebook.com/{$item['id']}/picture?type=large"
        ];
    }, $pages);
}
}
