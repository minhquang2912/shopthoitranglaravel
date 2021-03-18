@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
       
                        <h2 style="margin:0;position: inherit;font-size: 22px" class="title text-center">{{$meta_title}}</h2>
                        
                           <div class="product-image-wrapper">
                             @foreach($post as $key =>$p)
                                <div class="single-products" style="margin:10px 0; padding: 2px">
                                        {!!$p->post_content!!}
                                      
                                </div>
                             @endforeach  
                              
                            </div>
                          
                 </div>     
        <h2 style="margin:0;position: inherit;font-size: 22px" class="title text-center">BÀI VIẾT LIÊN QUAN</h2>
        <style type="text/css">
           ul.post_relate li{
              list-style-type:disc;
              font-size:16px;
              padding:6px;
           }
           ul.post_relate li a{
              color:#000;
           }
           ul.post_relate li a:hover{
              color:#FE980F;
           }

        </style>

        <ul class="post_relate">
            @foreach($related as $key => $post_relate)
            <li><a href="{{url('/bai-viet/.$post_relate->post_slug')}}">{{$post_relate->post_title}}</a></li>
            @endforeach
        </ul>
                      
@endsection