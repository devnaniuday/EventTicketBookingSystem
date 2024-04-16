<?php

namespace App\Http\Controllers\Auth;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOtpMail;
use App\Mail\TestMail;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class RegisterController extends Controller
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

        return view('auth.signup');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // Create new user and store the data of user
    public function store(Request $request)
    {
        // validate the user input fileds
        $request->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8|max:255',
            'terms' => 'accepted',
        ], [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',
            'terms.accepted' => 'You must accept the terms and conditions'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);



        // sent email to user email id to verify the user email id 
        $name = $request->input('name');
        $email = $request->input('email');
        $otp = rand(1000, 9999);
        session(['otp' => $otp]);

        // put all data to session to sent along with the email
        Session::put('email', $email);
        Session::put('otp', $otp);
        Session::put('name', $name);
        Mail::to($email)->send(new TestMail($otp, 'Sign-up OTP!'));
        Session::put('registration_in_progress', true);

        return Redirect()->route('showOtpForm');
    }


    // show the verify otp form 
    public function showOtpForm()
    {

        if (Session::get('registration_in_progress')) {
            return view('auth.otp');
        }

        return redirect('/sign-up');
    }

    // Genrate OTP for Google signin api
    public function GoogleOTP(Request $request)
    {

        $email = $request->query('email');
        $name = $request->query('name');

        $otp = rand(1000, 9999);
        // Log::info($name);
        session(['otp' => $otp]);

        Session::put('email', $email);
        Session::put('otp', $otp);
        Session::put('name', $name);
        Mail::to($email)->send(new TestMail($otp, 'Sign-up OTP!'));

        Session::put('registration_in_progress', true);

        return Redirect()->route('showOtpForm');
    }
    // verify the otp from the user email
    public function verifyOtp(Request $request)
    {
        if (Auth::check()) {
            return redirect(RouteServiceProvider::HOME);
        }
        // Get all data from session.
        $email = session('email');
        $otp = session('otp');
        $otpAttempts = session('otp_attempts', 0);

        // it will resent the otp to user email
        if ($request->input('action') === 'resend') {
            // if the resend attempt are more than 3 than it will show the error message.
            if ($otpAttempts > 2) {
                return back()->with('error', 'You have exceeded the maximum number of OTP generation attempts.');
            } else {
                Mail::to($email)->send(new TestMail($otp, 'New Otp!'));
                session(['otp_attempts' => $otpAttempts + 1]);
                return Redirect()->route('showOtpForm');
            }
        } else {
            $userotp = $request->input('d1') . $request->input('d2') . $request->input('d3') . $request->input('d4');

            // verify otp 
            if ($otp == $userotp) {

                session(['otp_verified_' . md5($email) => true]);
                Session::forget('registration_in_progress');

                // if the varification is successfull than it will redirect to payment gate way to for registartion fees 
                return redirect()->route('Registration.Fees');
            } else {
                return back()->with('error', 'Invalid OTP. Please try again.');
            }
        }
    }

    // show payment gate way form for registartion fees process
    public function RegistrationFees()
    {
        if (Auth::check()) {
            return redirect(RouteServiceProvider::HOME);
        }
        $email = session('email');
        $user = User::where('email', $email)->first();
        if ($user->email_verified_at === null) {
            // Set your Stripe API key.
            \Stripe\Stripe::setApiKey(config('stripe.sk'));


            $paymentGateway = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'INR',
                            'product_data' => [
                                'name' => 'BookMyTicket.com',
                                'description' => 'This fee covers the registration process for accessing and using BookMyTicket.com',
                            ],
                            "recurring" => [
                                "interval" => "year"
                            ],
                            'unit_amount' => 10000,
                        ],
                        'quantity' => 1,
                    ],
                ],
                'customer_email' => $email, // Add customer's email
                'billing_address_collection' => 'required', // Request customer's billing address
                'mode' => 'subscription',
                'success_url' => route('SuccessfullPayment'),
                'cancel_url' => route('sign-up'),
            ]);
            return redirect()->away($paymentGateway->url);
        }
    }

    // on successfull payment it will verify the user email and login the user.
    public function SuccessfullPayment()
    {
        $email = session('email');
        $user = User::where('email', $email)->first();
        Auth::login($user);
        $user->email_verified_at = now();
        $user->save();
        return redirect('dashboard');
    }
}
