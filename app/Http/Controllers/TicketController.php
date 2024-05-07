<?php

namespace App\Http\Controllers;

use App\Models\Performance;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class TicketController extends Controller
{
    public function create($performanceId)
    {
        $performance = Performance::findOrFail($performanceId);
        return view('tickets.create', compact('performance'));
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

    public function exportTickets($performanceId)
    {
        $performance = Performance::findOrFail($performanceId);
        $date = Carbon::parse($performance->starttime)->format('d-m-Y');
        $tickets = Ticket::where('performance_id', $performanceId)->orderBy('buyer_name')->get();
        $csvFileName = $performance->name . '_' . $date . '_tickets.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
        ];

        $handle = fopen('php://output', 'w');
        fputcsv($handle, ['Naam', 'Aantal', 'Email', 'Unieke code']);

        foreach ($tickets as $ticket) {
            fputcsv($handle, [$ticket->buyer_name, $ticket->amount, $ticket->buyer_email, $ticket->unique_number]);
        }

        fclose($handle);

        $success_status = 200;
        return Response::make('', $success_status, $headers);
    }
}
