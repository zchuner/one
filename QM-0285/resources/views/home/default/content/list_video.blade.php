<?php
/**
 * Created by PhpStorm.
 * User: Rouyi
 * Date: 2017/10/7
 * Time: 20:32
 * Desc: 视频栏目模板
 */
include getTemplate('header');
?>

<div class="container content">
    <div class="row">
        <div class="col-md-8 left">
            <div class="imagesTop">
                <h2 class="hr-title small">{$CAT['catname']} <!--a class="fr more"><i class="fa fa-refresh"></i>换一换</a--></h2>
                {qm:content action="lists" catid="$CAT['catid']" num="1"}
                <?php $noId = ''?>
                <div class="item ">
                    {loop $data $r}
                    <?php $noId = $r['id']?>
                    <a href="{$r['url']}"><img src="<?php echo ($r['thumb']) ?  $r['thumb'] : asset('admin/extends/images/nopic.gif')?>" alt="{$r['title']}"></a> 
                    <p class="title"><a href="{$r['url']}" title="{$r['title']}">{$r['title']}</a></p>
                    {/loop}
                </div>
                {/qm}
                <div class="items">
                    {qm:content action="lists" catid="$catid" num="21" order="id DESC" page="$page"}
                    <ul class="row">
                        {loop $data $r}
                        <?php if ($noId != $r['id']) : ?>
                        <li class="col-md-4 col-sm-4 col-xs-12"><!--原来col-xs-4 -->
                            <div class="box">
                                <div class="image">
                                    <a href="{$r['url']}"><img src="<?php echo ($r['thumb']) ?  $r['thumb'] : asset('admin/extends/images/nopic.gif')?>" alt="{$r['title']}"></a> <!--原来src="{$r['thumb']}" -->
                                </div>
                                <div class="info">
                                    <p class="title"><a href="{$r['url']}" title="{$r['title']}">{$r['title']}</a></p>
                                    <div class="data" style="height:18px;"> <!--新增style="height:18px;" -->
                                        <p class="col-xs-3 fav"><i class="fa fa-thumbs-o-up"></i>{getPraiseNumber($r['id'], $r['catid'])}</p>
                                        <p class="col-xs-3 view"><i class="fa fa-eye"></i>{getViewNumber($r['id'], $r['catid'])}</p>
                                        <p class="col-xs-6 comment"><i class="fa fa-clock-o"></i>{date('Y-m-d', $r['inputtime'])}</p><!--原来col-xs-8 -->
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php endif; ?>
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