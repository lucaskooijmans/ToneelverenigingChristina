<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use Illuminate\Http\Request;

class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sponsors = Sponsor::orderBy('position', 'asc')->get();
        return view('sponsors.index', compact('sponsors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sponsors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'url' => 'required',
            'logo' => 'image|nullable',
        ]);
        
        $path = null;
        if($request->hasFile('logo') && $request->file('logo')->isValid()) {
            $path = $request->logo->store('images', 'public');
        
        }

        Sponsor::create([
            'name' => $request->name,
            'url' => $request->url,
            'logo' => $path,
        ]);

        return redirect()->route('sponsors.index');
    }

    public function updateOrder(Request $request)
    {
        foreach ($request->order as $position => $id) {
            Sponsor::where('id', $id)->update(['position' => $position]);
        }

        return response()->json(['status' => 'success'], 200);
    }


    /**
     * Display the specified resource.
     */
    public function show(Sponsor $sponsor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sponsor $sponsor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sponsor $sponsor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sponsor $sponsor)
    {
        //
    }
}
