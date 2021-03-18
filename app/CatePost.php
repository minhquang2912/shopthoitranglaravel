<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatePost extends Model
{
     public $timestamps = false; // không cho chạy (để là false) (timestamps:created_at &updated_at) (set time to false)
    //fillable: trong này là các cột trong csdl mà ta có thể insert,thao tác vs chúng 
    protected $fillable = [
       'cate_post_name','cate_post_status','cate_post_slug','cate_post_desc']; // table có cột nào thì cho hết các cột đó vào đây
    protected $primaryKey='cate_post_id'; // đây là khóa chính (nếu ta k có dòng này nó chỉ hiểu khóa chính là id chứ kphai là brand_id )
    protected $table= 'tbl_category_post'; // tên table
}
