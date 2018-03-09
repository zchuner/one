<?php
/**
 * Created by PhpStorm.
 * User: Rouyi
 * Date: 2017/10/7
 * Time: 20:32
 * Desc: 专题栏目模板
 */
include getTemplate('header');
?>

<div class="container content news">
    <div class="row">
        <div class="col-md-8 left">
            <div class="imagesTop">
                <h2 class="hr-title small">{$info['name']}</h2>
                <div class="items">
                    {qm:special action="content_list" specialid="$specialid" typeid="$typeid" listorder="3" page="$page" num="20"}
                    <ul>
                        {loop $data $r}
                        <li class="row">
                            <div class="col-xs-3 image">
                                <a href="{$r['url']}"><img src="<?php echo ($r['thumb']) ?  $r['thumb'] : asset('admin/extends/images/nopic.gif')?>" alt="{$r['title']}"></a> <!--原来{$r['thumb']}   {thumb($r['thumb'])} -->
                            </div>
                            <div class="col-xs-9 info">
                                <p class="title"><a href="{$r['url']}" title="{$r['title']}">{$r['title']}</a></p>
                                <p class="description"><a href="{$r['url']}">{$r['description']}</a></p>
                                <div class="data">
                                    <!--<p class="col-xs-2 fav"><i class="fa fa-star"></i>227</p>
                                    <p class="col-xs-2 view"><i class="fa fa-eye"></i>228</p>
                                    <p class="col-xs-8 comment"><i class="fa fa-clock-o"></i>{date('Y-m-d', $r['inputtime'])}</p>-->
                                    <p class="col-xs-3 fav"><i class="fa fa-thumbs-o-up"></i>{getPraiseNumber($r['id'], $r['catid'])}</p>
                                    <p class="col-xs-3 view"><i class="fa fa-eye"></i>{getViewNumber($r['id'], $r['catid'])}</p>
                                    <p class="col-xs-6 comment" style="text-align:right;"><i class="fa fa-clock-o"></i>{date('Y-m-d', $r['inputtime'])}</p>
                                    <!--原来 比例 2 2 8 新增style="text-align:right;"-->
                                </div>
                            </div>
                        </li>
                        {/loop}
                    </ul>
                    <?php if ($pages) : ?>
                    <div class="clear pages">
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