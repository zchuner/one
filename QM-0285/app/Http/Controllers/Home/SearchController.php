<?php
/**
 * Created by PhpStorm.
 * User: 杨旭(Rouyi)
 * Date: 2017/5/8
 * Time: 4:04
 * Desc: 前台页面控制器
 */

namespace App\Http\Controllers\Home;

use App\Http\PHPExtends\System\extendLoad;
use Illuminate\Http\Request;

class SearchController extends extendLoad
{
    /**
     * 搜索
     * @param Request $request
     * @return mixed 显示模板
     */
    public function items(Request $request)
    {
        return getAppRoute([
            'm'     => 'search',
            'a'     => 'init',
            'c'     => 'index',
            'model' => intval($request->input('model')),
            'page'  => intval($request->input('page'))
        ]);
    }
}