<style type="text/css">
    .sbs{}
    .sbul{margin:10px;}
    .sbul li{line-height:30px;}
    .button{margin-top:20px;}
    .subnav,.ifm{display:none;}
</style>
<?php include $this->admin_tpl('header','admin');?>
<div class="pad-10">
    <form action="?c=cache_all&a=init" target="cache_if" method="post" id="myform" name="myform">
        <?php echo csrf_field()?>
        <input type="hidden" name="dosubmit" value="1">
        <div class="col-2">
            <h6><?php echo L('tip_zone')?></h6>
            <div class="sbs" id="update_tips" style="height:360px; overflow:auto;">
                <ul id="file" class="sbul"></ul>
            </div>
        </div>
    </form>
    <iframe id="cache_if" name="cache_if" class="ifm"></iframe>
    <iframe id="hidden" name="hidden"  width="0" height="0" frameborder=0></iframe>
</div>
<script type="text/javascript">
    document.myform.submit();
    function addtext(data) {
        $('#file').append(data);
        document.getElementById('update_tips').scrollTop = document.getElementById('update_tips').scrollHeight;
    }
</script>
</body>
</html>