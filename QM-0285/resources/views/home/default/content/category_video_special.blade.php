<?php
/**
 * Created by PhpStorm.
 * User: Rouyi
 * Date: 2017/5/21
 * Time: 13:04
 * Desc: 视频频道页模板
 */
$headerCss = [
    'index_special','new_special',
];
include getTemplate('header_special_lm');
?>

<div class="container content home">
    <div class="banner-box">
        <div class="item-card">
        	<div class="row"> <!--新增div-->
            	<!--<div class="banner col-xs-12" style="margin-top:10px;"></div>--><!--新增col-xs-12 style="margin-top:5px;"-->
            </div>
            
            
            {qm:content action="category" catid="$catid" num="25" siteid="$siteid" order="listorder ASC" return="nav"}
            {loop $nav $r}
            <div class="content-box"> 
            	<div class="row noM"> <!--新增div-->
                	<div class="col-xs-12 fl top"><!--新增col-xs-12   style="overflow:hidden;"-->
                        <a href="{$r['url']}" class="title">{$r['catname']}</a>
                        <a href="{$r['url']}" class="more"> 更多&gt;&gt;&gt; </a>
                    </div>
                </div>
                {qm:content action="lists" catid="$r['catid']" num="8" order="id DESC" return="show"}
                <div class="row fl item-box"><!--新增row-->
                    {loop $show $r}
                    <div class="fl item col-md-6 col-sm-6 col-xs-12"><!--新增 col-md-6 col-sm-6 col-xs-12-->
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
            {/qm}
        </div>
    </div>
</div>

<?php
include getTemplate('footer');