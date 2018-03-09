<?php
/**
 * Created by PhpStorm.
 * User: Rouyi
 * Date: 2017/5/31
 * Time: 17:09
 * Desc: 工作人员查询模板
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
            <div class="jizhe_main">
                <div class="jizhe_mainImg">
                    <a href="{$r['url']}" target="_blank"><img src="{$r['thumb']}" style="height:121px; width:164px;"></a>
                </div>
                <span>姓名：</span>{$r['title']} <br>
                <span>部门：</span>{$r['department']} <br>
                <span>职务：</span>{$r['post']} <br>
                <span>编号：</span>{$r['number']} <br>
                {str_cut($r['description'], 80)}
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