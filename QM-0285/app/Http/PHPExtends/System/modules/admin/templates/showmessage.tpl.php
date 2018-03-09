<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>提示信息</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="<?php echo csrf_token()?>" />
    <meta name="extend_url" content="<?php echo getExtendsUrl()?>" />
    <link href="//cdn.bootcss.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <link href="//cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script type="text/javaScript" src="<?php echo JS_PATH?>jquery.min.js"></script>
    <script type="text/javaScript" src="<?php echo JS_PATH?>admin_common.js"></script>
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
                <h4><i class="fa fa-info"></i><span><?php echo $msg ?></span></h4>
                <?php if($url_forward == 'goback' || $url_forward == 'blank' || $url_forward=='') { ?>
                    <a href="javascript:history.back();" >如果页面没有跳转，请点击操作按钮。</a>
                <?php } else if($url_forward == 'close') { ?>
                    <a href="javascript:window.close();">如果页面没有跳转，请点击操作按钮。</a>
                <?php } elseif($url_forward) { ?>
                    <a href="<?php echo $url_forward?>">如果页面没有跳转，请点击操作按钮。</a>
                <?php }?>
            </div>
            <div class="promptfooter">
                <?php if($url_forward == 'goback' || $url_forward == 'blank' || $url_forward=='') { ?>
                    <a href="javascript:history.back();" >[ <?php echo L('return_previous');?> ]</a>
                <?php } else if($url_forward == 'close') { ?>
                    <a href="javascript:window.close();">[ <?php echo L('close');?> ]</a>
                <?php } elseif($url_forward) { ?>
                    <a href="<?php echo $url_forward?>">[ <?php echo L('click_here');?> ]</a>
                    <script language="javascript">setTimeout("redirect('<?php echo $url_forward?>');",<?php echo $ms?>);</script>
                <?php }?>
            </div>
            <?php if($returnjs) { ?> <script style="text/javascript"><?php echo $returnjs;?></script><?php } ?>
            <?php if ($dialog):?><script type="text/javascript">window.top.right.location.reload();window.top.art.dialog({id:"<?php echo $dialog?>"}).close();</script><?php endif;?>
        </div>
    </div>
</div>
<script type="text/javascript">
    function close_dialog() {
        window.top.location.reload();
        window.top.art.dialog({id: "<?php echo $dialog?>"}).close();
    }
</script>
</body>
</html>