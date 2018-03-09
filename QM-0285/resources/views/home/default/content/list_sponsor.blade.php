<?php
/**
 * Created by PhpStorm.
 * User: Rouyi
 * Date: 2017/5/31
 * Time: 17:09
 * Desc: 合作单位栏目页模板
 */

/**
 * 引入头部
 */
include getTemplate('header_page');
?>

<div class="space"></div>
<div class="aboutus_main">
    <div class="aboutus_left">
        <div class="button">
            <div class="buttonBlack"></div>
            <div class="buttonMain">
                {qm:content action="category" catid="12" num="10" order="listorder DESC" return="pageNav"}
                <ul>
                    {loop $pageNav $v}
                    <li><a href="{$v['url']}" target="_blank">{$v['catname']}</a></li>
                    {/loop}
                </ul>
                {/qm}
            </div>
            <div class="botton_bottom"></div>
        </div>
    </div>
    <div class="aboutus_right">
        <div class="aboutus_top">
            <table width="789" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td>{$CAT['catname']} &gt;&gt;</td>
                    <td>&nbsp;</td>
                </tr>
            </table>
        </div>
        {qm:content action="lists" catid="$catid" num="10" order="listorder DESC" page="$page"}
        <div class="aboutus_rightMain">
            {loop $data $r}
            <div class="company">
                <a rel="nofollow" target="_blank" href="{$r['link']}">
                    <img src="{$r['thumb']}" width="350" height="96">
                    <p>{$r['title']}</p>
                </a>
            </div>
            {/loop}
            <div class="pages">{$pages}</div>
        </div>
        {/qm}
    </div>
</div>
<div class="bottom">
    <?php include getTemplate('copyright')?>
</div>
</body>
</html>