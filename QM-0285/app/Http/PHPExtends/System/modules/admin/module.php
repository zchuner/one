<?php
use \App\Http\PHPExtends\System\extendLoad;

extendLoad::load_app_class('admin', 'admin', 0);

class module extends admin
{
    private $db;

    public function __construct()
    {
        $this->db = extendLoad::load_model('module_model');
        parent::__construct();
    }

    public function init()
    {
        $dirs = $module = $dirs_arr = $directory = array();
        $dirs = glob(LOAD_PATH . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . '*');
        foreach ($dirs as $d) {
            if (is_dir($d)) {
                $d = basename($d);
                $dirs_arr[] = $d;
            }
        }
        define('INSTALL', true);
        $modules = $this->db->select('', '*', '', '', '', 'module');
        $total = count($dirs_arr);
        $dirs_arr = array_chunk($dirs_arr, 20, true);
        $page = max(intval($_GET['page']), 1);
        $pages = pages($total, $page, 20);
        $directory = $dirs_arr[intval($page - 1)];
        include $this->admin_tpl('module_list');
    }

    /**
     * 模块安装
     */
    public function install()
    {
        $this->module = $_POST['module'] ? $_POST['module'] : $_GET['module'];
        $module_api = extendLoad::load_app_class('module_api');
        if (!$module_api->check($this->module)) showmessage($module_api->error_msg, 'blank');
        if ($_POST['dosubmit']) {
            if ($module_api->install()) showmessage(L('success_module_install') . L('update_cache'), '?m=admin&c=module&a=cache');
            else showmessage($module_api->error_msg, HTTP_REFERER);
        } else {
            include LOAD_PATH . 'modules' . DIRECTORY_SEPARATOR . $this->module . DIRECTORY_SEPARATOR . 'install' . DIRECTORY_SEPARATOR . 'config.inc.php';
            include $this->admin_tpl('module_config');
        }
    }

    /**
     * 模块卸载
     */
    public function uninstall()
    {
        if (!isset($_GET['module']) || empty($_GET['module'])) showmessage(L('illegal_parameters'));

        $module_api = extendLoad::load_app_class('module_api');
        if (!$module_api->uninstall($_GET['module'])) showmessage($module_api->error_msg, 'blank');
        else showmessage(L('uninstall_success'), '?m=admin&c=module&a=cache');
    }

    /**
     * 更新模块缓存
     */
    public function cache()
    {
        echo '<script type="text/javascript">parent.right.location.href = "?m=admin&c=cache_all&a=init";window.top.art.dialog({id:\'install\'}).close();</script>';
    }
}