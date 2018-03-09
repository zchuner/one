<?php
/**
 * Created by PhpStorm.
 * User: Rouyi
 * Date: 2017/10/7
 * Time: 20:32
 * Desc: 文章栏目模板
 */

$headerCss = [
    'index',
];
include getTemplate('header');
?>

<div style="margin-top:10px;">
	{qm:content action="position" posid="3"  order="listorder DESC"  num="8" thumb="1"}
			<div id="owl-demo" class="owl-carousel owl-theme" style="opacity: 1; display: block;background:rgb(6, 141, 218);">
            	<!--<div class="owl-item" style="">-->
                {loop $data $r}
			    
                    <div class="item" style="">
                        <div class="zoom-container" style="width:100%;"> <!--style="width:100%;"-->
                            <div class="zoom-caption">
                                <span>{$r['catname']}</span>
                                <a href="{$r['url']}">
                                    <i class="fa fa-play-circle-o fa-5x" style="color: #fff"></i>
                                </a>
                                <p>{$r['title']}</p>
                            </div>
                            <img style="width:100%;height:310px;" src="{$r['thumb']}" alt="{$r['title']}"> <!--==新增==style="width:456px;height:294px;"-->
                        </div>
                    </div>
               
                {/loop}	
                <!--</div>-->	
        	</div>
        	{/qm}
            <div class="owl-controls clickable">
            	<div class="owl-pagination">
                	<div class="owl-page active">
                    	<span class=""></span>
                	</div>
                    <div class="owl-page">
                        <span class=""></span>
                    </div>
             	</div>
            </div>
            
            <script type="text/javascript" src="<?php echo asset('lib/js/owl.carousel')?>"></script>
    <script>
    $(document).ready(function() {
      $("#owl-demo").owlCarousel({
        autoPlay: 3000,
        items : 4,
        itemsDesktop : [1199,4],
        itemsDesktopSmall : [979,3],
		itemsTablet:[768,2],
		itemsMobile:[479,1]
      });

    });
    </script>
</div>
<!--新增 对联 广告-->
<div class="noGuangG">
	<script language="javascript" src="{APP_PATH}poster/index/show_poster?id=7"></script>
</div>

<div class="container content home">
    <div class="banner-box">
        <div class="item-card">
            
            {qm:content action="category" catid="0" num="25" siteid="$siteid" order="listorder ASC" return="nav"}
            {loop $nav $r}
            <div class="content-box">
            	<div class="row ">
                    <div class=" col-xs-12 fl top " >
                        <a href="{$r['url']}" class="title fl">{$r['catname']}</a>
                        <a href="{$r['url']}" class="more fr"> 更多&gt;&gt;&gt; </a>
                    </div>
                </div>

                {qm:content action="lists" catid="$r['catid']" num="4" order="id DESC" return="show"}
                <div class="fl item-box row ">
                    {loop $show $r}
                     {if $r[posids]==0} <!--新增，避免和推荐位重复-->
                    <div class=" fl item col-md-6 col-sm-6 col-xs-12 ">
                    	
                        <div class=" images ">
                            <a href="{$r['url']}">
                                <img alt="{$r['title']}" src="<?php echo ($r['thumb']) ?  $r['thumb'] : asset('admin/extends/images/nopic.gif')?>" /><!--yuan {thumb($r['thumb'], 190, 171)}-->
                            </a>
                        </div>
                        <div class="txt">
                            <h3>
                                <a href="{$r['url']}">{$r['title']}</a>
                            </h3>
                            <p>
                                <a href="{$r['url']}">{str_cut($r['description'], 100, '...')}</a> 
                            </p>
                        </div>
                        
                    </div>
                    {/if}
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