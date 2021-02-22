<?php

namespace App\Imports;

use App\Customer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CustomersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Customer([
            'store_code'=>$row['Search_Key'],
            'store_name' => $row['Name'],
            'address' => $row['Address'],
            'phone'=>$row['Phone'],
            'name' => $row['Contact'],
            'payment_term'=>$row['Payment_Term']
        ]);
    }
}
