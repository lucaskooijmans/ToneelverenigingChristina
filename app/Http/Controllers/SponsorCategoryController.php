<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sponsorcategories;

class SponsorCategoryController extends Controller
{
    public function create()
    {
        return view('sponsorcategory.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'sponsorcategories' => 'required',
        ]);

        Sponsorcategories::create([
            'sponsorcategories' => $request->sponsorcategories,
        ]);

        return redirect()->route('sponsors.index');
    }
}
