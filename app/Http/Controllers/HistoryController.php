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
        if($request->edit){
            $historyItem = HistoryItem::find($request->id);
            $formFields = $request->all();
            $formFields['milestone'] = $request->boolean('milestone') ? 1 : 0;
            $formFields['contribution'] = $request->boolean('contribution') ? 1 : 0;
            $videoCode = substr($formFields['video_path'], strpos($formFields['video_path'], 'v=')+2);
            $formFields['video_path'] = $videoCode;
            if($request->date == null){
                $formFields['date'] = date('Y-m-d');
            }     
            else{
                $formFields['date'] = $request->date;
            }
            if($request->hasFile('image_path')){
                $formFields['image_path'] = $request->file('image_path')->store('images', 'public');
            }
            $historyItem->update($formFields);
            return $this->index();
        } else{
            $formFields = $request->all();
            $formFields['milestone'] = $request->boolean('milestone') ? 1 : 0;
            $formFields['contribution'] = $request->boolean('contribution') ? 1 : 0;
            $videoCode = substr($formFields['video_path'], strpos($formFields['video_path'], 'v=')+2);
            $formFields['video_path'] = $videoCode;
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

    public function create(){
        $edit = false;
        return view('history.create', compact('edit'));
    }

    public function edit($id){
        $edit = true;
        $historyItem = HistoryItem::find($id);
        return view('history.create', compact('edit', 'historyItem'));
    }

    public function delete($id){
        $historyItem = HistoryItem::find($id);
        $historyItem->delete();
        return $this->index();
    }

}
