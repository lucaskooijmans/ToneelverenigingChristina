<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->check() && auth()->user()->isAdmin()) {
            // Admins get to see all sponsors, regardless of their active status
            $sponsors = Sponsor::orderBy('position', 'asc')->get();
        } else {
            // Non-admins see only active sponsors
            $sponsors = Sponsor::where('isActive', 1) // Assuming isActive is stored as 1 for true
                            ->orderBy('position', 'asc')
                            ->get();
        }

        return view('sponsors.index', compact('sponsors'));
    }

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
            'isActive' => true,
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
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $sponsor = Sponsor::findOrFail($id);
        return view('sponsors.edit', compact('sponsor'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'url' => 'required',
            'logo' => 'image|nullable',
            'isActive' => 'boolean'
        ]);
        
        $sponsor = Sponsor::findOrFail($id);
        $sponsor->name = $request->name;
        $sponsor->url = $request->url;
        $sponsor->isActive = $request->has('isActive') ? 1 : 0;
        
        if($request->hasFile('logo') && $request->file('logo')->isValid()) {
            Storage::delete('public/'.$sponsor->logo);
            $path = $request->logo->store('images', 'public');
            $sponsor->logo = $path;
        }

        $sponsor->save();

        return redirect()->route('sponsors.index')->with('success', 'Sponsor updated successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sponsor $sponsor)
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
