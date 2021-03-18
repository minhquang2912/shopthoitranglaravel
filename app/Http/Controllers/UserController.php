<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use App\Roles;
use App\Admin;
use Session;
use Auth;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //Model admin kèm theo Roles , paginate: phân trang : hiển thị 5 user trên 1 trang
        $admin = Admin::with('roles')->orderBy('admin_id','DESC')->paginate(5);
        return view('admin.users.all_users')->with(compact('admin'));  // compact: nghĩa là biến admin ở trên 
    }
    public function add_users(){
        return view('admin.users.add_users');
    }
    public function delete_user_roles($admin_id){
        // trường hợp id: trường hợp mà ta đang đăng nhập nick này mà ta lại ấn xóa chính nick mình đang login thì ko đc:
        if(Auth::id()==$admin_id){
             return redirect()->back()->with('message','Không được quyền xóa chính mình');
        }
         $admin= Admin::find($admin_id); // tìm đến id 
         if($admin){ // nếu có tìm ra id của admin mình chọn
              $admin->roles()->detach(); // vào model Roles bằng hàm role ở trong model admin gỡ (detach) (có nghĩa là xóa cả dữ liệu ở trong bảng admin_roles)
               $admin->delete();
         }
        
        return redirect()->back()->with('message','Xóa user thành công');
    }
    public function assign_roles(Request $request){
       if(Auth::id()==$request->admin_id){
             return redirect()->back()->with('message','Bạn không được phân quyền chính mình');
        }
        // bên trái là csdl bên phải là dữ liệu ở form
        $user = Admin::where('admin_email',$data['admin_email'])->first(); // lấy email trong csdl so sánh vs email  
        $user->roles()->detach(); //detach: là nhổ các quyển ra (ngc lại attach: kết hợp)

        //nếu checked một trong các ô checkbox sau thì ta sẽ truyền(attach) cho nó quyền cho user tương ứng : 
        // vì ở trong 1 chuỗi nên ['']
        // phải request lần lượt
        if($request['author_role']){
           $user->roles()->attach(Roles::where('name','author')->first());     
        }
        if($request['user_role']){
           $user->roles()->attach(Roles::where('name','user')->first());     
        }
        if($request['admin_role']){
           $user->roles()->attach(Roles::where('name','admin')->first());     
        }
        return redirect()->back()->with('message','Cấp quyền thành công');
    }
    public function store_users(Request $request){
        $data = $request->all();
        $admin = new Admin();
        $admin->admin_name = $data['admin_name'];
        $admin->admin_phone = $data['admin_phone'];
        $admin->admin_email = $data['admin_email'];
        $admin->admin_password = md5($data['admin_password']);
        $admin->save();
        $admin->roles()->attach(Roles::where('name','user')->first());
        Session::put('message','Thêm users thành công');
        return Redirect::to('users');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



}
