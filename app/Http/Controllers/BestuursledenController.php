<?php

namespace App\Http\Controllers;

use App\Models\Bestuursleden;
use App\Models\Bestuurslid;
use Illuminate\Http\Request;
use App\Models\BoardMember;
use Illuminate\Support\Facades\Gate;

class BestuursledenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bestuursleden = Bestuursleden::all();
        return view('bestuursleden.index', compact('bestuursleden'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Gate::allows('isAdmin')) {
            return view('bestuursleden.create');
        } else {
            return redirect()->route('bestuursleden.index')->with('error', 'Unauthorized action');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:bestuursleden,email',
            'phone' => 'required',
            'description' => 'required',
            'image_url' => 'required|url',
        ], [
            'image_url.required' => 'Vul alstublieft de URL naar de foto in.',
            'image_url.url' => 'De URL naar de foto moet een geldige URL zijn die naar een foto leidt.',
        ]);

        Bestuursleden::create($request->all());
        return redirect()->route('bestuursleden.index')
                         ->with('success', 'Board member created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $bestuurslid = Bestuursleden::findOrFail($id);
        if (Gate::allows('isAdmin')) {
            return view('bestuursleden.edit', compact('bestuurslid'));
        } else {
            return redirect()->route('bestuursleden.index')->with('error', 'Unauthorized action');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $bestuurslid = Bestuursleden::findOrFail($id);
        if (Gate::allows('isAdmin')) {

            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'description' => 'required',
                'image_url' => 'required',
            ], [
                'image_url.required' => 'Vul alstublieft de URL naar de foto in.',
                'image_url.url' => 'De URL naar de foto moet een geldige URL zijn die naar een foto leidt.',
            ]);

            // Use update method to save the validated data

            $bestuurslid->name = $request->name;
            $bestuurslid->email = $request->email;
            $bestuurslid->phone = $request->phone;
            $bestuurslid->description = $request->description;
            $bestuurslid->image_url = $request->image_url;
            $bestuurslid->save();

            return redirect()->route('bestuursleden.index')->with('success', 'Bestuurslid succesvol bijgewerkt.');
        } else {
            return redirect()->route('bestuursleden.index')->with('error', 'Unauthorized action');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Gate::allows('isAdmin')) {
            $bestuurslid = Bestuursleden::findOrFail($id);
            $bestuurslid->delete();

            return redirect()->route('bestuursleden.index');
        } else {
            return redirect()->route('bestuursleden.index')->with('error', 'Unauthorized action');
        }
    }
}
