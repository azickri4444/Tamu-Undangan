<?php

namespace App\Exports;

use App\Tamu;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TamuExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): view
    {
        return view('export', [
            'tamu' => Tamu::all()
        ]);
    }
}