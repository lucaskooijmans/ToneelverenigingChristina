<?php

namespace App\Http\Controllers;

use App\Models\HistoryItem;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        $historyItems = HistoryItem::orderBy('date', 'desc')->get();
        return view('history.index', compact('historyItems'));
    }

    public function store(Request $request){
        $formFields = $request->all();
        $formFields['milestone'] = $request->boolean('milestone') ? 1 : 0;
        $formFields['contribution'] = $request->boolean('contribution') ? 1 : 0;
        if($request->date == null){
            $formFields['date'] = date('Y-m-d');
        }     
        else{
            $formFields['date'] = $request->date;
        }
        if($request->hasFile('image_path')){
            $formFields['image_path'] = $request->file('image_path')->store('images', 'public');
        }
        HistoryItem::create($formFields);
        return $this->index();
    }
}
