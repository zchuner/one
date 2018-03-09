<?php 
use \App\Http\PHPExtends\System\extendLoad;
?>
<?php
/**
 * Created by PhpStorm.
 * User: Rouyi
 * Date: 2017/10/7
 * Time: 20:32
 * Desc: 通用右侧模板
 */
?>
<div class="col-md-4 right">
    <div class="items">
        <h2 class="hr-title border">特别推荐 <!--a class="fr more"><i class="fa fa-refresh"></i>换一换</a--></h2>
        <div class="double-row">
            <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=bc818c1e0893180cab001c674eff9676&action=position&posid=1&order=listorder+DESC&num=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = extendLoad::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'1','order'=>'listorder DESC','limit'=>'1',));}?>
            <?php $noId = []?>
            <div class="top"><!--原来clear top-->
                <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                <?php $noId[] = $r['id']?>
                <div class="fl item">
                    <a href="<?php echo $r['url'];?>">
                        <img src="<?php echo $r['thumb'];?>" alt="<?php echo $r['title'];?>">
                    </a>
                </div>
                <?php $n++;}unset($n); ?>
            </div>
            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            <div class="item-ul">
                <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=a9761abeacd83440d86cd897167fc88e&action=position&posid=1&order=listorder+DESC&num=12\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = extendLoad::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'1','order'=>'listorder DESC','limit'=>'12',));}?>
                <ul>
                    <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                    <?php if (!in_array($noId, $r['id'])) : ?>
                    <li style="overflow: hidden;text-overflow:ellipsis;white-space: nowrap;"><a href="<?php echo $r['url'];?>" title="<?php echo $r['title'];?>"><?php echo $r['title'];?></a></li>
                    <?php endif; ?>
                    <?php $n++;}unset($n); ?>
                </ul>
                <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </div>
        </div>
    </div>
    <div class="items">
        <!--<h2 class="hr-title border"><?php echo $CATEGORYS[11]['catname']?>--> <!--a class="fr more"><i class="fa fa-refresh"></i>换一换</a--></h2>
        <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=e4208ffb405076c2c82752b252afabab&action=lists&catid=11&num=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = extendLoad::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'11','limit'=>'10',));}?>
        <!--<div class="one-row">
            <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
            <div class="item">
                <a href="<?php echo $r['url'];?>"><img src="<?php echo $r['thumb'];?>" alt="<?php echo $r['title'];?>"></a>
                <p class="title"><a href="<?php echo $r['url'];?>" title="<?php echo $r['title'];?>"><?php echo $r['title'];?></a></p>
            </div>
            <?php $n++;}unset($n); ?>
        </div>-->
        <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
    </div>
</div>