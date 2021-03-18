<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false; // không cho chạy (để là false) (timestamps:created_at &updated_at) (set time to false)
    //fillable: trong này là các cột trong csdl mà ta có thể insert,thao tác vs chúng 
    protected $fillable = [
       'customer_id','shipping_id','order_status','order_code','created_at']; // table có cột nào thì cho hết các cột đó vào đây
    protected $primaryKey='order_id'; // đây là khóa chính (nếu ta k có dòng này nó chỉ hiểu khóa chính là id chứ kphai là brand_id )
    protected $table= 'tbl_order'; // tên table

  
}
