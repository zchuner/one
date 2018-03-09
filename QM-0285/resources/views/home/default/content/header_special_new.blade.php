<!doctype html>
<html lang="zh-CN"><head>
    <meta charset="UTF-8" />
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ((isset($SEO['title']) && !empty($SEO['title'])) ? $SEO['title'] : '') . $SEO['site_title'] ?></title>
    <meta name="keywords" content="<?php echo $SEO['keyword']?>">
    <meta name="description" content="<?php echo $SEO['description']?>">
    <meta name="author" content="<?php echo AUTHOR?>">
    <link rel="shortcut icon" href="<?php echo url('/favicon1.ico')?>" /> 
     <link type="text/css" rel="stylesheet" href="<?php echo asset('lib/css/font-awesome.min.css')?>" media="all" />
    <link type="text/css" rel="stylesheet" href="<?php echo asset('lib/css/bootstrap.min.css')?>" media="all" />
    <link type="text/css" rel="stylesheet" href="<?php echo asset('lib/css/style.css')?>" media="all" /><!--新增-->
    <link type="text/css" rel="stylesheet" href="<?php echo asset('lib/css/owl.carousel.css')?>" media="all" /><!--新增-->
    <link type="text/css" rel="stylesheet" href="<?php echo asset('lib/css/owl.theme.css')?>" media="all" /><!--新增-->  
    <link type="text/css" rel="stylesheet" href="<?php echo asset('home/css/new_special.css')?>" media="all" /> <!--改-->
     <link type="text/css" rel="stylesheet" href="<?php echo asset('home/css/index_special.css')?>" media="all" /> <!--新增 改-->
     <!--!!!!!!!!!!!!!!!!新建的文件!!!!!!!!!!!!!!!!!!!-->
     
    
    <script type="text/javascript" src="<?php echo asset('lib/js/jquery-3.1.1.min.js')?>"></script>
    <script type="text/javascript" src="<?php echo asset('lib/js/bootstrap.min.js')?>"></script>
    <script type="text/javascript" src="<?php echo asset('home/js/qimaweb.js')?>"></script>
  <script type="text/javascript" src="<?php echo asset('lib/js/owl.carousel.js')?>"></script><!--新增-->
    <base target="_blank">
</head>
<body>

<div class="header">
    
   <!-- <div class="top-banner" style="background-image: url('<?php echo ($banner) ? $banner : asset('home/images/video_special_banner_2.jpg')?>');background-size:100% 100%;"></div>-->
    <div class="top-new" style="width:100%;height:69px;"><!--新增top-new-->
    	<div class="top-new-img" style="width:1170px;margin:0 auto;">
    		<img alt="国普网" src="<?php echo asset('home/images/logo-s.png')?>" />
        </div>
    </div>
    
    <nav class="nav-box navbar navbar-default rowMT rowMT-new"><!--新增 rowMT   rowMT-new不带banner图的导航-->
        <div class="container">
            <div class="row "><!--新增 rowMT-->
                <div class="visible-xs-block navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo url('/'); ?>">首页</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    
                    
                     <ul class="items nav navbar-nav row">
                     	{qm:content action="category" catid="$catid" num="25" order="listorder ASC" return="topNav"}
                            <li class="item"><a href="<?php echo url('/'); ?>">首页 <span class="sr-only">(current)</span></a></li>
                            {loop $topNav $r}
                            <li class="itemNew"><a style="font-size:15px;color:#fff;" href="{$r['url']}" target="_blank">{$r['catname']}</a></li>
                            {/loop}
                        {/qm} 
                        
                    </ul>
                    
                    
                    
                    
                </div>
            </div>
        </div>
    </nav>

</div>