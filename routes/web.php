<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TicketController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Web Page
Route::get('/', function () {
    return redirect('/dashboard');
})->middleware('auth');

Route::get('/registrationFees', [RegisterController::class, 'RegistrationFees'])->name('Registration.Fees')->middleware('guest');
Route::get('/SuccessfullPayment', [RegisterController::class, 'SuccessfullPayment'])->name('SuccessfullPayment')->middleware('guest');

Route::get('/terms-and-conditions', function () {
    return view('terms&conditions');
})->name('t&c');

Route::get('/about-us', function () {
    return view('AboutUs');
})->name('about-us');

// Events Related Routes --------------------------------------------------------------------------------------------------------

// Show Event in my Event page


Route::get('/event', [EventController::class, 'ShowAllEvents'])->name('event')->middleware('auth');


// Add New Event
Route::get('/event/create', [EventController::class, 'ShowCreateEventPage'])->name('event.create')->middleware('auth');
Route::post('/event/create', [EventController::class, 'createEvent'])->name('event.create')->middleware('auth');

// Show Update Event  Page
Route::get('/eventUpdate/{id}', [EventController::class, 'ShowUpdateEventPage'])->name('events.update')->middleware('auth');
Route::post('/eventUpdate/{id}', [EventController::class, 'UpdateEvent'])->name('events.update')->middleware('auth');

// Delete The Event

Route::get('/eventDelete/{id}', [EventController::class, 'deleteEvent'])->name('eventDelete')->middleware('auth');



// Tickets Related Routes -------------------------------------------------------------------------------------------------------

// Show All Tickets in Dashboard
Route::get('/dashboard', [TicketController::class, 'ShowAllTickets'])->name('dashboard')->middleware('auth');

Route::prefix('ticket')->group(function () {

    // Show Single Ticket Info
    Route::get('/{id}', [TicketController::class, 'TicketInfo'])->name('ticket.info')->middleware('auth');
});



// Order Related route -------------------------------------------------------------------------------------------------------

Route::get('/userPurchaseOrder', [OrderController::class, 'UserPurchaseOrder'])->name('userPurchaseOrder')->middleware('auth');

// Show Event Statistics
Route::get('/organizerOrderDetails', [OrderController::class, 'OrganizerOrderDetails'])->name('OrganizerOrderDetails')->middleware('auth');

Route::get('/PurchasedTicket/{id}', [OrderController::class, 'PurchasedTicket'])->name('PurchasedTicket')->middleware('auth');
// User Profile Related Route----------------------------------------------------------------------------------------------------

// Show User PRofile


Route::prefix('user')->group(function () {
    // Update User Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('user.profile')->middleware('auth');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('user.update')->middleware('auth');
    
    // Upload Profile Photo
    Route::get('/PhotoUpdate', [ProfileController::class, 'showprofilephotoform'])->name('user.PhotoUpdate')->middleware('auth');
    Route::put('/PhotoUpdate', [ProfileController::class, 'updateprofilephoto'])->name('user.PhotoUpdate')->middleware('auth');
});



// Cart Related Routes --------------------------------------------------------------------------------------------------------

// Show Add to Cart Page 
Route::get('/cart', [CartController::class, 'ShowCart'])->name('cart')->middleware('auth');

// Add Item to add to cart table
Route::get('/addtoCart/{id}', [CartController::class, 'AddtoCart'])->name('addtocart')->middleware('auth');

// Delete the Item from the cart
Route::get('/deleteFromCart/{id}', [CartController::class, 'DeleteFromCart'])->name('deleteFromCart')->middleware('auth');

// Place the order from the cart 
Route::get('/Checkoutorder', [CartController::class, 'CheckOutOrder'])->name('CheckOutOrder')->middleware('auth');

Route::post('/paymentGateway', [CartController::class, 'paymentGateway'])->name('paymentGateway')->middleware('auth');

Route::post('/increaseQuantity/{id}', [CartController::class, 'increaseQuantity'])->name('increaseQuantity')->middleware('auth');
Route::post('/decreaseQuantity/{id}', [CartController::class, 'decreaseQuantity'])->name('decreaseQuantity')->middleware('auth');

// Auth Related Routes ----------------------------------------------------------------------------------------------------------

// Sign up page
Route::get('/sign-up', [RegisterController::class, 'create'])
->middleware('guest')
->name('sign-up');
Route::post('/sign-up', [RegisterController::class, 'store'])
->middleware('guest');

// Sign in Page
Route::get('/sign-in', [LoginController::class, 'create'])
->middleware('guest')
->name('sign-in');
Route::post('/sign-in', [LoginController::class, 'store'])
->middleware('guest');

// Log out route
Route::get('/logout', [LoginController::class, 'destroy'])
->middleware('auth')
->name('logout');

// Show Forget Password Page
Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])
->middleware('guest')
->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])
->middleware('guest')
->name('password.email');

// Show Reset Password Page 
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'create'])
->middleware('guest')
->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'store'])
->middleware('guest');

// Show OTP Verification PAge
Route::get('/verify-otp', [RegisterController::class, 'showOtpForm'])->name('showOtpForm')->middleware('guest');
Route::post('/verify-otp', [RegisterController::class, 'verifyOtp'])->name('verifyOtp')->middleware('guest');





// Testing Route-----------------------------------------------------------------------------------------------------------------
Route::get('/mailform', function () {
    return view('mail.test');
});

Route::get('/test', function () {
    return view('tickets.TicketInfo');
});







// Admin ----------------
Route::get('/users-management', [UserController::class, 'index'])->name('users-management')->middleware('auth');
Route::get('/userDelete/{id}', [UserController::class, 'destroy'])->name('user.delete');
Route::get('/viewEventsByUserId/{id}', [UserController::class, 'tickets'])->name('ticket-management')->middleware('auth');
Route::get('/purchasedBy/{id}', [UserController::class , 'purchasedBy'])->name('purchasedBy')->middleware('auth');
Route::get('/UserDetails', [UserController::class, 'UserStatistics'])->name('UserStatistics')->middleware('auth');