<?php
use \App\Http\PHPExtends\System\extendLoad;

class form
{
    /**
     * 百度编辑器
     * @param string $textareaid
     * @param string $toolbar
     * @param string $module 模块名称
     * @param string $catid 栏目id
     * @param string $color 编辑器颜色
     * @param int $allowupload 是否允许上传
     * @param int $allowbrowser 是否允许浏览文件
     * @param string $alowuploadexts 允许上传类型
     * @param int $height 编辑器高度
     * @param int $disabled_page 是否禁用分页和子标题
     * @return mixed
     */
    public static function editorBaidu($textareaid = 'content', $toolbar = 'basic', $module = '', $catid = '', $color = '', $allowupload = 0, $allowbrowser = 1, $alowuploadexts = '', $height = 200, $disabled_page = 0, $allowuploadnum = '10')
    {
        $str = '';
        if (!defined('EDITOR_INIT')) {
            $str .= '<link href="' . asset('umeditor/themes/default/css/umeditor.css') . '" rel="stylesheet" type="text/css">';
            $str .= '<script type="text/javascript" charset="utf-8" src="' . asset('umeditor/third-party/jquery.min.js') . '"></script>';
            $str .= '<script type="text/javascript" charset="utf-8" src="' . asset('umeditor/third-party/template.min.js') . '"></script>';
            $str .= '<script type="text/javascript" charset="utf-8" src="' . asset('umeditor/umeditor.config.js') . '"></script>';
            $str .= '<script type="text/javascript" charset="utf-8" src="' . asset('umeditor/umeditor.min.js') . '"></script>';
            $str .= '<script type="text/javascript" charset="utf-8" src="' . asset('umeditor/lang/zh-cn/zh-cn.js') . '"></script>';
            $str .= '';
            define('EDITOR_INIT', 1);
        }
        $str .= "<script type=text/javascript>";
        $str .= "UM.getEditor('{$textareaid}').setWidth('100%');";
        $str .= '</script>';

        return $str;
    }

    /**
     * 编辑器
     * @param string $textareaid
     * @param string $toolbar
     * @param string $module 模块名称
     * @param string $catid 栏目id
     * @param string $color 编辑器颜色
     * @param int $allowupload 是否允许上传
     * @param int $allowbrowser 是否允许浏览文件
     * @param string $alowuploadexts 允许上传类型
     * @param int $height 编辑器高度
     * @param int $disabled_page 是否禁用分页和子标题
     * @return mixed
     */
    public static function editor($textareaid = 'content', $toolbar = 'basic', $module = '', $catid = '', $color = '', $allowupload = 0, $allowbrowser = 1, $alowuploadexts = '', $height = 200, $disabled_page = 0, $allowuploadnum = '10')
    {
        $str = '';
        if (!defined('EDITOR_INIT')) {
            $str = '<script type="text/javascript" src="' . JS_PATH . 'ckeditor/ckeditor.js"></script>';
            define('EDITOR_INIT', 1);
        }
        if ($toolbar == 'basic') {
            $toolbar = defined('IN_ADMIN') ? "['Source']," : '';
            $toolbar .= "['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink' ],['Maximize'],\r\n";
        } elseif ($toolbar == 'full') {
            if (defined('IN_ADMIN')) {
                $toolbar = "['Source',";
            } else {
                $toolbar = '[';
            }
            $toolbar .= "'-','Templates'],
		    ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print'],
		    ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],['ShowBlocks'],['Image','Capture','Flash','flashplayer','MyVideo'],['Maximize'],
		    '/',
		    ['Bold','Italic','Underline','Strike','-'],
		    ['Subscript','Superscript','-'],
		    ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
		    ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
		    ['Link','Unlink','Anchor'],
		    ['Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
		    '/',
		    ['Styles','Format','Font','FontSize'],
		    ['TextColor','BGColor'],
		    ['attachment'],\r\n";
        } elseif ($toolbar == 'desc') {
            $toolbar = "['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink', '-', 'Image', '-','Source'],['Maximize'],\r\n";
        } else {
            $toolbar = '';
        }
        $str .= "<script type=\"text/javascript\">\r\n";
        $str .= "CKEDITOR.replace( '$textareaid',{";
        $str .= "height:{$height},";

        $show_page = ($module == 'content' && !$disabled_page) ? 'true' : 'false';
        $str .= "pages:$show_page,subtitle:$show_page,textareaid:'" . $textareaid . "',module:'" . $module . "',catid:'" . $catid . "',\r\n";
        if ($allowupload) {
            $authkey = upload_key("$allowuploadnum,$alowuploadexts,$allowbrowser");
            $str .= "flashupload:true,alowuploadexts:'" . $alowuploadexts . "',allowbrowser:'" . $allowbrowser . "',allowuploadnum:'" . $allowuploadnum . "',authkey:'" . $authkey . "',\r\n";
        }
        if ($allowupload) $str .= "filebrowserUploadUrl : '" . getExtendsUrl('?m=attachment&c=attachments&a=upload&module=' . $module . '&catid=' . $catid . '&dosubmit=1') . "',\r\n";
        if ($color) {
            $str .= "extraPlugins : 'uicolor',uiColor: '$color',";
        }
        $str .= "toolbar :\r\n";
        $str .= "[\r\n";
        $str .= $toolbar;
        $str .= "]\r\n";
        //$str .= "fullPage : true";
        $str .= "});\r\n";
        $str .= '</script>';
        $ext_str = "<div class='editor_bottom'>";
        if (!defined('IMAGES_INIT')) {
            $ext_str .= '<script type="text/javascript" src="' . JS_PATH . 'swfupload/swf2ckeditor.js"></script>';
            define('IMAGES_INIT', 1);
        }
        $ext_str .= "<div id='page_title_div'>
		<table cellpadding='0' cellspacing='1' border='0'><tr><td class='title'>" . L('subtitle') . "<span id='msg_page_title_value'></span></td><td>
		<a class='close' href='javascript:;' onclick='javascript:$(\"#page_title_div\").hide();'><span>×</span></a></td>
		<tr><td colspan='2'><input name='page_title_value' id='page_title_value' class='input-text' value='' size='30'>&nbsp;<input type='button' class='button' value='" . L('submit') . "' onclick=insert_page_title(\"$textareaid\",1)></td></tr>
		</table></div>";
        $ext_str .= "</div>";
        if (is_ie()) $ext_str .= "<div style='display:none'><OBJECT id='PC_Capture' classid='clsid:021E8C6F-52D4-42F2-9B36-BCFBAD3A0DE4'><PARAM NAME='_Version' VALUE='0'><PARAM NAME='_ExtentX' VALUE='0'><PARAM NAME='_ExtentY' VALUE='0'><PARAM NAME='_StockProps' VALUE='0'></OBJECT></div>";
        $str .= $ext_str;
        return $str;
    }

    /**
     *
     * @param string $name 表单名称
     * @param string/int $id 表单id
     * @param string $value 表单默认值
     * @param string $moudle 模块名称
     * @param string/int $catid 栏目id
     * @param int $size 表单大小
     * @param string $class 表单风格
     * @param string $ext 表单扩展属性 如果 js事件等
     * @param string $alowexts 允许图片格式
     * @param array $thumb_setting
     * @param int $watermark_setting 0或1
     * @return mixed
     */
    public static function images($name, $id = '', $value = '', $moudle = '', $catid = '', $size = 50, $class = '', $ext = '', $alowexts = '', $thumb_setting = array(), $watermark_setting = 0)
    {
        if (!$id) $id = $name;
        if (!$size) $size = 50;
        if (!empty($thumb_setting) && count($thumb_setting)) $thumb_ext = $thumb_setting[0] . ',' . $thumb_setting[1];
        else $thumb_ext = ',';
        if (!$alowexts) $alowexts = 'jpg|jpeg|gif|bmp|png';
        if (!defined('IMAGES_INIT')) {
            $str = '<script type="text/javascript" src="' . JS_PATH . 'swfupload/swf2ckeditor.js"></script>';
            define('IMAGES_INIT', 1);
        }
        $value = new_html_special_chars($value);
        $authkey = upload_key("1,$alowexts,1,$thumb_ext,$watermark_setting");
        return $str . "<input type=\"text\" name=\"$name\" id=\"$id\" value=\"$value\" size=\"$size\" class=\"$class\" $ext/>  <input type=\"button\" class=\"button\" onclick=\"javascript:flashupload('{$id}_images', '" . L('attachmentupload') . "','{$id}',submit_images,'1,{$alowexts},1,{$thumb_ext},{$watermark_setting}','{$moudle}','{$catid}','{$authkey}')\"/ value=\"" . L('imagesupload') . "\">";
    }

    /**
     *
     * @param string $name 表单名称
     * @param string/int $id 表单id
     * @param string $value 表单默认值
     * @param string $moudle 模块名称
     * @param string/int $catid 栏目id
     * @param int $size 表单大小
     * @param string $class 表单风格
     * @param string $ext 表单扩展属性 如果 js事件等
     * @param string $alowexts 允许上传的文件格式
     * @param array $file_setting
     * @return mixed
     */
    public static function upfiles($name, $id = '', $value = '', $moudle = '', $catid = '', $size = 50, $class = '', $ext = '', $alowexts = '', $file_setting = array())
    {
        if (!$id) $id = $name;
        if (!$size) $size = 50;
        if (!empty($file_setting) && count($file_setting)) $file_ext = $file_setting[0] . ',' . $file_setting[1];
        else $file_ext = ',';
        if (!$alowexts) $alowexts = 'rar|zip';
        if (!defined('IMAGES_INIT')) {
            $str = '<script type="text/javascript" src="' . JS_PATH . 'swfupload/swf2ckeditor.js"></script>';
            define('IMAGES_INIT', 1);
        }
        $authkey = upload_key("1,$alowexts,1,$file_ext");
        return $str . "<input type=\"text\" name=\"$name\" id=\"$id\" value=\"$value\" size=\"$size\" class=\"$class\" $ext/>  <input type=\"button\" class=\"button\" onclick=\"javascript:flashupload('{$id}_files', '" . L('attachmentupload') . "','{$id}',submit_attachment,'1,{$alowexts},1,{$file_ext}','{$moudle}','{$catid}','{$authkey}')\"/ value=\"" . L('filesupload') . "\">";
    }

    /**
     * 日期时间控件
     * @param string $name 控件name，id
     * @param string $value 选中值
     * @param int $isdatetime 是否显示时间
     * @param int $loadjs 是否重复加载js，防止页面程序加载不规则导致的控件无法显示
     * @param string $showweek 是否显示周，使用，true | false
     * @param int $timesystem
     * @return mixed
     */
    public static function date($name, $value = '', $isdatetime = 0, $loadjs = 0, $showweek = 'true', $timesystem = 1)
    {
        if ($value == '0000-00-00 00:00:00') $value = '';
        $id = preg_match("/\[(.*)\]/", $name, $m) ? $m[1] : $name;
        if ($isdatetime) {
            $size = 21;
            $format = '%Y-%m-%d %H:%M:%S';
            if ($timesystem) {
                $showsTime = 'true';
            } else {
                $showsTime = '12';
            }

        } else {
            $size = 10;
            $format = '%Y-%m-%d';
            $showsTime = 'false';
        }
        $str = '';
        if ($loadjs || !defined('CALENDAR_INIT')) {
            define('CALENDAR_INIT', 1);
            $str .= '<link rel="stylesheet" type="text/css" href="' . JS_PATH . 'calendar/jscal2.css"/>
			<link rel="stylesheet" type="text/css" href="' . JS_PATH . 'calendar/border-radius.css"/>
			<link rel="stylesheet" type="text/css" href="' . JS_PATH . 'calendar/win2k.css"/>
			<script type="text/javascript" src="' . JS_PATH . 'calendar/calendar.js"></script>
			<script type="text/javascript" src="' . JS_PATH . 'calendar/lang/en.js"></script>';
        }
        $str .= '<input type="text" name="' . $name . '" id="' . $id . '" value="' . $value . '" size="' . $size . '" class="date" readonly>&nbsp;';
        $str .= '<script type="text/javascript">
			Calendar.setup({
			weekNumbers: ' . $showweek . ',
		    inputField : "' . $id . '",
		    trigger    : "' . $id . '",
		    dateFormat: "' . $format . '",
		    showTime: ' . $showsTime . ',
		    minuteStep: 1,
		    onSelect   : function() {this.hide();}
			});
        </script>';
        return $str;
    }

    /**
     * 栏目选择
     * @param string $file 栏目缓存文件名
     * @param int/array $catid 别选中的ID，多选是可以是数组
     * @param string $str 属性
     * @param string $default_option 默认选项
     * @param int $modelid 按所属模型筛选
     * @param int $type 栏目类型
     * @param int $onlysub 只可选择子栏目
     * @param int $siteid 如果设置了siteid 那么则按照siteid取
     * @return mixed
     */
    public static function select_category($file = '', $catid = 0, $str = '', $default_option = '', $modelid = 0, $type = -1, $onlysub = 0, $siteid = 0, $is_push = 0)
    {
        $tree = extendLoad::load_sys_class('tree');
        if (!$siteid) $siteid = param::get_cookie('siteid');
        if (!$file) {
            $file = 'category_content_' . $siteid;
        }
        $result = getcache($file, 'commons');
        $string = '<select ' . $str . '>';
        if ($default_option) $string .= "<option value='0'>$default_option</option>";
        //加载权限表模型 ,获取会员组ID值,以备下面投入判断用
        if ($is_push == '1') {
            $priv = extendLoad::load_model('category_priv_model');
            $user_groupid = param::get_cookie('_groupid') ? param::get_cookie('_groupid') : 8;
        }
        if (is_array($result)) {
            foreach ($result as $r) {
                //检查当前会员组，在该栏目处是否允许投稿？
                if ($is_push == '1' and $r['child'] == '0') {
                    $sql = array('catid' => $r['catid'], 'roleid' => $user_groupid, 'action' => 'add');
                    $array = $priv->get_one($sql);
                    if (!$array) {
                        continue;
                    }
                }
                if ($siteid != $r['siteid'] || ($type >= 0 && $r['type'] != $type)) continue;
                $r['selected'] = '';
                if (is_array($catid)) {
                    $r['selected'] = in_array($r['catid'], $catid) ? 'selected' : '';
                } elseif (is_numeric($catid)) {
                    $r['selected'] = $catid == $r['catid'] ? 'selected' : '';
                }
                $r['html_disabled'] = "0";
                if (!empty($onlysub) && $r['child'] != 0) {
                    $r['html_disabled'] = "1";
                }
                $categorys[$r['catid']] = $r;
                if ($modelid && $r['modelid'] != $modelid) unset($categorys[$r['catid']]);
            }
        }
        $str = "<option value='\$catid' \$selected>\$spacer \$catname</option>;";
        $str2 = "<optgroup label='\$spacer \$catname'></optgroup>";

        $tree->init($categorys);
        $string .= $tree->get_tree_category(0, $str, $str2);

        $string .= '</select>';
        return $string;
    }

    /**
     * 联动菜单选择
     * @param int $keyid
     * @param int $parentid
     * @param string $name
     * @param string $id
     * @param string $alt
     * @param int $linkageid
     * @param string $property
     * @return string
     */
    public static function select_linkage($keyid = 0, $parentid = 0, $name = 'parentid', $id = '', $alt = '', $linkageid = 0, $property = '')
    {
        $tree = extendLoad::load_sys_class('tree');
        $result = getcache($keyid, 'linkage');
        $id = $id ? $id : $name;
        $string = "<select name='$name' id='$id' $property>\n<option value='0'>$alt</option>\n";
        if ($result['data']) {
            foreach ($result['data'] as $area) {
                $categorys[$area['linkageid']] = array('id' => $area['linkageid'], 'parentid' => $area['parentid'], 'name' => $area['name']);
            }
        }
        $str = "<option value='\$id' \$selected>\$spacer \$name</option>";

        $tree->init($categorys);
        $string .= $tree->get_tree($parentid, $str, $linkageid);

        $string .= '</select>';
        return $string;
    }

    /**
     * 下拉选择框
     * @param array $array
     * @param int $id
     * @param string $str
     * @param string $default_option
     * @return bool|string
     */
    public static function select($array = array(), $id = 0, $str = '', $default_option = '')
    {
        $string = '<select ' . $str . '>';
        $default_selected = (empty($id) && $default_option) ? 'selected' : '';
        if ($default_option) $string .= "<option value='' $default_selected>$default_option</option>";
        if (!is_array($array) || count($array) == 0) return false;
        $ids = array();
        if (isset($id)) $ids = explode(',', $id);
        foreach ($array as $key => $value) {
            $selected = in_array($key, $ids) ? 'selected' : '';
            $string .= '<option value="' . $key . '" ' . $selected . '>' . $value . '</option>';
        }
        $string .= '</select>';
        return $string;
    }

    /**
     * 复选框
     * @param array $array 选项 二维数组
     * @param string $id 默认选中值，多个用 '逗号'分割
     * @param string $str 属性
     * @param string $defaultvalue 是否增加默认值 默认值为 -99
     * @param int $width 宽度
     * @param string $field
     * @return mixed
     */
    public static function checkbox($array = array(), $id = '', $str = '', $defaultvalue = '', $width = 0, $field = '')
    {
        $string = '';
        $id = trim($id);
        if ($id != '') $id = strpos($id, ',') ? explode(',', $id) : array($id);
        if ($defaultvalue) $string .= '<input type="hidden" ' . $str . ' value="-99">';
        $i = 1;
        foreach ($array as $key => $value) {
            $key = trim($key);
            $checked = ($id && in_array($key, $id)) ? 'checked' : '';
            if ($width) $string .= '<label class="ib" style="width:' . $width . 'px">';
            $string .= '<input type="checkbox" ' . $str . ' id="' . $field . '_' . $i . '" ' . $checked . ' value="' . new_html_special_chars($key) . '"> ' . new_html_special_chars($value);
            if ($width) $string .= '</label>';
            $i++;
        }
        return $string;
    }

    /**
     * 单选框
     * @param array $array 选项 二维数组
     * @param int $id 默认选中值
     * @param string $str 属性
     * @return mixed
     */
    public static function radio($array = array(), $id = 0, $str = '', $width = 0, $field = '')
    {
        $string = '';
        foreach ($array as $key => $value) {
            $checked = trim($id) == trim($key) ? 'checked' : '';
            if ($width) $string .= '<label class="ib" style="width:' . $width . 'px">';
            $string .= '<input type="radio" ' . $str . ' id="' . $field . '_' . new_html_special_chars($key) . '" ' . $checked . ' value="' . $key . '"> ' . $value;
            if ($width) $string .= '</label>';
        }
        return $string;
    }

    /**
     * 模板选择
     * @param string $style  风格
     * @param string $module 模块
     * @param string $id 默认选中值
     * @param string $str 属性
     * @param string $pre 模板前缀
     * @return mixed
     */
    public static function select_template($style, $module, $id = '', $str = '', $pre = '')
    {
        $templatedir = TEMPLATE_PATH . $style . DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR;
        $confing_path = TEMPLATE_PATH . $style . DIRECTORY_SEPARATOR . 'config.php';
        $localdir = $style . '|' . $module;
        $templates = glob($templatedir . $pre . '*' . TEMPLATE_PREFIX);
        if (empty($templates)) {
            $style = 'default';
            $templatedir = TEMPLATE_PATH . $style . DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR;
            $confing_path = TEMPLATE_PATH . $style . DIRECTORY_SEPARATOR . 'config.php';
            $localdir = $style . '|' . $module;
            $templates = glob($templatedir . $pre . '*' . TEMPLATE_PREFIX);
        }
        if (empty($templates)) return false;
        $files = @array_map('basename', $templates);

        $names = [];

        if (file_exists($confing_path)) {
            $names = include $confing_path;
        }

        $templates = [];

        if (is_array($files)) {
            foreach ($files as $file) {
                list($key, $prefix) = explode(TEMPLATE_PREFIX, $file);
                $templates[$key] = isset($names['file_explan'][$localdir][$file]) && !empty($names['file_explan'][$localdir][$file]) ? $names['file_explan'][$localdir][$file] . ' [' . $file . ']' : $file;
            }
        }

        ksort($templates);
        return self::select($templates, $id, $str, L('please_select'));
    }

    /**
     * 验证码
     * @param string $id 生成的验证码ID
     * @param integer $code_len 生成多少位验证码
     * @param integer $font_size 验证码字体大小
     * @param integer $width 验证图片的宽
     * @param integer $height 验证码图片的高
     * @param string $font 使用什么字体，设置字体的URL
     * @param string $font_color 字体使用什么颜色
     * @param string $background 背景使用什么颜色
     * @return mixed
     */
    public static function checkcode($id = 'checkcode', $code_len = 4, $font_size = 20, $width = 130, $height = 50, $font = '', $font_color = '', $background = '')
    {
        return "<img id='$id' onclick='this.src = this.src+\"&\"+Math.random()' src='" . url('code/' . $width . '/' . $height . '/&') ."'>";
    }

    /**
     * url  规则调用
     * @param string $module 模块
     * @param string $file 文件名
     * @param int $ishtml 是否为静态规则
     * @param int $id 选中值
     * @param string $str 表单属性
     * @param string $default_option 默认选项
     * @return mixed
     */
    public static function urlrule($module, $file, $ishtml, $id, $str = '', $default_option = '')
    {
        if (!$module) $module = 'content';
        $urlrules = getcache('urlrules_detail', 'commons');
        $array = array();
        foreach ($urlrules as $roleid => $rules) {
            if ($rules['module'] == $module && $rules['file'] == $file && $rules['ishtml'] == $ishtml) $array[$roleid] = $rules['example'];
        }

        return form::select($array, $id, $str, $default_option);
    }
}