<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TextEditController extends Controller
{
    public function index()
    {
        // get the json from en.json
        $messages = json_decode(file_get_contents(resource_path('lang/en.json')), true);

        // get the keys from en.json
        $keys = array_keys($messages);

        return view('texteditor', [
            'messages' => $messages,
            'keys' => $keys
        ]);
    }

    public function edit(Request $request)
    {
        // get the json from en.json
        $messages = json_decode(file_get_contents(resource_path('lang/en.json')), true);

        // get the keys from en.json
        $keys = array_keys($messages);

        // get the key from the request
        $key = $request->id;

        // get the value from the request
        $value = $request->text;

        // update the value in the messages array
        $messages[$key] = $value;

        // save the messages array to en.json
        file_put_contents(resource_path('lang/en.json'), json_encode($messages, JSON_PRETTY_PRINT));

        return view('texteditor', [
            'messages' => $messages,
            'keys' => $keys
        ]);
    }
}
