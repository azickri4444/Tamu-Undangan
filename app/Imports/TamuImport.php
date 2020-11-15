<?php

namespace App\Imports;

use App\Tamu;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TamuImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Tamu([
            'nama' => $row['nama'],
            'instansi' => $row['instansi'],
            'status' => $row['status'],
        ]);
    }
}