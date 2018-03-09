<?php
/**
 * Created by PhpStorm.
 * User: 杨旭(Rouyi)
 * Date: 2017/5/8
 * Time: 4:04
 * Desc: 前台页面控制器
 */

namespace App\Http\Controllers\Home;

use App\Http\Model\Hits;
use App\Http\PHPExtends\System\extendLoad;
use Illuminate\Http\Request;

class SpecialController extends extendLoad
{
    /**
     * 网站首页
     * @param $id
     * @return mixed 显示模板
     */
    public function getHome($id)
    {
        $id = (intval($id)) ? intval($id) : message('参数错误！', 'back', 'error');
        return getAppRoute([
            'm'     => 'special',
            'a'     => 'init',
            'c'     => 'index',
            'specialid' => $id
        ]);
    }

    /**
     * 栏目页
     * @param int $id 专题 ID
     * @param int $cid 栏目ID
     * @param int $page 分页
     * @return mixed 显示模板
     */
    public function getCategory($id, $cid, $page)
    {
        $id = (intval($id)) ? intval($id) : message('参数错误！', 'back', 'error');
        $cid = (intval($cid)) ? intval($cid) : message('参数错误！', 'back', 'error');
        $page = intval($page);
        return getAppRoute([
            'm'     => 'special',
            'c'     => 'index',
            'a'     => 'type',
            'specialid' => $id,
            'typeid' => $cid,
            'page'  => $page
        ]);
    }

    /**
     * 详情页
     * @param int $id 文档ID
     * @param int $page 分页
     * @return mixed 显示模板
     */
    public function getShow($id, $page)
    {
        $id = (intval($id)) ? intval($id) : message('参数错误！', 'back', 'error');
        return getAppRoute([
            'm'     => 'special',
            'a'     => 'show',
            'c'     => 'index',
            'id'    => $id,
            'page'  => $page,
        ]);
    }

    /**
     * 专题页点击统计
     * @param $id
     * @param $module
     * @return string
     */
    public function getHits($id, $module)
    {
        $id = (intval($id)) ? intval($id) : message('参数错误！', 'back', 'error');
        $hitsDb = new Hits();
        $getItem = $hitsDb->getSpecialItem($id, $module);
        $item = ($getItem) ? $getItem : '0';
        $html = "$('#hits').html('{$item}');";
        return $html;
    }
}