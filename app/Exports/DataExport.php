<?php

namespace App\Exports;

use App\Models\DataModel;
use Maatwebsite\Excel\Concerns\FromCollection;

class DataExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DataModel::all();
    }
}
