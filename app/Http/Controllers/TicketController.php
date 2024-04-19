<?php

namespace App\Http\Controllers;

use App\Models\Performance;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function create($performanceId)
    {
        $performance = Performance::findOrFail($performanceId);
        return view('tickets.create', compact('performance'));
    }

    public function store(Request $request, $performanceId)
    {
        $performance = Performance::findOrFail($performanceId);

        $validatedData = $request->validate([
            'buyer_name' => 'required|max:255',
            'buyer_email' => 'required|email|max:255',
            'amount' => 'required|integer|min:1'
        ]);

        if ($performance->tickets_remaining < $request->amount) {
            return back()->withErrors(['amount' => 'There are not enough tickets available.']);
        }

        $ticket = new Ticket($validatedData);
        $ticket->performance_id = $performance->id;
        $ticket->unique_number = mt_rand(1000, 9999); // Generate a random 4-digit number
        $ticket->save();

        $performance->tickets_remaining -= $request->amount;
        $performance->save();

        return redirect()->route('performances.show', $performance->id);
    }

}
