<?php
/**
 * Created by PhpStorm.
 * User: Rouyi
 * Date: 2017/7/13
 * Time: 16:08
 * Desc: 搜索页模板
 */
include getTemplate('header');
?>

<div class="container content news">
    <div class="row">
        <div class="col-xs-8 left">
            <div class="imagesTop">
                <h2 class="hr-title small">搜索 [<?php echo $keyword ?>]</h2>
                <div class="items">
                    <ul>
                        <?php foreach ($searchItems as $k => $r) : ?>
                        <li class="row">
                            <div class="col-xs-3 image">
                                <a href="{$r['url']}"><img src="{$r['thumb']}" alt="{$r['title']}"></a>
                            </div>
                            <div class="col-xs-9 info">
                                <p class="title"><a href="{$r['url']}" title="{$r['title']}">{$r['title']}</a></p>
                                <p class="description"><a href="{$r['url']}">{$r['description']}</a></p>
                                <div class="clear data">
                                    <p class="col-xs-2 fav"><i class="fa fa-star"></i>227</p>
                                    <p class="col-xs-2 view"><i class="fa fa-eye"></i>228</p>
                                    <p class="col-xs-8 comment"><i class="fa fa-clock-o"></i>{date('Y-m-d', $r['inputtime'])}</p>
                                </div>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php if ($pages) : ?>
                    <div class="clear pages">
                        <?php echo $pages?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php include getTemplate('list_right');?>
    </div>
</div>

<?php
include getTemplate('footer');