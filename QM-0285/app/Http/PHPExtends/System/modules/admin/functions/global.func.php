<?php
use \App\Http\PHPExtends\System\extendLoad;

/**
 * 模板风格列表
 * @param int $siteid 站点ID，获取单个站点可使用的模板风格列表
 * @param int $disable 是否显示停用的{1:是,0:否}
 * @return mixed
 */
function template_list($siteid = '', $disable = 0)
{
    $list = glob(TEMPLATE_PATH . '*', GLOB_ONLYDIR);
    $arr = $template = [];
    if ($siteid) {
        $site = extendLoad::load_app_class('sites', 'admin');
        $info = $site->get_by_id($siteid);
        if ($info['template']) $template = explode(',', $info['template']);
    }

    foreach ($list as $key => $v) {
        $dirname = basename($v);
        if ($siteid && !in_array($dirname, $template)) continue;
        if (file_exists($v . DIRECTORY_SEPARATOR . 'config.php')) {
            $arr[$key] = include $v . DIRECTORY_SEPARATOR . 'config.php';
            if (!$disable && isset($arr[$key]['disable']) && $arr[$key]['disable'] == 1) {
                unset($arr[$key]);
                continue;
            }
        } else {
            $arr[$key]['name'] = $dirname;
        }
        $arr[$key]['dirname'] = $dirname;
    }
    return $arr;
}

/**
 * 设置config文件
 * @param array $config 配属信息
 * @param string $filename 要配置的文件名称
 * @return mixed
 */
function set_config($config, $filename = "system")
{
    $configfile = CACHE_PATH . 'configs' . DIRECTORY_SEPARATOR . $filename . '.php';
    if (!is_writable($configfile)) showmessage('Please chmod ' . $configfile . ' to 0777 !');
    $pattern = $replacement = [];
    foreach ($config as $k => $v) {
        if (in_array($k, array('js_path', 'css_path', 'img_path', 'attachment_stat', 'admin_log', 'gzip', 'errorlog', 'phpsso', 'phpsso_appid', 'phpsso_api_url', 'phpsso_auth_key', 'phpsso_version', 'connect_enable', 'upload_url', 'sina_akey', 'sina_skey', 'snda_enable', 'snda_status', 'snda_akey', 'snda_skey', 'wechat_app_id', 'wechat_app_secret', 'qq_akey', 'qq_skey', 'qq_appid', 'qq_appkey', 'qq_callback', 'admin_url'))) {
            $v = trim($v);
            $configs[$k] = $v;
            $pattern[$k] = "/'" . $k . "'\s*=>\s*([']?)[^']*([']?)(\s*),/is";
            $replacement[$k] = "'" . $k . "' => \${1}" . $v . "\${2}\${3},";
        }
    }
    $str = file_get_contents($configfile);
    $str = preg_replace($pattern, $replacement, $str);
    return extendLoad::load_config('system', 'lock_ex') ? file_put_contents($configfile, $str, LOCK_EX) : file_put_contents($configfile, $str);
}

/**
 * 获取系统信息
 */
function get_sysinfo()
{
    $sys_info['os'] = PHP_OS;
    $sys_info['zlib'] = function_exists('gzclose');//zlib
    $sys_info['safe_mode'] = (boolean)ini_get('safe_mode');//safe_mode = Off
    $sys_info['safe_mode_gid'] = (boolean)ini_get('safe_mode_gid');//safe_mode_gid = Off
    $sys_info['timezone'] = function_exists("date_default_timezone_get") ? date_default_timezone_get() : L('no_setting');
    $sys_info['socket'] = function_exists('fsockopen');
    $sys_info['web_server'] = strpos($_SERVER['SERVER_SOFTWARE'], 'PHP') === false ? $_SERVER['SERVER_SOFTWARE'] . 'PHP/' . phpversion() : $_SERVER['SERVER_SOFTWARE'];
    $sys_info['phpv'] = phpversion();
    $sys_info['fileupload'] = @ini_get('file_uploads') ? ini_get('upload_max_filesize') : 'unknown';
    return $sys_info;
}

/**
 * 检查目录可写性
 * @param string $dir 目录路径
 * @return mixed
 */
function dir_writeable($dir)
{
    $writeable = 0;
    if (is_dir($dir)) {
        if ($fp = @fopen("$dir/chkdir.test", 'w')) {
            @fclose($fp);
            @unlink("$dir/chkdir.test");
            $writeable = 1;
        } else {
            $writeable = 0;
        }
    }
    return $writeable;
}

/**
 * 返回错误日志大小，单位MB
 */
function errorlog_size()
{
    $logfile = CACHE_PATH . DIRECTORY_SEPARATOR . 'log' . 'error.php';
    if (file_exists($logfile)) {
        return $logsize = extendLoad::load_config('system', 'errorlog') ? round(filesize($logfile) / 1048576 * 100) / 100 : 0;
    }
    return 0;
}