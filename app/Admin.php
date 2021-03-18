<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Admin extends Authenticatable
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'admin_email', 'admin_password', 'admin_name','admin_phone'
    ];
    protected $primaryKey = 'admin_id';
 	protected $table = 'tbl_admin';
    // admin thì có thể thuộc nhiều quyền
 	public function roles(){
 		return $this->belongsToMany('App\Roles');
 	}

// lấy ra cột password bằng hàm getauthpassword
 	public function getAuthPassword(){
 		return $this->admin_password;
 	}
 	public function hasAnyRoles($roles){
 		return null !== $this->roles()->whereIn('name',$roles)->first();
 	}
 	public function hasRole($roles){
 		return null !== $this->roles()->where('name',$roles)->first();
 	}

 	
}
