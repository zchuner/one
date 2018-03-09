<?php
use \App\Http\PHPExtends\System\extendLoad;

if (param::get_cookie('sys_lang')) {
    define('SYS_STYLE', param::get_cookie('sys_lang'));
} else {
    define('SYS_STYLE', 'zh-cn');
}

define('IN_ADMIN', true);

class admin
{
    public $userid;
    public $username;

    public function __construct()
    {
        self::check_admin();
        self::check_priv();
        extendLoad::load_app_func('global', 'admin');
        if (!module_exists(ROUTE_M)) showmessage(L('module_not_exists'));
        self::manage_log();
        self::lock_screen();
        if (extendLoad::load_config('system', 'admin_url') && $_SERVER["HTTP_HOST"] != extendLoad::load_config('system', 'admin_url')) {
            Header("http/1.1 403 Forbidden");
            exit(0);
        }
    }

    /**
     * 判断用户是否已经登陆
     */
    final public function check_admin()
    {
        if (ROUTE_M == 'admin' && ROUTE_C == 'index' && in_array(ROUTE_A, array('login', 'public_card'))) {
            return true;
        } else {
            $userid = param::get_cookie('userid');
            if (!isset(session('admin')['userid']) || !isset(session('admin')['roleid']) || !session('admin')['userid'] || !session('admin')['roleid'] || $userid != session('admin')['userid']) {
                showmessage(L('admin_login'), url('admin/login'));
            }
        }
    }

    /**
     * 加载后台模板
     * @param string $file 文件名
     * @param string $m 模型名
     * @return mixed
     */
    final public static function admin_tpl($file, $m = '')
    {
        $m = empty($m) ? ROUTE_M : $m;
        if (empty($m)) return false;
        $tpl = LOAD_PATH . 'modules' . DIRECTORY_SEPARATOR . $m . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . $file . '.tpl.php';
        if (!file_exists($tpl)) exit('模板 /templates/' . $file . ' 不存在！');
        return $tpl;
    }

    /**
     * 按父ID查找菜单子项
     * @param int $parentid 父菜单ID
     * @param int $with_self 是否包括他自己
     * @return mixed
     */
    final public static function admin_menu($parentid, $with_self = 0)
    {
        $parentid = intval($parentid);
        $menudb = extendLoad::load_model('menu_model');
        $site_model = param::get_cookie('site_model');

        $where = array('parentid' => $parentid, 'display' => 1);
        if ($site_model && $parentid) {
            $where[$site_model] = 1;
        }
        $result = $menudb->select($where, '*', 1000, 'listorder ASC');
        if ($with_self) {
            $result2[] = $menudb->get_one(array('id' => $parentid));
            $result = array_merge($result2, $result);
        }
        //权限检查
        if (session('admin')['roleid'] == 1) return $result;
        $array = array();
        $privdb = extendLoad::load_model('admin_role_priv_model');
        $siteid = param::get_cookie('siteid');
        foreach ($result as $v) {
            $action = $v['a'];
            if (preg_match('/^public_/', $action)) {
                $array[] = $v;
            } else {
                if (preg_match('/^ajax_([a-z]+)_/', $action, $_match)) $action = $_match[1];
                $r = $privdb->get_one(array('m' => $v['m'], 'c' => $v['c'], 'a' => $action, 'roleid' => session('admin')['roleid'], 'siteid' => $siteid));
                if ($r) $array[] = $v;
            }
        }
        return $array;
    }

    /**
     * 获取菜单 头部菜单导航
     * @param string $parentid 菜单id
     * @param bool $big_menu
     * @return mixed
     */
    final public static function submenu($parentid = '', $big_menu = false)
    {
        if (empty($parentid)) {
            $menudb = extendLoad::load_model('menu_model');
            $r = $menudb->get_one(array('m' => ROUTE_M, 'c' => ROUTE_C, 'a' => ROUTE_A));
            $parentid = $_GET['menuid'] = $r['id'];
        }
        $array = self::admin_menu($parentid, 1);

        $numbers = count($array);
        if ($numbers == 1 && !$big_menu) return '';
        $string = '';
        foreach ($array as $_value) {
            if (!isset($_GET['s'])) {
                $classname = ROUTE_M == $_value['m'] && ROUTE_C == $_value['c'] && ROUTE_A == $_value['a'] ? 'class="on"' : '';
            } else {
                $_s = !empty($_value['data']) ? str_replace('=', '', strstr($_value['data'], '=')) : '';
                $classname = ROUTE_M == $_value['m'] && ROUTE_C == $_value['c'] && ROUTE_A == $_value['a'] && $_GET['s'] == $_s ? 'class="on"' : '';
            }
            if ($_value['parentid'] == 0 || $_value['m'] == '') continue;
            if ($classname) {
                $string .= "<a href='javascript:;' $classname><em>" . L($_value['name']) . "</em></a><span>|</span>";
            } else {
                $string .= "<a href='?m=" . $_value['m'] . "&c=" . $_value['c'] . "&a=" . $_value['a'] . "&menuid=$parentid" . '&' . $_value['data'] . "' $classname><em>" . L($_value['name']) . "</em></a><span>|</span>";
            }
        }
        $string = substr($string, 0, -14);
        return $string;
    }

    /**
     * 当前位置
     * @param int $id 菜单id
     * @return string
     */
    final public static function current_pos($id)
    {
        $menudb = extendLoad::load_model('menu_model');
        $r = $menudb->get_one(array('id' => $id), 'id,name,parentid');
        $str = '';
        if ($r['parentid']) {
            $str = self::current_pos($r['parentid']);
        }
        return $str . L($r['name']) . ' > ';
    }

    /**
     * 获取当前的站点ID
     */
    final public static function get_siteid()
    {
        return get_siteid();
    }

    /**
     * 获取当前站点信息
     * @param $siteid
     * @return array|bool
     */
    final public static function get_siteinfo($siteid = '')
    {
        if ($siteid == '') $siteid = self::get_siteid();
        if (empty($siteid)) return false;
        $sites = extendLoad::load_app_class('sites', 'admin');
        return $sites->get_by_id($siteid);
    }

    final public static function return_siteid()
    {
        $sites = extendLoad::load_app_class('sites', 'admin');
        $siteid = explode(',', $sites->get_role_siteid(session('admin')['roleid']));
        return current($siteid);
    }

    /**
     * 权限判断
     */
    final public function check_priv()
    {
        if (ROUTE_M == 'admin' && ROUTE_C == 'index' && in_array(ROUTE_A, array('login', 'init', 'public_card'))) return true;
        if (session('admin')['roleid'] == 1) return true;
        $siteid = param::get_cookie('siteid');
        $action = ROUTE_A;
        $privdb = extendLoad::load_model('admin_role_priv_model');
        if (preg_match('/^public_/', ROUTE_A)) return true;
        if (preg_match('/^ajax_([a-z]+)_/', ROUTE_A, $_match)) {
            $action = $_match[1];
        }
        $r = $privdb->get_one(array('m' => ROUTE_M, 'c' => ROUTE_C, 'a' => $action, 'roleid' => session('admin')['roleid'], 'siteid' => $siteid));
        if (!$r) showmessage('您没有权限操作该项', 'blank');
    }

    /**
     * 记录日志
     */
    final private function manage_log()
    {
        //判断是否记录
        $setconfig = extendLoad::load_config('system');
        extract($setconfig);
        if ($admin_log == 1) {
            $action = ROUTE_A;
            if ($action == '' || strchr($action, 'public') || $action == 'init' || $action == 'public_current_pos') {
                return false;
            } else {
                $ip = ip();
                $log = extendLoad::load_model('log_model');
                $username = param::get_cookie('admin_username');
                $userid = isset(session('admin')['userid']) ? session('admin')['userid'] : '';
                $time = date('Y-m-d H-i-s', SYS_TIME);
                $url = '?m=' . ROUTE_M . '&c=' . ROUTE_C . '&a=' . ROUTE_A;
                $log->insert(['module' => ROUTE_M, 'username' => $username, 'userid' => $userid, 'action' => ROUTE_C, 'querystring' => $url, 'time' => $time, 'ip' => $ip]);
            }
        }
    }

    /**
     * 检查锁屏状态
     */
    final private function lock_screen()
    {
        $lock_screen = session('lock_screen');
        if (isset($lock_screen) && $lock_screen == 1) {
            if (preg_match('/^public_/', ROUTE_A) || (ROUTE_M == 'content' && ROUTE_C == 'create_html') || (ROUTE_M == 'release') || (ROUTE_A == 'login') || (ROUTE_M == 'search' && ROUTE_C == 'search_admin' && ROUTE_A == 'createindex')) return true;
            showmessage(L('admin_login'), url('admin/login'));
        }
    }

    /**
     * 后台信息列表模板
     * @param string $id 被选中的模板名称
     * @param string $str form表单中的属性名
     * @return mixed
     */
    final public function admin_list_template($id = '', $str = '')
    {
        return self::admin_content_template($id, $str);
    }

    /**
     * 后台信息列表模板
     * @param string $id 被选中的模板名称
     * @param string $str form表单中的属性名
     * @param string $type 调用的类型
     * @return mixed
     */
    final  public function admin_content_template($id = '', $str = '', $type = 'list')
    {
        $templatedir = LOAD_PATH . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . 'content' . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR;
        $pre = 'content_' . $type;
        $templates = glob($templatedir . $pre . '*.tpl.php');
        if (empty($templates)) return false;
        $files = @array_map('basename', $templates);
        $templates = array();
        if (is_array($files)) {
            foreach ($files as $file) {
                $key = substr($file, 0, -8);
                $templates[$key] = $file;
            }
        }
        ksort($templates);
        return form::select($templates, $id, $str, L('please_select'));
    }
}