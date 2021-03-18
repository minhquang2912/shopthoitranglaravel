<?php

namespace App\Imports;

use App\CategoryProductModel;
use Maatwebsite\Excel\Concerns\ToModel;

class ExcelImports implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {  // rows này là cột trong file excel mình cần insert dữ liệu
        return new CategoryProductModel([
            'slug_category_product' => $row[0],
            'meta_keywords' => $row[1],
            'category_name' => $row[2],
            'category_desc' => $row[3],
            'category_status' => $row[4],
        ]);
    }
}
