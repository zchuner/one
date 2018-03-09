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

<div class="space"></div>
<div class="aboutus_main">
    <div class="aboutus_left">
        <div class="button">
            <div class="buttonBlack"></div>
            <div class="buttonMain">
                <ul>
                    {loop $arrchild_arr $cid}
                    <li{if $catid==$cid} class="cur"{/if}><a href="{$CATEGORYS[$cid][url]}" target="_blank">{$CATEGORYS[$cid][catname]}</a></li>
                    {/loop}
                </ul>
            </div>
            <div class="botton_bottom"></div>
        </div>
    </div>
    <div class="aboutus_right">
        <div class="aboutus_top">
            <table width="789" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="80">{$title} &gt;&gt;</td>
                    <td>&nbsp;</td>
                </tr>
            </table>
        </div>
        <div class="aboutus_rightMain">
            {$content}
        </div>
    </div>
</div>
<div class="bottom">
    <p>
        <a href="http://www.12377.cn/" target="_blank">中国互联网违法和不良信息举报中心</a> |
        <a href="http://www.hbgd.net/jgdt/2013-12/04/cms280article.shtml" target="_blank">中国互联网视听节目服务自律公约</a> |
        <a href="http://www.mps.gov.cn/" target="_blank">网络110报警服务</a> |
        <a href="https://www.12321.cn/" target="_blank">12321垃圾信息举报中心</a> |
        <a href="http://www.newswm.com/" target="_blank">中国新闻网站联盟</a> |
        <a href="http://search.people.com.cn/cnpeople/news/index.html" target="_blank">人民搜索</a> |
        <a href="http://www.chinaso.com/" target="_blank">盘古搜索</a>
    </p>
    <p>版权所有 中国互联网新闻中心 电子邮件: fzzg2013@126.com 电话: 010-57128662 57735282</p>
    <p>京ICP证 040089号 网络传播视听节目许可证号:0105123</p>
    <p>
        <a href="{$CATEGORYS[13]['url']}" target="_blank">{$CATEGORYS[13]['catname']}</a> |
        法律顾问：<a href="http://www.yuecheng.com/" target="_blank">北京岳成律师事务所</a> |
        <a href="{$CATEGORYS[15]['url']}" target="_blank">{$CATEGORYS[15]['catname']}</a> |
        <a href="{$CATEGORYS[14]['url']}" target="_blank">{$CATEGORYS[14]['catname']}</a> |
        <a href="{$CATEGORYS[18]['url']}" target="_blank">{$CATEGORYS[18]['catname']}</a> |
        <a href="{$CATEGORYS[16]['url']}" target="_blank">{$CATEGORYS[16]['catname']}</a>
    </p>
</div>
</body>
</html>
