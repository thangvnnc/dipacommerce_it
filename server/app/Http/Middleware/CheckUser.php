<?php

namespace App\Http\Middleware;

use App\ZUsers;
use Closure;
use Illuminate\Http\Request;

class CheckUser {
    public static $key = 'USER_SESSION';

    public function handle(Request $request, Closure $next) {
        if($request->session()->get(CheckUser::$key) === null) {
            return redirect()->route('admin.login');
        }
        return $next($request);
    }


    public static function setSession (Request $request, ZUsers $zUser) {
        $request->session()->put(CheckUser::$key, $zUser);
    }

    public static function getSession (Request $request) {
        $zUser = $request->session()->get(CheckUser::$key);
        return $zUser;
    }

    public static function clearAllSession (Request $request) {
        $request->session()->flush();
    }
}
