<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SponsorCategoryController extends Controller
{
    public function create()
    {
        return view('sponsorcategory.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'categoryname' => 'required',
        ]);

        Sponsorcategory::create([
            'sponsorcategories' => $request->sponsorcategory,
        ]);

        return redirect()->route('sponsors.index');
    }
}
