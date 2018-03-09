<?php
/**
 * Created by PhpStorm.
 * User: Rouyi
 * Date: 2017/10/7
 * Time: 20:32
 * Desc: 专题首页模板
 */

$headerCss = ['index','index_special','new_special',];
include getTemplate('header_special');
?>

<div class="container content home">
    <div class="banner-box">
        <div class="item-card">
        	<div class="row"> <!--新增div-->
            	<!--<div class="banner col-xs-12"></div>--><!--新增col-xs-12-->
            </div>
            
            
            {php $j=1}

            {loop $types $cat}
            <div class="content-box"> 
            	<div class="row noM"> <!--新增div-->
                	<div class="col-xs-12 fl top"><!--新增col-xs-12   style="overflow:hidden;"-->
                        <a href="{$cat['url']}" class="title">{$cat['name']}</a>
                        <a href="{$cat['url']}" class="more"> 更多&gt;&gt;&gt; </a>
                    </div>
                </div>
                {qm:special action="content_list" specialid="$id" typeid="$cat[typeid]" num="8" listorder="3" return="show"}
                <div class="row fl item-box"><!--新增row-->
                    {loop $show $r}
                    <div class="fl item col-md-6 col-sm-6 col-xs-12"><!--新增 col-md-6 col-sm-6 col-xs-12-->
                        <div class="images">
                            <a href="{$r['url']}">
                                <img alt="{$r['title']}" src="<?php echo ($r['thumb']) ?  $r['thumb'] : asset('admin/extends/images/nopic.gif')?>" />
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