<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>提示信息</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="//cdn.bootcss.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
	<link href="//cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<style>
		body{font:normal 12px/24px '微软雅黑'}
		a{cursor:pointer}
		.prompt h4{color:#3B4658}
		.prompt .promptmain{max-width:500px;-webkit-box-shadow:0 0 25px #E4E3E3;-moz-box-shadow:0 0 25px #E4E3E3;box-shadow:0 0 25px #E4E3E3;position:relative;margin:13% auto 0 auto}
		.prompt .prompthead{margin:0;padding:17px 15px;background:#3B4658;border-radius:5px 5px 0 0;-webkit-border-radius:5px 5px 0 0}
		.prompt .promptfooter{margin:0;padding:6px 15px;background:#3B4658;border-radius:0 0 5px 5px;-webkit-border-radius:0 0 5px 5px}
		.prompt .promptfooter a{color:#B5B8BE}
		.prompt .prompcontainer{background-color:#FCFCFC;padding:40px 20px}
		.prompt .prompcontainer button{margin:-67px -15px 0 0}
		.prompt a{line-height:28px}
		.prompt i{font-size:18px;padding:0 10px}
	</style>
</head>
<body>
<div class="container">
	<div class="prompt text-center">
		<div class="promptmain">
			<div class="prompthead"></div>
			<div class="prompcontainer">
				<button class="close close-sm" type="button" onclick="window.close();"><i class="fa fa-close"></i></button>
				<h4><i class="fa fa-info"></i><span>{$msg}</span></h4>
				<a>如果页面没有跳转，请点击操作按钮。</a>
			</div>
			<div class="promptfooter">
				<!--{if $url_forward == 'goback' ||  $url_forward == 'blank' || $url_forward == ''}-->
				<a href="javascript:history.back();" >[ 返回上一页 ]</a>
				<!--{elseif $url_forward == 'close'}-->
				<a href="javascript:window.close();" >[ 关闭 ]</a>
				<!--{elseif $url_forward}-->
				<script language="javascript">setTimeout("location.href = '<?php echo (strip_tags($url_forward) == 'back') ? 'history.back();' : strip_tags($url_forward)?>', "{$ms}");</script>
				<a href="{strip_tags($url_forward)}">[ 立即跳转 ]</a>
				<!--{/if}-->
			</div>
			<!--{if $dialog}-->
			<script type="text/javascript">window.top.location.reload();window.top.art.dialog({id:"{$dialog}"}).close();</script>
			<!--{/if}-->
		</div>
	</div>
</div>
</body>
</html>