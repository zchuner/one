<?php
/**
 * Created by PhpStorm.
 * User: Rouyi
 * Date: 2017/5/2
 * Time: 23:51
 */

namespace App\Http\Controllers\Admin;

use App\Http\Model\Admin;
use App\Http\PHPExtends\System\extendLoad;
use App\Services\VerifyCode;
use Illuminate\Http\Request;

class LoginController extends extendLoad
{
    /**
     * 登录系统
     */
    public function index()
    {
        if (session('admin')) {
            return redirect(url('admin/index'));
        }

        return view('admin.login.index');
    }

    /**
     * 登录系统提交表单
     * @param Request $request
     * @return mixed
     */
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {

            $code = $request->input('code');
            if ($code != session('code') || !VerifyCode::check($code)) {
                session(['code' => null]);
                message('验证码错误，请重新输入！', url('admin/login'), 'error');
            }

            session(['code' => null]);

            if (!is_username($request->input('username'))) message('用户名不合法，请重新输入！', 'back', 'error');
            if (!$request->input('password')) message('请输入密码！', 'back', 'error');
            elseif (!is_password($request->input('password'))) message('密码不合法，请重新输入！', 'back', 'error');

            $_admin = Admin::where('username', $request->input('username'))->first();
            if (!$_admin) message('管理员不存在！', 'back', 'error');

            $_password = password($request->input('password'), $_admin['encrypt']);
            if ($_admin->password != $_password) message('密码错误，请重新输入！', 'back', 'error');

            Admin::where('userid', $_admin->userid)->update([
                'login_time' => time(),
                'lastloginip' => ip(),
                'lastlogintime' => ($_admin->login_time) ? $_admin->login_time : time()
            ]);

            session([
                'admin' => [
                    'userid' => $_admin->userid,
                    'username' => $_admin->username,
                    'roleid' => $_admin->roleid
                ],
                'pc_hash' => random(6, 'abcdefghigklmnopqrstuvwxwyABCDEFGHIGKLMNOPQRSTUVWXWY0123456789'),
                'lock_screen' => 0
            ]);

            $cookie_time = SYS_TIME + 86400 * 3000;
            if (!$_admin['lang']) $r['lang'] = 'zh-cn';
            include LOAD_PATH . DIRECTORY_SEPARATOR . 'libs' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'param.class.php';
            $param = new \param();
            $param->set_cookie('admin_username', $_admin->username, $cookie_time);
            $param->set_cookie('siteid', 1, $cookie_time);
            $param->set_cookie('userid', $_admin->userid, $cookie_time);
            $param->set_cookie('admin_email', $_admin->email, $cookie_time);
            $param->set_cookie('sys_lang', $_admin->lang, $cookie_time);

            return redirect(url('admin/index'));
        }

        return message('登录信息输入不完整！');
    }

    /**
     * 退出登录
     */
    public function logout()
    {
        session(['admin' => null]);

        include LOAD_PATH . DIRECTORY_SEPARATOR . 'libs' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'param.class.php';
        $param = new \param();
        $param->set_cookie('admin_username', '');
        $param->set_cookie('userid', 0);

        return redirect(url('admin/login'));
    }
}