<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        // Store the image path in a config file for simplicity
        $configPath = config_path('introImages.php');
        $images = include $configPath;
        $images[$section] = $imageName;
        file_put_contents($configPath, '<?php return ' . var_export($images, true) . ';');

        return redirect()->back()->with('success', 'Image uploaded successfully.');
    }
}
