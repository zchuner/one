<?php
/**
 * Created by PhpStorm.
 * User: Rouyi
 * Date: 2017/10/7
 * Time: 20:32
 * Desc: 视频内容模板
 */
include getTemplate('header');
?>

<div class="container content video">
    <div class="position">
        <a href="<?php echo url('/')?>">首页</a> >
        <?php echo catpos($CAT['catid'])?>
        <?php echo $title ?>
    </div>
    <div class="row">
        <div class="col-md-8 left show">
            <div class="body">
                <h1 class="hr-title small"><?php echo $title?></h1>
                <div class="info titleMT" ><!--新增titleMT-->
                    <span>发布时间：<?php echo $inputtime?></span>
                    <span>来源：<?php echo ($copyfrom) ? $copyfrom : $SEO['site_title']?></span>
                    <span>作者：<?php echo ($author) ? $author : '侠名'?></span>
                    <span>责任编辑：<?php echo getNickname($username)?></span>
                    <span>浏览：<em id="hits">--</em></span>
                    <span>
                        点赞：
                        <a href="#" class="praise-btn" data-id="<?php echo $id?>" data-cid="<?php echo $catid?>">
                            <i class="fa fa-thumbs-o-up"></i>
                            (<em><?php echo getPraiseNumber($id, $catid)?></em>)
                        </a>
                    </span>
                </div>
                <div class="show-content">
                    <div class="body-info">
                        <div class="text"><?php echo $content?></div>
                        <div class=" share-box"> <!--原来有clear-->
                            <div class="share">
                                <div class="bdsharebuttonbox">
                                    <a href="#" class="bds_more" data-cmd="more"></a>
                                    <a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
                                    <a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
                                    <a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a>
                                    <a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a>
                                    <a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!--新增评论-->
            <div class="row">
        <div class="col-md-12 left">
            <h2 class="hr-title border">评论<!-- (<span id="changyan_count_unit">0</span>)--></h2>
            <div class="comment">
                <?php include getTemplate('chang_yan')?>
            </div>
        </div>
    </div>
        </div>
        <div class="col-md-4 right">
            <div class="items">
                <h2 class="hr-title border">特别推荐</h2>
                <div class="double-row titleMT">
                    {qm:content action="position" posid="1" order="listorder DESC" num="1"}<!--原来num="2"-->
                    <?php $noId = []?>
                    <div class="row top">
                        {loop $data $r}
                        <?php $noId[] = $r['id']?>
                        <div class="col-xs-12 item"><!--原来col-xs-6-->
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
                            <li><a href="{$r['url']}" title="{$r['title']}">{$r['title']}</a></li>
                            <?php endif; ?>
                            {/loop}
                        </ul>
                        {/qm}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{APP_PATH}hits/{$modelid}/{$id}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click', '.praise-btn', function () {
            var $this = $(this),
                cid = $this.data('cid'),
                id = $this.data('id'),
                praise = parseInt($this.find('em').text());

            $.post('<?php echo url('praise/update')?>', {
                cid: cid,
                id: id,
                _token: '<?php echo csrf_token()?>'
            }, function (rs) {
                if (rs.code < 0) return qm.message(rs.message);
                $this.find('em').text(praise + 1);
            }, 'JSON');

            return false;
        });

        window._bd_share_config = {
            "common": {
                "bdSnsKey": {},
                "bdText": "<?php echo $description?>",
                "bdMini": 2,
                "bdMiniList": false,
                "bdPic": "<?php echo $thumb?>",
                "bdStyle": 0,
                "bdSize": 24,
                "bdUrl": "<?php echo $url?>"
            }, "share": {}
        };
        with (document)0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=' + ~(-new Date() / 36e5)];
    });
</script>
<?php
include getTemplate('footer');