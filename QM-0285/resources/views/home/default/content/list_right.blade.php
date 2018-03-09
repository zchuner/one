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
            {qm:content action="position" posid="1" order="listorder DESC" num="1"}
            <?php $noId = []?>
            <div class="top"><!--原来clear top-->
                {loop $data $r}
                <?php $noId[] = $r['id']?>
                <div class="fl item">
                    <a href="{$r['url']}">
                        <img src="{$r['thumb']}" alt="{$r['title']}">
                    </a>
                </div>
                {/loop}
            </div>
            {/qm}
            <div class="item-ul">
                {qm:content action="position" posid="1" order="listorder DESC" num="12"}
                <ul>
                    {loop $data $r}
                    <?php if (!in_array($noId, $r['id'])) : ?>
                    <li style="overflow: hidden;text-overflow:ellipsis;white-space: nowrap;"><a href="{$r['url']}" title="{$r['title']}">{$r['title']}</a></li>
                    <?php endif; ?>
                    {/loop}
                </ul>
                {/qm}
            </div>
        </div>
    </div>
    <div class="items">
        <!--<h2 class="hr-title border"><?php echo $CATEGORYS[11]['catname']?>--> <!--a class="fr more"><i class="fa fa-refresh"></i>换一换</a--></h2>
        {qm:content action="lists" catid="11" num="10"}
        <!--<div class="one-row">
            {loop $data $r}
            <div class="item">
                <a href="{$r['url']}"><img src="{$r['thumb']}" alt="{$r['title']}"></a>
                <p class="title"><a href="{$r['url']}" title="{$r['title']}">{$r['title']}</a></p>
            </div>
            {/loop}
        </div>-->
        {/qm}
    </div>
</div>