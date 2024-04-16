<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use PhpParser\Node\Stmt\TryCatch;

class GoogleController extends Controller
{
    public function loginwithgoogle()
    {
        if (Auth::check()) {
            return redirect(RouteServiceProvider::HOME);
        }
        // redirect to Google sign-in link
        return Socialite::driver('google')->redirect();
    }

    public function callbackFromGoogle()
    {
        if (Auth::check()) {
            return redirect(RouteServiceProvider::HOME);
        }
        try {

            $user = Socialite::driver('google')->user();
            // Check if the user is already loged-in or not
            $is_user = User::where('email', $user->getEmail())->first();

            // if new user sign-in then create into database
            if (!$is_user) {
                User::create([
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'password' => Hash::make($user->getId()),
                    'google_id' => $user->getId(),
                ]);
                // Redirect to Registartion Fees proccess
                $redirectUrl = route('GoogleOTP', [
                    'email' => $user->getEmail(),
                    'name' => $user->getName()
                ]);
                return redirect($redirectUrl);
            } else {
                // if user is already loged-in then it will get data from the database and login

                
                $useremail = $user->getEmail();
                $verify = User::where('email', $useremail)->first();
                //if user's email is not verifed then it will sent the opt
                if ($verify->email_verified_at ===  null) {
                    $redirectUrl = route('showOtpFormGoogle', [
                        'email' => $user->email,
                        'name' => $user->name,
                    ]);

                    return redirect($redirectUrl);
                } else {
                    // it will directly redirect to dashboard
                    $saveUser = User::where('email', $user->getEmail())->first();
                    // if(Auth::attempt(['email' => $user->getEmail(), 'password' => $user->getName().'@'.$user->getId()])){
                    Auth::loginUsingId($saveUser->id);
                    return redirect()->route('dashboard');
                }
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
