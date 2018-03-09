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
                <h2 class="hr-title small">{$CAT['catname']} <!--a class="fr more"><i class="fa fa-refresh"></i>换一换</a--></h2>
                {qm:content action="lists" catid="$CAT['catid']" num="1"}
                <div class="items">
                    {qm:content action="lists" catid="$catid" num="21" order="id DESC" page="$page"}
                    <ul>
                        {loop $data $r}
                        <li class="row mt-5-new"><!--新增mt-5-new-->
                            <div class="col-md-3 col-sm-3 col-xs-4 image"> <!--原来col-xs-3 -->
                                <a href="{$r['url']}"><img src="<?php echo ($r['thumb']) ?  $r['thumb'] : asset('admin/extends/images/nopic.gif')?>" alt="{$r['title']}"></a><!--src="{$r['thumb']}"-->
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-8 info"> <!--原来col-xs-9-->
                                <p class="title"><a href="{$r['url']}" title="{$r['title']}">{$r['title']}</a></p>
                                <p class="description"><a href="{$r['url']}">{$r['description']}</a></p> <!--原来{$r['description']}   {str_cut($r['description'], 120, '...')}-->
                                <div class="data">
                                    <p class="col-xs-3 fav"><i class="fa fa-thumbs-o-up"></i>{getPraiseNumber($r['id'], $r['catid'])}</p>
                                    <p class="col-xs-3 view"><i class="fa fa-eye"></i>{getViewNumber($r['id'], $r['catid'])}</p>
                                    <p class="col-xs-6 comment" style="text-align:right;"><i class="fa fa-clock-o"></i>{date('Y-m-d', $r['inputtime'])}</p>
                                    <!--原来 比例 2 2 8  新增style="text-align:right;"-->
                                </div>
                            </div>
                        </li>
                        {/loop}
                    </ul>
                    <?php if ($pages) : ?>
                    <div class="clear pages"><!--原有clear -->
                        <?php echo $pages?>
                    </div>
                    <?php endif; ?>
                    {/qm}
                </div>
            </div>
        </div>
        <?php include getTemplate('list_right');?>
    </div>
</div>

<?php
include getTemplate('footer');