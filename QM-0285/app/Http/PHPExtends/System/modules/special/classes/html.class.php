<?php
/**
 * html.class.php 生成静态类
 */
use \App\Http\PHPExtends\System\extendLoad;

class html
{
    private $db, $type_db, $c_db, $data_db, $site, $queue;

    public function __construct()
    {
        $this->db = extendLoad::load_model('special_model'); //专题数据模型
        $this->type_db = extendLoad::load_model('type_model'); //专题分类数据模型
        $this->c_db = extendLoad::load_model('special_content_model'); //专题内容数据模型
        $this->data_db = extendLoad::load_model('special_c_data_model');
        $this->site = extendLoad::load_app_class('sites', 'admin');
        $this->queue = extendLoad::load_model('queue_model');
        define('HTML', true);
    }

    /**
     * 生成文章静态页
     * @param int $contentid 文章ID
     * @return string|mixed   返回文章的url
     */
    public function _create_content($contentid = 0)
    {
        if (!$contentid) return false;
        extendLoad::load_app_func('global', 'special');
        $r = $this->c_db->get_one(array('id' => $contentid));
        $_special = $s_info = $this->db->get_one(array('id' => $r['specialid']));
        if ($s_info['ishtml'] == 0) return content_url($contentid, '1', 0, 'php');
        unset($arr_content);
        $arr_content = $this->data_db->get_one(array('id' => $contentid));
        @extract($r);
        $title = strip_tags($title);
        if ($arr_content['paginationtype']) {            //文章使用分页时
            if ($arr_content['paginationtype'] == 1) {
                if (strpos($arr_content['content'], '[/page]') !== false) {
                    $arr_content['content'] = preg_replace("|\[page\](.*)\[/page\]|U", '', $arr_content['content']);
                }
                if (strpos($arr_content['content'], '[page]') !== false) {
                    $arr_content['content'] = str_replace('[page]', '', $data['content']);
                }
                $contentpage = extendLoad::load_app_class('contentpage', 'content'); //调用自动分页类
                $arr_content['content'] = $contentpage->get_data($arr_content['content'], $arr_content['maxcharperpage']); //自动分页，自动添加上[page]
            }
        } else {
            if (strpos($arr_content['content'], '[/page]') !== false) {
                $arr_content['content'] = preg_replace("|\[page\](.*)\[/page\]|U", '', $arr_content['content']);
            }
            if (strpos($arr_content['content'], '[page]') !== false) {
                $arr_content['content'] = str_replace('[page]', '', $arr_content['content']);
            }
        }
        $template = $arr_content['show_template'] ? $arr_content['show_template'] : 'show'; //调用模板

        //分站时，计算分站路径
        if ($s_info['siteid'] > 1) {
            $site_info = $this->site->get_by_id($s_info['siteid']);
        }
        $siteid = $s_info['siteid'];
        $CONTENT_POS = strpos($arr_content['content'], '[page]');
        if ($CONTENT_POS !== false) {
            $contents = array_filter(explode('[page]', $arr_content['content']));
            $pagenumber = count($contents);
            $END_POS = strpos($arr_content['content'], '[/page]');
            if ($END_POS !== false && ($CONTENT_POS < 7)) {
                $pagenumber--;
            }
            for ($i = 1; $i <= $pagenumber; $i++) {
                $pageurls[$i] = content_url($contentid, $i, $inputtime, 'html', $site_info);
            }
            if ($END_POS !== false) {
                if ($CONTENT_POS > 7) {
                    $arr_content['content'] = '[page]' . $title . '[/page]' . $arr_content['content'];
                }
                if (preg_match_all("|\[page\](.*)\[/page\]|U", $arr_content['content'], $m, PREG_PATTERN_ORDER)) {
                    foreach ($m[1] as $k => $v) {
                        $p = $k + 1;
                        $titles[$p]['title'] = strip_tags($v);
                        $titles[$p]['url'] = $pageurls[$p][1];
                    }
                }
            }
            $currentpage = $filesize = 0;
            for ($i = 1; $i <= $pagenumber; $i++) {
                $currentpage++;
                //判断[page]出现的位置是否在第一位
                if ($CONTENT_POS < 7) {
                    $content = $contents[$currentpage];
                } else {
                    if ($currentpage == 1 && !empty($titles)) {
                        $content = $title . '[/page]' . $contents[$currentpage - 1];
                    } else {
                        $content = $contents[$currentpage - 1];
                    }
                }
                if ($titles) {
                    list($title, $content) = explode('[/page]', $content);
                    $content = trim($content);
                    if (strpos($content, '</p>') === 0) {
                        $content = '<p>' . $content;
                    }
                    if (stripos($content, '<p>') === 0) {
                        $content = $content . '</p>';
                    }
                }
                $file_url = content_url($contentid, $currentpage, $inputtime, 'html', $site_info);
                if ($currentpage == 1) $urls = $file_url;
                extendLoad::load_app_func('util', 'content');
                $title_pages = content_pages($pagenumber, $currentpage, $pageurls);
                $SEO = seo($s_info['siteid'], '', $title);
                $file = $file_url[1];

                //如果是分站的文件，将文件写入到信息队列中
                $this->queue->add_queue('add', $file, $siteid);
                $file = WEB_PATH . $file; //生成文件的路径

                ob_start();
                include template('special', $template);
                $this->create_html($file);
            }
        } else {
            $page = 1;
            $title = strip_tags($title);
            $SEO = seo($s_info['siteid'], '', $title);
            $content = $arr_content['content'];
            $urls = content_url($contentid, $page, $inputtime, 'html', $site_info);
            $file = $urls[1];

            //如果是分站的文件，将文件写入到信息队列中
            $this->queue->add_queue('add', $file, $siteid);
            $file = WEB_PATH . $file;
            ob_start();
            include template('special', $template);
            $this->create_html($file);
        }
        //$this->_index($specialid, 20, 5);  //更新专题首页
        //$this->_list($typeid, 20, 5); 		//更新所在的分类页
        return $urls;
    }

    /**
     * 生成静态文件
     * @param string $file 文件路径
     * @return bool/intval 成功返回生成文件的大小
     */
    private function create_html($file)
    {
        $data = ob_get_contents();
        ob_end_clean();
        extendLoad::load_sys_func('dir');
        dir_create(dirname($file));
        $strlen = file_put_contents($file, $data);
        @chmod($file, 0777);
        return $strlen;
    }

    /**
     * 生成专题首页
     * @param int $specialid 专题ID
     * @param int $pagesize 每页个数
     * @param int $pages_num 最大更新页数
     * @return mixed 成功返回生成文件的大小
     */
    public function _index($specialid = 0, $pagesize = 20, $pages_num = 0)
    {
        extendLoad::load_app_func('global', 'special');
        $specialid = intval($specialid);
        if (!$specialid) return false;
        $r = $this->db->get_one(array('id' => $specialid, 'siteid' => get_siteid()));
        if (!$r['ishtml'] || $r['disabled'] != 0) return true;

        if (!$specialid) showmessage(L('illegal_action'));
        $info = $this->db->get_one(array('id' => $specialid));
        if (!$info) showmessage(L('special_not_exist'), 'back');
        extract($info);
        if ($pics) {
            $pic_data = get_pic_content($pics);
            unset($pics);
        }
        if ($voteid) {
            $vote_info = explode('|', $voteid);
            $voteid = $vote_info[1];
        }
        $commentid = id_encode('special', $id, $siteid);
        //分站时计算路径
        if ($siteid > 1) {
            $site_info = $this->site->get_by_id($siteid);
            $file = extendLoad::load_config('system', 'html_root') . '/' . $site_info['dirname'] . '/special/' . $filename . '/index.html';
        } else {
            $file = extendLoad::load_config('system', 'html_root') . '/special/' . $filename . '/index.html';
        }
        if (!$ispage) {
            $type_db = extendLoad::load_model('type_model');
            $types = $type_db->select(array('module' => 'special', 'parentid' => $specialid), '*', '', '`listorder` ASC, `typeid` ASC', '', 'listorder');
        }
        $css = get_css(unserialize($css));
        $template = $index_template ? $index_template : 'index';
        $SEO = seo($siteid, '', $title, $description);
        if ($ispage) {
            $re = $this->c_db->get_one(array('specialid' => $specialid), 'COUNT(`id`) AS num');
            $total = $re['num'];
            $times = ceil($total / $pagesize);
            if ($pages_num) $pages_num = min($times, $pages_num);
            else $pages_num = $times;
            for ($i = 1; $i <= $pages_num; $i++) {
                if ($i == 1) $file_root = $file;
                else $file_root = str_replace('index', 'index-' . $i, $file);
                $this->queue->add_queue('add', $file_root, $siteid); //添加至信息队列
                $file_root = WEB_PATH . $file_root;
                ob_start();
                include template('special', $template);
                $this->create_html($file_root);
            }
            return true;
        } else {
            $this->queue->add_queue('add', $file, $siteid); //添加至信息队列
            $file = WEB_PATH . $file;
            ob_start();
            include template('special', $template, $style);
            return $this->create_html($file);
        }
    }

    /**
     * 生成列表页
     */
    public function create_list($page = 1)
    {
        $siteid = get_siteid();
        $site_info = $this->site->get_by_id($siteid);
        define('URLRULE', $site_info['domain'] . substr(extendLoad::load_config('system', 'html_root'), 1) . '/special/index.html~' . $site_info['domain'] . substr(extendLoad::load_config('system', 'html_root'), 1) . '/special/index-{$page}.html');
        //分站时计算路径
        if ($siteid > 1) {
            if ($page == 1) $file = extendLoad::load_config('system', 'html_root') . '/' . $site_info['dirname'] . '/special/index.html';
            else $file = extendLoad::load_config('system', 'html_root') . '/' . $site_info['dirname'] . '/special/index-' . $page . '.html';
        } else {
            if ($page == 1) $file = extendLoad::load_config('system', 'html_root') . '/special/index.html';
            else $file = extendLoad::load_config('system', 'html_root') . '/special/index-' . $page . '.html';
        }
        $this->queue->add_queue('add', $file, $siteid);
        $file = WEB_PATH . $file;
        ob_start();
        include template('special', 'special_list');
        return $this->create_html($file);
    }

    /**
     * 生成分类页
     * @param intval $typeid 分类ID
     * @param intval $page 页数
     */
    public function create_type($typeid = 0, $page = 1)
    {
        if (!$typeid) return false;
        $info = $this->type_db->get_one(array('typeid' => $typeid));
        $s_info = $this->db->get_one(array('id' => $info['parentid']));
        extract($s_info);
        $site_info = $this->site->get_by_id($siteid);
        define('URLRULE', $site_info['domain'] . substr(extendLoad::load_config('system', 'html_root'), 1) . '/special/{$specialdir}/{$typedir}/type-{$typeid}.html~' . $site_info['domain'] . substr(extendLoad::load_config('system', 'html_root'), 1) . '/special/{$specialdir}/{$typedir}/type-{$typeid}-{$page}.html');
        $GLOBALS['URL_ARRAY'] = array('specialdir' => $filename, 'typedir' => $info['typedir'], 'typeid' => $typeid);
        $SEO = seo($siteid, '', $info['typename'], '');
        $template = $list_template ? $list_template : 'list';

        if ($siteid > 1) {
            if ($page == 1) $file = extendLoad::load_config('system', 'html_root') . '/' . $site_info['dirname'] . '/special/' . $filename . '/' . $info['typedir'] . '/type-' . $typeid . '.html';
            else $file = extendLoad::load_config('system', 'html_root') . '/' . $site_info['dirname'] . '/special/' . $filename . '/' . $info['typedir'] . '/type-' . $typeid . '-' . $page . '.html';
        } else {
            if ($page == 1) $file = extendLoad::load_config('system', 'html_root') . '/special/' . $filename . '/' . $info['typedir'] . '/type-' . $typeid . '.html';
            else $file = extendLoad::load_config('system', 'html_root') . '/special/' . $filename . '/' . $info['typedir'] . '/type-' . $typeid . '-' . $page . '.html';
        }
        $this->queue->add_queue('add', $file, $siteid);
        $file = WEB_PATH . $file;
        ob_start();
        include template('special', $template);
        $this->create_html($file);
    }

    /**
     * 生成分类静态页
     * @param intval $typeid 分类ID
     * @param intval $pagesize 每页篇数
     * @param intval $pages 最大更新页数
     */
    public function _list($typeid = 0, $pagesize = 20, $pages = 0)
    {
        if (!$typeid) return false;
        $r = $this->c_db->get_one(array('typeid' => $typeid), 'COUNT(`id`) AS num');
        $total = $r['num'];
        $times = ceil($total / $pagesize);
        if ($pages) $pages = min($times, $pages);
        else $pages = $times;
        for ($i = 1; $i <= $pages; $i++) {
            $this->create_type($typeid, $i);
        }
        return true;
    }
}