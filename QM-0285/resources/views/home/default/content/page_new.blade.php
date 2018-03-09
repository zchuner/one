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
        <div class="col-md-12 left show">
            <div class="body">
                <h1 class="hr-title small"><?php echo $title?></h1>
                <div class="info">
                    <span>发布时间：<?php echo $inputtime?></span>
                    <span>来源：<?php echo ($copyfrom) ? $copyfrom : $SEO['site_title']?></span>
                    <span>作者：<?php echo ($author) ? $author : '侠名'?></span>
                    <span>责任编辑：<?php echo getNickname($username)?></span>
                </div>
                <div class="show-content">
                    <div class="body-info">
                        <div class="text"><?php echo $content?></div>
                        <div class="clear share-box">
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
        </div>
    </div>
</div>
<script type="text/javascript">
    window._bd_share_config = {
        "common": {
            "bdSnsKey": {},
            "bdText": "<?php echo $description?>",
            "bdMini": 2,
            "bdMiniList": false,
            "bdPic": "",
            "bdStyle": 0,
            "bdSize": 24,
            "bdUrl": "<?php echo $url?>"
        }, "share": {}
    };
    with (document) 0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=' + ~(-new Date() / 36e5)];
</script>
<?php
include getTemplate('footer');