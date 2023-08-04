<?php

namespace App\Http\Controllers;

use App\Models\SocialAccount;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class OauthController extends Controller
{
    public function redirectToProvider($provider)
    {   
        Session::forget('socialite:driver');
        Session::forget('socialite:state');
        
        $url = Socialite::driver($provider)->redirect()->getTargetUrl();
        // supaya popup google dapat tampil terus meskipun pengguna telah melakukan login sebelumnya
        if ($provider == 'facebook') {
            $url .= '&auth_type=reauthenticate';
        } elseif ($provider == 'google') {
            $url .= '&prompt=select_account';
        }

        return redirect($url);
    }

    public function handleProvideCallback($provider)
    {
        try {
            $user = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            return back()->with('error', $e);
        }

        $authUser = $this->findOrCreateUser($user, $provider);

        if (is_string($authUser)) {
            return redirect('/login')->with('error', $authUser);
        }

        Auth()->login($authUser, true);

        return redirect('/')->with('success', 'Login Successfully');
    }

    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->getId())->first();
        
        if ($authUser) {
            return $authUser;
        } else {
            $existingEmail = User::where('email', $user->getEmail())
                ->count();

            if ($existingEmail) {
                return 'Email already registered';
            }

            $data = User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => ''
            ]);
            
            if ($provider == 'google') {
                $data->profile = $user->getAvatar();
            } else {
                $data->profile = $user->getAvatar() . "&access_token={$user->token}";
            }
            // tambahkan access token supaya tampil avatar yg dipakai
            $data->provider = $provider;
            $data->provider_id = $user->getId();
            $data->save();
            
            return $data;
        }
    }
}
