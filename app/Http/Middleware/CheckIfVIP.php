<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckIfVIP
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
       
    
        // Kiểm tra người dùng đã đăng nhập và có utype là VIP
        if (Auth::check() && Auth::user()->utype === 'VIP') {
            return $next($request);
        }

        // Nếu không phải VIP, trả về lỗi hoặc chuyển hướng
        return redirect()->route('index')->with('error', 'Bạn cần là thành viên VIP để truy cập nội dung này.');
    }
}
