<?php

namespace App\Exports;

use App\Models\Quotation;
use Maatwebsite\Excel\Concerns\FromCollection;

class QuotationsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Quotation::all();
    }
}
