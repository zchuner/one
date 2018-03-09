	function image($field, $value, $fieldinfo) {
		$setting = string2array($fieldinfo['setting']);
		extract($setting);
		if(!defined('IMAGES_INIT')) {
			$str = '<script type="text/javascript" src="'.JS_PATH.'swfupload/swf2ckeditor.js"></script>';
			define('IMAGES_INIT', 1);
		}
		$html = '';
		if (defined('IN_ADMIN')) {
			$html = "<input type=\"button\" style=\"width:135px;\" class=\"button\" onclick=\"$('#".$field."_preview').attr('src','".IMG_PATH."icon/upload-pic.png');$('#".$field."').val(' ');return false;\" value=\"".L('cancel_the_picture','','content')."\">";
			}
		$authkey = upload_key("1,$upload_allowext,$isselectimage,$images_width,$images_height,$watermark");
		if($show_type && defined('IN_ADMIN')) {
			$preview_img = $value ? $value : IMG_PATH.'icon/upload-pic.png';
			return $str."<div class='upload-pic img-wrap'><input type='hidden' name='info[$field]' id='$field' value='$value'>
			<a href='javascript:void(0);' onclick=\"flashupload('{$field}_images', '".L('attachment_upload', '', 'content')."','{$field}',thumb_images,'1,{$upload_allowext},$isselectimage,$images_width,$images_height,$watermark','content','$this->catid','$authkey');return false;\">
			<img src='$preview_img' id='{$field}_preview' width='135' height='113' style='cursor:hand' /></a>".$html."</div>";
		} else {
			return $str."<input type='text' name='info[$field]' id='$field' value='$value' size='$size' class='input-text' />  <input type='button' class='button' onclick=\"flashupload('{$field}_images', '".L('attachment_upload', '', 'content')."','{$field}',submit_images,'1,{$upload_allowext},$isselectimage,$images_width,$images_height,$watermark','content','$this->catid','$authkey')\"/ value='".L('upload_pic', '', 'content')."'>".$html;
		}
	}
