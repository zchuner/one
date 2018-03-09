<?php
use \App\Http\PHPExtends\System\extendLoad;

extendLoad::load_app_class('admin', 'admin', 0);

define('IN_ADMIN', true);

class menu extends admin
{
    private $db;

    function __construct()
    {
        parent::__construct();
        $this->db = new \App\Http\Model\AdminMenu();
    }

    /**
     * 模块首页
     */
    function init()
    {
        $tree = extendLoad::load_sys_class('tree');
        $tree->icon = array('&nbsp;&nbsp;&nbsp;│ ', '&nbsp;&nbsp;&nbsp;├─ ', '&nbsp;&nbsp;&nbsp;└─ ');
        $tree->nbsp = '&nbsp;&nbsp;&nbsp;';
        $userid = session('admin')['userid'];
        $admin_username = param::get_cookie('admin_username');

        $result = $this->db->orderBy('listorder')->get()->toArray();
        $array = [];
        foreach ($result as $r) {
            $r['cname'] = L($r['name']);
            $r['str_manage'] = '<a href="?m=admin&c=menu&a=add&parentid=' . $r['id'] . '&menuid=' . $_GET['menuid'] . '">' . L('add_submenu') . '</a> | <a href="?m=admin&c=menu&a=edit&id=' . $r['id'] . '&menuid=' . $_GET['menuid'] . '">' . L('modify') . '</a> | <a href="javascript:confirmurl(\'?m=admin&c=menu&a=delete&id=' . $r['id'] . '&menuid=' . $_GET['menuid'] . '\',\'' . L('confirm', array('message' => $r['cname'])) . '\')">' . L('delete') . '</a> ';
            $array[] = $r;
        }

        $str = "<tr>
					<td align='center'><input name='listorders[\$id]' type='text' size='3' value='\$listorder' class='input-text-c'></td>
					<td align='center'>\$id</td>
					<td >\$spacer\$cname</td>
					<td align='center'>\$str_manage</td>
				</tr>";
        $tree->init($array);
        $categorys = $tree->get_tree(0, $str);
        include $this->admin_tpl('menu');
    }

    /**
     * 添加模块
     */
    function add()
    {
        if (isset($_POST['dosubmit'])) {
            $this->db->create($_POST['info']);
            //开发过程中用于自动创建语言包
            $file = LOAD_PATH . 'languages' . DIRECTORY_SEPARATOR . 'zh-cn' . DIRECTORY_SEPARATOR . 'system_menu.lang.php';
            if (file_exists($file)) {
                $content = file_get_contents($file);
                $content = substr($content, 0, -2);
                $key = $_POST['info']['name'];
                $data = $content . "\$LANG['$key'] = '$_POST[language]';\r\n?>";
                file_put_contents($file, $data);
            } else {
                $key = $_POST['info']['name'];
                $data = "<?php\r\n\$LANG['$key'] = '$_POST[language]';\r\n?>";
                file_put_contents($file, $data);
            }
            message(L('operation_success'), getExtendsUrl('?c=menu&a=init'));
        } else {
            $show_validator = '';
            $tree = extendLoad::load_sys_class('tree');
            $result = $this->db->orderBy('listorder')->get()->toArray();
            $array = array();
            foreach ($result as $r) {
                $r['cname'] = L($r['name']);
                $r['selected'] = $r['id'] == $_GET['parentid'] ? 'selected' : '';
                $array[] = $r;
            }
            $str = "<option value='\$id' \$selected>\$spacer \$cname</option>";
            $tree->init($array);
            $select_categorys = $tree->get_tree(0, $str);
            $models = extendLoad::load_config('model_config');
            include $this->admin_tpl('menu');
        }
    }

    /**
     * 删除模块
     */
    function delete()
    {
        $id = intval($_GET['id']);
        $this->db->where('id', $id)->delete();
        message(L('operation_success'), getExtendsUrl('?c=menu&a=init'));
    }

    /**
     * 编辑模块
     */
    function edit()
    {
        if (isset($_POST['dosubmit'])) {
            $id = intval($_POST['id']);
            $r = $this->db->find($id);
            $this->db->where('id', $id)->update($_POST['info']);
            //修改语言文件
            $file = LOAD_PATH . 'languages' . DIRECTORY_SEPARATOR . 'zh-cn' . DIRECTORY_SEPARATOR . 'system_menu.lang.php';
            require $file;
            $key = $_POST['info']['name'];
            if (!isset($LANG[$key])) {
                $content = file_get_contents($file);
                $content = substr($content, 0, -2);
                $data = $content . "\$LANG['$key'] = '$_POST[language]';\r\n?>";
                file_put_contents($file, $data);
            } elseif (isset($LANG[$key]) && $LANG[$key] != $_POST['language']) {
                $content = file_get_contents($file);
                $content = str_replace($LANG[$key], $_POST['language'], $content);
                file_put_contents($file, $content);
            }

            $this->update_menu_models($id, $r, $_POST['info']);

            //结束语言文件修改
            message(L('operation_success'), getExtendsUrl('?c=menu&a=init'));
        } else {
            $show_validator = $array = $r = '';
            $tree = extendLoad::load_sys_class('tree');
            $id = intval($_GET['id']);
            $r = $this->db->find($id);
            if ($r)  extract($r->toArray());
            $result = $this->db->orderBy('listorder')->get()->toArray();
            foreach ($result as $r) {
                $r['cname'] = L($r['name']);
                $r['selected'] = $r['id'] == $parentid ? 'selected' : '';
                $array[] = $r;
            }
            $str = "<option value='\$id' \$selected>\$spacer \$cname</option>";
            $tree->init($array);
            $select_categorys = $tree->get_tree(0, $str);
            $models = extendLoad::load_config('model_config');
            include $this->admin_tpl('menu');
        }
    }

    /**
     * 模块排序
     */
    function listorder()
    {
        if (isset($_POST['dosubmit'])) {
            foreach ($_POST['listorders'] as $id => $listorder) {
                $this->db->where('id', $id)->update(['listorder' => $listorder]);
            }
            message(L('operation_success'), getExtendsUrl('?c=menu&a=init'));
        } else {
            message(L('operation_failure'), getExtendsUrl('?c=menu&a=init'), 'error');
        }
    }

    /**
     * 更新菜单的所属模式
     * @param int $id INT 菜单的ID
     * @param array $old_data 该菜单的老数据
     * @param array $new_data 菜单的新数据
     * @return mixed
     **/
    private function update_menu_models($id, $old_data, $new_data)
    {
        $models_config = extendLoad::load_config('model_config');
        if (is_array($models_config)) {
            foreach ($models_config as $_k => $_m) {
                if (!isset($new_data[$_k])) $new_data[$_k] = 0;
                if ($old_data[$_k] == $new_data[$_k]) continue; //数据没有变化时继续执行下一项
                $r = $this->db->find($id);
                $this->db->where('id', $id)->update([$_k => $new_data[$_k]]);
                if ($new_data[$_k] && $r['parentid']) {
                    $this->update_parent_menu_models($r['parentid'], $_k); //如果设置所属模式，更新父级菜单的所属模式
                }
            }
        }
        return true;
    }

    /**
     * 更新父级菜单的所属模式
     * @param int $id int 菜单ID
     * @param string $field  修改字段名
     * @return mixed
     */
    private function update_parent_menu_models($id, $field)
    {
        $id = intval($id);
        $r = $this->db->find($id);
        $this->db->where('id', $id)->update([$field => 1]); //修改父级的所属模式，然后判断父级是否存在父级
        if ($r && $r['parentid']) {
            $this->update_parent_menu_models($r['parentid'], $field);
        }
        return true;
    }
}