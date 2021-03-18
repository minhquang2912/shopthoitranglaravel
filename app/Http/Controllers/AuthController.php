<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Roles;
use Auth;



class AuthController extends Controller
{
    public function register_auth(){
    	return view('admin.custom_auth.register');// trả về giao diện đăng kí
    }
    public function login_auth(){
    	return view('admin.custom_auth.login_auth');
    }
    public function logout_auth(){
    	Auth::logout();
    	return redirect('/login-auth')->with('message','Đăng xuất Authentication thành công');
    }
    public function login(Request $request){
          $this->validate($request,[
              'admin_email' =>'required|email|max:255',
              'admin_password' =>'required|max:255',
          ]);
          $data=$request->all();
          // nếu như ng dùng nhập vào đúng email vs pass:
          if(Auth::attempt(['admin_email' => $request->admin_email , 'admin_password' => $request->admin_password])){
              return redirect('/dashboard');
          }else{
          	return redirect('/login-auth')->with('message','Lỗi đăng nhập Authentication');
          }
    }
    // khi gửi dữ liệu qua form post trong controller hàm register này nó sẽ xử lí vc đó 
    public function register(Request $request){
        // gọi ra hàm kiểm tra:
        $this->validation($request); 
        // nếu ok rồi:
        $data= $request->all();
        $admin= new Admin();

        $admin->admin_name= $data['admin_name'];
        $admin->admin_phone= $data['admin_phone'];
        $admin->admin_email= $data['admin_email'];
        $admin->admin_password= md5($data['admin_password']);
        $admin->save();
        return redirect('/register-auth')->with('message','Đăng ký thành công');

    }
    // hàm để kiểm tra: kiểm tra các trường gửi qua có đúng yêu cầu hay k
    public function validation($request){
        return $this->validate($request,[
           'admin_name' => 'required|max:255',
           'admin_email' => 'required|email|max:255',
           'admin_phone' => 'required|max:255',
           'admin_password' => 'required|max:255',

        ]);
    }
}
