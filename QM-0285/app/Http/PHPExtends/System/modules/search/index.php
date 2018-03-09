<?php
use App\Http\PHPExtends\System\extendLoad;

extendLoad::load_sys_class('form', '', 0);
extendLoad::load_sys_class('format', '', 0);

class index
{
    function __construct()
    {
        $this->db = extendLoad::load_model('search_model');
        $this->content_db = extendLoad::load_model('content_model');
    }

    /**
     * 关键词搜索
     */
    public function init()
    {
        $SEO = seo(1);
        $SEO['title'] = '搜索 - ';

        switch ($_GET['model']) {
            case 1:
                $db = extendLoad::load_model('news_model');
                break;
            default:
                $db = extendLoad::load_model('video_model');
                break;
        }

        $keyword = safe_replace(trim($_GET['keyword']));
        $keyword = new_html_special_chars(strip_tags($keyword));
        $keyword = str_replace('%', '', $keyword);    //过滤'%'，用户全文搜索

        if ($keyword) {
            $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
            $pageSize = 10;

            $data = $db->listinfo("`title` like '%$keyword%'", 'id DESC', $page, $pageSize);

            foreach ($data as $_k => $_v) {
                $data[$_k]['title'] = str_replace($keyword, '<font color=red>' . $keyword . '</font>', $_v['title']);
                $data[$_k]['description'] = str_replace($keyword, '<font color=red>' . $keyword . '</font>', $_v['description']);
            }

            $pages = $db->pages;
            $execute_time = execute_time();
            $searchItems = isset($data) ? $data : '';
            include template('search', 'list');
        } else {
            message('请输入搜索关键词', 'back', 'error');
        }
    }
}