<?php

namespace App\Http\Controllers;

use App\Models\Performance;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PerformanceController extends Controller
{
    public function index()
    {
        $performances = Performance::all();
        return view('performances.index', ['performances' => $performances]);
    }

    public function create()
    {
        return view('performances.create');
    }

    public function store(Request $request)
    {
        if($request->edit){
            $performance = Performance::find($request->id);

            $formFields = $request->all();

            if($request->hasFile('image')){
                $imageName = time().'.'.$request->image->extension();
                $request->image->move(public_path('images'), $imageName);
                $formFields['image'] = $imageName;
            }

            $performance->update($formFields);
            return $this->index();
        } else {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'starttime' => 'required|date',
                'endtime' => 'required|date|after:starttime',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'location' => 'required|string',
                'available_seats' => 'required|integer',
                'price' => 'required|numeric',
            ]);

            $formFields = $request->all();

            if($request->hasFile('image')){
                $imageName = time().'.'.$request->image->extension();
                $request->image->move(public_path('images'), $imageName);
                $formFields['image'] = $imageName;
            }

            $performance = Performance::create($formFields);
            $performance->tickets_remaining = $request->available_seats;
            $performance->save();

            return redirect()->route('performances.index');
        }
    }

    public function edit(Request $request, $id)
    {
        $edit = true;
        $performance = Performance::findOrFail($id);
        return view('performances.create', compact('performance', 'edit'));
    }

    public function delete($id)
    {
        $performance = Performance::find($id);
        $performance->delete();
        return $this->index();
    }

    public function calendar()
    {
        $performances = Performance::where('endtime', '>=', Carbon::now())->get();

        $events = [];
        foreach ($performances as $performance) {
            $events[] = [
                'id' => $performance->id,
                'title' => $performance->name,
                'description' => $performance->description,
                'start' => $performance->starttime,
                'end' => $performance->endtime,
                'available_seats' => $performance->available_seats
                // You can add more event properties if needed
            ];
        }

        return view('performances.calendar', compact('events'));
    }

    public function show($id)
    {
        $performance = Performance::findOrFail($id);
        return view('performances.show', compact('performance'));
    }

}
