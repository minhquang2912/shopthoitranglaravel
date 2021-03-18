<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Session;
use App\Slider;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Post;
use App\CatePost; // ta sẽ sử dụng danh mục bài viết ở bài viết
session_start();

class PostController extends Controller
{
     public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_post(){
        $this->AuthLogin();
        $cate_post =CatePost::orderby('cate_post_id','DESC')->get(); // get là lấy hết tất cả

       

       // return view('admin.post.add_post')->with('cate_post', $cate_post);
    	return view('admin.post.add_post')->with(compact('cate_post'));

    }
    public function save_post(Request $request){
         $this->AuthLogin();
    	$data = $request->all();
    	$post = new Post();
    	// bên trái là các cột trong csdl , bên phải là các data ở giao diện gửi qua(trường name gửi qua?)
    	$post->post_title = $data['post_title'];
    	$post->post_slug = $data['post_slug'];
    	$post->post_desc = $data['post_desc'];
    	$post->post_content = $data['post_content'];
    	$post->post_meta_desc = $data['post_meta_desc'];
    	$post->post_meta_keywords = $data['post_meta_keywords'];
    	$post->cate_post_id = $data['cate_post_id'];
    	$post->post_status = $data['post_status'];

        $get_image = $request->file('post_image');
      
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName(); // lấy tên của hình ảnh
            $name_image = current(explode('.',$get_name_image)); // lấy tên hình ảnh (lấy các kí tự trước dấu . (tên của 1 file)) ; current: lấy đằng trước dấu chấm , end: lấy kí tự đằng sau dấu chấm
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension(); // sau khi lấy đc tên 1 file thì ghép với số ngâu nhiên ()
            $get_image->move('public/uploads/post',$new_image); // đường dẫn chứa ảnh và tên mà nó ms tạo ra
            
            $post->post_image = $new_image; // lưu tên mới của ảnh vào csdl

            $post->save();
            Session::put('message','Thêm bài viết thành công');
            return Redirect()->back();
        } else{ // bắt buộc phải có thêm hình ảnh thì ms cho thêm bài viết mới 
        	 Session::put('message','Làm ơn thêm hình ảnh');
            return Redirect()->back();

        }
       
    }
    public function all_post(){
        $this->AuthLogin();

    	$all_post = Post::orderby('post_id')->paginate(10); // 10 bài viết trên mỗi trang
        
    	
    	//return view('admin.p')->with('admin.all_product', $manager_product);
         return view('admin.post.list_post')->with(compact('all_post',$all_post)); // compact với biến lấy ra từ csdl luôn
    }

    public function delete_post($post_id){
        $this->AuthLogin();
        $post= Post::find($post_id);

        //trc h chỉ xóa được ở web thôi chứ thư mục gốc k xóa đc h ta sẽ khai báo cho nó xóa đc cả ở thư mục:
        $post_image= $post->post_image;
        if($post_image){ // nếu có hình ảnh
        $path='public/uploads/post/'.$post_image;
        unlink($path);
         }
        $post->delete();

        Session::put('message','Xóa bài viết thành công');
        return redirect()->back();
    }
    
    
    // public function edit_product($product_id){
    //      $this->AuthLogin();
    //     $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get(); 
    //     $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get(); 

    //     $edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get();

    //     $manager_product  = view('admin.edit_product')->with('edit_product',$edit_product)->with('cate_product',$cate_product)->with('brand_product',$brand_product);

    //     return view('admin_layout')->with('admin.edit_product', $manager_product);
    // }
    // public function update_product(Request $request,$product_id){
    //      $this->AuthLogin();
    //     $data = array();
    //     $data['product_name'] = $request->product_name;
    //     $data['product_quantity'] = $request->product_quantity;
    //     $data['product_slug'] = $request->product_slug;
    //     $data['product_price'] = $request->product_price;
    //     $data['product_desc'] = $request->product_desc;
    //     $data['product_content'] = $request->product_content;
    //     $data['category_id'] = $request->product_cate;
    //     $data['brand_id'] = $request->product_brand;
    //     $data['product_status'] = $request->product_status;
    //     $get_image = $request->file('product_image');
        
    //     if($get_image){
    //                 $get_name_image = $get_image->getClientOriginalName();
    //                 $name_image = current(explode('.',$get_name_image));
    //                 $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
    //                 $get_image->move('public/uploads/product',$new_image);
    //                 $data['product_image'] = $new_image;
    //                 DB::table('tbl_product')->where('product_id',$product_id)->update($data);
    //                 Session::put('message','Cập nhật sản phẩm thành công');
    //                 return Redirect::to('all-product');
    //     }
            
    //     DB::table('tbl_product')->where('product_id',$product_id)->update($data);
    //     Session::put('message','Cập nhật sản phẩm thành công');
    //     return Redirect::to('all-product');
    // }
    public function danh_muc_bai_viet(Request $request ,$post_slug){
    	 // do ta đang muốn hiển thị ngoài trang chủ nên ta phải khai báo các thứ liên quan đến trang chủ ở đây:

    	 //category_post:
         $category_post = CatePost::orderBy('cate_post_id','DESC')->get();
    	 //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
    

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get(); 
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get(); 

        $catepost= CatePost::where('cate_post_slug',$post_slug)->take(1)->get(); // take 1 giống như first()
        foreach($catepost as $key => $cate){
         //seo 
        
        $meta_desc = $cate->cate_post_desc; 
        $meta_keywords = $cate->cate_post_slug;
        $meta_title = $cate->cate_post_name;
        $cate_id = $cate->cate_post_id;
        $url_canonical = $request->url();
        //--seo

    }
        $post= Post::with('cate_post')->where('post_status',0)->where('cate_post_id',$cate_id)->paginate(10);

        return view('pages.baiviet.danhmucbaiviet')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('post',$post)->with('category_post',$category_post);

    	

    }
    public function bai_viet(Request $request ,$post_slug){
    	 //category_post:
         $category_post = CatePost::orderBy('cate_post_id','DESC')->get();
    	 //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
    

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get(); 
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get(); 
        $post= Post::with('cate_post')->where('post_status',0)->where('post_slug',$post_slug)->take(1)->get();// lấy 1 bài viết

        foreach($post as $key => $p){
         //seo 
        
        $meta_desc = $p->post_meta_desc; 
        $meta_keywords = $p->post_meta_keywords;
        $meta_title = $p->post_title;
        $cate_id = $p->cate_post_id;
        $url_canonical = $request->url();
        $cate_post_id = $p->cate_post_id;
        //--seo

    }
    //wherenotIn:lấy ra bài viết liên quan nhưng mà trừ bài viết đang mở , lấy những bài viết có cùng danh mục bài viết
    $related= Post::with('cate_post')->where('post_status',0)->where('cate_post_id', $cate_post_id)->wherenotIn('post_slug',['$post_slug'])->take(5)->get(); // lấy tối đa 5 bài

        return view('pages.baiviet.baiviet')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('post',$post)->with('category_post',$category_post)->with('related',$related);
    }
    
}
