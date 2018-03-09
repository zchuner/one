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
use App\Http\Model\PraiseModel;
use App\Http\PHPExtends\System\extendLoad;
use Illuminate\Http\Request;

class IndexController extends extendLoad
{
    /**
     * 网站首页
     * @return mixed 显示模板
     */
    public function getHome()
    {
        return getAppRoute([
            'm'     => 'content',
            'a'     => 'init',
            'c'     => 'index',
        ]);
    }

    /**
     * 栏目页
     * @param int $cat_id 栏目ID
     * @param int $page 分页
     * @return mixed 显示模板
     */
    public function getCategory($cat_id, $page)
    {
        $cat_id = (intval($cat_id)) ? intval($cat_id) : message('参数错误！', 'back', 'error');
        $page = intval($page);
        return getAppRoute([
            'm'     => 'content',
            'c'     => 'index',
            'a'     => 'category',
            'catid' => $cat_id,
            'page'  => $page
        ]);
    }

    /**
     * 详情页
     * @param int $cat_id 栏目ID
     * @param int $id 文档ID
     * @param int $page 分页
     * @return mixed 显示模板
     */
    public function getShow($cat_id, $id, $page)
    {
        $cat_id = (intval($cat_id)) ? intval($cat_id) : message('参数错误！', 'back', 'error');
        $id = (intval($id)) ? intval($id) : message('参数错误！', 'back', 'error');
        $page = intval($page);
        return getAppRoute([
            'm'     => 'content',
            'c'     => 'index',
            'a'     => 'show',
            'catid' => $cat_id,
            'id'    => $id,
            'page'  => $page
        ]);
    }

    /**
     * 展示广告位
     * @param string $type 操作类型
     * @return mixed 显示模板
     */
    public function getPoster($type)
    {
        return getAppRoute([
            'm'         => 'poster',
            'c'         => 'index',
            'a'         => $type
        ]);
    }

    /**
     * 获取文档内容的点击次数
     * @param int $modelId 模型ID
     * @param int $id 文档ID
     * @return string|bool
     */
    public function getHits($modelId, $id)
    {
        $modelId = (intval($modelId)) ? intval($modelId) : message('参数错误！', 'back', 'error');
        $id = (intval($id)) ? intval($id) : message('参数错误！', 'back', 'error');
        $hitsDb = new Hits();
        $getItem = $hitsDb->getItem($modelId, $id);
        $item = ($getItem) ? $getItem : '0';
        $html = "$('#hits').html('{$item}');";
        return $html;
    }

    /**
     * 更新点赞数量
     * @param Request $request
     * @return array
     */
    public function praiseUpdate(Request $request)
    {
        $id = intval($request->input('id'));
        $cid = intval($request->input('cid'));
        if (!$id || !$cid) return ['code' => -100, 'message' => '参数错误！'];

        $model = new PraiseModel();
        $rs = $model->where(['id' => $id, 'cid' => $cid, 'ip' => ip()])->first();

        if (is_null($rs)) {
            $re = $model->create([
                'id' => $id,
                'cid' => $cid,
                'ip' => ip(),
            ]);

            if (!$re) return ['code' => -100, '操作失败，请稍后重试！'];

            return ['code' => 200];
        }

        return ['code' => -100, 'message' => '您已经赞过了'];
    }
}