<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
use Illuminate\Support\Facades\Route; // kiểm tra tất cả route có nhiệm vụ gì
class AccessPermission
{  
    //KHÔNG SỬ DỤNG MODEL TRONG MIDDLEWARE
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //Auth::user() nó là model Admin rồi , rồi sau đó nó lấy ra hàm hasRole 
        if(Auth::user()->hasAnyRoles(['admin','author'])){// nếu có quyền admin
           return $next($request);
        }
        return redirect('/dashboard'); // nếu k có quyền admin thì sẽ bị đá về dashboard
    }
}
