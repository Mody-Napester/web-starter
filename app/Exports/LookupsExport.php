<?php

namespace App\Exports;

use App\Models\Lookup;
use Maatwebsite\Excel\Concerns\FromCollection;

class LookupsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Lookup::all();
    }
}
