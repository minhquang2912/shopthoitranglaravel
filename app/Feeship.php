<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feeship extends Model
{
     public $timestamps = false; //set time to false
    protected $fillable = [
    	'fee_matp', 'fee_maqh','fee_xaid','fee_feeship'
    ];
    protected $primaryKey = 'fee_id';
 	protected $table = 'tbl_feeship';
 // khai báo thuộc model feeship này thuộc về model city province, wards
 	// khi ta ghi belongsto như này mặc định nó sẽ lấy các khóa chính của các model City , Province ,Wards so sánh với các biến khai báo tương ứng ở dưới (thuộc về bảng feeship)
 	public function city(){
 		return $this->belongsTo('App\City','fee_matp'); //  cột fee_matp của bảng Feeship thuộc mãtp của bảng thành phố
  	}
 	public function province(){
 		return $this->belongsTo('App\Province','fee_maqh');
 	}
 	public function wards(){
 		return $this->belongsTo('App\Wards','fee_xaid');
 	}
 }
