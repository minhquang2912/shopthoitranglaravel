<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'name'
    ];
    protected $primaryKey = 'id_roles';
 	protected $table = 'tbl_roles';

// khai báo như này là 1 role sẽ có nhiều user
 	public function admin(){
 		return $this->belongsToMany('App\Admin');
 	}
}
