<?php

use \App\Http\PHPExtends\System\extendLoad;

extendLoad::load_app_class('admin', 'admin', 0);

define('IN_ADMIN', true);

class cache_all extends admin
{
    private $cache_api;

    public function init()
    {
        if (isset($_POST['dosubmit']) || isset($_GET['dosubmit'])) {
            $page = $_GET['page'] ? intval($_GET['page']) : 0;
            $modules = [
                ['name' => L('module'), 'function' => 'module'],
                ['name' => L('sites'), 'mod' => 'admin', 'file' => 'sites', 'function' => 'set_cache'],
                ['name' => L('category'), 'function' => 'category'],
                ['name' => L('position'), 'function' => 'position'],
                ['name' => L('admin_role'), 'function' => 'admin_role'],
                ['name' => L('sitemodel'), 'function' => 'sitemodel'],
                ['name' => L('type'), 'function' => 'type', 'param' => 'content'],
                ['name' => L('workflow'), 'function' => 'workflow'],
                ['name' => L('update_link_setting'), 'function' => 'link_setting'],
                ['name' => L('special'), 'function' => 'special'],
                ['name' => L('setting'), 'function' => 'setting'],
                ['name' => L('database'), 'function' => 'database'],
                ['name' => L('update_formguide_model'), 'mod' => 'formguide', 'file' => 'formguide', 'function' => 'public_cache'],
                ['name' => L('cache_file'), 'function' => 'cache2database'],
                ['name' => L('cache_copyfrom'), 'function' => 'copyfrom'],
                ['name' => L('clear_files'), 'function' => 'del_file'],
            ];

            $this->cache_api = extendLoad::load_app_class('cache_api', 'admin');
            $m = $modules[$page];
            if ($m['mod'] && $m['function']) {
                if ($m['file'] == '') $m['file'] = $m['function'];
                $M = getcache('modules', 'commons');
                if (in_array($m['mod'], array_keys($M))) {
                    $cache = extendLoad::load_app_class($m['file'], $m['mod']);
                    $cache->{$m['function']}();
                }
            } else if ($m['target'] == 'iframe') {
                //echo '<script type="text/javascript">window.parent.frames["hidden"].location="' . getExtendsUrl('?' . $m['link']) . '";</script>';
            } else {
                $this->cache_api->cache($m['function'], $m['param']);
            }

            $page++;

            if (!empty($modules[$page])) {
                echo '<script type="text/javascript">window.parent.addtext("<li>' . L('update') . $m['name'] . L('cache_file_success') . '..........</li>");</script>';
                showmessage(L('update') . $m['name'] . L('cache_file_success'), '?m=admin&c=cache_all&page=' . $page . '&dosubmit=1', 0);
            } else {
                echo '<script type="text/javascript">window.parent.addtext("<li>' . L('update') . $m['name'] . L('site_cache_success') . '..........</li>")</script>';
                showmessage(L('update') . $m['name'] . L('site_cache_success'), url('admin/home'));
            }
        } else {
            include $this->admin_tpl('cache_all');
        }
    }
}