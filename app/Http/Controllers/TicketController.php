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
            'buyer_first_name' => 'required|max:255|regex:/^[a-zA-ZÀ-ÿ\-\' ]+$/u',
            'buyer_last_name' => 'required|max:255|regex:/^[a-zA-ZÀ-ÿ\-\' ]+$/u',
            'buyer_email' => 'required|email|max:255',
            'amount' => 'required|integer|min:1'
        ]);

        if ($performance->tickets_remaining < $request->amount) {
            return back()->withErrors(['amount' => 'Er zijn niet genoeg kaartjes beschikbaar.']);
        }

        $fullName = $validatedData['buyer_first_name'] . ' ' . $validatedData['buyer_last_name'];

        $ticket = new Ticket([
            'buyer_name' => $fullName,
            'buyer_email' => $validatedData['buyer_email'],
            'amount' => $validatedData['amount']
        ]);
        $ticket->performance_id = $performance->id;
        $ticket->unique_number = mt_rand(1000, 9999); // Generate a random 4-digit number
        $ticket->save();

        $performance->tickets_remaining -= $request->amount;
        $performance->tickets_sold += $request->amount;
        $performance->save();

        return redirect()->route('performances.show', $performance->id);
    }
        

    public function updateTicketAmount(Request $request, $id)
    {
        $performance = Performance::findOrFail($id);
        $ticketChange = $request->input('ticket_change');
        if ($request->input('action') == 'add') {
            $performance->tickets_remaining += $ticketChange;
            $performance->tickets_added += $ticketChange;
        } elseif ($request->input('action') == 'remove') {
            if ($performance->tickets_remaining < $ticketChange) {
                return back()->withErrors(['ticket_change' => 'Het aantal kaartjes kan niet onder de 0 liggen.']);
            }
            $performance->tickets_remaining -= $ticketChange;
            $performance->tickets_removed += $ticketChange;
        }
        $performance->save();

        return redirect()->route('performances.show', $performance->id);
    }
}
