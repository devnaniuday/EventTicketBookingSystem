<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Events;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    // Show All the event of the user
    public function ShowAllEvents()
    {
        $id = Auth::id();
        $events = Events::where('organizer_id', $id)->orderByDesc('updated_at')->paginate(5);
        return view('events.MyEvent', compact('events'));
    }

    // Show Create Event From
    public function ShowCreateEventPage()
    {
        return view('events.CreateEvent');
    }

    // Store Event Data to the Database
    public function createEvent(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'venue' => 'required|min:3',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i', // validate if the the event date is aftre the today or not 
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'about' => '',
            'image' => 'mimes:jpeg,png,jpg,gif,avif|max:10240',
        ]);
        // if the event has the image than it will store the image to the local folder in public/storage/event 
        if ($request->hasFile('image')) {
            $imagepath = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('event', $imagepath, 'public');
            $imagepath = 'event/' . $imagepath;
        } else {
            $imagepath = null;
        }
        $user = Auth::user();
        // change the date formate acoording to the database folder
        $date = Carbon::createFromFormat('m/d/Y', $request['date'], 'UTC')->format('Y-m-d');
        $organizer_id = $user->id;
        Events::create([
            "name" => $request['name'],
            "venue" => $request['venue'],
            "date" => $date,
            "time" => $request['time'],
            "price" => $request['price'],
            "quantity" => $request['quantity'],
            "about" => $request['about'],
            "image" => $imagepath,
            'organizer_id' => $organizer_id,
        ]);
        return redirect()->route("event")->with('success', 'Event created successfully!');
    }


    // Show Edit Event Form
    public function ShowUpdateEventPage($id)
    {
        $event = Events::findOrFail($id);
        $date = $event->date;
        $time = $event->time;
        // Change the formate of the date and time for the display inthe input box 
        $newTime = Carbon::createFromFormat('H:i:s', $time)->format('H:i');
        $newDate = Carbon::createFromFormat('Y-m-d', $date)->format('m/d/Y');
        return view('events.UpdateEvent', compact('event', 'newTime', 'newDate'));
    }

    // Update the Event Data 
    public function UpdateEvent($id, Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'venue' => 'required|min:3',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'about' => '',
            'imageUpadte' => 'mimes:jpeg,png,jpg,gif,avif|max:10240',
        ]);
        // we upload the image fike than it will update the image path to the database. if the user does not provide the new image than it will not change the image and keep the old image as it is in the database.
        if ($request->hasFile('imageUpadte')) {
            $imagepath = $request->file('imageUpadte')->getClientOriginalName();
            $request->file('imageUpadte')->storeAs('event', $imagepath, 'public');
            $imagepath = 'event/' . $imagepath;
            Events::where('id', $id)->update([
                'image' => $imagepath,
            ]);
        }
        // Change the formate of the date from the input box according to the database formate.
        $date = Carbon::createFromFormat('m/d/Y', $request['date'])->format('Y-m-d');
        Events::where('id', $id)->update([
            "name" => $request['name'],
            "venue" => $request['venue'],
            "time" => $request['time'],
            "date" => $date,
            "price" => $request['price'],
            "quantity" => $request['quantity'],
            "about" => $request['about'],
        ]);
        return redirect()->route("event")->with('success', 'Event Updated successfully!');
    }

    // Delete the Event of user if any other user bought the event ticket then it will not delete event 
    public function deleteEvent($id)
    {
        $Order = Order::where('event_id', $id)->first();
        // If the event is not sold out yet than we can delete that event otherwise we can not delete that event 
        if ($Order) {
            return redirect('event')->with('error', 'Someone Has Purchesed Your Ticket You Can not Deleted it now!!');
        } else {
            Events::where('id', $id)->delete();
            return redirect('event')->with('error', 'Event Deleted successfully!');
        }
    }
}
