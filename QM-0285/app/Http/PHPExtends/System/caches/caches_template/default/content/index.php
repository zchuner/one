<?php 
use \App\Http\PHPExtends\System\extendLoad;
?>
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
	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=15571e81aedcabc66a3344a32157a146&action=position&posid=3&order=listorder+DESC&num=8&thumb=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = extendLoad::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'3','order'=>'listorder DESC','thumb'=>'1','limit'=>'8',));}?>
			<div id="owl-demo" class="owl-carousel owl-theme" style="opacity: 1; display: block;background:rgb(6, 141, 218);">
            	<!--<div class="owl-item" style="">-->
                <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			    
                    <div class="item" style="">
                        <div class="zoom-container" style="width:100%;"> <!--style="width:100%;"-->
                            <div class="zoom-caption">
                                <span><?php echo $r['catname'];?></span>
                                <a href="<?php echo $r['url'];?>">
                                    <i class="fa fa-play-circle-o fa-5x" style="color: #fff"></i>
                                </a>
                                <p><?php echo $r['title'];?></p>
                            </div>
                            <img style="width:100%;height:310px;" src="<?php echo $r['thumb'];?>" alt="<?php echo $r['title'];?>"> <!--==新增==style="width:456px;height:294px;"-->
                        </div>
                    </div>
               
                <?php $n++;}unset($n); ?>	
                <!--</div>-->	
        	</div>
        	<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
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
	<script language="javascript" src="<?php echo APP_PATH;?>poster/index/show_poster?id=7"></script>
</div>

<div class="container content home">
    <div class="banner-box">
        <div class="item-card">
            
            <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=6867c61d0f48a6a42d14c2123ae3e2c0&action=category&catid=0&num=25&siteid=%24siteid&order=listorder+ASC&return=nav\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = extendLoad::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$nav = $content_tag->category(array('catid'=>'0','siteid'=>$siteid,'order'=>'listorder ASC','limit'=>'25',));}?>
            <?php $n=1;if(is_array($nav)) foreach($nav AS $r) { ?>
            <div class="content-box">
            	<div class="row ">
                    <div class=" col-xs-12 fl top " >
                        <a href="<?php echo $r['url'];?>" class="title fl"><?php echo $r['catname'];?></a>
                        <a href="<?php echo $r['url'];?>" class="more fr"> 更多&gt;&gt;&gt; </a>
                    </div>
                </div>

                <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=3a6227143b880e1b0649f4f796f49a4e&action=lists&catid=%24r%5B%27catid%27%5D&num=4&order=id+DESC&return=show\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = extendLoad::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$show = $content_tag->lists(array('catid'=>$r['catid'],'order'=>'id DESC','limit'=>'4',));}?>
                <div class="fl item-box row ">
                    <?php $n=1;if(is_array($show)) foreach($show AS $r) { ?>
                     <?php if($r[posids]==0) { ?> <!--新增，避免和推荐位重复-->
                    <div class=" fl item col-md-6 col-sm-6 col-xs-12 ">
                    	
                        <div class=" images ">
                            <a href="<?php echo $r['url'];?>">
                                <img alt="<?php echo $r['title'];?>" src="<?php echo ($r['thumb']) ?  $r['thumb'] : asset('admin/extends/images/nopic.gif')?>" /><!--yuan <?php echo thumb($r['thumb'], 190, 171);?>-->
                            </a>
                        </div>
                        <div class="txt">
                            <h3>
                                <a href="<?php echo $r['url'];?>"><?php echo $r['title'];?></a>
                            </h3>
                            <p>
                                <a href="<?php echo $r['url'];?>"><?php echo str_cut($r['description'], 100, '...');?></a> 
                            </p>
                        </div>
                        
                    </div>
                    <?php } ?>
                    <?php $n++;}unset($n); ?>
                </div>
                <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>

            </div>
            <?php $n++;}unset($n); ?>
            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
        </div>
    </div>
    
    
</div>


<?php
include getTemplate('footer');