<?php
/**
 * Created by PhpStorm.
 * User: Rouyi
 * Date: 2017/10/7
 * Time: 20:32
 * Desc: 专题首页模板
 */

$headerCss = ['index'];
include getTemplate('header');
?>

<div class="container content home">
    <div class="banner-box">
        <div class="item-card">
            <div class="banner"></div>
            {qm:content action="position" posid="2" order="listorder DESC" num="1"}
            <div class="content-box">
                {loop $data $r}
                <div class="fl video-src">
                    <video controls="controls" height="280px" width="380px">
                        <source src="http://mp4.china.com.cn/video_tide/video/2015/11/4/20151141446605054865_347.mp4" type="video/mp4" />
                    </video>
                </div>
                <div class="fl video-desc">
                    <div class="title">
                        <a href="{$r['url']}">{$r['title']}</a>
                    </div>
                    <div class="item">
                        {$r['description']}
                    </div>
                </div>
                {/loop}
            </div>
            {/qm}

            {php $j=1}

            {loop $types $cat}
            <div class="content-box">
                <div class="fl top">
                    <a href="{$cat['url']}" class="title">{$cat['name']}</a>
                    <a href="{$cat['url']}" class="more"> 更多&gt;&gt;&gt; </a>
                </div>
                {qm:special action="content_list" specialid="$id" typeid="$cat[typeid]" listorder="3" num="8"}
                <div class="fl item-box">
                    {loop $data $r}
                    <div class="fl item">
                        <div class="images">
                            <a href="{$r['url']}">
                                <img alt="{$r['title']}" src="{thumb($r['thumb'], 190, 170)}" />
                            </a>
                        </div>
                        <div class="txt">
                            <h3>
                                <a href="{$r['url']}">{$r['title']}</a>
                            </h3>
                            <p>
                                <a href="{$r['url']}">{str_cut($r['description'], 180, '...')}</a>
                            </p>
                        </div>
                    </div>
                    {/loop}
                </div>
                {/qm}
            </div>
            {/loop}
        </div>
    </div>
</div>
<?php
include getTemplate('footer');