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
    <link type="text/css" rel="stylesheet" href="<?php echo asset('home/css/new.css')?>" media="all" />  
 
   <?php foreach ($headerCss as $css) : ?>
    <link type="text/css" rel="stylesheet" href="<?php echo asset('home/css/' . $css . '.css')?>" media="all" />
    <?php endforeach; ?>
    <script type="text/javascript" src="<?php echo asset('lib/js/jquery-3.1.1.min.js')?>"></script>
    <script type="text/javascript" src="<?php echo asset('lib/js/bootstrap.min.js')?>"></script>
    <script type="text/javascript" src="<?php echo asset('home/js/qimaweb.js')?>"></script>
  <script type="text/javascript" src="<?php echo asset('lib/js/owl.carousel.js')?>"></script><!--新增-->
    <base target="_blank">
</head>
<body>

<div class="header">
    <div class="hidden-xs container top">
        <div class="row">
            <div class="col-xs-4 logo">
                <h1><a href="<?php echo url('/'); ?>">{$SEO['site_title']}</a></h1>
            </div>
            <div class="col-xs-5 search">
                <form action="<?php echo url('/search')?>" method="get" class="form">
                    <i class="fa fa-search"></i>
                    <input type="text" class="col-xs-7 input" name="keyword" required placeholder="请输入搜索关键词" value="<?php echo (isset($keyword)) ? $keyword : ''?>">
                    <select name="model" class="col-xs-2 select">
                        <option value="1">新闻</option>
                        <option value="2" selected>视频</option>
                    </select>
                    <button class="col-xs-3 btn submit" type="submit">搜索</button>
                </form>
            </div>
            <div class="col-xs-3 user">
                <!--<ul>
                    <li class="text-center col-xs-4"><a>登录</a></li>
                    <li class="text-center col-xs-4"><a>注册</a></li>
                    <li class="text-center col-xs-4"><a>爆料</a></li>
                </ul>-->
            </div>
        </div>
    </div>
    <nav class="nav-box navbar navbar-default" style="z-index:200;">
        <div class="container" style="z-index:200;">
            <div class="row">
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
                    {qm:content action="category" catid="0" num="30" siteid="$siteid" order="listorder ASC" return="TopNav"}
                    <?php $i = 1; $noId = []; $maxNavNum = 10;?>
                    <ul class="items nav navbar-nav row">
                        <li class="item<?php echo (!isset($catid)) ? ' active' : ''?>"><a href="<?php echo url('/'); ?>">首页 <span class="sr-only">(current)</span></a></li>
                        <?php foreach ($TopNav as $k => $r) : ?>
                        <?php if ($i < $maxNavNum) : ?>
                        <li class="item<?php echo ($top_parentid == $r['catid'] || $catid == $r['catid'] || $parentid == $r['catid']) ? ' active' : ''?>"><a href="<?php echo $r['url']?>" title="<?php echo $r['catname']?>"><?php echo $r['catname']?></a></li>
                        <?php $noId[$k] = $r['catid']?>
                        <?php $i++ ?>
                        <?php endif; ?>
                        <?php endforeach; ?>
                        <?php if ($i >= $maxNavNum) : ?>
                        <li class="item dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">更多 <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <?php foreach ($TopNav as $k => $r) : ?>
                                <?php if (!in_array($r['catid'], $noId)) : ?>
                                <li><a href="<?php echo $r['url']?>" title="<?php echo $r['catname']?>"><?php echo $r['catname']?></a></li>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                        <?php endif; ?>
                    </ul>
                    {/qm}
                </div>
            </div>
        </div>
    </nav>

</div>