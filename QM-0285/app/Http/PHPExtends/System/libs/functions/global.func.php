<?php
use \App\Http\PHPExtends\System\extendLoad;

if (!function_exists('new_addslashes')) {
    /**
     * 返回经addslashes处理过的字符串或数组
     * @param string $string 需要处理的字符串或数组
     * @return mixed
     */
    function new_addslashes($string)
    {
        if (!is_array($string)) return addslashes($string);
        foreach ($string as $key => $val) $string[$key] = new_addslashes($val);
        return $string;
    }
}

if (!function_exists('new_stripslashes')) {
    /**
     * 返回经stripslashes处理过的字符串或数组
     * @param string $string 需要处理的字符串或数组
     * @return mixed
     */
    function new_stripslashes($string)
    {
        if (!is_array($string)) return stripslashes($string);
        foreach ($string as $key => $val) $string[$key] = new_stripslashes($val);
        return $string;
    }
}

if (!function_exists('new_html_special_chars')) {
    /**
     * 返回经htmlspecialchars处理过的字符串或数组
     * @param string $string 需要处理的字符串或数组
     * @return mixed
     */
    function new_html_special_chars($string)
    {
        $encoding = 'utf-8';
        if (strtolower(CHARSET) == 'gbk') $encoding = 'ISO-8859-15';
        if (!is_array($string)) return htmlspecialchars($string, ENT_QUOTES, $encoding);
        foreach ($string as $key => $val) $string[$key] = new_html_special_chars($val);
        return $string;
    }
}

if (!function_exists('new_html_entity_decode')) {
    function new_html_entity_decode($string)
    {
        $encoding = 'utf-8';
        if (strtolower(CHARSET) == 'gbk') $encoding = 'ISO-8859-15';
        return html_entity_decode($string, ENT_QUOTES, $encoding);
    }
}

if (!function_exists('new_htmlentities')) {
    function new_htmlentities($string)
    {
        $encoding = 'utf-8';
        if (strtolower(CHARSET) == 'gbk') $encoding = 'ISO-8859-15';
        return htmlentities($string, ENT_QUOTES, $encoding);
    }
}

if (!function_exists('safe_replace')) {
    /**
     * 安全过滤函数
     * @param $string
     * @return string
     */
    function safe_replace($string)
    {
        $string = str_replace('%20', '', $string);
        $string = str_replace('%27', '', $string);
        $string = str_replace('%2527', '', $string);
        $string = str_replace('*', '', $string);
        $string = str_replace('"', '&quot;', $string);
        $string = str_replace("'", '', $string);
        $string = str_replace('"', '', $string);
        $string = str_replace(';', '', $string);
        $string = str_replace('<', '&lt;', $string);
        $string = str_replace('>', '&gt;', $string);
        $string = str_replace("{", '', $string);
        $string = str_replace('}', '', $string);
        $string = str_replace('\\', '', $string);
        return $string;
    }
}

if (!function_exists('remove_xss')) {
    /**
     * xss过滤函数
     * @param $string
     * @return string
     */
    function remove_xss($string)
    {
        $string = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S', '', $string);

        $parm1 = Array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'script', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'title', 'base');

        $parm2 = Array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload');

        $parm = array_merge($parm1, $parm2);

        for ($i = 0; $i < sizeof($parm); $i++) {
            $pattern = '/';
            for ($j = 0; $j < strlen($parm[$i]); $j++) {
                if ($j > 0) {
                    $pattern .= '(';
                    $pattern .= '(&#[x|X]0([9][a][b]);?)?';
                    $pattern .= '|(&#0([9][10][13]);?)?';
                    $pattern .= ')?';
                }
                $pattern .= $parm[$i][$j];
            }
            $pattern .= '/i';
            $string = preg_replace($pattern, ' ', $string);
        }
        return $string;
    }
}

if (!function_exists('trim_unsafe_control_chars')) {
    /**
     * 过滤ASCII码从0-28的控制字符
     * @return String
     */
    function trim_unsafe_control_chars($str)
    {
        $rule = '/[' . chr(1) . '-' . chr(8) . chr(11) . '-' . chr(12) . chr(14) . '-' . chr(31) . ']*/';
        return str_replace(chr(0), '', preg_replace($rule, '', $str));
    }
}

if (!function_exists('trim_textarea')) {
    /**
     * 格式化文本域内容
     * @param string $string 文本域内容
     * @return string
     */
    function trim_textarea($string)
    {
        $string = nl2br(str_replace(' ', '&nbsp;', $string));
        return $string;
    }
}

if (!function_exists('format_js')) {
    /**
     * 将文本格式成适合js输出的字符串
     * @param string $string 需要处理的字符串
     * @param int $isjs 是否执行字符串格式化，默认为执行
     * @return string 处理后的字符串
     */
    function format_js($string, $isjs = 1)
    {
        $string = addslashes(str_replace(array("\r", "\n", "\t"), array('', '', ''), $string));
        return $isjs ? 'document.write("' . $string . '");' : $string;
    }
}

if (!function_exists('trim_script')) {
    /**
     * 转义 javascript 代码标记
     * @param $str
     * @return mixed
     */
    function trim_script($str)
    {
        if (is_array($str)) {
            foreach ($str as $key => $val) {
                $str[$key] = trim_script($val);
            }
        } else {
            $str = preg_replace('/\<([\/]?)script([^\>]*?)\>/si', '&lt;\\1script\\2&gt;', $str);
            $str = preg_replace('/\<([\/]?)iframe([^\>]*?)\>/si', '&lt;\\1iframe\\2&gt;', $str);
            $str = preg_replace('/\<([\/]?)frame([^\>]*?)\>/si', '&lt;\\1frame\\2&gt;', $str);
            $str = str_replace('javascript:', 'javascript：', $str);
        }
        return $str;
    }
}

if (!function_exists('get_url')) {
    /**
     * 获取当前页面完整URL地址
     */
    function get_url()
    {
        $sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
        $php_self = $_SERVER['PHP_SELF'] ? safe_replace($_SERVER['PHP_SELF']) : safe_replace($_SERVER['SCRIPT_NAME']);
        $path_info = isset($_SERVER['PATH_INFO']) ? safe_replace($_SERVER['PATH_INFO']) : '';
        $relate_url = isset($_SERVER['REQUEST_URI']) ? safe_replace($_SERVER['REQUEST_URI']) : $php_self . (isset($_SERVER['QUERY_STRING']) ? '?' . safe_replace($_SERVER['QUERY_STRING']) : $path_info);
        return $sys_protocal . (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '') . $relate_url;
    }
}

if (!function_exists('str_cut')) {
    /**
     * 字符截取 支持UTF8/GBK
     * @param $string
     * @param $length
     * @param string $dot
     * @return mixed|string
     */
    function str_cut($string, $length, $dot = '...')
    {
        $strlen = strlen($string);
        if ($strlen <= $length) return $string;
        $string = str_replace(array(' ', '&nbsp;', '&amp;', '&quot;', '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '&lt;', '&gt;', '&middot;', '&hellip;'), array('∵', ' ', '&', '"', "'", '“', '”', '—', '<', '>', '·', '…'), $string);
        $strcut = '';
        if (strtolower(CHARSET) == 'utf-8') {
            $length = intval($length - strlen($dot) - $length / 3);
            $n = $tn = $noc = 0;
            while ($n < strlen($string)) {
                $t = ord($string[$n]);
                if ($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
                    $tn = 1;
                    $n++;
                    $noc++;
                } elseif (194 <= $t && $t <= 223) {
                    $tn = 2;
                    $n += 2;
                    $noc += 2;
                } elseif (224 <= $t && $t <= 239) {
                    $tn = 3;
                    $n += 3;
                    $noc += 2;
                } elseif (240 <= $t && $t <= 247) {
                    $tn = 4;
                    $n += 4;
                    $noc += 2;
                } elseif (248 <= $t && $t <= 251) {
                    $tn = 5;
                    $n += 5;
                    $noc += 2;
                } elseif ($t == 252 || $t == 253) {
                    $tn = 6;
                    $n += 6;
                    $noc += 2;
                } else {
                    $n++;
                }
                if ($noc >= $length) {
                    break;
                }
            }
            if ($noc > $length) {
                $n -= $tn;
            }
            $strcut = substr($string, 0, $n);
            $strcut = str_replace(array('∵', '&', '"', "'", '“', '”', '—', '<', '>', '·', '…'), array(' ', '&amp;', '&quot;', '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '&lt;', '&gt;', '&middot;', '&hellip;'), $strcut);
        } else {
            $dotlen = strlen($dot);
            $maxi = $length - $dotlen - 1;
            $current_str = '';
            $search_arr = array('&', ' ', '"', "'", '“', '”', '—', '<', '>', '·', '…', '∵');
            $replace_arr = array('&amp;', '&nbsp;', '&quot;', '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '&lt;', '&gt;', '&middot;', '&hellip;', ' ');
            $search_flip = array_flip($search_arr);
            for ($i = 0; $i < $maxi; $i++) {
                $current_str = ord($string[$i]) > 127 ? $string[$i] . $string[++$i] : $string[$i];
                if (in_array($current_str, $search_arr)) {
                    $key = $search_flip[$current_str];
                    $current_str = str_replace($search_arr[$key], $replace_arr[$key], $current_str);
                }
                $strcut .= $current_str;
            }
        }
        return $strcut . $dot;
    }
}

if (!function_exists('ip')) {
    /**
     * 获取请求ip
     * @return string ip地址
     */
    function ip()
    {
        if (getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
            $ip = getenv('HTTP_CLIENT_IP');
        } elseif (getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        } elseif (getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
            $ip = getenv('REMOTE_ADDR');
        } elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return preg_match('/[\d\.]{7,15}/', $ip, $matches) ? $matches [0] : '';
    }
}

if (!function_exists('get_cost_time')) {
    function get_cost_time()
    {
        $microtime = microtime(TRUE);
        return $microtime - SYS_START_TIME;
    }
}

if (!function_exists('execute_time')) {
    /**
     * 程序执行时间
     * @return    int    单位ms
     */
    function execute_time()
    {
        $stime = explode(' ', SYS_START_TIME);
        $etime = explode(' ', microtime());
        return number_format(($etime [1] + $etime [0] - $stime [1] - $stime [0]), 6);
    }
}

if (!function_exists('random')) {
    /**
     * 产生随机字符串
     * @param    int $length 输出长度
     * @param    string $chars 可选的 ，默认为 0123456789
     * @return   string     字符串
     */
    function random($length, $chars = '0123456789')
    {
        $hash = '';
        $max = strlen($chars) - 1;
        mt_srand();
        for ($i = 0; $i < $length; $i++) {
            $hash .= $chars[mt_rand(0, $max)];
        }
        return $hash;
    }
}

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
        if ($data == '') return array();
        if (strpos($data, 'array') === 0) {
            @eval("\$array = $data;");
        } else {
            if (strpos($data, '{\\') === 0) $data = stripslashes($data);
            $array = json_decode($data, true);
            if (strtolower(CHARSET) == 'gbk') {
                $array = mult_iconv("UTF-8", "GBK//IGNORE", $array);
            }
        }
        return $array;
    }
}

if (!function_exists('array2string')) {
    /**
     * 将数组转换为字符串
     * @param    array $data 数组
     * @param    int $isformdata 如果为0，则不使用new_stripslashes处理，可选参数，默认为1
     * @return    string    返回字符串，如果，data为空，则返回空
     */
    function array2string($data, $isformdata = 1)
    {
        if ($data == '' || empty($data)) return '';

        if ($isformdata) $data = new_stripslashes($data);
        if (strtolower(CHARSET) == 'gbk') {
            $data = mult_iconv("GBK", "UTF-8", $data);
        }
        if (version_compare(PHP_VERSION, '5.3.0', '<')) {
            return addslashes(json_encode($data));
        } else {
            return addslashes(json_encode($data, JSON_FORCE_OBJECT));
        }
    }
}

if (!function_exists('mult_iconv')) {
    /**
     * 数组转码
     * @param $in_charset
     * @param $out_charset
     * @param $data
     * @return mixed|string
     */
    function mult_iconv($in_charset, $out_charset, $data)
    {
        if (substr($out_charset, -8) == '//IGNORE') {
            $out_charset = substr($out_charset, 0, -8);
        }
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                if (is_array($value)) {
                    $key = iconv($in_charset, $out_charset . '//IGNORE', $key);
                    $rtn[$key] = mult_iconv($in_charset, $out_charset, $value);
                } elseif (is_string($key) || is_string($value)) {
                    if (is_string($key)) {
                        $key = iconv($in_charset, $out_charset . '//IGNORE', $key);
                    }
                    if (is_string($value)) {
                        $value = iconv($in_charset, $out_charset . '//IGNORE', $value);
                    }
                    $rtn[$key] = $value;
                } else {
                    $rtn[$key] = $value;
                }
            }
        } elseif (is_string($data)) {
            $rtn = iconv($in_charset, $out_charset . '//IGNORE', $data);
        } else {
            $rtn = $data;
        }
        return $rtn;
    }
}

if (!function_exists('sizecount')) {
    /**
     * 转换字节数为其他单位
     * @param    string $filesize 字节大小
     * @return    string    返回大小
     */
    function sizecount($filesize)
    {
        if ($filesize >= 1073741824) {
            $filesize = round($filesize / 1073741824 * 100) / 100 . ' GB';
        } elseif ($filesize >= 1048576) {
            $filesize = round($filesize / 1048576 * 100) / 100 . ' MB';
        } elseif ($filesize >= 1024) {
            $filesize = round($filesize / 1024 * 100) / 100 . ' KB';
        } else {
            $filesize = $filesize . ' Bytes';
        }
        return $filesize;
    }
}

if (!function_exists('sys_auth')) {
    /**
     * 字符串加密、解密函数
     * @param    string $string 字符串
     * @param    string $operation ENCODE为加密，DECODE为解密，可选参数，默认为ENCODE，
     * @param    string $key 密钥：数字、字母、下划线
     * @param    int $expiry 过期时间
     * @return    string
     */
    function sys_auth($string, $operation = 'ENCODE', $key = '', $expiry = 0)
    {
        $ckey_length = 4;
        $key = md5($key != '' ? $key : extendLoad::load_config('system', 'auth_key'));
        $keya = md5(substr($key, 0, 16));
        $keyb = md5(substr($key, 16, 16));
        $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length) : substr(md5(microtime()), -$ckey_length)) : '';

        $cryptkey = $keya . md5($keya . $keyc);
        $key_length = strlen($cryptkey);

        $string = $operation == 'DECODE' ? base64_decode(strtr(substr($string, $ckey_length), '-_', '+/')) : sprintf('%010d', $expiry ? $expiry + time() : 0) . substr(md5($string . $keyb), 0, 16) . $string;
        $string_length = strlen($string);

        $result = '';
        $box = range(0, 255);

        $rndkey = array();
        for ($i = 0; $i <= 255; $i++) {
            $rndkey[$i] = ord($cryptkey[$i % $key_length]);
        }

        for ($j = $i = 0; $i < 256; $i++) {
            $j = ($j + $box[$i] + $rndkey[$i]) % 256;
            $tmp = $box[$i];
            $box[$i] = $box[$j];
            $box[$j] = $tmp;
        }

        for ($a = $j = $i = 0; $i < $string_length; $i++) {
            $a = ($a + 1) % 256;
            $j = ($j + $box[$a]) % 256;
            $tmp = $box[$a];
            $box[$a] = $box[$j];
            $box[$j] = $tmp;
            $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
        }

        if ($operation == 'DECODE') {
            if ((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26) . $keyb), 0, 16)) {
                return substr($result, 26);
            } else {
                return '';
            }
        } else {
            return $keyc . rtrim(strtr(base64_encode($result), '+/', '-_'), '=');
        }
    }
}

if (!function_exists('L')) {
    /**
     * 语言文件处理
     * @param    string $language 标示符
     * @param    array $pars 转义的数组,二维数组 ,'key1'=>'value1','key2'=>'value2',
     * @param    string $modules 多个模块之间用半角逗号隔开，如：member,guestbook
     * @return    string        语言字符
     */
    function L($language = 'no_language', $pars = array(), $modules = '')
    {
        static $LANG = array();
        static $LANG_MODULES = array();
        static $lang = '';
        if (defined('IN_ADMIN')) {
            $lang = SYS_STYLE ? SYS_STYLE : 'zh-cn';
        } else {
            $lang = extendLoad::load_config('system', 'lang');
        }

        if (!$LANG) {
            require_once LOAD_PATH . 'languages' . DIRECTORY_SEPARATOR . $lang . DIRECTORY_SEPARATOR . 'system.lang.php';
            if (defined('IN_ADMIN')) require_once LOAD_PATH . 'languages' . DIRECTORY_SEPARATOR . $lang . DIRECTORY_SEPARATOR . 'system_menu.lang.php';
            if (file_exists(LOAD_PATH . 'languages' . DIRECTORY_SEPARATOR . $lang . DIRECTORY_SEPARATOR . ROUTE_M . '.lang.php')) require_once LOAD_PATH . 'languages' . DIRECTORY_SEPARATOR . $lang . DIRECTORY_SEPARATOR . ROUTE_M . '.lang.php';
        }
        if (!empty($modules)) {
            $modules = explode(',', $modules);
            foreach ($modules AS $m) {
                if (!isset($LANG_MODULES[$m])) require_once LOAD_PATH . 'languages' . DIRECTORY_SEPARATOR . $lang . DIRECTORY_SEPARATOR . $m . '.lang.php';
            }
        }

        if (!array_key_exists($language, $LANG)) {
            return $language;
        } else {
            $language = $LANG[$language];
            if ($pars) {
                foreach ($pars AS $_k => $_v) {
                    $language = str_replace('{' . $_k . '}', $_v, $language);
                }
            }
            return $language;
        }
    }
}

if (!function_exists('template')) {
    /**
     * 模板调用
     *
     * @param string $module 模块
     * @param string $template 模板
     * @param string $style 风格目录
     * @return mixed
     */
    function template($module = 'content', $template = 'index', $style = '')
    {
        if (strpos($module, 'plugin/') !== false) {
            $plugin = str_replace('plugin/', '', $module);
            return p_template($plugin, $template, $style);
        }

        $module = str_replace('/', DIRECTORY_SEPARATOR, $module);

        if (!empty($style) && preg_match('/([a-z0-9\-_]+)/is', $style)) {
            //
        } elseif (empty($style) && !defined('STYLE')) {
            if (defined('SITEID')) {
                $siteid = SITEID;
            } else {
                $siteid = param::get_cookie('siteid');
            }
            if (!$siteid) $siteid = 1;
            $sitelist = getcache('sitelist', 'commons');
            if (!empty($siteid)) {
                $style = $sitelist[$siteid]['default_style'];
            }
        } elseif (empty($style) && defined('STYLE')) {
            $style = STYLE;
        } else {
            $style = 'default';
        }

        if (!$style) $style = 'default';

        $template_cache = extendLoad::load_sys_class('template_cache');
        $compiledtplfile = CACHE_PATH . 'caches_template' . DIRECTORY_SEPARATOR . $style . DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR . $template . '.php';

        if (file_exists(TEMPLATE_PATH . $style . DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR . $template . TEMPLATE_PREFIX)) {
            if (!file_exists($compiledtplfile) || (@filemtime(TEMPLATE_PATH . $style . DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR . $template . TEMPLATE_PREFIX) > @filemtime($compiledtplfile))) {
                $template_cache->template_compile($module, $template, $style);
            }
        } else {
            $compiledtplfile = CACHE_PATH . 'caches_template' . DIRECTORY_SEPARATOR . 'default' . DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR . $template . '.php';
            if (!file_exists($compiledtplfile) || (file_exists(TEMPLATE_PATH . 'default' . DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR . $template . TEMPLATE_PREFIX) && filemtime(TEMPLATE_PATH . 'default' . DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR . $template . TEMPLATE_PREFIX) > filemtime($compiledtplfile))) {
                $template_cache->template_compile($module, $template, 'default');
            } elseif (!file_exists(TEMPLATE_PATH . 'default' . DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR . $template . '.html')) {
                showmessage('模板.' . DIRECTORY_SEPARATOR . $style . DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR . $template . TEMPLATE_PREFIX . '不存在');
            }
        }

        return $compiledtplfile;
    }
}

if (!function_exists('getTemplate')) {
    /**
     * 引入模板文件 用于页面中显示
     * @param string $template 需要引入的模板文件
     * @param string $page 页面属性 如：home, category, news
     * @return mixed
     */
    function getTemplate($template = 'header', $page = 'home')
    {
        return template('content', $template);
    }
}

if (!function_exists('my_error_handler')) {
    /**
     * 输出自定义错误
     *
     * @param int $errno 错误号
     * @param string $errstr 错误描述
     * @param string $errfile 报错文件地址
     * @param int $errline 错误行号
     * @return string 错误提示
     */
    function my_error_handler($errno, $errstr, $errfile, $errline)
    {
        if ($errno == 8) return '';
        $errfile = str_replace(LOAD_PATH, '', $errfile);
        if (extendLoad::load_config('system', 'errorlog')) {
            error_log('<?php exit;?>' . date('m-d H:i:s', SYS_TIME) . ' | ' . $errno . ' | ' . str_pad($errstr, 30) . ' | ' . $errfile . ' | ' . $errline . "\r\n", 3, CACHE_PATH . 'log' . DIRECTORY_SEPARATOR . 'error.php');
        } else {
            $str = '<div><span>errorno:' . $errno . ',str:' . $errstr . ',file:<font color="red">' . $errfile . '</font>,line' . $errline . '<br /></span></div>';
            echo $str;
        }
        return '';
    }
}

if (!function_exists('showmessage')) {
    /**
     * 提示信息页面跳转，跳转地址如果传入数组，页面会提示多个地址供用户选择，默认跳转地址为数组的第一个值，时间为5秒。
     * @param string $msg 提示信息
     * @param mixed(string/array) $url_forward 跳转地址
     * @param int $ms 跳转等待时间
     * @return mixed
     */
    function showmessage($msg, $url_forward = 'goback', $ms = 1250, $dialog = '', $returnjs = '')
    {
        if (defined('IN_ADMIN')) {
            include(admin::admin_tpl('showmessage', 'admin'));
        } else {
            include(template('content', 'message'));
        }
        exit;
    }
}

if (!function_exists('str_exists')) {
    /**
     * 查询字符是否存在于某字符串
     *
     * @param string $haystack 字符串
     * @param string $needle 要查找的字符
     * @return bool
     */
    function str_exists($haystack, $needle)
    {
        return !(strpos($haystack, $needle) === FALSE);
    }
}

if (!function_exists('fileext')) {
    /**
     * 取得文件扩展
     *
     * @param string $filename 文件名
     * @return string 扩展名
     */
    function fileext($filename)
    {
        return strtolower(trim(substr(strrchr($filename, '.'), 1, 10)));
    }
}

if (!function_exists('tpl_cache')) {
    /**
     * 加载模板标签缓存
     * @param string $name 缓存名
     * @param int $times 缓存时间
     * @return mixed
     */
    function tpl_cache($name, $times = 0)
    {
        $filepath = 'tpl_data';
        $info = getcacheinfo($name, $filepath);
        if (SYS_TIME - $info['filemtime'] >= $times) {
            return false;
        } else {
            return getcache($name, $filepath);
        }
    }
}

if (!function_exists('setcache')) {
    /**
     * 写入缓存，默认为文件缓存，不加载缓存配置。
     * @param string $name 缓存名称
     * @param array $data 缓存数据
     * @param string $filepath 数据路径（模块名称） caches/cache_$filepath/
     * @param string $type 缓存类型[file,memcache,apc]
     * @param string $config 配置名称
     * @param int $timeout 过期时间
     * @return mixed
     */
    function setcache($name, $data, $filepath = '', $type = 'file', $config = '', $timeout = 0)
    {
        if (!preg_match("/^[a-zA-Z0-9_-]+$/", $name)) return false;
        if ($filepath != "" && !preg_match("/^[a-zA-Z0-9_-]+$/", $filepath)) return false;
        extendLoad::load_sys_class('cache_factory', '', 0);
        if ($config) {
            $cacheconfig = extendLoad::load_config('cache');
            $cache = cache_factory::get_instance($cacheconfig)->get_cache($config);
        } else {
            $cache = cache_factory::get_instance()->get_cache($type);
        }

        return $cache->set($name, $data, $timeout, '', $filepath);
    }
}

if (!function_exists('getcache')) {
    /**
     * 读取缓存，默认为文件缓存，不加载缓存配置。
     * @param string $name 缓存名称
     * @param string $filepath 数据路径（模块名称） caches/cache_$filepath/
     * @param string $config 配置名称
     * @return mixed
     */
    function getcache($name, $filepath = '', $type = 'file', $config = '')
    {
        if (!preg_match("/^[a-zA-Z0-9_-]+$/", $name)) return false;
        if ($filepath != "" && !preg_match("/^[a-zA-Z0-9_-]+$/", $filepath)) return false;
        extendLoad::load_sys_class('cache_factory', '', 0);
        if ($config) {
            $cacheconfig = extendLoad::load_config('cache');
            $cache = cache_factory::get_instance($cacheconfig)->get_cache($config);
        } else {
            $cache = cache_factory::get_instance()->get_cache($type);
        }
        return $cache->get($name, '', '', $filepath);
    }
}

if (!function_exists('delcache')) {
    /**
     * 删除缓存，默认为文件缓存，不加载缓存配置。
     * @param string $name 缓存名称
     * @param string $filepath 数据路径（模块名称） caches/cache_$filepath/
     * @param string $type 缓存类型[file,memcache,apc]
     * @param string $config 配置名称
     * @return mixed
     */
    function delcache($name, $filepath = '', $type = 'file', $config = '')
    {
        if (!preg_match("/^[a-zA-Z0-9_-]+$/", $name)) return false;
        if ($filepath != "" && !preg_match("/^[a-zA-Z0-9_-]+$/", $filepath)) return false;
        extendLoad::load_sys_class('cache_factory', '', 0);
        if ($config) {
            $cacheconfig = extendLoad::load_config('cache');
            $cache = cache_factory::get_instance($cacheconfig)->get_cache($config);
        } else {
            $cache = cache_factory::get_instance()->get_cache($type);
        }
        return $cache->delete($name, '', '', $filepath);
    }
}

if (!function_exists('getcacheinfo')) {
    /**
     * 读取缓存，默认为文件缓存，不加载缓存配置。
     * @param string $name 缓存名称
     * @param string $filepath 数据路径（模块名称） caches/cache_$filepath/
     * @param string $config 配置名称
     * @return mixed
     */
    function getcacheinfo($name, $filepath = '', $type = 'file', $config = '')
    {
        if (!preg_match("/^[a-zA-Z0-9_-]+$/", $name)) return false;
        if ($filepath != "" && !preg_match("/^[a-zA-Z0-9_-]+$/", $filepath)) return false;
        extendLoad::load_sys_class('cache_factory');
        if ($config) {
            $cacheconfig = extendLoad::load_config('cache');
            $cache = cache_factory::get_instance($cacheconfig)->get_cache($config);
        } else {
            $cache = cache_factory::get_instance()->get_cache($type);
        }
        return $cache->cacheinfo($name, '', '', $filepath);
    }
}

if (!function_exists('to_sqls')) {
    /**
     * 生成sql语句，如果传入$in_cloumn 生成格式为 IN('a', 'b', 'c')
     * @param array $data 条件数组或者字符串
     * @param string $front 连接符
     * @param bool $in_column 字段名称
     * @return string|array
     */
    function to_sqls($data, $front = ' AND ', $in_column = false)
    {
        if ($in_column && is_array($data)) {
            $ids = '\'' . implode('\',\'', $data) . '\'';
            $sql = "$in_column IN ($ids)";
            return $sql;
        } else {
            if ($front == '') {
                $front = ' AND ';
            }
            if (is_array($data) && count($data) > 0) {
                $sql = '';
                foreach ($data as $key => $val) {
                    $sql .= $sql ? " $front `$key` = '$val' " : " `$key` = '$val' ";
                }
                return $sql;
            } else {
                return $data;
            }
        }
    }
}

if (!function_exists('pages')) {
    /**
     * 分页函数
     *
     * @param int $num 信息总数
     * @param int $curr_page 当前分页
     * @param int $perpage 每页显示数
     * @param string $urlrule URL规则
     * @param array $array 需要传递的数组，用于增加额外的方法
     * @return string 分页
     */
    function pages($num, $curr_page, $perpage = 20, $urlrule = '', $array = array(), $setpages = 10)
    {
        if (defined('URLRULE') && $urlrule == '') {
            $urlrule = URLRULE;
            $array = $GLOBALS['URL_ARRAY'];
        } elseif ($urlrule == '') {
            $urlrule = url_par('page={$page}');
        }
        $multipage = '';
        if ($num > $perpage) {
            $page = $setpages + 1;
            $offset = ceil($setpages / 2 - 1);
            $pages = ceil($num / $perpage);
            if (defined('IN_ADMIN') && !defined('PAGES')) define('PAGES', $pages);
            $from = $curr_page - $offset;
            $to = $curr_page + $offset;
            $more = 0;
            if ($page >= $pages) {
                $from = 2;
                $to = $pages - 1;
            } else {
                if ($from <= 1) {
                    $to = $page - 1;
                    $from = 2;
                } elseif ($to >= $pages) {
                    $from = $pages - ($page - 2);
                    $to = $pages - 1;
                }
                $more = 1;
            }
            $multipage .= '<a>' . $num . L('page_item') . '</a>';
            if ($curr_page > 0) {
                $multipage .= ' <a href="' . pageurl($urlrule, $curr_page - 1, $array) . '">' . L('previous') . '</a>';
                if ($curr_page == 1) {
                    $multipage .= ' <span>1</span>';
                } elseif ($curr_page > 6 && $more) {
                    $multipage .= ' <a href="' . pageurl($urlrule, 1, $array) . '">1</a>..';
                } else {
                    $multipage .= ' <a href="' . pageurl($urlrule, 1, $array) . '">1</a>';
                }
            }
            for ($i = $from; $i <= $to; $i++) {
                if ($i != $curr_page) {
                    $multipage .= ' <a href="' . pageurl($urlrule, $i, $array) . '">' . $i . '</a>';
                } else {
                    $multipage .= ' <span>' . $i . '</span>';
                }
            }
            if ($curr_page < $pages) {
                if ($curr_page < $pages - 5 && $more) {
                    $multipage .= ' ..<a href="' . pageurl($urlrule, $pages, $array) . '">' . $pages . '</a> <a href="' . pageurl($urlrule, $curr_page + 1, $array) . '">' . L('next') . '</a>';
                } else {
                    $multipage .= ' <a href="' . pageurl($urlrule, $pages, $array) . '">' . $pages . '</a> <a href="' . pageurl($urlrule, $curr_page + 1, $array) . '">' . L('next') . '</a>';
                }
            } elseif ($curr_page == $pages) {
                $multipage .= ' <span>' . $pages . '</span> <a href="' . pageurl($urlrule, $curr_page, $array) . '">' . L('next') . '</a>';
            } else {
                $multipage .= ' <a href="' . pageurl($urlrule, $pages, $array) . '">' . $pages . '</a> <a href="' . pageurl($urlrule, $curr_page + 1, $array) . '">' . L('next') . '</a>';
            }
        }
        return $multipage;
    }
}

if (!function_exists('pageurl')) {
    /**
     * 返回分页路径
     * @param string $urlrule 分页规则
     * @param int $page 当前页
     * @param array $array 需要传递的数组，用于增加额外的方法
     * @return string 完整的URL路径
     */
    function pageurl($urlrule, $page, $array = [])
    {
        if (strpos($urlrule, '~')) {
            $urlrules = explode('~', $urlrule);
            $urlrule = $page < 2 ? $urlrules[0] : $urlrules[1];
        }
        $findme = ['{$page}'];
        $replaceme = [$page];
        if (is_array($array)) foreach ($array as $k => $v) {
            $findme[] = '{$' . $k . '}';
            $replaceme[] = $v;
        }

        $url = str_replace($findme, $replaceme, $urlrule);
        return (strpos($url, '://') === false) ? APP_PATH . $url : $url;
    }
}

if (!function_exists('url_par')) {
    /**
     * URL路径解析，pages 函数的辅助函数
     * @param string $par 传入需要解析的变量 默认为，page={$page}
     * @param string $url URL地址
     * @return string
     */
    function url_par($par, $url = '')
    {
        if ($url == '') $url = get_url();
        $pos = strpos($url, '?');
        if ($pos === false) {
            $url .= '?' . $par;
        } else {
            $querystring = substr(strstr($url, '?'), 1);
            parse_str($querystring, $pars);
            $query_array = array();
            foreach ($pars as $k => $v) {
                if ($k != 'page') $query_array[$k] = $v;
            }
            $querystring = http_build_query($query_array) . '&' . $par;
            $url = substr($url, 0, $pos) . '?' . $querystring;
        }
        return $url;
    }
}

if (!function_exists('is_email')) {
    /**
     * 判断email格式是否正确
     * @param string $email
     * @return bool
     */
    function is_email($email)
    {
        return strlen($email) > 6 && preg_match("/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/", $email);
    }
}

if (!function_exists('iconv')) {
    /**
     * iconv 编辑转换
     */
    function iconv($in_charset, $out_charset, $str)
    {
        $in_charset = strtoupper($in_charset);
        $out_charset = strtoupper($out_charset);
        if (function_exists('mb_convert_encoding')) {
            return mb_convert_encoding($str, $out_charset, $in_charset);
        } else {
            extendLoad::load_sys_func('iconv');
            $in_charset = strtoupper($in_charset);
            $out_charset = strtoupper($out_charset);
            if ($in_charset == 'UTF-8' && ($out_charset == 'GBK' || $out_charset == 'GB2312')) {
                return utf8_to_gbk($str);
            }
            if (($in_charset == 'GBK' || $in_charset == 'GB2312') && $out_charset == 'UTF-8') {
                return gbk_to_utf8($str);
            }
            return $str;
        }
    }
}

if (!function_exists('show_ad')) {
    /**
     * 代码广告展示函数
     * @param int $siteid 所属站点
     * @param int $id 广告ID
     * @return string 返回广告代码
     */
    function show_ad($siteid, $id)
    {
        $siteid = intval($siteid);
        $id = intval($id);
        if (!$id || !$siteid) return false;
        $p = extendLoad::load_model('poster_model');
        $r = $p->get_one(array('spaceid' => $id, 'siteid' => $siteid), 'disabled, setting', '`id` ASC');
        if ($r['disabled']) return '';
        if ($r['setting']) {
            $c = string2array($r['setting']);
        } else {
            $r['code'] = '';
        }
        return $c['code'];
    }
}

if (!function_exists('get_siteid')) {
    /**
     * 获取当前的站点ID
     */
    function get_siteid()
    {
        static $siteid;
        if (!empty($siteid)) return $siteid;
        if (defined('IN_ADMIN')) {
            if ($d = param::get_cookie('siteid')) {
                $siteid = $d;
            } else {
                return '';
            }
        } else {
            $data = getcache('sitelist', 'commons');
            if (!is_array($data)) return '1';
            $site_url = SITE_PROTOCOL . SITE_URL;
            foreach ($data as $v) {
                if ($v['url'] == $site_url . '/') $siteid = $v['siteid'];
            }
        }
        if (empty($siteid)) $siteid = 1;
        return $siteid;
    }
}

if (!function_exists('get_nickname')) {
    /**
     * 获取用户昵称
     * 不传入userid取当前用户nickname,如果nickname为空取username
     * 传入field，取用户$field字段信息
     */
    function get_nickname($userid = '', $field = '')
    {
        $return = '';
        if (is_numeric($userid)) {
            $member_db = extendLoad::load_model('member_model');
            $memberinfo = $member_db->get_one(array('userid' => $userid));
            if (!empty($field) && $field != 'nickname' && isset($memberinfo[$field]) && !empty($memberinfo[$field])) {
                $return = $memberinfo[$field];
            } else {
                $return = isset($memberinfo['nickname']) && !empty($memberinfo['nickname']) ? $memberinfo['nickname'] . '(' . $memberinfo['username'] . ')' : $memberinfo['username'];
            }
        } else {
            if (param::get_cookie('_nickname')) {
                $return .= '(' . param::get_cookie('_nickname') . ')';
            } else {
                $return .= '(' . param::get_cookie('_username') . ')';
            }
        }
        return $return;
    }
}

if (!function_exists('get_memberinfo')) {
    /**
     * 获取用户信息
     * 不传入$field返回用户所有信息,
     * 传入field，取用户$field字段信息
     */
    function get_memberinfo($userid, $field = '')
    {
        if (!is_numeric($userid)) {
            return false;
        } else {
            static $memberinfo;
            if (!isset($memberinfo[$userid])) {
                $member_db = extendLoad::load_model('member_model');
                $memberinfo[$userid] = $member_db->get_one(array('userid' => $userid));
            }
            if (!empty($field) && !empty($memberinfo[$userid][$field])) {
                return $memberinfo[$userid][$field];
            } else {
                return $memberinfo[$userid];
            }
        }
    }
}

if (!function_exists('get_memberinfo_buyusername')) {
    /**
     * 通过 username 值，获取用户所有信息
     * 获取用户信息
     * 不传入$field返回用户所有信息,
     * 传入field，取用户$field字段信息
     */
    function get_memberinfo_buyusername($username, $field = '')
    {
        if (empty($username)) {
            return false;
        }
        static $memberinfo;
        if (!isset($memberinfo[$username])) {
            $member_db = extendLoad::load_model('member_model');
            $memberinfo[$username] = $member_db->get_one(array('username' => $username));
        }
        if (!empty($field) && !empty($memberinfo[$username][$field])) {
            return $memberinfo[$username][$field];
        } else {
            return $memberinfo[$username];
        }
    }
}

if (!function_exists('get_memberavatar')) {
    /**
     * 获取用户头像，建议传入phpssouid
     * @param int $uid 默认为phpssouid
     * @param string $is_userid $uid是否为v9 userid，如果为真，执行sql查询此用户的phpssouid
     * @param string $size 头像大小 有四种[30x30 45x45 90x90 180x180] 默认30
     * @return bool|string
     */
    function get_memberavatar($uid, $is_userid = '', $size = '30')
    {
        return '';
    }
}

if (!function_exists('menu_linkage')) {
    /**
     * 调用关联菜单
     * @param int $linkageid 联动菜单id
     * @param string $id 生成联动菜单的样式id
     * @param int $defaultvalue 默认值
     * @return string
     */
    function menu_linkage($linkageid = 0, $id = 'linkid', $defaultvalue = 0)
    {
        $linkageid = intval($linkageid);
        $datas = array();
        $datas = getcache($linkageid, 'linkage');
        $infos = $datas['data'];

        if ($datas['style'] == '1') {
            $title = $datas['title'];
            $container = 'content' . random(3) . date('is');
            if (!defined('DIALOG_INIT_1')) {
                define('DIALOG_INIT_1', 1);
                $string .= '<script type="text/javascript" src="' . JS_PATH . 'dialog.js"></script>';
                //TODO $string .= '<link href="'.CSS_PATH.'dialog.css" rel="stylesheet" type="text/css">';
            }
            if (!defined('LINKAGE_INIT_1')) {
                define('LINKAGE_INIT_1', 1);
                $string .= '<script type="text/javascript" src="' . JS_PATH . 'linkage/js/pop.js"></script>';
            }
            $var_div = $defaultvalue && (ROUTE_A == 'edit' || ROUTE_A == 'account_manage_info' || ROUTE_A == 'info_publish' || ROUTE_A == 'orderinfo') ? menu_linkage_level($defaultvalue, $linkageid, $infos) : $datas['title'];
            $var_input = $defaultvalue && (ROUTE_A == 'edit' || ROUTE_A == 'account_manage_info' || ROUTE_A == 'info_publish') ? '<input type="hidden" name="info[' . $id . ']" value="' . $defaultvalue . '">' : '<input type="hidden" name="info[' . $id . ']" value="">';
            $string .= '<div name="' . $id . '" value="" id="' . $id . '" class="ib">' . $var_div . '</div>' . $var_input . ' <input type="button" name="btn_' . $id . '" class="button" value="' . L('linkage_select') . '" onclick="open_linkage(\'' . $id . '\',\'' . $title . '\',' . $container . ',\'' . $linkageid . '\')">';
            $string .= '<script type="text/javascript">';
            $string .= 'var returnid_' . $id . '= \'' . $id . '\';';
            $string .= 'var returnkeyid_' . $id . ' = \'' . $linkageid . '\';';
            $string .= 'var ' . $container . ' = new Array(';
            foreach ($infos AS $k => $v) {
                if ($v['parentid'] == 0) {
                    $s[] = 'new Array(\'' . $v['linkageid'] . '\',\'' . $v['name'] . '\',\'' . $v['parentid'] . '\')';
                } else {
                    continue;
                }
            }
            $s = implode(',', $s);
            $string .= $s;
            $string .= ')';
            $string .= '</script>';

        } elseif ($datas['style'] == '2') {
            if (!defined('LINKAGE_INIT_1')) {
                define('LINKAGE_INIT_1', 1);
                $string .= '<script type="text/javascript" src="' . JS_PATH . 'linkage/js/jquery.ld.js"></script>';
            }
            $default_txt = '';
            if ($defaultvalue) {
                $default_txt = menu_linkage_level($defaultvalue, $linkageid, $infos);
                $default_txt = '["' . str_replace(' > ', '","', $default_txt) . '"]';
            }
            $string .= $defaultvalue && (ROUTE_A == 'edit' || ROUTE_A == 'account_manage_info' || ROUTE_A == 'info_publish') ? '<input type="hidden" name="info[' . $id . ']"  id="' . $id . '" value="' . $defaultvalue . '">' : '<input type="hidden" name="info[' . $id . ']"  id="' . $id . '" value="">';

            for ($i = 1; $i <= $datas['setting']['level']; $i++) {
                $string .= '<select class="pc-select-' . $id . '" name="' . $id . '-' . $i . '" id="' . $id . '-' . $i . '" width="100"><option value="">请选择菜单</option></select> ';
            }

            $string .= '<script type="text/javascript">
					$(function(){
						var $ld5 = $(".pc-select-' . $id . '");					  
						$ld5.ld({ajaxOptions : {"url" : "' . APP_PATH . 'api.php?op=get_linkage&act=ajax_select&keyid=' . $linkageid . '"},defaultParentId : 0,style : {"width" : 120}})	 
						var ld5_api = $ld5.ld("api");
						ld5_api.selected(' . $default_txt . ');
						$ld5.bind("change",onchange);
						function onchange(e){
							var $target = $(e.target);
							var index = $ld5.index($target);
							$("#' . $id . '-' . $i . '").remove();
							$("#' . $id . '").val($ld5.eq(index).show().val());
							index ++;
							$ld5.eq(index).show();								}
					})
		</script>';

        } else {
            $title = $defaultvalue ? $infos[$defaultvalue]['name'] : $datas['title'];
            $colObj = random(3) . date('is');
            $string = '';
            if (!defined('LINKAGE_INIT')) {
                define('LINKAGE_INIT', 1);
                $string .= '<script type="text/javascript" src="' . JS_PATH . 'linkage/js/mln.colselect.js"></script>';
                if (defined('IN_ADMIN')) {
                    $string .= '<link href="' . JS_PATH . 'linkage/style/admin.css" rel="stylesheet" type="text/css">';
                } else {
                    $string .= '<link href="' . JS_PATH . 'linkage/style/css.css" rel="stylesheet" type="text/css">';
                }
            }
            $string .= '<input type="hidden" name="info[' . $id . ']" value="1"><div id="' . $id . '"></div>';
            $string .= '<script type="text/javascript">';
            $string .= 'var colObj' . $colObj . ' = {"Items":[';

            foreach ($infos AS $k => $v) {
                $s .= '{"name":"' . $v['name'] . '","topid":"' . $v['parentid'] . '","colid":"' . $k . '","value":"' . $k . '","fun":function(){}},';
            }

            $string .= substr($s, 0, -1);
            $string .= ']};';
            $string .= '$("#' . $id . '").mlnColsel(colObj' . $colObj . ',{';
            $string .= 'title:"' . $title . '",';
            $string .= 'value:"' . $defaultvalue . '",';
            $string .= 'width:100';
            $string .= '});';
            $string .= '</script>';
        }
        return $string;
    }
}

if (!function_exists('menu_linkage_level')) {
    /**
     * 联动菜单层级
     * @param $linkageid
     * @param $keyid
     * @param $infos
     * @param array $result
     * @return string
     */
    function menu_linkage_level($linkageid, $keyid, $infos, $result = array())
    {
        if (array_key_exists($linkageid, $infos)) {
            $result[] = $infos[$linkageid]['name'];
            return menu_linkage_level($infos[$linkageid]['parentid'], $keyid, $infos, $result);
        }
        krsort($result);
        return implode(' > ', $result);
    }
}

if (!function_exists('menu_level')) {
    /**
     * 通过catid获取显示菜单完整结构
     * @param int $menuid 菜单ID
     * @param string $cache_file 菜单缓存文件名称
     * @param string $cache_path 缓存文件目录
     * @param string $key 取得缓存值的键值名称
     * @param string $parentkey 父级的ID
     * @param string $linkstring 链接字符
     * @return string
     */
    function menu_level($menuid, $cache_file, $cache_path = 'commons', $key = 'catname', $parentkey = 'parentid', $linkstring = ' > ', $result = array())
    {
        $menu_arr = getcache($cache_file, $cache_path);
        if (array_key_exists($menuid, $menu_arr)) {
            $result[] = $menu_arr[$menuid][$key];
            return menu_level($menu_arr[$menuid][$parentkey], $cache_file, $cache_path, $key, $parentkey, $linkstring, $result);
        }
        krsort($result);
        return implode($linkstring, $result);
    }
}

if (!function_exists('get_linkage')) {
    /**
     * 通过id获取显示联动菜单
     * @param int $linkageid 联动菜单ID
     * @param int $keyid 菜单keyid
     * @param string $space 菜单间隔符
     * @param int $type 1 返回间隔符链接，完整路径名称 3 返回完整路径数组，2返回当前联动菜单名称，4 直接返回ID
     * @param array $result 递归使用字段1
     * @param array $infos 递归使用字段2
     * @return mixed
     */
    function get_linkage($linkageid, $keyid, $space = '>', $type = 1, $result = array(), $infos = array())
    {
        if ($space == '' || !isset($space)) $space = '>';
        if (!$infos) {
            $datas = getcache($keyid, 'linkage');
            $infos = $datas['data'];
        }
        if ($type == 1 || $type == 3 || $type == 4) {
            if (array_key_exists($linkageid, $infos)) {
                $result[] = ($type == 1) ? $infos[$linkageid]['name'] : (($type == 4) ? $linkageid : $infos[$linkageid]);
                return get_linkage($infos[$linkageid]['parentid'], $keyid, $space, $type, $result, $infos);
            } else {
                if (count($result) > 0) {
                    krsort($result);
                    if ($type == 1 || $type == 4) $result = implode($space, $result);
                    return $result;
                } else {
                    return $result;
                }
            }
        } else {
            return $infos[$linkageid]['name'];
        }
    }
}

if (!function_exists('is_ie')) {
    /**
     * IE浏览器判断
     */
    function is_ie()
    {
        $useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
        if ((strpos($useragent, 'opera') !== false) || (strpos($useragent, 'konqueror') !== false)) return false;
        if (strpos($useragent, 'msie ') !== false) return true;
        return false;
    }
}

if (!function_exists('file_down')) {
    /**
     * 文件下载
     * @param string $filepath 文件路径
     * @param string $filename 文件名称
     */
    function file_down($filepath, $filename = '')
    {
        if (!$filename) $filename = basename($filepath);
        if (is_ie()) $filename = rawurlencode($filename);
        $filetype = fileext($filename);
        $filesize = sprintf("%u", filesize($filepath));
        if (ob_get_length() !== false) @ob_end_clean();
        header('Pragma: public');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Cache-Control: pre-check=0, post-check=0, max-age=0');
        header('Content-Transfer-Encoding: binary');
        header('Content-Encoding: none');
        header('Content-type: ' . $filetype);
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-length: ' . $filesize);
        readfile($filepath);
        exit;
    }
}

if (!function_exists('is_utf8')) {
    /**
     * 判断字符串是否为utf8编码，英文和半角字符返回ture
     * @param $string
     * @return bool
     */
    function is_utf8($string)
    {
        return preg_match('%^(?:
					[\x09\x0A\x0D\x20-\x7E] # ASCII
					| [\xC2-\xDF][\x80-\xBF] # non-overlong 2-byte
					| \xE0[\xA0-\xBF][\x80-\xBF] # excluding overlongs
					| [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2} # straight 3-byte
					| \xED[\x80-\x9F][\x80-\xBF] # excluding surrogates
					| \xF0[\x90-\xBF][\x80-\xBF]{2} # planes 1-3
					| [\xF1-\xF3][\x80-\xBF]{3} # planes 4-15
					| \xF4[\x80-\x8F][\x80-\xBF]{2} # plane 16
					)*$%xs', $string);
    }
}

if (!function_exists('id_encode')) {
    /**
     * 组装生成ID号
     * @param string $modules 模块名
     * @param int $contentid 内容ID
     * @param int $siteid 站点ID
     * @return string
     */
    function id_encode($modules, $contentid, $siteid)
    {
        return urlencode($modules . '-' . $contentid . '-' . $siteid);
    }
}

if (!function_exists('id_decode')) {
    /**
     * 解析ID
     * @param int $id 评论ID
     * @return array
     */
    function id_decode($id)
    {
        return explode('-', $id);
    }
}

if (!function_exists('password')) {
    /**
     * 对用户的密码进行加密
     * @param $password
     * @param $encrypt //传入加密串，在修改密码时做认证
     * @return array/password
     */
    function password($password, $encrypt = '')
    {
        $pwd = array();
        $pwd['encrypt'] = $encrypt ? $encrypt : create_randomstr();
        $pwd['password'] = md5(md5(trim($password)) . $pwd['encrypt']);
        return $encrypt ? $pwd['password'] : $pwd;
    }
}

if (!function_exists('create_randomstr')) {
    /**
     * 生成随机字符串
     * @param int $lenth 长度
     * @return string 字符串
     */
    function create_randomstr($lenth = 6)
    {
        return random($lenth, '123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ');
    }
}

if (!function_exists('is_password')) {
    /**
     * 检查密码长度是否符合规定
     * @param string $password
     * @return bool
     */
    function is_password($password)
    {
        $strlen = strlen($password);
        if ($strlen >= 6 && $strlen <= 20) return true;
        return false;
    }
}

if (!function_exists('is_badword')) {
    /**
     * 检测输入中是否含有错误字符
     * @param string $string 要检查的字符串名称
     * @return bool
     */
    function is_badword($string)
    {
        $badwords = array("\\", '&', ' ', "'", '"', '/', '*', ',', '<', '>', "\r", "\t", "\n", "#");
        foreach ($badwords as $value) {
            if (strpos($string, $value) !== FALSE) {
                return TRUE;
            }
        }
        return FALSE;
    }
}

if (!function_exists('is_username')) {
    /**
     * 检查用户名是否符合规定
     * @param string $username 要检查的用户名
     * @return bool
     */
    function is_username($username)
    {
        $strlen = strlen($username);
        if (is_badword($username) || !preg_match("/^[a-zA-Z0-9_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]+$/", $username)) {
            return false;
        } elseif (20 < $strlen || $strlen < 2) {
            return false;
        }
        return true;
    }
}

if (!function_exists('check_in')) {
    /**
     * 检查id是否存在于数组中
     * @param $id
     * @param $ids
     * @param $s
     * @return mixed
     */
    function check_in($id, $ids = '', $s = ',')
    {
        if (!$ids) return false;
        $ids = explode($s, $ids);
        return is_array($id) ? array_intersect($id, $ids) : in_array($id, $ids);
    }
}

if (!function_exists('array_iconv')) {
    /**
     * 对数据进行编码转换
     * @param array /string $data       数组
     * @param string $input 需要转换的编码
     * @param string $output 转换后的编码
     * @return array
     */
    function array_iconv($data, $input = 'gbk', $output = 'utf-8')
    {
        if (!is_array($data)) {
            return iconv($input, $output, $data);
        } else {
            foreach ($data as $key => $val) {
                if (is_array($val)) {
                    $data[$key] = array_iconv($val, $input, $output);
                } else {
                    $data[$key] = iconv($input, $output, $val);
                }
            }
            return $data;
        }
    }
}

if (!function_exists('thumb')) {
    /**
     * 生成缩略图函数
     * @param string $imgurl 图片路径
     * @param int $width 缩略图宽度
     * @param int $height 缩略图高度
     * @param int $autocut 是否自动裁剪 默认裁剪，当高度或宽度有一个数值为0是，自动关闭
     * @param string $smallpic 无图片是默认图片路径
     * @return string
     */
    function thumb($imgurl, $width = 100, $height = 100, $autocut = 1, $smallpic = 'nopic.gif')
    {
        global $image;
        $upload_url = UPLOAD_URL;
        $upload_path = UPLOAD_PATH;
        if (empty($imgurl)) return IMG_PATH . $smallpic;
        $imgurl_replace = str_replace($upload_url, '', $imgurl);
        if (!extension_loaded('gd') || strpos($imgurl_replace, '://')) return $imgurl;
        if (!file_exists($upload_path . $imgurl_replace)) return IMG_PATH . $smallpic;

        list($width_t, $height_t, $type, $attr) = getimagesize($upload_path . $imgurl_replace);
        if ($width >= $width_t || $height >= $height_t) return $imgurl;

        $newimgurl = dirname($imgurl_replace) . '/thumb_' . $width . '_' . $height . '_' . basename($imgurl_replace);

        if (file_exists($upload_path . $newimgurl)) return $upload_url . $newimgurl;

        if (!is_object($image)) {
            extendLoad::load_sys_class('image', '', '0');
            $image = new image(1, 0);
        }
        return $image->thumb($upload_path . $imgurl_replace, $upload_path . $newimgurl, $width, $height, '', $autocut) ? $upload_url . $newimgurl : $imgurl;
    }
}

if (!function_exists('watermark')) {
    /**
     * 水印添加
     * @param string $source 原图片路径
     * @param string $target 生成水印图片途径，默认为空，覆盖原图
     * @param int $siteid 站点id，系统需根据站点id获取水印信息
     * @return string
     */
    function watermark($source, $target = '', $siteid)
    {
        global $image_w;
        if (empty($source)) return $source;
        if (!extension_loaded('gd') || strpos($source, '://')) return $source;
        if (!$target) $target = $source;
        if (!is_object($image_w)) {
            extendLoad::load_sys_class('image', '', '0');
            $image_w = new image(0, $siteid);
        }
        $image_w->watermark($source, $target);
        return $target;
    }
}

if (!function_exists('catpos')) {
    /**
     * 当前路径
     * 返回指定栏目路径层级
     * @param int $catid 栏目id
     * @param string $symbol 栏目间隔符
     * @return string
     */
    function catpos($catid, $symbol = ' > ')
    {
        $category_arr = array();
        $siteids = getcache('category_content', 'commons');
        $siteid = $siteids[$catid];
        $category_arr = getcache('category_content_' . $siteid, 'commons');
        if (!isset($category_arr[$catid])) return '';
        $pos = '';
        $siteurl = siteurl($category_arr[$catid]['siteid']);
        $arrparentid = array_filter(explode(',', $category_arr[$catid]['arrparentid'] . ',' . $catid));
        foreach ($arrparentid as $catid) {
            $url = $category_arr[$catid]['url'];
            if (strpos($url, '://') === false) $url = $siteurl . $url;
            $pos .= '<a href="' . $url . '">' . $category_arr[$catid]['catname'] . '</a>' . $symbol;
        }
        return $pos;
    }
}

if (!function_exists('get_sql_catid')) {
    /**
     * 根据catid获取子栏目数据的sql语句
     * @param string $module 缓存文件名
     * @param int $catid 栏目ID
     * @param string $module 模块名称
     * @return mixed
     */
    function get_sql_catid($file = 'category_content_1', $catid = 0, $module = 'commons')
    {
        $category = getcache($file, $module);
        $catid = intval($catid);
        if (!isset($category[$catid])) return false;
        return $category[$catid]['child'] ? " `catid` IN(" . $category[$catid]['arrchildid'] . ") " : " `catid`=$catid ";
    }
}

if (!function_exists('subcat')) {
    /**
     * 获取子栏目
     * @param int $parentid 父级id
     * @param null /string $type 栏目类型
     * @param string $self 是否包含本身 0为不包含
     * @param string /int $siteid 站点id
     * @return mixed
     */
    function subcat($parentid = NULL, $type = NULL, $self = '0', $siteid = '')
    {
        $subcat = '';

        if (empty($siteid)) $siteid = get_siteid();
        $category = getcache('category_content_' . $siteid, 'commons');
        foreach ($category as $id => $cat) {
            if ($cat['siteid'] == $siteid && ($parentid === NULL || $cat['parentid'] == $parentid) && ($type === NULL || $cat['type'] == $type)) $subcat[$id] = $cat;
            if ($self == 1 && $cat['catid'] == $parentid && !$cat['child']) $subcat[$id] = $cat;
        }
        return $subcat;
    }
}

if (!function_exists('go')) {
    /**
     * 获取内容地址
     * @param int $catid 栏目ID
     * @param int $id 文章ID
     * @param string $allurl 是否以绝对路径返回
     * @return string
     */
    function go($catid, $id, $allurl = 0)
    {
        static $category;
        if (empty($category)) {
            $siteids = getcache('category_content', 'commons');
            $siteid = $siteids[$catid];
            $category = getcache('category_content_' . $siteid, 'commons');
        }
        $id = intval($id);
        if (!$id || !isset($category[$catid])) return '';
        $modelid = $category[$catid]['modelid'];
        if (!$modelid) return '';
        $db = extendLoad::load_model('content_model');
        $db->set_model($modelid);
        $r = $db->get_one(array('id' => $id), '`url`');
        if (!empty($allurl)) {
            if (strpos($r['url'], '://') === false) {
                $site = siteinfo($category[$catid]['siteid']);
                $r['url'] = substr($site['domain'], 0, -1) . $r['url'];
            }
        }

        return $r['url'];
    }
}

if (!function_exists('atturl')) {
    /**
     * 将附件地址转换为绝对地址
     * @param string $path 附件地址
     * @return string
     */
    function atturl($path)
    {
        if (strpos($path, ':/')) {
            return $path;
        } else {
            $sitelist = getcache('sitelist', 'commons');
            $siteid = get_siteid();
            $siteurl = $sitelist[$siteid]['domain'];
            $domainlen = strlen($sitelist[$siteid]['domain']) - 1;
            $path = $siteurl . $path;
            $path = substr_replace($path, '/', strpos($path, '//', $domainlen), 2);
            return $path;
        }
    }
}

if (!function_exists('module_exists')) {
    /**
     * 判断模块是否安装
     * @param string $m 模块名称
     * @return bool
     */
    function module_exists($m = '')
    {
        if ($m == 'admin') return true;
        $modules = getcache('modules', 'commons');
        $modules = array_keys($modules);
        return in_array($m, $modules);
    }
}

if (!function_exists('seo')) {
    /**
     * 生成SEO
     * @param int $siteid 站点ID
     * @param string /int $catid        栏目ID
     * @param string $title 标题
     * @param string $description 描述
     * @param string $keyword 关键词
     * @return array
     */
    function seo($siteid, $catid = '', $title = '', $description = '', $keyword = '')
    {
        if (!empty($title)) $title = strip_tags($title);
        if (!empty($description)) $description = strip_tags($description);
        if (!empty($keyword)) $keyword = str_replace(' ', ',', strip_tags($keyword));
        $sites = getcache('sitelist', 'commons');
        $site = $sites[$siteid];
        $cat = array();
        if (!empty($catid)) {
            $siteids = getcache('category_content', 'commons');
            $siteid = $siteids[$catid];
            $categorys = getcache('category_content_' . $siteid, 'commons');
            $cat = $categorys[$catid];
            $cat['setting'] = string2array($cat['setting']);
        }
        $seo['site_title'] = isset($site['site_title']) && !empty($site['site_title']) ? $site['site_title'] : $site['name'];
        $seo['keyword'] = !empty($keyword) ? $keyword : $site['keywords'];
        $seo['description'] = isset($description) && !empty($description) ? $description : (isset($cat['setting']['meta_description']) && !empty($cat['setting']['meta_description']) ? $cat['setting']['meta_description'] : (isset($site['description']) && !empty($site['description']) ? $site['description'] : ''));
        $seo['title'] = (isset($title) && !empty($title) ? $title . ' - ' : '') . (isset($cat['setting']['meta_title']) && !empty($cat['setting']['meta_title']) ? $cat['setting']['meta_title'] . ' - ' : (isset($cat['catname']) && !empty($cat['catname']) ? $cat['catname'] . ' - ' : ''));
        foreach ($seo as $k => $v) {
            $seo[$k] = str_replace(array("\n", "\r"), '', $v);
        }
        return $seo;
    }
}

if (!function_exists('siteinfo')) {
    /**
     * 获取站点的信息
     * @param int $siteid 站点ID
     * @return mixed
     */
    function siteinfo($siteid)
    {
        static $sitelist;
        if (empty($sitelist)) $sitelist = getcache('sitelist', 'commons');
        return isset($sitelist[$siteid]) ? $sitelist[$siteid] : '';
    }
}

if (!function_exists('tjcode')) {
    /**
     * 生成CNZZ统计代码
     */
    function tjcode()
    {
        if (!module_exists('cnzz')) return false;
        $config = getcache('cnzz', 'commons');
        if (empty($config)) {
            return false;
        } else {
            return '<script src=\'http://pw.cnzz.com/c.php?id=' . $config['siteid'] . '&l=2\' language=\'JavaScript\' charset=\'gb2312\'></script>';
        }
    }
}

if (!function_exists('title_style')) {
    /**
     * 生成标题样式
     * @param string $style 样式
     * @param int $html 是否显示完整的STYLE
     * @return string
     */
    function title_style($style, $html = 1)
    {
        if (!$style) return "";
        $str = '';
        if ($html) $str = ' style="';
        $style_arr = explode(';', $style);
        if (!empty($style_arr[0])) $str .= 'color:' . $style_arr[0] . ';';
        if (!empty($style_arr[1])) $str .= 'font-weight:' . $style_arr[1] . ';';
        if ($html) $str .= '" ';
        return $str;
    }
}

if (!function_exists('siteurl')) {
    /**
     * 获取站点域名
     * @param int $siteid 站点id
     * @return mixed
     */
    function siteurl($siteid)
    {
        static $sitelist;
        if (!$siteid) return WEB_PATH;
        if (empty($sitelist)) $sitelist = getcache('sitelist', 'commons');
        return substr($sitelist[$siteid]['domain'], 0, -1);
    }
}

if (!function_exists('upload_key')) {
    /**
     * 生成上传附件验证
     * @param array $args 参数
     * @return string
     */
    function upload_key($args)
    {
        $pc_auth_key = md5(LOAD_PATH . 'upload' . extendLoad::load_config('system', 'auth_key') . $_SERVER['HTTP_USER_AGENT']);
        $authkey = md5($args . $pc_auth_key);
        return $authkey;
    }
}

if (!function_exists('get_auth_key')) {
    /**
     * 生成验证key
     * @param string $prefix 参数
     * @param string $suffix 参数
     * @return string
     */
    function get_auth_key($prefix, $suffix = "")
    {
        if ($prefix == 'login') {
            $pc_auth_key = md5(LOAD_PATH . 'login' . extendLoad::load_config('system', 'auth_key') . ip());
        } else if ($prefix == 'email') {
            $pc_auth_key = md5(LOAD_PATH . 'email' . extendLoad::load_config('system', 'auth_key'));
        } else {
            $pc_auth_key = md5(LOAD_PATH . 'other' . extendLoad::load_config('system', 'auth_key') . $suffix);
        }
        $authkey = md5($prefix . $pc_auth_key);
        return $authkey;
    }
}

if (!function_exists('string2img')) {
    /**
     * 文本转换为图片
     * @param string $txt 图形化文本内容
     * @param int $fonttype 无外部字体时生成文字大小，取值范围1-5
     * @param int $fontsize 引入外部字体时，字体大小
     * @param string $font 字体名称 字体请放于libs\data\font下
     * @param string $fontcolor 字体颜色 十六进制形式 如FFFFFF,FF0000
     * @return string
     */
    function string2img($txt, $fonttype = 5, $fontsize = 16, $font = '', $fontcolor = 'FF0000', $transparent = '1')
    {
        if (empty($txt)) return false;
        if (function_exists("imagepng")) {
            $txt = urlencode(sys_auth($txt));
        }
        return $txt;
    }
}

if (!function_exists('get_pc_version')) {
    /**
     * 获取版本号
     */
    function get_pc_version($type = '')
    {
        return 1000;
    }
}

if (!function_exists('runhook')) {
    /**
     * 运行钩子（插件使用）
     */
    function runhook($method)
    {
        //
    }
}

if (!function_exists('getmicrotime')) {
    function getmicrotime()
    {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }
}

if (!function_exists('p_template')) {
    /**
     * 插件前台模板加载
     * Enter description here ...
     * @param string $plugin
     * @param string $template
     * @param string $style
     * @return mixed
     */
    function p_template($plugin = 'content', $template = 'index', $style = 'default')
    {
        if (!$style) $style = 'default';
        $template_cache = extendLoad::load_sys_class('template_cache');
        $compiledtplfile = CACHE_PATH . 'caches_template' . DIRECTORY_SEPARATOR . $style . DIRECTORY_SEPARATOR . 'plugin' . DIRECTORY_SEPARATOR . $plugin . DIRECTORY_SEPARATOR . $template . '.php';

        if (!file_exists($compiledtplfile) || (file_exists(LOAD_PATH . 'plugin' . DIRECTORY_SEPARATOR . $plugin . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . $template . '.html') && filemtime(LOAD_PATH . 'plugin' . DIRECTORY_SEPARATOR . $plugin . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . $template . '.html') > filemtime($compiledtplfile))) {
            $template_cache->template_compile('plugin/' . $plugin, $template, 'default');
        } elseif (!file_exists(LOAD_PATH . 'plugin' . DIRECTORY_SEPARATOR . $plugin . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . $template . '.html')) {
            showmessage('Template does not exist.' . DIRECTORY_SEPARATOR . 'plugin' . DIRECTORY_SEPARATOR . $plugin . DIRECTORY_SEPARATOR . $template . '.html');
        }

        return $compiledtplfile;
    }
}

if (!function_exists('cache_page_start')) {
    /**
     * 读取缓存动态页面
     */
    function cache_page_start()
    {
        $relate_url = isset($_SERVER['REQUEST_URI']) ? safe_replace($_SERVER['REQUEST_URI']) : $php_self . (isset($_SERVER['QUERY_STRING']) ? '?' . safe_replace($_SERVER['QUERY_STRING']) : $path_info);
        define('CACHE_PAGE_ID', md5($relate_url));
        $contents = getcache(CACHE_PAGE_ID, 'page_tmp/' . substr(CACHE_PAGE_ID, 0, 2));
        if ($contents && intval(substr($contents, 15, 10)) > SYS_TIME) {
            echo substr($contents, 29);
            exit;
        }
        if (!defined('HTML')) define('HTML', true);
        return true;
    }
}

if (!function_exists('cache_page')) {
    /**
     * 写入缓存动态页面
     * @param int $ttl
     * @param int $isjs
     * @return bool
     */
    function cache_page($ttl = 360, $isjs = 0)
    {
        if ($ttl == 0 || !defined('CACHE_PAGE_ID')) return false;
        $contents = ob_get_contents();

        if ($isjs) $contents = format_js($contents);
        $contents = "<!--expiretime:" . (SYS_TIME + $ttl) . "-->\n" . $contents;
        setcache(CACHE_PAGE_ID, $contents, 'page_tmp/' . substr(CACHE_PAGE_ID, 0, 2));
        return true;
    }
}

if (!function_exists('pc_file_get_contents')) {
    /**
     * 获取远程内容
     * @param string $url 接口url地址
     * @param int $timeout 超时时间
     * @return mixed
     */
    function pc_file_get_contents($url, $timeout = 30)
    {
        $stream = stream_context_create(array('http' => array('timeout' => $timeout)));
        return @file_get_contents($url, 0, $stream);
    }
}

if (!function_exists('get_vid')) {
    /**
     * Function get_vid
     * 获取视频信息
     * @param int $contentid 内容ID 必须
     * @param int $catid 栏目id 取内容里面视频信息时必须
     * @param int $isspecial 是否取专题的视频信息
     */
    function get_vid($contentid = 0, $catid = 0, $isspecial = 0)
    {
        static $categorys;
        if (!$contentid) return false;
        if (!$isspecial) {
            if (!$catid) return false;
            $contentid = intval($contentid);
            $catid = intval($catid);
            $siteid = get_siteid();
            if (!$categorys) {
                $categorys = getcache('category_content_' . $siteid, 'commons');
            }
            $modelid = $categorys[$catid]['modelid'];
            $video_content = extendLoad::load_model('video_content_model');
            $r = $video_content->get_one(array('contentid' => $contentid, 'modelid' => $modelid), 'videoid', '`listorder` ASC');
            $video_store = extendLoad::load_model('video_store_model');
            return $video_store->get_one(array('videoid' => $r['videoid']));
        } else {
            $special_content = extendLoad::load_model('special_content_model');
            $contentid = intval($contentid);
            $video_store = extendLoad::load_model('video_store_model');
            $r = $special_content->get_one(array('id' => $contentid), 'videoid');
            return $video_store->get_one(array('videoid' => $r['videoid']));
        }
    }
}

if (!function_exists('dataformat')) {
    /**
     * Function dataformat
     * 时间转换
     * @param int $n INT时间
     * @return mixed
     */
    function dataformat($n)
    {
        $hours = floor($n / 3600);
        $minite = floor($n % 3600 / 60);
        $secend = floor($n % 3600 % 60);
        $minite = $minite < 10 ? "0" . $minite : $minite;
        $secend = $secend < 10 ? "0" . $secend : $secend;
        if ($n >= 3600) {
            return $hours . ":" . $minite . ":" . $secend;
        } else {
            return $minite . ":" . $secend;
        }

    }
}

if (!function_exists('getHits')) {
    /**
     * 获取文档点击次数
     * @param int $catId 文档栏目ID
     * @param int $id 文档ID
     * @return int
     */
    function getHits($catId = 1, $id = 1)
    {
        $CATEGORY = getcache('category_content_1', 'commons');
        $modelId = $CATEGORY[$catId]['modelid'];
        $db = extendLoad::load_model('hits_model');
        $hitsId = 'c-' . $modelId . '-' . $id;
        $rs = $db->get_one(['hitsid' => $hitsId], '`views`');
        if (!$rs) return 0;
        return $rs['views'];
    }
}

if (!function_exists('getRecommendDta')) {
    /**
     * 获取专题推荐内容
     * @param int $specialid 专题ID
     * @return mixed
     */
    function getRecommendDta($specialid = 1)
    {
        $c_db = extendLoad::load_model('special_content_model');
        $rs = $c_db->select(array('specialid' => $specialid, 'recommend' => 1));
        return ($rs) ? $rs : [];
    }
}