<?php

namespace App\Exports;

use App\Product;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportProduct implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::all(); // trả về dữ liệu chứa trong model CategoryProduct(tức là dữ liệu trong bảng category product)
    }
}
