<?php include $this->admin_tpl('header')?>
<script type="text/javascript">
    <!--
    $(function(){
        $.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:'200',height:'50'}, function(){this.close();$(obj).focus();})}});
        $("#name").formValidator({onshow:"<?php echo L("input").L('site_name')?>",onfocus:"<?php echo L("input").L('site_name')?>"}).inputValidator({min:1,onerror:"<?php echo L("input").L('site_name')?>"}).ajaxValidator({type : "get",url : "", data :"?m=admin&c=site&a=public_name&siteid=<?php echo $data['siteid']?>",datatype : "html",async:'true',success : function(data){	if( data == "1" ){return true;}else{return false;}},buttons: $("#dosubmit"),onerror : "<?php echo L('site_name').L('exists')?>",onwait : "<?php echo L('connecting')?>"}).defaultPassed();
        $("#domain").formValidator({onshow:"<?php echo L('site_domain_ex')?>",onfocus:"<?php echo L('site_domain_ex')?>",tipcss:{width:'300px'},empty:false}).inputValidator({onerror:"<?php echo L('site_domain_ex')?>"}).regexValidator({regexp:"http|https:\/\/(.+)\/$",onerror:"<?php echo L('site_domain_ex2')?>"});
    })
    //-->
</script>
<style type="text/css">
    .radio-label{ border-top:1px solid #e4e2e2; border-left:1px solid #e4e2e2}
    .radio-label td{ border-right:1px solid #e4e2e2; border-bottom:1px solid #e4e2e2;background:#f6f9fd}
</style>
<div class="content">
    <div class="formbody">
        <div class="formtitle">
            <span>基本信息</span>
        </div>
        <form action="?c=site&a=edit&siteid=<?php echo $siteid?>" method="post" id="myform">
            <?php echo csrf_field()?>
            <fieldset>
                <legend><?php echo L('basic_configuration')?></legend>
                <table width="100%"  class="table_form">
                    <tr>
                        <th width="80"><?php echo L('site_name')?>：</th>
                        <td class="y-bg"><input type="text" class="input-text" name="name" id="name" size="30" value="<?php echo $data['name']?>" required /></td>
                    </tr>
                    <tr>
                        <th><?php echo L('site_domain')?>：</th>
                        <td class="y-bg"><input type="text" class="input-text" name="domain" id="domain"  size="30" value="<?php echo $data['domain']?>" required /></td>
                    </tr>
                </table>
            </fieldset>
            <div class="bk10"></div>
            <fieldset>
                <legend><?php echo L('seo_configuration')?></legend>
                <table width="100%"  class="table_form">
                    <tr>
                        <th width="80"><?php echo L('site_title')?>：</th>
                        <td class="y-bg"><input type="text" class="input-text" name="site_title" id="site_title" size="30" value="<?php echo $data['site_title']?>" required /></td>
                    </tr>
                    <tr>
                        <th><?php echo L('keyword_name')?>：</th>
                        <td class="y-bg"><input type="text" class="input-text" name="keywords" id="keywords" size="30" value="<?php echo $data['keywords']?>" required /></td>
                    </tr>
                    <tr>
                        <th><?php echo L('description')?>：</th>
                        <td class="y-bg">
                            <textarea name="description" id="description" class="textinput" required><?php echo $data['description']?></textarea>
                        </td>
                    </tr>
                </table>
            </fieldset>
            <div class="bk10"></div>
            <fieldset>
                <legend>腾讯VOD</legend>
                <table width="100%"  class="table_form">
                    <tr>
                        <th width="80">APP_ID：</th>
                        <td class="y-bg"><input type="text" class="input-text" name="t_vod[APP_ID]" id="site_title" size="30" value="<?php echo $data['t_vod']['APP_ID']?>" required /></td>
                    </tr>
                    <tr>
                        <th>SecretId：</th>
                        <td class="y-bg"><input type="text" class="input-text" name="t_vod[SecretId]" size="30" value="<?php echo $data['t_vod']['SecretId']?>" required /></td>
                    </tr>
                    <tr>
                        <th>SecretKey：</th>
                        <td class="y-bg"><input type="text" class="input-text" name="t_vod[SecretKey]" size="30" value="<?php echo $data['t_vod']['SecretKey']?>" required /></td>
                    </tr>
                    <tr>
                        <th>&nbsp;</th>
                        <td class="y-bg">
                            <select name="t_vod[is_delete]" style="width:220px">
                                <option value="1" <?php if($data['t_vod']['is_delete']) echo 'selected="selected"'?>>是</option>
                                <option value="0" <?php if(!$data['t_vod']['is_delete']) echo 'selected="selected"'?>>否</option>
                            </select>
                            <p>删除视频时是否同步删除远程文件？</p>
                        </td>
                    </tr>
                </table>
            </fieldset>
            <div class="bk10"></div>
            <fieldset>
                <legend>畅言</legend>
                <table width="100%"  class="table_form">
                    <tr>
                        <th width="80">APP_ID：</th>
                        <td class="y-bg"><input type="text" class="input-text" name="chang_yan[APP_ID]" value="<?php echo $data['chang_yan']['APP_ID']?>" required /></td>
                    </tr>
                </table>
            </fieldset>
            <div class="bk10"></div>
            <fieldset>
                <legend>腾讯LVB直播</legend>
                <table width="100%"  class="table_form">
                    <tr>
                        <th width="80">APP_ID：</th>
                        <td class="y-bg"><input type="text" class="input-text" name="t_lvb[APP_ID]" value="<?php echo $data['t_lvb']['APP_ID']?>" required /></td>
                    </tr>
                    <tr>
                        <th width="80">播放器宽度：</th>
                        <td class="y-bg"><input type="text" class="input-text" name="t_lvb[player][width]" value="<?php echo $data['t_lvb']['player']['width']?>" required /></td>
                    </tr>
                    <tr>
                        <th width="80">播放器高度：</th>
                        <td class="y-bg"><input type="text" class="input-text" name="t_lvb[player][height]" value="<?php echo $data['t_lvb']['player']['height']?>" required /></td>
                    </tr>
                </table>
            </fieldset>
            <div class="bk15"></div>
            <input type="submit" class="btn" id="dosubmit" name="dosubmit" value="<?php echo L('submit')?>" />
        </form>
    </div>
</div>

</body>
</html>