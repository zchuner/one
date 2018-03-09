<div class="container adBox1">
	<div class="bxW row"><!--新增 div-->
    <script language="javascript" src="{APP_PATH}poster/index/show_poster?id=4"></script>
    </div>
</div>
<div class="footer">
    <div class="container">
    	<div class="bxW"><!--新增 div-->
            <h3>合作伙伴 >></h3>
            {qm:link action="type_list" linktype="0" order="listorder DESC" num="10" return="linkText"}
            <p class="links_text">
                {loop $linkText $v}
                <a href="{$v['url']}" target="_blank" title="{$v['name']}">{$v['name']}</a>
                {/loop}
            </p>
            {/qm}
            <p>
                <a href="http://www.12377.cn/" target="_blank">中国互联网违法和不良信息举报中心</a> |
                <a href="http://www.hbgd.net/jgdt/2013-12/04/cms280article.shtml" target="_blank">中国互联网视听节目服务自律公约</a> |
                <a href="https://www.12321.cn/" target="_blank">12321垃圾信息举报中心</a> |
                <a href="http://union.china.com.cn/" target="_blank">中国新闻网站联盟</a> |
                <a href="http://search.people.com.cn/cnpeople/news/index.html" target="_blank">人民搜索</a> |
                <a href="http://www.chinaso.com/" target="_blank">盘古搜索</a>
            </p>
            <p>版权所有 中国互联网新闻中心 电子邮件： fzzg2013@126.com  电话：010-57128662  57735282</p>
            <p>京ICP证  040089号  网络传播视听节目许可证号：0105123</p>
            <p>
                <a href="<?php echo $CATEGORYS[12]['url']?>"><?php echo $CATEGORYS[12]['catname']?></a>|
                <a href="http://www.yuecheng.com/" target="_blank">法律顾问：北京岳成律师事务所</a>|
                <a href="<?php echo $CATEGORYS[13]['url']?>"><?php echo $CATEGORYS[13]['catname']?></a>|
                <a href="<?php echo $CATEGORYS[15]['url']?>"><?php echo $CATEGORYS[15]['catname']?></a>|
                <a href="<?php echo $CATEGORYS[16]['url']?>"><?php echo $CATEGORYS[16]['catname']?></a>|
                <a href="<?php echo $CATEGORYS[14]['url']?>"><?php echo $CATEGORYS[14]['catname']?></a>
            </p>
        </div>
    </div>
</div>
</body>
</html>