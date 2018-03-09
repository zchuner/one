<?php
use \App\Http\PHPExtends\System\extendLoad;

extendLoad::load_app_class('admin', 'admin', 0);

define('IN_ADMIN', true);

class site extends admin
{
    private $db;

    public function __construct()
    {
        $this->db = extendLoad::load_model('site_model');
        parent::__construct();
    }

    /**
     * 站点列表
     */
    public function init()
    {
        $total = $this->db->count();
        $page = isset($_GET['page']) && intval($_GET['page']) ? intval($_GET['page']) : 1;
        $pagesize = 20;
        $offset = ($page - 1) * $pagesize;
        $list = $this->db->select('', '*', $offset . ',' . $pagesize);
        $pages = pages($total, $page, $pagesize);
        include $this->admin_tpl('site_list');
    }

    /**
     * 编辑站点
     */
    public function edit()
    {
        $siteid = isset($_GET['siteid']) && intval($_GET['siteid']) ? intval($_GET['siteid']) : showmessage(L('illegal_parameters'), HTTP_REFERER);
        $data = $this->db->get_one(['siteid' => $siteid]);
        if ($data) {
            if (isset($_POST['dosubmit'])) {
                $name = isset($_POST['name']) && trim($_POST['name']) ? trim($_POST['name']) : showmessage(L('site_name') . L('empty'));
                $domain = isset($_POST['domain']) && trim($_POST['domain']) ? trim($_POST['domain']) : '';
                $site_title = isset($_POST['site_title']) && trim($_POST['site_title']) ? trim($_POST['site_title']) : '';
                $keywords = isset($_POST['keywords']) && trim($_POST['keywords']) ? trim($_POST['keywords']) : '';
                $description = isset($_POST['description']) && trim($_POST['description']) ? trim($_POST['description']) : '';

                if (!empty($domain) && !preg_match('/http:\/\/(.+)\/$/i', $domain)) {
                    showmessage(L('site_domain') . L('site_domain_ex2'));
                }

                $_POST['setting']['watermark_img'] = 'statics/images/water/' . $_POST['setting']['watermark_img'];

                $t_vod = trim(array2string($_POST['t_vod']));
                $chang_yan = trim(array2string($_POST['chang_yan']));
                $t_lvb = trim(array2string($_POST['t_lvb']));

                $sql = [
                    'name' => $name,
                    'domain' => $domain,
                    'site_title' => $site_title,
                    'keywords' => $keywords,
                    'description' => $description,
                    't_vod' => $t_vod,
                    'chang_yan' => $chang_yan,
                    't_lvb' => $t_lvb,
                ];

                if ($this->db->update($sql, ['siteid' => $siteid])) {
                    $class_site = extendLoad::load_app_class('sites');
                    $class_site->set_cache();
                    showmessage(L('operation_success'), url('admin/extend?c=site&a=init'));
                } else {
                    showmessage(L('operation_failure'), HTTP_REFERER);
                }
            } else {
                $show_validator = true;
                $show_header = true;
                $show_scroll = true;
                $template_list = template_list();
                $setting = string2array($data['setting']);
                $data['t_vod'] = string2array($data['t_vod']);;
                $data['chang_yan'] = string2array($data['chang_yan']);;
                $data['t_lvb'] = string2array($data['t_lvb']);;
                include $this->admin_tpl('site_edit');
            }
        } else {
            showmessage(L('notfound'), HTTP_REFERER);
        }
    }

    public function public_name()
    {
        $name = isset($_GET['name']) && trim($_GET['name']) ? (extendLoad::load_config('system', 'charset') == 'gbk' ? iconv('utf-8', 'gbk', trim($_GET['name'])) : trim($_GET['name'])) : exit('0');
        $siteid = isset($_GET['siteid']) && intval($_GET['siteid']) ? intval($_GET['siteid']) : '';
        $data = [];
        if ($siteid) {

            $data = $this->db->get_one(array('siteid' => $siteid), 'name');
            if (!empty($data) && $data['name'] == $name) {
                exit('1');
            }
        }
        if ($this->db->get_one(array('name' => $name), 'siteid')) {
            exit('0');
        } else {
            exit('1');
        }
    }

    public function public_dirname()
    {
        $dirname = isset($_GET['dirname']) && trim($_GET['dirname']) ? (extendLoad::load_config('system', 'charset') == 'gbk' ? iconv('utf-8', 'gbk', trim($_GET['dirname'])) : trim($_GET['dirname'])) : exit('0');
        $siteid = isset($_GET['siteid']) && intval($_GET['siteid']) ? intval($_GET['siteid']) : '';
        $data = [];
        if ($siteid) {
            $data = $this->db->get_one(array('siteid' => $siteid), 'dirname');
            if (!empty($data) && $data['dirname'] == $dirname) {
                exit('1');
            }
        }
        if ($this->db->get_one(array('dirname' => $dirname), 'siteid')) {
            exit('0');
        } else {
            exit('1');
        }
    }
}