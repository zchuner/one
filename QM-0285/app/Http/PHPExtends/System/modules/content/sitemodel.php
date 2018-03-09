<?php
use \App\Http\PHPExtends\System\extendLoad;

//模型原型存储路径
define('MODEL_PATH', LOAD_PATH . 'modules' . DIRECTORY_SEPARATOR . 'content' . DIRECTORY_SEPARATOR . 'fields' . DIRECTORY_SEPARATOR);
//模型缓存路径
define('CACHE_MODEL_PATH', CACHE_PATH . 'caches_model' . DIRECTORY_SEPARATOR . 'caches_data' . DIRECTORY_SEPARATOR);
extendLoad::load_app_class('admin', 'admin', 0);

class sitemodel extends admin
{
    private $db;
    public $siteid;

    function __construct()
    {
        parent::__construct();
        $this->db = extendLoad::load_model('sitemodel_model');
        $this->siteid = $this->get_siteid();
        if (!$this->siteid) $this->siteid = 1;
    }

    public function init()
    {
        $categorys = getcache('category_content_' . $this->siteid, 'commons');

        $datas = $this->db->listinfo(array('siteid' => $this->siteid, 'type' => 0), '', $_GET['page'], 30);
        //模型文章数array('模型id'=>数量);
        $items = array();
        foreach ($datas as $k => $r) {
            foreach ($categorys as $catid => $cat) {
                if (intval($cat['modelid']) == intval($r['modelid'])) {
                    $items[$r['modelid']] += intval($cat['items']);
                } else {
                    $items[$r['modelid']] += 0;
                }
            }
            $datas[$k]['items'] = $items[$r['modelid']];
        }

        $pages = $this->db->pages;
        $this->public_cache();
        $big_menu = array('javascript:window.top.art.dialog({id:\'add\',iframe:\'?m=content&c=sitemodel&a=add\', title:\'' . L('add_model') . '\', width:\'580\', height:\'420\', lock:true}, function(){var d = window.top.art.dialog({id:\'add\'}).data.iframe;var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'add\'}).close()});void(0);', L('add_model'));
        include $this->admin_tpl('sitemodel_manage');
    }

    public function add()
    {
        if (isset($_POST['dosubmit'])) {
            $_POST['info']['siteid'] = $this->siteid;
            $_POST['info']['category_template'] = $_POST['setting']['category_template'];
            $_POST['info']['list_template'] = $_POST['setting']['list_template'];
            $_POST['info']['show_template'] = $_POST['setting']['show_template'];
            if (isset($_POST['other']) && $_POST['other']) {
                $_POST['info']['admin_add_template']    = $_POST['setting']['admin_add_template'];
                $_POST['info']['admin_edit_template']   = $_POST['setting']['admin_edit_template'];
                $_POST['info']['admin_list_template']   = $_POST['setting']['admin_list_template'];
                $_POST['info']['member_add_template']   = $_POST['setting']['member_add_template'];
                $_POST['info']['member_list_template']  = $_POST['setting']['member_list_template'];
            } else {
                $unset_array = [
                    'admin_add_template',
                    'admin_edit_template',
                    'admin_list_template',
                    'member_add_template',
                    'member_list_template',
                ];
                foreach ($unset_array as $v) unset($_POST['setting'][$v]);
            }
            $modelid = $this->db->insert($_POST['info'], 1);
            $model_sql = file_get_contents(MODEL_PATH . 'model.sql');
            $tablepre = $this->db->db_tablepre;
            $tablename = $_POST['info']['tablename'];
            $model_sql = str_replace('$basic_table', $tablepre . $tablename, $model_sql);
            $model_sql = str_replace('$table_data', $tablepre . $tablename . '_data', $model_sql);
            $model_sql = str_replace('$table_model_field', $tablepre . 'model_field', $model_sql);
            $model_sql = str_replace('$modelid', $modelid, $model_sql);
            $model_sql = str_replace('$siteid', $this->siteid, $model_sql);

            $this->db->sql_execute($model_sql);
            $this->cache_field($modelid);
            //调用全站搜索类别接口
            $this->type_db = extendLoad::load_model('type_model');
            $this->type_db->insert(array('name' => $_POST['info']['name'], 'module' => 'search', 'modelid' => $modelid, 'siteid' => $this->siteid));
            $cache_api = extendLoad::load_app_class('cache_api', 'admin');
            $cache_api->cache('type');
            $cache_api->search_type();
            showmessage(L('add_success'), '', '', 'add');
        } else {
            extendLoad::load_sys_class('form', '', 0);
            $show_header = $show_validator = '';
            $style_list = template_list($this->siteid, 0);
            foreach ($style_list as $k => $v) {
                $style_list[$v['dirname']] = $v['name'] ? $v['name'] : $v['dirname'];
                unset($style_list[$k]);
            }

            $admin_content_template_array = [
                'add'   => ['content_add', 'name="setting[admin_add_template]"'],
                'edit'  => ['content_edit', 'name="setting[admin_edit_template]"'],
                'list'  => ['content_list', 'name="setting[admin_list_template]"'],
            ];

            foreach ($admin_content_template_array as $_k => $_v) {
                $admin_content_template[$_k] = $this->admin_content_template($_v[0], $_v[1], $_k);
            }

            include $this->admin_tpl('sitemodel_add');
        }
    }

    public function edit()
    {
        if (isset($_POST['dosubmit'])) {

            $modelid = intval($_POST['modelid']);
            $_POST['info']['category_template'] = $_POST['setting']['category_template'];
            $_POST['info']['list_template'] = $_POST['setting']['list_template'];
            $_POST['info']['show_template'] = $_POST['setting']['show_template'];
            if (isset($_POST['other']) && $_POST['other']) {
                $_POST['info']['admin_add_template']    = $_POST['setting']['admin_add_template'];
                $_POST['info']['admin_edit_template']   = $_POST['setting']['admin_edit_template'];
                $_POST['info']['admin_list_template']   = $_POST['setting']['admin_list_template'];
                $_POST['info']['member_add_template']   = $_POST['setting']['member_add_template'];
                $_POST['info']['member_list_template']  = $_POST['setting']['member_list_template'];
            } else {
                $unset_array = [
                    'admin_add_template',
                    'admin_edit_template',
                    'admin_list_template',
                    'member_add_template',
                    'member_list_template',
                ];
                foreach ($unset_array as $v) unset($_POST['setting'][$v]);
            }

            $this->db->update($_POST['info'], array('modelid' => $modelid, 'siteid' => $this->siteid));
            showmessage(L('update_success'), '', '', 'edit');
        } else {
            extendLoad::load_sys_class('form', '', 0);
            $show_header = $show_validator = '';
            $style_list = template_list($this->siteid, 0);
            foreach ($style_list as $k => $v) {
                $style_list[$v['dirname']] = $v['name'] ? $v['name'] : $v['dirname'];
                unset($style_list[$k]);
            }
            $modelid = intval($_GET['modelid']);
            $r = $this->db->get_one(array('modelid' => $modelid));
            extract($r);

            $admin_content_template_array = [
                'add' => [$r['admin_add_template'], 'name="setting[admin_add_template]"'],
                'edit' => [$r['admin_edit_template'], 'name="setting[admin_edit_template]"'],
                'list' => [$r['admin_list_template'], 'name="setting[admin_list_template]"'],
            ];

            foreach ($admin_content_template_array as $_k => $_v) {
                $admin_content_template[$_k] = $this->admin_content_template($_v[0], $_v[1], $_k);
            }

            include $this->admin_tpl('sitemodel_edit');
        }
    }

    public function delete()
    {
        $this->sitemodel_field_db = extendLoad::load_model('sitemodel_field_model');
        $modelid = intval($_GET['modelid']);
        $model_cache = getcache('model', 'commons');
        $model_table = $model_cache[$modelid]['tablename'];
        $this->sitemodel_field_db->delete(array('modelid' => $modelid, 'siteid' => $this->siteid));
        $this->db->drop_table($model_table);
        $this->db->drop_table($model_table . '_data');

        $this->db->delete(array('modelid' => $modelid, 'siteid' => $this->siteid));
        //删除全站搜索接口数据
        $this->type_db = extendLoad::load_model('type_model');
        $this->type_db->delete(array('module' => 'search', 'modelid' => $modelid, 'siteid' => $this->siteid));
        $cache_api = extendLoad::load_app_class('cache_api', 'admin');
        $cache_api->cache('type');
        $cache_api->search_type();
        exit('1');
    }

    public function disabled()
    {
        $modelid = intval($_GET['modelid']);
        $r = $this->db->get_one(array('modelid' => $modelid, 'siteid' => $this->siteid));

        $status = $r['disabled'] == '1' ? '0' : '1';
        $this->db->update(array('disabled' => $status), array('modelid' => $modelid, 'siteid' => $this->siteid));
        showmessage(L('update_success'), HTTP_REFERER);
    }

    /**
     * 更新模型缓存
     */
    public function public_cache()
    {
        require MODEL_PATH . 'fields.inc.php';
        //更新内容模型类：表单生成、入库、更新、输出
        $classtypes = array('form', 'input', 'update', 'output');
        foreach ($classtypes as $classtype) {
            $cache_data = file_get_contents(MODEL_PATH . 'content_' . $classtype . '.class.php');
            $cache_data = str_replace('}?>', '', $cache_data);
            foreach ($fields as $field => $fieldvalue) {
                if (file_exists(MODEL_PATH . $field . DIRECTORY_SEPARATOR . $classtype . '.inc.php')) {
                    $cache_data .= file_get_contents(MODEL_PATH . $field . DIRECTORY_SEPARATOR . $classtype . '.inc.php');
                }
            }
            $cache_data .= "\r\n } \r\n?>";
            file_put_contents(CACHE_MODEL_PATH . 'content_' . $classtype . '.class.php', $cache_data);
            @chmod(CACHE_MODEL_PATH . 'content_' . $classtype . '.class.php', 0777);
        }
        //更新模型数据缓存
        $model_array = array();
        $datas = $this->db->select(array('type' => 0));
        foreach ($datas as $r) {
            if (!$r['disabled']) $model_array[$r['modelid']] = $r;
        }
        setcache('model', $model_array, 'commons');
        return true;
    }

    /**
     * 导出模型
     */
    function export()
    {
        $modelid = isset($_GET['modelid']) ? $_GET['modelid'] : showmessage(L('illegal_parameters'), HTTP_REFERER);
        $modelarr = getcache('model', 'commons');
        //定义系统字段排除
        //$system_field = array('id','title','style','catid','url','listorder','status','userid','username','inputtime','updatetime','pages','readpoint','template','groupids_view','posids','content','keywords','description','thumb','typeid','relation','islink','allow_comment');
        $this->sitemodel_field_db = extendLoad::load_model('sitemodel_field_model');
        $modelinfo = $this->sitemodel_field_db->select(array('modelid' => $modelid));
        foreach ($modelinfo as $k => $v) {
            //if(in_array($v['field'],$system_field)) continue;
            $modelinfoarr[$k] = $v;
            $modelinfoarr[$k]['setting'] = string2array($v['setting']);
        }
        $res = var_export($modelinfoarr, TRUE);
        header('Content-Disposition: attachment; filename="' . $modelarr[$modelid]['tablename'] . '.model"');
        echo $res;
        exit;
    }

    /**
     * 检查表是否存在
     */
    public function public_check_tablename()
    {
        $r = $this->db->table_exists(strip_tags($_GET['tablename']));
        if (!$r) echo '1';
    }

    /**
     * 更新指定模型字段缓存
     *
     * @param $modelid 模型id
     */
    public function cache_field($modelid = 0)
    {
        $this->field_db = extendLoad::load_model('sitemodel_field_model');
        $field_array = array();
        $fields = $this->field_db->select(array('modelid' => $modelid, 'disabled' => $disabled), '*', 100, 'listorder ASC');
        foreach ($fields as $_value) {
            $setting = string2array($_value['setting']);
            $_value = array_merge($_value, $setting);
            $field_array[$_value['field']] = $_value;
        }
        setcache('model_field_' . $modelid, $field_array, 'model');
        return true;
    }
}

?>