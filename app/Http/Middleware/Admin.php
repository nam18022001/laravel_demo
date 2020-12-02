<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        
        if (Auth::check()) {
            # code...
            $user = Auth::user();
            if ($user->quyen == 1) {
                # code...
                return $next($request);
            
            }else {
                # code...
                return redirect('admin/login')->with('errorquyen', 'Bạn không đủ đặc quyền');
            }
        }
        else
        {
            return redirect('admin/login')->with('errorno', 'Thay đổi đường link cũng không giúp được gì cho bạn đâu');
        }
    }
}
