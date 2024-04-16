<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Mail\TestMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.signin');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            // User not found, redirect back with error message
            return back()->withErrors([
                'message' => 'User with this email does not exist.',
            ])->withInput($request->only('email'));
        }
        // if user is not verify then it will redirect to verify page.
        if ($user->email_verified_at ===  null) {
            // Store verification data in session for later use when user clicks on resend link or submit form
            // Store verification data in session and redirect to enter OTP page
            $name = $user->name;
            $email = $request->input('email');
            $otp = rand(1000, 9999);
            session(['otp' => $otp]);

            // get data from the session and sent the email to user to verify the user email.
            Session::put('email', $email);
            Session::put('otp', $otp);
            Session::put('name', $name);
            Mail::to($email)->send(new TestMail($otp, 'Sign-up OTP!'));
            // atter sending the email it will redirect to the verifyotp page and add session progress on .
            Session::put('registration_in_progress', true);

            return redirect()->route('verifyOtp');
        }
        // if same user is trying to access the login page without verify and came form half way to registation prosess.
        if (Session::get('registration_in_progress') && $user) {
            $emailInSession = session('email');

            if ($emailInSession === $request->email) {
                // Proceed to verify OTP
                session(['otp_attempts' => 0]);
                return redirect()->route('verifyOtp');
            }
        }
        $credentials = $request->only('email', 'password');
        $rememberMe = $request->rememberMe ? true : false;

        // if the user is verified then it will check for the password and login the user.
        if (Auth::attempt($credentials, $rememberMe)) {
            $request->session()->regenerate();

            // Clear registration in progress only if the user is the same
            if ($user && session('registration_in_progress') == $user->id) {
                Session::forget('registration_in_progress');
            }
            if ($user->email_verified_at) {
                // User's email is already verified, login and redirect to home
                Auth::login($user);

                return redirect()->intended('/dashboard');
            }
            if ($user->email_verified_at ==  null) {
                // Store verification data in session for later use when user clicks on resend link or submit form
                // Store verification data in session and redirect to enter OTP page
                session(['email' => $request->email, 'registration_in_progress' => $user->id]);

                return redirect()->route('verifyOtp');
            }
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'message' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/sign-in');
    }
}
