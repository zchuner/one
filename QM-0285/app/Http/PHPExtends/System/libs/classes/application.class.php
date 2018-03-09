<?php

use \App\Http\PHPExtends\System\extendLoad;

class application
{
    /**
     * 构造函数
     */
    public function __construct()
    {
        $param = extendLoad::load_sys_class('param');
        define('ROUTE_M', $param->route_m());
        define('ROUTE_C', $param->route_c());
        define('ROUTE_A', $param->route_a());
        $this->init();
    }

    /**
     * 调用件事
     */
    private function init()
    {
        $controller = $this->load_controller();
        if (method_exists($controller, ROUTE_A)) {
            if (preg_match('/^[_]/i', ROUTE_A)) {
                errors(404);
            } else {
                call_user_func(array($controller, ROUTE_A));
            }
        } else {
            errors(404);
        }
    }

    /**
     * 加载控制器
     * @param string $filename
     * @param string $m
     * @return mixed obj
     */
    private function load_controller($filename = '', $m = '')
    {
        if (empty($filename)) $filename = ROUTE_C;
        if (empty($m)) $m = ROUTE_M;
        $filepath = LOAD_PATH . 'modules' . DIRECTORY_SEPARATOR . $m . DIRECTORY_SEPARATOR . $filename . '.php';
        if (file_exists($filepath)) {
            $classname = $filename;
            include $filepath;
            if ($mypath = extendLoad::my_path($filepath)) {
                $classname = 'MY_' . $filename;
                include $mypath;
            }
            if (class_exists($classname)) {
                return new $classname;
            } else {
                errors(404);
            }
        } else {
            errors(404);
        }
    }
}