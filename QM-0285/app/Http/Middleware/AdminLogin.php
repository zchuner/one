<?php
/**
 * Created by PhpStorm.
 * User: Rouyi(杨旭)
 * Date: 2017/5/6
 * Time: 14:37
 * Desc: 管理员登录验证中间件
 */

namespace App\Http\Middleware;

use App\Http\Model\Admin;
use Closure;

class AdminLogin
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
        $session_id = $request->input('PHPSESSID');
        if($session_id && ($session_id != $request->session()->getId())){
            $request->session()->flush();
            $request->session()->setId($session_id);
            $request->session()->start();
        }

        $admin = session('admin');
        if (!$admin['userid']) {
            return redirect('admin/login');
        } else {
            $r = Admin::where('userid', $admin['userid'])->first();
            if (!$r) return redirect('admin/login');
        }

        return $next($request);
    }
}
