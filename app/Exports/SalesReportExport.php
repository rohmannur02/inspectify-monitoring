<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SalesReportExport implements FromCollection, WithHeadings
{
    protected $orders;

    public function __construct($orders)
    {
        $this->orders = $orders;
    }

    public function collection()
    {
        return $this->orders;
    }


    public function headings(): array
    {
        // Tentukan judul kolom untuk header tabel Excel
        return [
            'Order ID',
            'Transaction Time',
            'Nama Kasir',
            'Payment Method',
            'Total Items',
            'Total Price',
            'Nominal Bayar',
            'Kembalian',
        ];
    }
}