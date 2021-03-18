<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
     public $timestamps = false; // không cho chạy (để là false) (timestamps:created_at &updated_at) (set time to false)
    //fillable: trong này là các cột trong csdl mà ta có thể insert,thao tác vs chúng 
    protected $fillable = [
       'provider_user_id','provider','user']; // table có cột nào thì cho hết các cột đó vào đây
    protected $primaryKey='user_id'; // đây là khóa chính (nếu ta k có dòng này nó chỉ hiểu khóa chính là id chứ kphai là user_id )
    protected $table= 'tbl_social'; // tên table
   
   // khai báo mối quan hệ với table admin
    public function login(){
    	return $this->belongsTo('App\Login', 'user');
    }
}
