<?php

namespace App\Http\Controllers;

use App\Models\SocialAccount;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class OauthController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
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
            
            $data->profile = $user->getAvatar();
            $data->provider = $provider;
            $data->provider_id = $user->getId();
            $data->save();
            
            return $data;
        }
    }
}
