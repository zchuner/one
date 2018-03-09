<?php
/**
 * Created by PhpStorm.
 * User: Rouyi
 * Date: 2017/5/31
 * Time: 17:30
 * Desc: 工作人员名片详情模板
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
                    <td>{$CAT['catname']} &gt;&gt; {$title}</td>
                    <td>&nbsp;</td>
                </tr>
            </table>
        </div>
        <div class="aboutus_rightMain">
            <div class="jizhe_contentmain">
                {$title}<br>
                <div style="text-align:center;margin-top:6px;">
                    <img src="{$thumb}" onload="if(this.width > 400)this.width = 400" width="400">
                </div>
            </div>
            {$description}
        </div>
    </div>
</div>
<div class="bottom">
    <?php include getTemplate('copyright')?>
</div>
</body>
</html>


