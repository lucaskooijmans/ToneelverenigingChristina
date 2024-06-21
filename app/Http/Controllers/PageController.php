<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;

class PageController extends Controller
{
    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'section' => 'required|string',
        ]);

        $section = $request->input('section');
        $imageName = $section . '_' . time() . '.' . $request->image->extension();
        $request->image->storeAs('public/introImages', $imageName);

        $jsonPath = resource_path('intro.json');
        $images = json_decode(file_get_contents($jsonPath), true);
        $images[$section] = $imageName;
        file_put_contents($jsonPath, json_encode($images, JSON_PRETTY_PRINT));

        return redirect()->back()->with('success', 'Image uploaded successfully.');
    }
}
