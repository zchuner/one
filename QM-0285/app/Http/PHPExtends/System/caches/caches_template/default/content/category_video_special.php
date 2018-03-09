<?php 
use \App\Http\PHPExtends\System\extendLoad;
?>
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
            
            
            <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=40efb959dcb125f7d3388daf4b954cae&action=category&catid=%24catid&num=25&siteid=%24siteid&order=listorder+ASC&return=nav\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = extendLoad::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$nav = $content_tag->category(array('catid'=>$catid,'siteid'=>$siteid,'order'=>'listorder ASC','limit'=>'25',));}?>
            <?php $n=1;if(is_array($nav)) foreach($nav AS $r) { ?>
            <div class="content-box"> 
            	<div class="row noM"> <!--新增div-->
                	<div class="col-xs-12 fl top"><!--新增col-xs-12   style="overflow:hidden;"-->
                        <a href="<?php echo $r['url'];?>" class="title"><?php echo $r['catname'];?></a>
                        <a href="<?php echo $r['url'];?>" class="more"> 更多&gt;&gt;&gt; </a>
                    </div>
                </div>
                <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=12e407c771152ca8f019c92bc874e673&action=lists&catid=%24r%5B%27catid%27%5D&num=8&order=id+DESC&return=show\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = extendLoad::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$show = $content_tag->lists(array('catid'=>$r['catid'],'order'=>'id DESC','limit'=>'8',));}?>
                <div class="row fl item-box"><!--新增row-->
                    <?php $n=1;if(is_array($show)) foreach($show AS $r) { ?>
                    <div class="fl item col-md-6 col-sm-6 col-xs-12"><!--新增 col-md-6 col-sm-6 col-xs-12-->
                        <div class="images">
                            <a href="<?php echo $r['url'];?>">
                                <img alt="<?php echo $r['title'];?>" src="<?php echo thumb($r['thumb'], 190, 170);?>" />
                            </a>
                        </div>
                        <div class="txt">
                            <h3>
                                <a href="<?php echo $r['url'];?>"><?php echo $r['title'];?></a>
                            </h3>
                            <p>
                                <a href="<?php echo $r['url'];?>"><?php echo str_cut($r['description'], 180, '...');?></a>
                            </p>
                        </div>
                    </div>
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