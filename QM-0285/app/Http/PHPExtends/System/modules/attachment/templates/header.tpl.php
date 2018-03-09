<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"<?php if(isset($addbg)) { ?> class="addbg"<?php } ?>>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET;?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=7" />
    <meta name="_token" content="<?php echo csrf_token()?>" />
    <meta name="extend_url" content="<?php echo getExtendsUrl()?>" />
    <title><?php echo L('website_manage');?></title>
    <link href="<?php echo CSS_PATH?>reset.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo CSS_PATH.SYS_STYLE;?>-system.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo CSS_PATH?>table_form.css" rel="stylesheet" type="text/css" />
    <?php
    if(!$this->get_siteid()) exit('error');
    if(isset($show_dialog)) {
    ?>
    <link href="<?php echo CSS_PATH?>dialog.css" rel="stylesheet" type="text/css" />
</head>
<body>
<script language="javascript" type="text/javascript" src="<?php echo JS_PATH?>dialog.js"></script>
<?php } ?>
<script language="javascript" type="text/javascript" src="<?php echo JS_PATH?>jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo JS_PATH?>admin_common.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo JS_PATH?>styleswitch.js"></script>
<?php if(isset($show_validator)) { ?>
    <script language="javascript" type="text/javascript" src="<?php echo JS_PATH?>formvalidator.js" charset="UTF-8"></script>
    <script language="javascript" type="text/javascript" src="<?php echo JS_PATH?>formvalidatorregex.js" charset="UTF-8"></script>
<?php } ?>
<style type="text/css">
    html{_overflow-y:scroll}
</style>