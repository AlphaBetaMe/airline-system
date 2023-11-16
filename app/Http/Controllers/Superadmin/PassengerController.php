<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Mail\FlightApproved;
use App\Mail\FlightCanceled;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class PassengerController extends Controller
{
    public function index()
    {
        $tickets = Booking::where('status', '0')->get(); 
        return view('superadmin.passenger.index', compact('tickets'));
    }

    public function show($id)
    {
        $ticket = Booking::findOrFail($id);
        $tickets = [$ticket];
        return view('superadmin.passenger.details', compact('tickets'));
    }
   
    public function updateTicket(Request $request, $id) {
        $ticket = Booking::findOrFail($id);
        $previousStatus = $ticket->status; // Store the previous status for comparison
        $ticket->status = $request->status;
        $ticket->save();
    
        if ($request->status == 1 && $previousStatus != 1) {
            // Send approval email to the passenger
            Mail::to($ticket->user->email)->send(new FlightApproved($ticket));
        } elseif ($request->status == 2 && $previousStatus != 2) {
            // Send cancellation email to the passenger
            $reason = $request->input('cancellation_reason');
            Mail::to($ticket->user->email)->send(new FlightCanceled($ticket, $reason));
        }
    
        return redirect('superadmin/passenger-history')->with('success', 'Reservation Updated Successfully');
    }

    public function history()
    {
        $tickets = Booking::whereIn('status', ['1', '2'])->get();
        return view('superadmin.passenger.history', compact('tickets'));
    }
    
}
