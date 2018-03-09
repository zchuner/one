<?php
use \App\Http\PHPExtends\System\extendLoad;
$addbg = 1;
include $this->admin_tpl('header','admin');
?>

<meta name="app" content="<?php echo url('')?>/">
<link href="<?php echo asset('admin/css/jquery.fileuploader.css')?>" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    var charset = '<?php echo CHARSET;?>';
    var uploadurl = '<?php echo extendLoad::load_config('system','upload_url')?>';
</script>
<script language="javascript" type="text/javascript" src="<?php echo JS_PATH?>content_addtop.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo JS_PATH?>colorpicker.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo JS_PATH?>hotkeys.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo JS_PATH?>cookie.js"></script>
<script type="text/javascript" src="<?php echo asset('lib/js/jquery.cookie.js')?>"></script>
<script type="text/javascript">var catid = '<?php echo $catid;?>'</script>
<form name="myform" id="myform" action="?m=content&c=content&a=add" method="post" enctype="multipart/form-data">
    <input type="hidden" id="serverFileId" />
    <div class="addContent">
        <div class="crumbs"><?php echo L('add_content_position');?></div>
        <div class="col-right">
            <div class="col-1">
                <div class="content pad-6">
                    <?php
                    if (is_array($forminfos['senior'])) {
                        foreach ($forminfos['senior'] as $field => $info) {
                            if ($info['isomnipotent']) continue;
                            if ($info['formtype'] == 'omnipotent') {
                                foreach ($forminfos['base'] as $_fm => $_fm_value) {
                                    if ($_fm_value['isomnipotent']) {
                                        $info['form'] = str_replace('{' . $_fm . '}', $_fm_value['form'], $info['form']);
                                    }
                                }
                                foreach ($forminfos['senior'] as $_fm => $_fm_value) {
                                    if ($_fm_value['isomnipotent']) {
                                        $info['form'] = str_replace('{' . $_fm . '}', $_fm_value['form'], $info['form']);
                                    }
                                }
                            }
                            ?>

                                <h6><?php if($info['star']){ ?> <font color="red">*</font><?php } ?> <?php echo $info['name']?></h6>
                                <?php echo $info['form']?><?php echo $info['tips']?>
                            <?php
                        }
                    }
                    ?>
                    <?php if(session('admin')['roleid']==1 || $priv_status) {?>
                        <h6><?php echo L('c_status');?></h6>
                        <span class="ib" style="width:90px"><label><input type="radio" name="status" value="99" checked/> <?php echo L('c_publish');?> </label></span>
                        <?php if($workflowid) { ?><label><input type="radio" name="status" value="1" > <?php echo L('c_check');?> </label><?php }?>
                    <?php }?>
                </div>
            </div>
        </div>
        <a title="展开与关闭" class="r-close" hidefocus="hidefocus" style="outline-style: none; outline-width: medium;" id="RopenClose" href="javascript:;"><span class="hidden">展开</span></a>
        <div class="col-auto">
            <div class="col-1">
                <div class="content pad-6">
                    <table width="100%" cellspacing="0" class="table_form">
                        <tbody>
                        <?php
                        if (is_array($forminfos['base'])) {
                            foreach ($forminfos['base'] as $field => $info) {
                                if ($info['isomnipotent']) continue;
                                if ($info['formtype'] == 'omnipotent') {
                                    foreach ($forminfos['base'] as $_fm => $_fm_value) {
                                        if ($_fm_value['isomnipotent']) {
                                            $info['form'] = str_replace('{' . $_fm . '}', $_fm_value['form'], $info['form']);
                                        }
                                    }
                                    foreach ($forminfos['senior'] as $_fm => $_fm_value) {
                                        if ($_fm_value['isomnipotent']) {
                                            $info['form'] = str_replace('{' . $_fm . '}', $_fm_value['form'], $info['form']);
                                        }
                                    }
                                }
                                ?>
                                <?php if ($field == 'catid') { ?>
                                    <tr>
                                        <th width="80">
                                            <?php if ($info['star']) { ?> <font color="red">*</font><?php } ?> <?php echo $info['name'] ?>
                                        </th>
                                        <td>
                                            <?php echo $info['form'] ?><?php echo $info['tips'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th width="80">上传视频</th>
                                        <td>
                                            <div class="upload-file">
                                                <div class="fileuploader fileuploader-theme-default">
                                                    <div class="fileuploader-input" id="select_file">
                                                        <div class="fileuploader-input-caption"><span>请选择一个文件来进行上传...</span></div>
                                                        <div class="fileuploader-input-button"><span>选择文件</span></div>
                                                    </div>
                                                    <div class="fileuploader-items" style="display: none">
                                                        <ul class="fileuploader-items-list">
                                                            <li class="fileuploader-item">
                                                                <div class="columns">
                                                                    <div class="column-thumbnail">
                                                                        <div class="item-ext">
                                                                            <div class="fileuploader-item-icon"><i>--</i></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="column-title">
                                                                        <div class="filename">--</div>
                                                                        <span class="size">--</span>
                                                                        <span class="speed">--/-</span>
                                                                    </div>
                                                                    <div class="column-actions">
                                                                        <a class="fileuploader-action fileuploader-action-start" style="display:none" data-type="start" title="开始上传"><i></i></a>
                                                                        <a class="fileuploader-action fileuploader-action-suspend" data-type="suspend" title="暂停上传"><i></i></a>
                                                                        <a class="fileuploader-action fileuploader-action-retry" style="display:none" data-type="retry" title="重新上传"><i></i></a>
                                                                        <a class="fileuploader-action fileuploader-action-remove" data-type="remove" title="删除/取消上传"><i></i></a>
                                                                        <a class="fileuploader-action fileuploader-action-success" style="display:none" title="上传完成"><i></i></a>
                                                                    </div>
                                                                </div>
                                                                <div class="progress-bar2">
                                                                    <div class="fileuploader-progressbar"><div class="bar"></div></div>
                                                                    <span>-</span>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="fileuploader-items-list message-box">
                                                        <ul>
                                                            <li class="fileuploader-item message" id="error"></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } else { ?>
                                    <tr>
                                        <th width="80">
                                            <?php if ($info['star']) { ?> <font color="red">*</font><?php } ?> <?php echo $info['name'] ?>
                                        </th>
                                        <td>
                                            <?php echo $info['form'] ?><?php echo $info['tips'] ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                        }
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="fixed-bottom">
                <div class="fixed-but text-c">
                    <div class="button"><input value="<?php echo L('save_close');?>" type="submit" name="dosubmit" class="cu" style="width:145px;" onclick="refersh_window()"></div>
                    <div class="button"><input value="<?php echo L('save_continue');?>" type="submit" name="dosubmit_continue" class="cu" style="width:130px;" title="Alt+X" onclick="refersh_window()"></div>
                    <div class="button"><input value="<?php echo L('c_close');?>" type="button" name="close" onclick="refersh_window();close_window();" class="cu" style="width:70px;"></div>
                </div>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript" src="<?php echo asset('admin/js/video_upload/uploaderh5V3.js')?>"></script>
<script type="text/javascript" src="<?php echo asset('admin/js/video_upload/upload.js')?>" charset="utf-8"></script>
<script type="text/javascript">
    var openClose = $("#RopenClose"), rh = $(".addContent .col-auto").height(), colRight = $(".addContent .col-right"),
        valClose = getcookie('openClose');
    $(function () {
        if (valClose == 1) {
            colRight.hide();
            openClose.addClass("r-open");
            openClose.removeClass("r-close");
        } else {
            colRight.show();
        }
        openClose.height(rh);
        $.formValidator.initConfig({
            formid: "myform", autotip: true, onerror: function (msg, obj) {
                window.top.art.dialog({
                    id: 'check_content_id',
                    content: msg,
                    lock: true,
                    width: '200',
                    height: '50'
                }, function () {
                    $(obj).focus();
                    boxid = $(obj).attr('id');
                    if ($('#' + boxid).attr('boxid') != undefined) {
                        check_content(boxid);
                    }
                })
            }
        });
        <?php echo $formValidator;?>

        /*
         * 加载禁用外边链接
         */

        $('#linkurl').attr('disabled', true);
        $('#islink').attr('checked', false);
        $('.edit_content').hide();

        jQuery(document).bind('keydown', 'Alt+x', function () {
            close_window();
        });
    });
    document.title = '<?php echo L('add_content');?>';
    self.moveTo(-4, -4);
    function refersh_window() {
        setcookie('refersh_time', 1);
    }
    openClose.click(
        function () {
            if (colRight.css("display") == "none") {
                setcookie('openClose', 0, 1);
                openClose.addClass("r-close");
                openClose.removeClass("r-open");
                colRight.show();
            } else {
                openClose.addClass("r-open");
                openClose.removeClass("r-close");
                colRight.hide();
                setcookie('openClose', 1, 1);
            }
        }
    )
</script>

</body>
</html>