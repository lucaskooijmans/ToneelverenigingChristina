<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\ServiceProvider;

class PDFController extends Controller
{
    public function generatePDF()
    {
        $data = [
            'title' => 'Voorstelling titel',
            'name' => 'Thomas Versteeg',
            'code' => '123ABX84',
            'price' => '€ 12,50',
            'quantity' => '2',
            'date' => date('m/d/Y')
        ];
        $pdf = Pdf::loadView('pdf.kaart', $data);
  
        return $pdf->stream('test.pdf');
    }

    public function openView()
    {
        $data = [
            'title' => 'Voorstelling titel',
            'name' => 'Thomas Versteeg',
            'code' => '123ABX84',
            'price' => '€ 12,50',
            'quantity' => '2',
            'date' => date('m/d/Y')
        ];
        return view('pdf.kaart', $data);
    }
}
