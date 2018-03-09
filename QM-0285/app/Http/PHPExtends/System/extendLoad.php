<?php
/**
 * Created by PhpStorm.
 * User: Rouyi
 * Date: 2017/5/19
 * Time: 19:32
 */

namespace App\Http\PHPExtends\System;

use App\Http\Controllers\Controller;

class extendLoad extends Controller
{
    public function __construct()
    {
        define('WEB_PATH', '/');

        define('CACHE_PATH', LOAD_PATH . 'caches' . DIRECTORY_SEPARATOR); //缓存文件夹地址
        define('SITE_PROTOCOL', isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://'); //主机协议
        define('SITE_URL', (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '')); //当前访问的主机名
        define('HTTP_REFERER', isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : ''); //访问来源
        define('SYS_START_TIME', microtime()); //系统开始时间

        define('CHARSET', 'utf-8'); //网站编码
        define('SYS_TIME', time()); //系统时间
        define('JS_PATH', asset('admin/extends/js') . '/'); //JS 路径
        define('CSS_PATH', asset('admin/extends/css') . '/'); //CSS 路径
        define('IMG_PATH', asset('admin/extends/images') . '/'); //图片路径
        define('APP_PATH', url('') . '/'); //动态程序路径
        define('AUTHOR', '杨旭/Rouyi');
        define('UPLOAD_PATH', ROOT_PATH . 'attachment' . DIRECTORY_SEPARATOR); //附件路径
        define('UPLOAD_URL', url('attachment') . '/'); //附件URL

        /**
         * 加载公用函数库
         */
        extendLoad::load_sys_func('global');
        extendLoad::auto_load_func();
        extendLoad::load_config('system', 'errorlog') ? set_error_handler('my_error_handler') : error_reporting(E_ERROR | E_WARNING | E_PARSE);

        if (function_exists('ob_gzhandler')) ob_start('ob_gzhandler');
        else ob_start();

        header('Content-type: text/html; charset=' . CHARSET); //输出页面字符集
    }

    /**
     * 初始化应用程序
     * @return bool|mixed
     */
    public static function creat_app()
    {
        return self::load_sys_class('application');
    }

    /**
     * 加载系统类方法
     * @param string $classname 类名
     * @param string $path 扩展地址
     * @param int $initialize 是否初始化
     * @return bool|mixed
     */
    public static function load_sys_class($classname, $path = '', $initialize = 1)
    {
        return self::_load_class($classname, $path, $initialize);
    }

    /**
     * 加载应用类方法
     * @param string $classname 类名
     * @param string $m 模块
     * @param int $initialize 是否初始化
     * @return bool|mixed
     */
    public static function load_app_class($classname, $m = '', $initialize = 1)
    {
        $m = empty($m) && defined('ROUTE_M') ? ROUTE_M : $m;
        if (empty($m)) return false;
        return self::_load_class($classname, 'modules' . DIRECTORY_SEPARATOR . $m . DIRECTORY_SEPARATOR . 'classes', $initialize);
    }

    /**
     * 加载数据模型
     * @param string $classname 类名
     * @return bool|mixed
     */
    public static function load_model($classname)
    {
        return self::_load_class($classname, 'model');
    }

    /**
     * 加载类文件函数
     * @param string $classname 类名
     * @param string $path 扩展地址
     * @param int $initialize 是否初始化
     * @return bool|mixed
     */
    private static function _load_class($classname, $path = '', $initialize = 1)
    {
        static $classes = array();
        if (empty($path)) $path = 'libs' . DIRECTORY_SEPARATOR . 'classes';

        $key = md5($path . $classname);
        if (isset($classes[$key])) {
            if (!empty($classes[$key])) {
                return $classes[$key];
            } else {
                return true;
            }
        }
        if (file_exists(LOAD_PATH . $path . DIRECTORY_SEPARATOR . $classname . '.class.php')) {
            include LOAD_PATH . $path . DIRECTORY_SEPARATOR . $classname . '.class.php';
            $name = $classname;
            if ($my_path = self::my_path(LOAD_PATH . $path . DIRECTORY_SEPARATOR . $classname . '.class.php')) {
                include $my_path;
                $name = 'MY_' . $classname;
            }
            if ($initialize) {
                $classes[$key] = new $name;
            } else {
                $classes[$key] = true;
            }
            return $classes[$key];
        } else {
            return false;
        }
    }

    /**
     * 加载系统的函数库
     * @param string $func 函数库名
     * @param string $path 路径
     * @param bool $load 路径
     * @return bool
     */
    public static function load_sys_func($func, $path = '', $load = false)
    {
        return self::_load_func($func, $path, $load);
    }

    /**
     * 自动加载autoload目录下函数库
     * @param string $path 函数库名
     * @return mixed
     */
    public static function auto_load_func($path = '')
    {
        return self::_auto_load_func($path);
    }

    /**
     * 加载应用函数库
     * @param string $func 函数库名
     * @param string $m 模型名
     * @return bool
     */
    public static function load_app_func($func, $m = '')
    {
        $m = empty($m) && defined('ROUTE_M') ? ROUTE_M : $m;
        if (empty($m)) return false;
        return self::_load_func($func, 'modules' . DIRECTORY_SEPARATOR . $m . DIRECTORY_SEPARATOR . 'functions');
    }

    /**
     * 加载插件类库
     */
    public static function load_plugin_class($classname, $identification = '', $initialize = 1)
    {
        $identification = empty($identification) && defined('PLUGIN_ID') ? PLUGIN_ID : $identification;
        if (empty($identification)) return false;
        return extendLoad::load_sys_class($classname, 'plugin' . DIRECTORY_SEPARATOR . $identification . DIRECTORY_SEPARATOR . 'classes', $initialize);
    }

    /**
     * 加载插件函数库
     * @param string $func 函数文件名称
     * @param string $identification 插件标识
     * @return bool
     */
    public static function load_plugin_func($func, $identification)
    {
        static $funcs = array();
        $identification = empty($identification) && defined('PLUGIN_ID') ? PLUGIN_ID : $identification;
        if (empty($identification)) return false;
        $path = 'plugin' . DIRECTORY_SEPARATOR . $identification . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . $func . '.func.php';
        $key = md5($path);
        if (isset($funcs[$key])) return true;
        if (file_exists(LOAD_PATH . $path)) {
            include LOAD_PATH . $path;
        } else {
            $funcs[$key] = false;
            return false;
        }
        $funcs[$key] = true;
        return true;
    }

    /**
     * 加载插件数据模型
     * @param string $classname 类名
     * @return bool|mixed
     */
    public static function load_plugin_model($classname, $identification)
    {
        $identification = empty($identification) && defined('PLUGIN_ID') ? PLUGIN_ID : $identification;
        $path = 'plugin' . DIRECTORY_SEPARATOR . $identification . DIRECTORY_SEPARATOR . 'model';
        return self::_load_class($classname, $path);
    }

    /**
     * 加载函数库
     * @param string $func 函数库名
     * @param string $path 地址
     * @param bool $load
     * @return bool|mixed
     */
    private static function _load_func($func, $path = '', $load = false)
    {
        static $funcs = array();
        if (empty($path)) $path = 'libs' . DIRECTORY_SEPARATOR . 'functions';
        $path .=  DIRECTORY_SEPARATOR . $func . '.func.php';
        $key = md5($path);
        if (isset($funcs[$key])) return true;
        $load_path = (!$load) ? LOAD_PATH . $path : $path;
        if (file_exists($load_path)) {
            include $load_path;
        } else {
            $funcs[$key] = false;
            return false;
        }
        $funcs[$key] = true;
        return true;
    }

    /**
     * 加载函数库
     * @param string $path 函数库名
     * @param string $path 地址
     */
    private static function _auto_load_func($path = '')
    {
        if (empty($path)) $path = 'libs' . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . 'autoload';
        $path .= DIRECTORY_SEPARATOR . '*.func.php';
        $auto_funcs = glob(LOAD_PATH . DIRECTORY_SEPARATOR . $path);
        if (!empty($auto_funcs) && is_array($auto_funcs)) {
            foreach ($auto_funcs as $func_path) {
                include $func_path;
            }
        }
    }

    /**
     * 是否有自己的扩展文件
     * @param string $filepath 路径
     * @return bool|mixed
     */
    public static function my_path($filepath)
    {
        $path = pathinfo($filepath);
        if (file_exists($path['dirname'] . DIRECTORY_SEPARATOR . 'MY_' . $path['basename'])) {
            return $path['dirname'] . DIRECTORY_SEPARATOR . 'MY_' . $path['basename'];
        } else {
            return false;
        }
    }

    /**
     * 加载配置文件
     * @param string $file 配置文件
     * @param string $key 要获取的配置荐
     * @param string $default 默认配置。当获取配置项目失败时该值发生作用。
     * @param boolean $reload 强制重新加载。
     * @return array|string
     */
    public static function load_config($file, $key = '', $default = '', $reload = false)
    {
        static $configs = array();
        if (!$reload && isset($configs[$file])) {
            if (empty($key)) {
                return $configs[$file];
            } elseif (isset($configs[$file][$key])) {
                return $configs[$file][$key];
            } else {
                return $default;
            }
        }

        $path = CACHE_PATH . 'configs' . DIRECTORY_SEPARATOR . $file . '.php';

        if (file_exists($path)) {
            $configs[$file] = include $path;
        }

        if (empty($key)) {
            return $configs[$file];
        } elseif (isset($configs[$file][$key])) {
            return $configs[$file][$key];
        } else {
            return $default;
        }
    }
}