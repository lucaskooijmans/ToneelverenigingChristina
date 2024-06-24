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

    public function edit($id)
    {
        $category = Sponsorcategories::findOrFail($id);
        return view('sponsorcategory.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Sponsorcategories::findOrFail($id);
        $category->update($request->all());
        return redirect()->route('sponsors.index');
    }

    public function destroy($id)
    {
        $category = Sponsorcategories::findOrFail($id);

        if ($category->sponsors()->exists()) {
            return redirect()->route('sponsors.index')
                ->with('error', 'Categorie kan niet worden verwijderd omdat er sponsors aan verbonden zijn.');
        }

        $category->delete();

        return redirect()->route('sponsors.index')
            ->with('success', 'Categorie succesvol verwijderd.');
    }
}
