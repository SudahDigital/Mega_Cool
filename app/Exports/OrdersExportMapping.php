<?php

namespace App\Exports;

use App\Order;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class OrdersExportMapping implements FromCollection, WithMapping, WithHeadings, WithColumnFormatting
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Order::with('products')->whereNotNull('customer_id')->get();
    }

    public function map($order) : array {
        $rows = [];
        foreach ($order->products as $p) {
            if(($p->pivot->discount_item != NULL)&&($p->pivot->discount_item > 0)){
                $diskon =$p->pivot->discount_item;
                $total= $p->pivot->price_item_promo * $p->pivot->quantity;
            }else{
                $diskon = 0;
                $total= $p->pivot->price_item * $p->pivot->quantity;
            }
            array_push($rows,[
                $order->id,
                $order->status,
                $order->customers->store_name,
                $order->customers->email,
                $order->customers->address,
                $order->customers->phone,
                $order->customers->store_name,
                $order->users->name,
                $p->Product_name,
                $p->pivot->quantity,
                $p->pivot->price_item,
                Carbon::parse($order->created_at)->toFormattedDateString()
            ]);
        }
        return $rows;
    }

    public function headings() : array {
        return [
           'Order Id',
           'Status',
           'Name',
           'Email',
           'Address',
           'Phone',
           'Contact Person',
           'Sales Rep',
           'Product',
           'Quantity',
           'Price',
           'Order Date'
        ] ;
    }

    public function columnFormats(): array
    {
        return [
            'F' =>'0',
        ];
        
    }
}
