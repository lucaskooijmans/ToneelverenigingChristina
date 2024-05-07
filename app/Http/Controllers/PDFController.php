<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\ServiceProvider;
use Illuminate\Support\Facades\Storage;

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

    public static function createPDF($pdfFileName, $title, $name, $code, $price, $quantity, $date)
    {
        $data = [
            'title' => $title,
            'name' => $name,
            'code' => $code,
            'price' => $price,
            'quantity' => $quantity,
            'date' => $date
        ];
        $pdf = Pdf::loadView('pdf.kaart', $data);
        Storage::put($pdfFileName, $pdf->download()->getOriginalContent());
    }
}
