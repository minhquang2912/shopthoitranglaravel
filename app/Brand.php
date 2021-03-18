<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{    
    public $timestamps = false; // không cho chạy (để là false) (timestamps:created_at &updated_at) (set time to false)
    //fillable: trong này là các cột trong csdl mà ta có thể insert,thao tác vs chúng 
    protected $fillable = [
       'brand_name','brand_slug','brand_desc','brand_status']; // table có cột nào thì cho hết các cột đó vào đây
    protected $primaryKey='brand_id'; // đây là khóa chính (nếu ta k có dòng này nó chỉ hiểu khóa chính là id chứ kphai là brand_id )
    protected $table= 'tbl_brand'; // tên table

   
}
