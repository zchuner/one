<?php
use \App\Http\PHPExtends\System\extendLoad;

extendLoad::load_app_class('admin', 'admin', 0);
define('IN_ADMIN', true);

/**
 * Created by PhpStorm.
 * User: Rouyi
 * Date: 2017/7/2
 * Time: 17:25
 * Desc: 查看评论
 */
class comment_admin extends admin
{
    public function lists()
    {
        $sitelist = getcache('sitelist', 'commons');
        $chang_yan_config = string2array($sitelist[1]['chang_yan']);
        $url = urlencode($_GET['url']);
        $getUrl = 'load?client_id=' . $chang_yan_config['APP_ID'] . '&topic_url=' . $url;
        $data = $this->getChangYan($getUrl);
        if (!$data['topic_id']) message('参数错误！', 'back', 'error');

        $page_size = 1;
        $page_no = ($_GET['page']) ? $_GET['page'] : 1;

        $itemsGetUrl = 'comments?client_id=' . $chang_yan_config['APP_ID'] . '&topic_id=' . $data['topic_id'] . '&page_size=' . $page_size . '&page_no=' . $page_no;
        $items = $this->getChangYan($itemsGetUrl);
        include $this->admin_tpl('list');
    }

    /**
     * CURL GET 请求
     * @param $url
     * @return mixed
     */
    private function getChangYan($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'http://changyan.sohu.com/api/2/topic/' . $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($curl);
        curl_close($curl);
        return json_decode($data, true);
    }
}