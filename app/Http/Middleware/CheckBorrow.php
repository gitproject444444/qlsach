<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckBorrow
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $status = Auth::user()->status;
        if ($status == 1) {
            return redirect()->route('user.borrow.index')->with('error', "Vẫn đang mượn sách chưa trả");
        } else {
            return $next($request);
        }
    }
}
