<?php

namespace App\Http\Controllers;

use App\Models\Bestuursleden;
use Illuminate\Http\Request;
use App\Models\BoardMember;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class BoardmembersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bestuursleden = BoardMember::all();
        return view('boardmembers.index', compact('bestuursleden'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Gate::allows('isAdmin')) {
            return view('boardmembers.create');
        } else {
            return redirect()->route('boardmembers.index')->with('error', 'Unauthorized action');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:boardmembers,email',
            'phone' => 'nullable',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'image.image' => 'De afbeeldingen moeten een jpeg, png of jpg zijn',
        ]);

        $path = $request->file('image')->store('images', 'public');

        $boardMember = new BoardMember([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'description' => $request->description,
            'image_url' => $path,
        ]);

        $boardMember->save();

        return redirect()->route('boardmembers.index')
                        ->with('success', 'Board member created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $bestuurslid = BoardMember::findOrFail($id);
        if (Gate::allows('isAdmin')) {
            return view('boardmembers.edit', compact('bestuurslid'));
        } else {
            return redirect()->route('boardmembers.index')->with('error', 'Unauthorized action');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $boardMember = BoardMember::findOrFail($id);
        if (Gate::allows('isAdmin')) {

            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:boardmembers,email,' . $id . ',id',
                'phone' => 'nullable',
                'description' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',]);

            $boardMember->name = $request->name;
            $boardMember->email = $request->email;
            $boardMember->phone = $request->phone;
            $boardMember->description = $request->description;

            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                if (!empty($boardMember->image_url)) {
                    Storage::disk('public')->delete($boardMember->image_url);
                }
                $path = $request->file('image')->store('images', 'public');
                $boardMember->image_url = $path;
            }
            $boardMember->save();

            return redirect()->route('boardmembers.index')->with('success', 'Board member updated successfully.');
        } else {
            return redirect()->route('boardmembers.index')->with('error', 'Unauthorized action.');
        }
    }

    public function destroy(string $id)
    {
        if (Gate::allows('isAdmin')) {
            $bestuurslid = BoardMember::findOrFail($id);
            $bestuurslid->delete();

            return redirect()->route('boardmembers.index');
        } else {
            return redirect()->route('boardmembers.index')->with('error', 'Unauthorized action');
        }
    }
}
