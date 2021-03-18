<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
     public $timestamps = false; 
    protected $fillable = [
       'gallery_name','gallery_image','product_id']; // table có cột nào thì cho hết các cột đó vào đây
    protected $primaryKey='gallery_id'; 
    protected $table= 'tbl_gallery'; // tên table
}
