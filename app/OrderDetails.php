<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    public $timestamps = false; // không cho chạy (để là false) (timestamps:created_at &updated_at) (set time to false)
    //fillable: trong này là các cột trong csdl mà ta có thể insert,thao tác vs chúng 
    protected $fillable = [
       'order_code','product_id','product_name','product_price','product_sales_quantity','product_coupon','product_feeship']; // table có cột nào thì cho hết các cột đó vào đây
    protected $primaryKey='order_details_id'; // đây là khóa chính (nếu ta k có dòng này nó chỉ hiểu khóa chính là id chứ kphai là brand_id )
    protected $table= 'tbl_order_details'; // tên table
     public function product(){
    	return $this->belongsTo('App\Product','product_id'); // vì mỗi sp trong cthd thuộc 1sp trong bảng Product
    }
}
