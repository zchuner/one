<?php
/**
 * Created by PhpStorm.
 * User: Rouyi
 * Date: 2017/5/31
 * Time: 17:12
 * Desc: 单页头部模板
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{if isset($SEO['title']) && !empty($SEO['title'])}{$SEO['title']}{/if}{$SEO['site_title']}</title>
    <link href="{asset('home/css/page.css')}" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="top">
    <div class="topMain"><img src="{asset('home/images/logo-s.png')}" name="logo" width="339" height="117" id="logo" alt="{$SEO['site_title']}" />
        <div class="topMain_right">
            <div class="topRight_title">
            	<!--新增广告-->
            	<script language="javascript" src="{APP_PATH}poster/index/show_poster?id=8"></script>
                <!--<a>法烧友</a> |
                <a>官方微博</a> |
                <a>开通博客</a>-->
            </div>
        </div>
    </div>
    <div class="topNav">
        {qm:content action="category" catid="0" num="10" order="listorder ASC" return="topNav"}
        <ul>
            <li><a href="{APP_PATH}" target="_blank">网站首页</a></li>
            {loop $topNav $r}
            <li><a href="{$r['url']}" target="_blank">{$r['catname']}</a></li>
            {/loop}
        </ul>
        {/qm}
    </div>
</div>
