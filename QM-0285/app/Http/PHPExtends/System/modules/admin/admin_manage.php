<?php

use \App\Http\PHPExtends\System\extendLoad;

extendLoad::load_app_class('admin', 'admin', 0);
extendLoad::load_app_func('admin');

define('IN_ADMIN', true);

class admin_manage extends admin
{
    private $db, $role_db, $op, $currentAdmin;

    function __construct()
    {
        parent::__construct();
        $this->db = new \App\Http\Model\Admin();
        $this->role_db = new \App\Http\Model\AdminRole();
        $this->op = extendLoad::load_app_class('admin_op');
        $this->currentAdmin = session('admin');
    }

    /**
     * 管理员管理列表
     */
    public function init()
    {
        $userid = $this->currentAdmin['userid'];
        $admin_username = param::get_cookie('admin_username');
        $infos = $this->db->orderBy('userid', 'DESC')->get()->toArray();
        $roles = getcache('role', 'commons');
        include $this->admin_tpl('admin_list');
    }

    /**
     * 添加管理员
     */
    public function add()
    {
        if (isset($_POST['dosubmit'])) {

            if ($this->check_admin_manage_code() == false) {
                return showmessage("error auth code");
            }

            $info = [];

            if (!$this->op->checkname($_POST['info']['username'])) {
                showmessage(L('admin_already_exists'));
            }

            $info = checkuserinfo($_POST['info']);

            if ($info['roleid'] < $this->currentAdmin['roleid']) {
                return showmessage('您没有权限添加等级别自己高的管理员');
            }

            if (!checkpasswd($info['password'])) {
                showmessage(L('pwd_incorrect'));
            }

            $passwordinfo = password($info['password']);
            $info['password'] = $passwordinfo['password'];
            $info['encrypt'] = $passwordinfo['encrypt'];

            $admin_fields = ['username', 'email', 'password', 'encrypt', 'roleid', 'realname'];
            foreach ($info as $k => $value) {
                if (!in_array($k, $admin_fields)) {
                    unset($info[$k]);
                }
            }

            if ($this->db->insertGetId($info)) {
                return showmessage(L('operation_success'), '?m=admin&c=admin_manage');
            }

            return showmessage('添加失败，请稍后重试', '?m=admin&c=admin_manage');
        }

        $roles = $this->role_db->where('disabled', 0)->where(function ($query) {
            $query->where('roleid', '>', $this->currentAdmin['roleid']);
        })->get();

        $admin_manage_code = $this->get_admin_manage_code();
        include $this->admin_tpl('admin_add');
    }

    /**
     * 修改管理员
     */
    public function edit()
    {
        if (isset($_POST['dosubmit'])) {
            if ($this->check_admin_manage_code() == false) {
                showmessage("error auth code");
            }

            $memberinfo = $info = array();

            $info = checkuserinfo($_POST['info']);
            if (isset($info['password']) && !empty($info['password'])) {
                $this->op->edit_password($info['userid'], $info['password']);
            }

            $userid = intval($info['userid']);
            $admin_fields = ['username', 'email', 'roleid', 'realname'];
            foreach ($info as $k => $value) {
                if (!in_array($k, $admin_fields)) {
                    unset($info[$k]);
                }
            }
            $this->db->where('userid', $userid)->update($info);
            return showmessage(L('operation_success'), HTTP_REFERER);
        }

        $info = $this->db->find($_GET['userid']);
        if ($info->roleid < $this->currentAdmin['roleid']) {
            return showmessage('您没有权限修改等级别自己高的管理员');
        }

        if ($info) extract($info->toArray());;
        $roles = $this->role_db->where('disabled', 0)->get();
        $show_header = true;
        $admin_manage_code = $this->get_admin_manage_code();
        include $this->admin_tpl('admin_edit');
    }

    /**
     * 删除管理员
     */
    public function delete()
    {
        $userid = intval($_GET['userid']);
        if ($userid == '1') showmessage(L('this_object_not_del'), HTTP_REFERER);

        $rs = $this->db->find($userid);
        if ($rs->roleid < $this->currentAdmin['roleid']) {
            return showmessage('您没有权限删除等级别自己高的管理员');
        }

        $this->db->where('userid', $userid)->delete();
        showmessage(L('admin_cancel_succ'), getExtendsUrl('?a=init'));
    }

    /**
     * 编辑用户信息
     */
    public function public_edit_info()
    {
        if (isset($_POST['dosubmit'])) {
            $admin_fields = ['email', 'realname', 'lang'];
            $info = [];
            $info = $_POST['info'];
            if (trim($info['lang']) == '') $info['lang'] = 'zh-cn';
            foreach ($info as $k => $value) {
                if (!in_array($k, $admin_fields)) {
                    unset($info[$k]);
                }
            }
            $this->db->where('userid', $this->currentAdmin['userid'])->update($info);
            param::set_cookie('sys_lang', $info['lang'], SYS_TIME + 86400 * 3000);
            return showmessage(L('operation_success'), HTTP_REFERER);
        }

        $info = $this->db->find($this->currentAdmin['userid'])->toArray();
        extract($info);

        $lang_dirs = glob(LOAD_PATH . 'languages/*');
        $dir_array = array();
        foreach ($lang_dirs as $dirs) {
            $dir_array[] = str_replace(LOAD_PATH . 'languages/', '', $dirs);
        }
        include $this->admin_tpl('admin_edit_info');
    }

    /**
     * 管理员自助修改密码
     */
    public function public_edit_pwd()
    {
        $userid = session('admin')['userid'];
        if (isset($_POST['dosubmit'])) {
            $r = $this->db->find($userid);
            if (password($_POST['old_password'], $r['encrypt']) !== $r['password']) showmessage(L('old_password_wrong'), HTTP_REFERER);
            if (isset($_POST['new_password']) && !empty($_POST['new_password'])) {
                $this->op->edit_password($userid, $_POST['new_password']);
            }
            showmessage(L('password_edit_succ_logout'), url('admin/logout'));
        } else {
            $info = $this->db->find($userid);
            if ($info) extract($info->toArray());
            include $this->admin_tpl('admin_edit_pwd');
        }
    }

    /**
     * 异步检测用户名
     */
    function public_checkname_ajx()
    {
        $username = isset($_GET['username']) && trim($_GET['username']) ? trim($_GET['username']) : exit(0);
        $ck = $this->db->where('username', $username)->first();
        if ($ck['userid']) exit('0');
        exit('1');
    }

    /**
     * 异步检测密码
     */
    function public_password_ajx()
    {
        $r = $this->db->find($this->currentAdmin['userid']);
        if (password($_GET['old_password'], $r['encrypt']) == $r['password']) {
            exit('1');
        }
        exit('0');
    }

    /**
     * 异步检测emial合法性
     */
    function public_email_ajx()
    {
        $email = $_GET['email'];
        $userid = $_SESSION['userid'];
        $check = $this->db->where('email', $email)->first();
        if ($check && $check['userid'] != $userid) {
            exit('0');
        } else {
            exit('1');
        }
    }

    //添加修改用户 验证串验证
    private function check_admin_manage_code()
    {
        $admin_manage_code = $_POST['info']['admin_manage_code'];
        $pc_auth_key = md5(extendLoad::load_config('system', 'auth_key') . 'adminuser');
        $admin_manage_code = sys_auth($admin_manage_code, 'DECODE', $pc_auth_key);
        if ($admin_manage_code == "") {
            return false;
        }
        $admin_manage_code = explode("_", $admin_manage_code);
        if ($admin_manage_code[0] != "adminuser" || $admin_manage_code[1] != $_POST['pc_hash']) {
            return false;
        }
        return true;
    }

    //添加修改用户 生成验证串
    private function get_admin_manage_code()
    {
        $pc_auth_key = md5(extendLoad::load_config('system', 'auth_key') . 'adminuser');
        $code = sys_auth("adminuser_" . $_GET['pc_hash'] . "_" . time(), 'ENCODE', $pc_auth_key);
        return $code;
    }
}