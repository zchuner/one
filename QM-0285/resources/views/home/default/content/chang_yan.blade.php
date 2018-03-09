<?php
/**
 * Created by PhpStorm.
 * User: Rouyi
 * Date: 2017/7/2
 * Time: 20:40
 * Desc: 评论
 */
?>
<div class="chan-yan">
    <div id="SOHUCS" sid='{$id}' ></div>
    <script charset="utf-8" type="text/javascript" src="https://changyan.sohu.com/upload/changyan.js" ></script>
    <script type="text/javascript">
        window._config = { showScore: true };
        window.changyan.api.config({
            appid: '<?php echo getChangYanConfig('APP_ID')?>',  <!--cytnscMM9-->
            conf: 'prod_dada78c802200e9ee816834e838afce3'
        });
    </script>
</div>
