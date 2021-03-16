<?php

namespace App\Exports;

use App\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class CustomerExport implements FromCollection, WithMapping, WithHeadings, WithColumnFormatting
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Customer::all();
    }

    public function map($customer) : array {
        return[
                $customer->store_code,
                $customer->store_name,
                $customer->address,
                $customer->phone,
                $customer->phone_owner,
                $customer->phone_store,
                $customer->name,
                $customer->payment_term,
                /*$customer->user_id,*/
            ];
    }

    public function headings() : array {
        return [
           'Cust_Code',
           'Name',
           'Address',
           'Whatsapp',
           'Owner Phone',
           'Office/Shop Phone',
           'Contact',
           'Payment_Term',
           /*'Sales_Rep',*/
        ] ;
    }

    public function columnFormats(): array
    {
        return [
            'D' =>'0',
            'E' =>'0',
            'F' =>'0',
        ];
        
    }
}
