<?php

namespace App\Imports;

use App\Customer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class CustomersImport implements ToModel,  WithStartRow
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Customer([
            'store_code'=>$row[0]=='NULL' ? null : $row[0],
            'store_name' => $row[1]=='NULL' ? null : $row[1],
            'address' => $row[2]=='NULL' ? null : $row[2],
            'phone'=>$row[3]=='NULL' ? null : $row[3],
            'name' => $row[4]=='NULL' ? null : $row[4],
            'payment_term'=>$row[5]=='NULL' ? null : $row[5],
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
