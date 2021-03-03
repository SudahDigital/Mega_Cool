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
            'phone_owner'=>$row[4]=='NULL' ? null : $row[4],
            'phone_store'=>$row[5]=='NULL' ? null : $row[5],
            'name' => $row[6]=='NULL' ? null : $row[6],
            'payment_term'=>$row[7]=='NULL' ? null : $row[7],
            'user_id'=>$row[8]=='NULL' ? null : $row[8],
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
