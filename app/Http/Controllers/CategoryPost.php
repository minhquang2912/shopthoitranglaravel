<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Slider;
use Auth;
use App\CategoryProductModel;
use Session;
use App\Http\Requests;
use App\CatePost;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryPost extends Controller
{
	 public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function add_category_post(){
        $this->AuthLogin();
    	return view('admin.category_post.add_category');
    }
      public function save_category_post(Request $request){
        $this->AuthLogin();
    	$data = $request->all();
    	// tạo mới bài viết
    	$category_post= new CatePost();
    	// bên trái là csdl bên phải là biến lấy dữ liệu từ form
    	$category_post->cate_post_name = $data['cate_post_name'];
        $category_post->cate_post_slug = $data['cate_post_slug'];
        $category_post->cate_post_desc = $data['cate_post_desc'];
        $category_post->cate_post_status = $data['cate_post_status'];
        $category_post->save();// đưa dữ liệu vào csdl bằng lệnh save

    	
    	Session::put('message','Thêm danh mục sản phẩm thành công');
    	return Redirect()->back();
    }
    public function all_category_post(){
        $this->AuthLogin();
    	
    	$category_post= CatePost::orderBy('cate_post_id','DESC')->paginate(5); // 5 danh mục trên mỗi trang, nếu dùng get thì k phân trang

    	
    	
    	//return view('admin.category_post')->with('admin.all_category_product', $manager_category_product);
         return view('admin.category_post.list_category')->with(compact('category_post'));

    }
  
  
    public function edit_category_post($category_post_id){
        $this->AuthLogin();
// sử dụng phg thức là find thì ko thực hiện vòng lặp foreach nữa (find là tìm 1 danh mục sp thôi dựa trên id)
        $category_post= CatePost::find($category_post_id);

       
        return view('admin.category_post.edit_category')->with(compact('category_post'));
      } 

     public function update_category_post(Request $request, $cate_id){
     	
     	 $data = $request->all();
     	 $category_post = CatePost::find($cate_id);
     	
    	// bên trái là csdl bên phải là biến lấy dữ liệu từ form
    	$category_post->cate_post_name = $data['cate_post_name'];
        $category_post->cate_post_slug = $data['cate_post_slug'];
        $category_post->cate_post_desc = $data['cate_post_desc'];
        $category_post->cate_post_status = $data['cate_post_status'];
        $category_post->save();// đưa dữ liệu vào csdl bằng lệnh save

        Session::put('message','Cập nhật danh mục bài viết thành công');
    	return Redirect()->back();

     }
     public function delete_category_post($cate_id){
     	$category_post = CatePost::find($cate_id);
     	$category_post->delete();
     	 Session::put('message','Xóa danh mục bài viết thành công');
    	return Redirect()->back();	
     }
  
   
}
