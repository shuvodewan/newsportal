<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\SocialSettings;
use App\Models\SocialProvider;
use Config;
use Socialite;
use Illuminate\Support\Facades\Auth;

class SocialRegisterController extends Controller
{
    public function __construct()
    {
        $link = SocialSettings::findOrFail(1);
        Config::set('services.google.client_id', $link->gclient_id);
        Config::set('services.google.client_secret', $link->gclient_secret);
        Config::set('services.google.redirect', url('/auth/google/callback'));
        Config::set('services.facebook.client_id', $link->fclient_id);
        Config::set('services.facebook.client_secret', $link->fclient_secret);
        $url = url('/auth/facebook/callback');
        $url = preg_replace("/^http:/i", "https:", $url);
        Config::set('services.facebook.redirect', $url);
    }
    public function redirectToProvider($provider){
        return Socialite::driver($provider)->redirect();
    }
    public function handleProviderCallback($provider)
    {
        try
        {
            $socialUser = Socialite::driver($provider)->user();
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
        //check if we have logged provider
         $socialProvider = SocialProvider::where('provider_id',$socialUser->getId())->first();
        if(!$socialProvider)
        {
            $ck = Admin::where('email','=',$socialUser->email)->count();
            if($ck > 0)
            {
                $user = Admin::where('email','=',$socialUser->email)->first();
                Auth::guard('admin')->login($user); 
                return redirect()->route('frontend.index');
            }

            //create a new user and provider
            $user = new Admin();
            $user->email = $socialUser->email;
            $user->name = $socialUser->name;
            $user->photo = $socialUser->avatar_original;
            $user->role_id = 3;
            $user->save();

            $user->socialProviders()->create(
                ['provider_id' => $socialUser->getId(), 'provider' => $provider]
            );
        }
        else
        {
            $user = $socialProvider->user;
        }

        Auth::guard('admin')->login($user); 
        return redirect()->route('frontend.index');

    }
}
