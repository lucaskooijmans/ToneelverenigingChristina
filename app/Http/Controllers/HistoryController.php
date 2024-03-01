<?php

namespace App\Http\Controllers;

use App\Models\HistoryItem;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        $historyItems = HistoryItem::orderBy('created_at', 'desc')->get();
        return view('history.index', compact('historyItems'));
    }
}
