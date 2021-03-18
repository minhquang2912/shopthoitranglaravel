<?php

namespace App\Exports;

use App\CategoryProductModel;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExcelExports implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CategoryProductModel::all(); // trả về dữ liệu chứa trong model CategoryProduct(tức là dữ liệu trong bảng category product)
    }
}
