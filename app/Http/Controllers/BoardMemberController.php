<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BoardMember;

class BoardMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $boardMembers = BoardMember::all();
        return view('board_members.index', compact('boardMembers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('board_members.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:board_members,email',
            'phone' => 'required',
            'description' => 'required',
            'image_url' => 'required|url',
        ]);

        $data = $request->except('_token');
        
        BoardMember::create($request->all());
        return redirect()->route('board-members.index')
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
        //
    }
}
