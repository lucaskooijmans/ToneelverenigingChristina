<?php

namespace App\Http\Controllers;

use App\Models\Bestuursleden;
use App\Models\Bestuurslid;
use Illuminate\Http\Request;
use App\Models\BoardMember;

class BestuursledenController extends Controller
{

    // TODO: ADD ADMIN AUTHENTICATION

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
        return view('bestuursleden.create');
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
        ]);

        $data = $request->except('_token');

        Bestuursleden::create($request->all());
        return redirect()->route('bestuursleden.index')
                         ->with('success', 'Board member created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bestuurslid = Bestuursleden::findOrFail($id);
        $bestuurslid->delete();

        return redirect()->route('bestuursleden.index')
                        ->with('success', 'Bestuurslid succesvol verwijderd.');
    }
}
