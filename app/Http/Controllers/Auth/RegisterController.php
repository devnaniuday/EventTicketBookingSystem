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
        return view('auth.signup');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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


        $name = $request->input('name');


        $email = $request->input('email');
        $otp = rand(1000, 9999);
        session(['otp' => $otp]);

        Session::put('email', $email);
        Session::put('otp', $otp);
        Session::put('name', $name);
        Mail::to($email)->send(new TestMail($otp, 'Sign-up OTP!'));

        Session::put('registration_in_progress', true);

        return Redirect()->route('showOtpForm');
    }


    public function showOtpForm()
    {

        if (Session::get('registration_in_progress')) {
            return view('auth.otp');
        }

        return redirect('/sign-up');
    }

    public function verifyOtp(Request $request)
    {
        if (Auth::check()) {
            return redirect(RouteServiceProvider::HOME);
        }
        // Validate the otp input field
        $email = session('email');
        $otp = session('otp');
        $otpAttempts = session('otp_attempts', 0);



        if ($request->input('action') === 'resend') {
            if ($otpAttempts > 2) {
                return back()->with('error', 'You have exceeded the maximum number of OTP generation attempts.');
            } else {

                Mail::to($email)->send(new TestMail($otp, 'New Otp!'));
                session(['otp_attempts' => $otpAttempts + 1]);


                return Redirect()->route('showOtpForm');
            }
        } else {
            $userotp = $request->input('d1') . $request->input('d2') . $request->input('d3') . $request->input('d4');

            if ($otp == $userotp) {

                session(['otp_verified_' . md5($email) => true]);
                Session::forget('registration_in_progress');

                return redirect()->route('Registration.Fees');
            } else {
                return back()->with('error', 'Invalid OTP. Please try again.');
            }
        }
    }
    public function SuccessfullPayment()
    {
        $email = session('email');
        $user = User::where('email', $email)->first();
        Auth::login($user);
        $user->email_verified_at = now();
        $user->save();
        return redirect('dashboard');
    }
    public function RegistrationFees()
    {
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
                                'name' => 'Registration Fees for BookMyTicket.com',
                                'description' => 'This fee covers the registration process for accessing and using BookMyTicket.com',
                            ],
                            'unit_amount' => 10000,
                        ],
                        'quantity' => 1,
                    ],
                ],
                'customer_email' => $email, // Add customer's email
                'billing_address_collection' => 'required', // Request customer's billing address
                'mode' => 'payment',
                'success_url' => route('SuccessfullPayment'),
                'cancel_url' => route('sign-up'),
            ]);
            return redirect()->away($paymentGateway->url);
        }
    }
}
