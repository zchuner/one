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
include getTemplate('header');
?>

<div class="container content news">
    <div class="row">
        <div class="col-md-8 left">
            <div class="imagesTop">
                <h2 class="hr-title small"><?php echo $CAT['catname'];?> <!--a class="fr more"><i class="fa fa-refresh"></i>换一换</a--></h2>
                <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=aff04c13d2782de2079ffb0635cd818d&action=lists&catid=%24CAT%5B%27catid%27%5D&num=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = extendLoad::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>$CAT['catid'],'limit'=>'1',));}?>
                <div class="items">
                    <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=81fbd1ecd71f5fe897a7274a98d3550b&action=lists&catid=%24catid&num=21&order=id+DESC&page=%24page\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = extendLoad::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$pagesize = 21;$page = intval($page) ? intval($page) : 1;if($page<=0){$page=1;}$offset = ($page - 1) * $pagesize;$content_total = $content_tag->count(array('catid'=>$catid,'order'=>'id DESC','limit'=>$offset.",".$pagesize,'action'=>'lists',));$pages = pages($content_total, $page, $pagesize, $urlrule);$data = $content_tag->lists(array('catid'=>$catid,'order'=>'id DESC','limit'=>$offset.",".$pagesize,'action'=>'lists',));}?>
                    <ul>
                        <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                        <li class="row mt-5-new"><!--新增mt-5-new-->
                            <div class="col-md-3 col-sm-3 col-xs-4 image"> <!--原来col-xs-3 -->
                                <a href="<?php echo $r['url'];?>"><img src="<?php echo ($r['thumb']) ?  $r['thumb'] : asset('admin/extends/images/nopic.gif')?>" alt="<?php echo $r['title'];?>"></a><!--src="<?php echo $r['thumb'];?>"-->
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-8 info"> <!--原来col-xs-9-->
                                <p class="title"><a href="<?php echo $r['url'];?>" title="<?php echo $r['title'];?>"><?php echo $r['title'];?></a></p>
                                <p class="description"><a href="<?php echo $r['url'];?>"><?php echo $r['description'];?></a></p> <!--原来<?php echo $r['description'];?>   <?php echo str_cut($r['description'], 120, '...');?>-->
                                <div class="data">
                                    <p class="col-xs-3 fav"><i class="fa fa-thumbs-o-up"></i><?php echo getPraiseNumber($r['id'], $r['catid']);?></p>
                                    <p class="col-xs-3 view"><i class="fa fa-eye"></i><?php echo getViewNumber($r['id'], $r['catid']);?></p>
                                    <p class="col-xs-6 comment" style="text-align:right;"><i class="fa fa-clock-o"></i><?php echo date('Y-m-d', $r['inputtime']);?></p>
                                    <!--原来 比例 2 2 8  新增style="text-align:right;"-->
                                </div>
                            </div>
                        </li>
                        <?php $n++;}unset($n); ?>
                    </ul>
                    <?php if ($pages) : ?>
                    <div class="clear pages"><!--原有clear -->
                        <?php echo $pages?>
                    </div>
                    <?php endif; ?>
                    <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                </div>
            </div>
        </div>
        <?php include getTemplate('list_right');?>
    </div>
</div>

<?php
include getTemplate('footer');