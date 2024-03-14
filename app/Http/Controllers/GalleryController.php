<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $photos = Photo::latest()->get();
        return view('gallery.index', compact('photos'));
    }

    public function create()
    {
        if (Gate::allows('isAdmin')) {
            return view('gallery.create');
        } else {
            return redirect()->route('gallery.index')->with('error', 'Unauthorized action');
        }
    }

    public function store(Request $request)
    {
        $formFields = $request->all();
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required',
            'description' => 'required',
        ]);

        if($request->hasFile('image')){
            $formFields['image'] = $request->file('image')->store('images', 'public');
        }

        $request->image->move(public_path('images'));

        Photo::create([
            'image' => $formFields['image'],
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('gallery.index')->with('success', 'Photo added successfully');
    }

    public function edit($id)
    {
        $photo = Photo::findOrFail($id);

        if (Gate::allows('isAdmin')) {
            return view('gallery.edit', compact('photo'));
        } else {
            return redirect()->route('gallery.index')->with('error', 'Unauthorized action');
        }
    }

    public function update(Request $request, $id)
    {
        $photo = Photo::findOrFail($id);

        if (Gate::allows('isAdmin')) {
            $photo->title = $request->title;
            $photo->description = $request->description;
            $photo->save();

            return redirect()->route('gallery.index');
        } else {
            return redirect()->route('gallery.index')->with('error', 'Unauthorized action');
        }
    }

    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);

        if (Gate::allows('isAdmin')) {

            $tempphoto = $photo->image;
            Storage::disk('public')->delete($tempphoto);

            $photo->delete();

            return redirect()->route('gallery.index');
        } else {
            return redirect()->route('gallery.index')->with('error', 'Unauthorized action');
        }
    }
}