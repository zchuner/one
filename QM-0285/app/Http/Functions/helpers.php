<?php
/**
 * Created by PhpStorm.
 * User: Rouyi
 * Date: 2017/5/3
 * Time: 2:25
 * Desc: 公共函数库
 */

define('ROOT_PATH', dirname(dirname(dirname(dirname(__FILE__)))) . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR);
define('LOAD_PATH', dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'PHPExtends' . DIRECTORY_SEPARATOR . 'System' . DIRECTORY_SEPARATOR);
define('TEMPLATE_PATH', dirname(dirname(dirname(dirname(__FILE__)))) . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'home' . DIRECTORY_SEPARATOR);
define('TEMPLATE_PREFIX', '.blade.php');

if (!function_exists('string2array')) {
    /**
     * 将字符串转换为数组
     * @param    string $data 字符串
     * @return    array    返回数组格式，如果，data为空，则返回空数组
     */
    function string2array($data)
    {
        $array = [];
        $data = trim($data);
        if ($data == '') return [];
        if (strpos($data, 'array') === 0) {
            @eval("\$array = $data;");
        } else {
            if (strpos($data, '{\\') === 0) $data = stripslashes($data);
            $array = json_decode($data, true);
        }
        return $array;
    }
}

if (!function_exists('p')) {
    /**
     * 打印输出数据
     *
     * @param $var
     */
    function p($var)
    {
        echo "<pre>" . print_r($var, true) . "</pre>";
    }
}

if (!function_exists('message')) {

    /**
     * 消息提示
     *
     * @param string $content 消息内容
     * @param string $redirect 跳转地址有三种方式 1:back(返回上一页)  2:refresh(刷新当前页)  3:具体Url
     * @param string $type 信息类型  success(成功），error(失败），warning(警告），info(提示）
     * @param int $timeout 等待时间
     * @return mixed
     */
    function message($content, $redirect = 'back', $type = 'success', $timeout = 1)
    {
        switch ($redirect) {
            case 'back':
                //有回调地址时回调,没有时返回主页
                $url = "window.history.go(-1)";
                break;
            default:
                if (empty($redirect)) {
                    $url = 'window.history.go(-1)';
                } else {
                    $url = "location.replace('" . url($redirect) . "')";
                }
                break;
        }

        //图标
        switch ($type) {
            case 'success':
                $ico = 'fa-check-circle';
                break;
            case 'error':
                $ico = 'fa-times-circle';
                break;
            case 'info':
                $ico = 'fa-info-circle';
                break;
            case 'warning':
                $ico = 'fa-warning';
                break;
            default:
                $ico = 'fa-info-circle';
                break;
        }

        exit(view('message.index')->with('data', [
            'content' => $content,
            'url' => $url,
            'ico' => $ico,
            'timeout' => $timeout * 1000
        ]));
    }
}

if (!function_exists('getExecuteTime')) {
    /**
     * 执行程序用时
     * @return string 0.000012
     */
    function getExecuteTime()
    {
        $start_time = explode(' ', microtime());
        $end_time = explode(' ', microtime());
        return number_format(($end_time [1] + $end_time [0] - $start_time [1] - $start_time [0]), 6);
    }
}

if (!function_exists('getSec2Time')) {

    /**
     * 将秒数转换为时间（年、天、小时、分、秒）
     * @param int $time
     * @return bool|string
     */
    function getSec2Time($time)
    {
        if (!$time) return '0:00';
        if (is_numeric($time)) {
            $value = [
                "years" => 0, "days" => 0, "hours" => 0,
                "minutes" => 0, "seconds" => 0,
            ];

            if ($time >= 31556926) {
                $value["years"] = floor($time / 31556926);
                $time = ($time % 31556926);
            }

            if ($time >= 86400) {
                $value["days"] = floor($time / 86400);
                $time = ($time % 86400);
            }

            if ($time >= 3600) {
                $value["hours"] = floor($time / 3600);
                $time = ($time % 3600);
            }

            if ($time >= 60) {
                $value["minutes"] = floor($time / 60);
                $time = ($time % 60);
            }

            $value["seconds"] = floor($time);

            foreach ($value as $k => $v) if ($v < 10) $value[$k] = '0' . $v;

            //$t = $value["years"] . "年" . $value["days"] . "天" . " " . $value["hours"] . "小时" . $value["minutes"] . "分" . $value["seconds"] . "秒";
            $t = $value["hours"] . ":" . $value["minutes"] . ":" . $value["seconds"];
            return $t;
        } else {
            return (bool)FALSE;
        }
    }
}

if (!function_exists('getCurl')) {
    /**
     * CURL GET 请求服务器
     * @param $url
     * @return string
     * @throws Exception
     */
    function getCurl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        if (curl_exec($ch) === false) {
            throw new \Exception(curl_error($ch));
            $data = '';
        } else {
            $data = curl_multi_getcontent($ch);
        }
        curl_close($ch);

        return $data;
    }
}

if (!function_exists('postCurl')) {
    /**
     * CURL POST 请求服务器
     * @param $url
     * @param $postData
     * @return string
     * @throws Exception
     */
    function postCurl($url, $postData)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        if (curl_exec($ch) === false) {
            throw new \Exception(curl_error($ch));
            $data = '';
        } else {
            $data = curl_multi_getcontent($ch);
        }
        curl_close($ch);

        return $data;
    }
}

if (!function_exists('getLang')) {
    /**
     * 获取语言配置
     * @param string $language
     * @param array $pars
     * @param string $modules
     * @return mixed
     */
    function getLang($language = 'no_language', $pars = [], $modules = '')
    {
        static $LANG = [];
        static $LANG_MODULES = [];
        static $lang = '';

        $admin = \App\Http\Model\Admin::find(session('admin')['userid']);
        $lang = ($admin['lang'] == 'en') ? 'en' : 'zh-cn';
        $LANG_PATH = LOAD_PATH . 'languages' . DIRECTORY_SEPARATOR . $lang . DIRECTORY_SEPARATOR;;

        if (!$LANG) {
            require_once $LANG_PATH . 'system.lang.php';
            require_once $LANG_PATH . 'system_menu.lang.php';
            if (file_exists($LANG_PATH . 'admin.lang.php')) require_once $LANG_PATH . 'admin.lang.php';
        }

        if (!empty($modules)) {
            $modules = explode(',', $modules);
            foreach ($modules AS $m) {
                if (!isset($LANG_MODULES[$m])) require_once $LANG_PATH . $m . '.lang.php';
            }
        }

        if (!array_key_exists($language, $LANG)) {
            return $language;
        }

        $language = $LANG[$language];
        if ($pars) {
            foreach ($pars AS $_k => $_v) {
                $language = str_replace('{' . $_k . '}', $_v, $language);
            }
        }
        return $language;
    }
}

if (!function_exists('getNickname')) {
    /**
     * 获取模型配置数据
     * @param string $username 如果指定用户名
     * @return string
     */
    function getNickname($username = '')
    {
        if ($username) {
            $admin = \App\Http\Model\Admin::where('username', $username)->first();
            if ($admin) return ($admin['realname']) ? $admin['realname'] : $username;
            return $username;
        } else {
            $admin = \App\Http\Model\Admin::find(session('admin')['userid']);
            return ($admin['realname']) ? $admin['realname'] : $admin['username'];
        }
    }
}

if (!function_exists('getExtendsUrl')) {
    /**
     * 获取模块URL
     * @param string $url
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    function getExtendsUrl($url = '')
    {
        return url('admin/extend' . $url);
    }
}

if (!function_exists('getConfigRole')) {
    /**
     * 获取角色权限
     * @param $roleId
     * @param $field
     * @return string|bool
     */
    function getConfigRole($roleId, $field)
    {
        if (!$roleId) return '';
        $data = \App\Http\Model\AdminRole::find($roleId);
        if ($data) return ($field) ? $data[$field] : $data;
        return false;
    }
}

if (!function_exists('errors')) {
    /**
     * 显示自定义错误页面模板
     * @param $code
     * @return mixed
     */
    function errors($code = 404)
    {
        Header("http/1.1 {$code} Forbidden");
        exit(view('errors.' . $code, compact('message')));
    }
}

if (!function_exists('getVodConfig')) {
    /**
     * 获取腾讯 VOD 配置
     * @param string $field 字段
     * @param string $field2 字段
     * @return array|string
     */
    function getVodConfig($field = '', $field2 = '')
    {
        $siteDb = new \App\Http\Model\Site();
        $rs = $siteDb->find(1);
        if (!$rs) return '';
        $data = string2array($rs['t_vod']);
        if ($field && $field2 && $data[$field][$field2]) return $data[$field][$field2];
        return ($field && $data[$field]) ? $data[$field] : $data;
    }
}

if (!function_exists('getLvbConfig')) {
    /**
     * 获取腾讯 VOD 配置
     * @param string $field 字段
     * @param string $field2 字段2
     * @return array|string
     */
    function getLvbConfig($field = '', $field2 = '')
    {
        $siteDb = new \App\Http\Model\Site();
        $rs = $siteDb->find(1);
        if (!$rs) return '';
        $data = string2array($rs['t_lvb']);
        if ($field && $field2 && $data[$field][$field2]) return $data[$field][$field2];
        return ($field && $data[$field]) ? $data[$field] : $data;
    }
}

if (!function_exists('getVideoDelete')) {
    /**
     * 删除腾讯 VOD 视频
     * @param int $file_id 视频ID
     * @return bool
     */
    function getVideoDelete($file_id)
    {
        if (!$file_id) return false;
        return getVodFile($file_id, 'DeleteVodFile');
    }
}

if (!function_exists('getVodFile')) {
    /**
     * 腾讯视频 VOD API GET 操作
     * @param string $file_id 文件ID
     * @param string $action 接口名称 GetVideoInfo:获取文件信息, DeleteVodFile:删除文件,
     * @param int $isArray 是否需要转为数组
     * @return bool|array
     */
    function getVodFile($file_id, $action = 'GetVideoInfo', $isArray = 1)
    {
        $vodConfig = getVodConfig();
        $url = 'vod.api.qcloud.com/v2/index.php';
        $url .= '?Action=' . $action;
        $url .= '&Nonce=' . random(5); //随机正整数，与 Timestamp 联合起来, 用于防止重放攻击。
        $url .= '&SecretId=' . $vodConfig['SecretId']; //在云API密钥上申请的标识身份的 SecretId，一个 SecretId 对应唯一的 SecretKey , 而 SecretKey 会用来生成请求签名 Signature。具体可参考 签名方法 页面。
        $url .= '&SignatureMethod=HmacSHA256'; //签名方式，目前支持HmacSHA256和HmacSHA1。只有指定此参数为HmacSHA256时，才使用HmacSHA256算法验证签名，其他情况均使用HmacSHA1验证签名。签名计算方法可参考 签名方法 页面。
        $url .= '&Timestamp=' . time(); //当前UNIX时间戳，可记录发起API请求的时间。
        $url .= '&fileId=' . $file_id; //文件id
        switch ($action) {
            case 'DeleteVodFile': {
                $url .= '&priority=0'; //可填0；优先级0:中 1：高 2：低
            }
                break;
            case 'GetVideoInfo': {
                $url .= '&infoFilter.0=basicInfo'; //如果是获取视频信息，即获取简单信息，想要获取全部，删掉此行即可
            }
                break;
        }

        $signStr = base64_encode(hash_hmac('sha256', 'GET' . $url, $vodConfig['SecretKey'], true)); //签名

        $url .= '&Signature=' . urlencode($signStr); //请求签名，用来验证此次请求的合法性，需要用户根据实际的输入参数计算得出。计算方法可参考 签名方法 页面。
        $url = 'https://' . $url; //最后拼凑的URL

        $curl = getCurl($url);
        $back = ($isArray) ? json_decode($curl, true) : $curl;
        return $back;
    }
}

if (!function_exists('getAppRoute')) {
    /**
     * 组装路由
     * @param array $data
     */
    function getAppRoute($data = [])
    {
        if (!$data) exit(0);
        foreach ($data as $k => $v) {
            $_GET[$k] = $v;
        }

        \App\Http\PHPExtends\System\extendLoad::creat_app();
    }
}

if (!function_exists('getListsPick')) {
    /**
     * 排除指定ID内容
     * @param array $data
     * @param array $reNoIds
     * @return array
     */
    function getListsPick($data = [], $reNoIds = [])
    {
        foreach ($reNoIds as $k => $v) {
            if (in_array($v, $data[$v])) {
                unset($data[$v]);
            }
        }
        return $data;
    }
}

if (!function_exists('getChangeIntoTime')) {
    /**
     * 毫秒转换成时间
     * @param string $tag
     * @param int $time
     * @return mixed
     */
    function getChangeIntoTime($tag, $time)
    {
        $a = substr($time, 0, 10);
        $date = date($tag, $a);
        return $date;
    }
}

if (!function_exists('getCommentPage')) {
    /**
     * 获取评论分页
     * @param int $cmt_sum
     * @param int $page_no
     * @return mixed
     */
    function getCommentPage($cmt_sum, $page_no)
    {
        $next = "<a style='cursor:no-drop;background:#f1f1f1'>下一页</a>\n";
        $pre = "<a style='cursor:no-drop;background:#f1f1f1'>上一页</a>\n";
        if ($cmt_sum > $page_no) {
            $next = '<a href="' . get_url() . '&page=' . ($page_no + 1) . '">下一页</a>' . "\n";
        } else {
            $pre = '<a href="' . get_url() . '&page=' . ($page_no - 1) . '">上一页</a>' . "\n";
        }
        return $next . $pre;
    }
}

if (!function_exists('getChangYanConfig')) {
    /**
     * 获取畅言评论配置
     * @param string $field
     * @return mixed
     */
    function getChangYanConfig($field)
    {
        $sitelist = getcache('sitelist', 'commons');
        $chang_yan_config = string2array($sitelist[1]['chang_yan']);
        return $chang_yan_config[$field];
    }
}

if (!function_exists('getViewNumber')) {
    /**
     * 取得文章阅读量
     * @param int $id 文档ID
     * @param int $cid 栏目ID
     * @return int
     */
    function getViewNumber($id, $cid)
    {
        $model = new \App\Http\Model\Hits();
        $CATEGORYS = getcache('category_content_1', 'commons');
        $getItem = $model->getCount('c-' . $CATEGORYS[$cid]['modelid'] . '-' . $id);
        return !is_null($getItem) ? $getItem['views'] : 0;
    }
}

if (!function_exists('getPraiseNumber')) {
    /**
     * 取得文章点赞数量
     * @param int $id 文档ID
     * @param int $cid 栏目ID
     * @return int
     */
    function getPraiseNumber($id, $cid)
    {
        $model = new \App\Http\Model\PraiseModel();
        return $model->where(['id' => $id, 'cid' => $cid])->count();
    }
}