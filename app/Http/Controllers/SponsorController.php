<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use App\Models\Sponsorcategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;



class SponsorController extends Controller
{
    // TODO: Sort op updated_at 
    public function index()
    {
        $categories = Sponsorcategories::with(['sponsors' => function($query) {
            if(auth()->check() && auth()->user()->isAdmin()) {
                $query->orderBy('position', 'asc')->orderBy('updated_at', 'desc');
            } else {
                $query->where('isActive', 1)->orderBy('position', 'asc');
            }
        }])->get();

        return view('sponsors.index', compact('categories'));
    }

    public function create()
    {
        $categories = Sponsorcategories::all();
        return view('sponsors.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'url' => 'required',
            'logo' => 'image|nullable',
            'category_id' => 'required|exists:sponsorcategories,id'
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
            'category_id' => $request->category_id,
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

    public function updateCategory(Request $request)
    {
       Log::debug('Update Category Request:', $request->all());


        $sponsor = Sponsor::findOrFail($request->sponsorId);
        $sponsor->category_id = $request->categoryId;
        $sponsor->save();

        return response()->json(['status' => 'success'], 200);
    }

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
        $sponsor->isActive = $request->input('isActive') == '1' ? 1 : 0;
        
        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
            Storage::delete('public/'.$sponsor->logo);
            $path = $request->logo->store('images', 'public');
            $sponsor->logo = $path;
        }
        
        $sponsor->save();
        
        return redirect()->route('sponsors.index')->with('success', 'Sponsor updated successfully');
        
    }

    public function destroy($id)
    {
        $sponsor = Sponsor::findOrFail($id);
        if ($sponsor->logo) {
            Storage::delete('public/' . $sponsor->logo);
        }
        $sponsor->delete();
    
        return redirect()->route('sponsors.index')->with('success', 'Sponsor successfully deleted.');
    }
    
    public function show(Sponsor $sponsor)
    {
        //
    }
}
