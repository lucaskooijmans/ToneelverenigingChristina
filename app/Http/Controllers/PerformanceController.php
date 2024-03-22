<?php

namespace App\Http\Controllers;

use App\Models\Performance;
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