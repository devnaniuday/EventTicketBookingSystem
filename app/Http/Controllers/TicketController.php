<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    // Show all the ticket to the user Dashboard
    public function ShowAllTickets(Request $request)
    {
        $sortBy = $request->query('sort_by');

        // Default sorting if no option is selected
        $sortBy = $sortBy ?: 'date_asc';

        $tickets = Events::query();

        switch ($sortBy) {
            case 'date_asc':
                $tickets->orderBy('updated_at', 'desc');
                break;
            case 'date_desc':
                $tickets->orderBy('updated_at', 'asc');
                break;
            case 'price_asc':
                $tickets->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $tickets->orderBy('price', 'desc');
                break;
            default:
                // Default sorting
                $tickets->orderBy('updated_at', 'asc');
        }
        // Search functionality
        $searchTerm = $request->query('search');
        if ($searchTerm) {
            $tickets->where('name', 'like', '%' . $searchTerm . '%')
                ->orWhere('venue', 'like', '%' . $searchTerm . '%')
                ->orWhere('price', 'like', '%' . $searchTerm . '%');
        }

        $tickets = $tickets->paginate(10);

        return view('dashboard', ['tickets' => $tickets]);
    }

    // Show the Specific Ticket 
    public function TicketInfo($id)
    {
        $ticket = Events::where('id', $id)->first();
        return view('tickets.TicketInfo', compact('ticket'));
    }

    // Show Ticket order of the user 
    public function UserTicketOrder()
    {
        return view('tickets.UserTicketOrder');
    }
}
