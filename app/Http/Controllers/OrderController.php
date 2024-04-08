<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Show the user's ordered ticket list to user 
    public function UserPurchaseOrder()
    {
        $user_id = Auth::id();
        $orders = Order::where('user_id', $user_id)->with('event')->orderByDesc('created_at')->paginate(5);
        return view('tickets.UserTicketOrder', compact('orders'));
    }

    // Show all the data related to organizer's tickets like total sales , revenue and others...
    public function OrganizerOrderDetails()
    {
        $user_id = Auth::id();
        $orders = Order::where('organizer_id', $user_id)->with('event', 'user')->orderByDesc('created_at')->paginate(5);
        $Totalsale = Order::where('organizer_id', $user_id)->sum('quantity');
        $Todaysale = Order::where('organizer_id', $user_id)->whereDate('created_at', Carbon::today())->sum('quantity');
        $Totalprice = Order::where('organizer_id', $user_id)->sum('total_price');
        $Todayprice = Order::where('organizer_id', $user_id)->whereDate('created_at', Carbon::today())->sum('total_price');
        return view('events.EventStatistic', compact('orders', 'Totalsale', 'Totalprice', 'Todaysale', 'Todayprice'));
    }

    public function PurchasedTicket($id)
    {
        $user_id = Auth::id();
        $orders = Order::where('id', $id)->first();
        $check = $orders->user_id == $user_id;
        if ($check) {
            $ticket = Order::where('id', $id)->with('event')->first();


            return view('tickets.PurchasedTicket', compact('ticket'));
        } else {
            abort(403, 'Unauthorized');
        }
    }
}
