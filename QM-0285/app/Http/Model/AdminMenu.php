<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AdminMenu extends Model
{
    protected $table = 'menu';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = [];

    /**
     * 按父ID查找菜单子项
     * @param int $parentid 父菜单ID
     * @param int $with_self 是否包括他自己
     * @return array
     */
    public function admin_menu($parentid, $with_self = 0)
    {
        $parentid = intval($parentid);
        $where = ['parentid' => $parentid, 'display' => 1];

        $result = $this->where($where)->orderBy('listorder')->get();

        if ($with_self) {
            $result2[] = $this->find($parentid);
            $result = array_merge($result2, $result);
        }

        //权限检查
        if (session('admin')['roleid'] == 1) return $result;
        $array = [];
        $siteid = 1;
        foreach ($result as $v) {
            $action = $v['a'];
            if (preg_match('/^public_/', $action)) {
                $array[] = $v;
            } else {
                if (preg_match('/^ajax_([a-z]+)_/', $action, $_match)) $action = $_match[1];
                $r = DB::table('admin_role_priv')->where(['m' => $v['m'], 'c' => $v['c'], 'a' => $action, 'roleid' => session('admin')['roleid'], 'siteid' => $siteid])->get();
                if ($r) $array[] = $v;
            }
        }
        return $array;
    }

    /**
     * 当前位置
     * @param int $id 菜单id
     * @return string
     */
    public function currentPos($id)
    {
        $r = $this->find($id);
        if (!$r) return '';
        $str = '';
        if ($r['parentid']) {
            $str = $this->currentPos($r['parentid']);
        }
        return $str . '<li>' . getLang($r['name']) . '</li><span></span>';
    }
}
