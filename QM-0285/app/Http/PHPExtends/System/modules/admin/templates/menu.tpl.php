<?php
include $this->admin_tpl('header'); ?>
<?php if (ROUTE_A == 'init') { ?>
    <div class="content">
        <div class="formbody">
            <form name="myform" action="?c=menu&a=listorder" method="post">
                <?php echo csrf_field() ?>
                <div class="pad-lr-10">
                    <div class="table-list">
                        <table width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th width="40"><?php echo L('listorder'); ?></th>
                                <th width="100">id</th>
                                <th><?php echo L('menu_name'); ?></th>
                                <th><?php echo L('operations_manage'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php echo $categorys; ?>
                            </tbody>
                        </table>
                        <div class="btn-box" style="margin-top:20px">
                            <input type="submit" class="btn" name="dosubmit" value="<?php echo L('listorder') ?>"/>
                        </div>
                    </div>
                </div>
                </div>
            </form>
        </div>
    </div>
    </body>
    </html>


<?php } elseif (ROUTE_A == 'add') { ?>
        <script type="text/javascript">
            <!--
            $(function () {
                $.formValidator.initConfig({
                    formid: "myform", autotip: true, onerror: function (msg, obj) {
                        window.top.art.dialog({content: msg, lock: true, width: '200', height: '50'}, function () {
                            this.close();
                            $(obj).focus();
                        })
                    }
                });
                $("#language").formValidator({
                    onshow: "<?php echo L("input") . L('chinese_name')?>",
                    onfocus: "<?php echo L("input") . L('chinese_name')?>",
                    oncorrect: "<?php echo L('input_right');?>"
                }).inputValidator({min: 1, onerror: "<?php echo L("input") . L('chinese_name')?>"});
                $("#name").formValidator({
                    onshow: "<?php echo L("input") . L('menu_name')?>",
                    onfocus: "<?php echo L("input") . L('menu_name')?>",
                    oncorrect: "<?php echo L('input_right');?>"
                }).inputValidator({min: 1, onerror: "<?php echo L("input") . L('menu_name')?>"});
                $("#m").formValidator({
                    onshow: "<?php echo L("input") . L('module_name')?>",
                    onfocus: "<?php echo L("input") . L('module_name')?>",
                    oncorrect: "<?php echo L('input_right');?>"
                }).inputValidator({min: 1, onerror: "<?php echo L("input") . L('module_name')?>"});
                $("#c").formValidator({
                    onshow: "<?php echo L("input") . L('file_name')?>",
                    onfocus: "<?php echo L("input") . L('file_name')?>",
                    oncorrect: "<?php echo L('input_right');?>"
                }).inputValidator({min: 1, onerror: "<?php echo L("input") . L('file_name')?>"});
                $("#a").formValidator({
                    tipid: 'a_tip',
                    onshow: "<?php echo L("input") . L('action_name')?>",
                    onfocus: "<?php echo L("input") . L('action_name')?>",
                    oncorrect: "<?php echo L('input_right');?>"
                }).inputValidator({min: 1, onerror: "<?php echo L("input") . L('action_name')?>"});
            })
            //-->
        </script>
        <div class="content">
            <div class="formbody">
                <div class="formtitle">
                    <span>基本信息</span>
                </div>
                <div class="common-form">
                    <form name="myform" id="myform" action="?c=menu&a=add" method="post">
                        <?php echo csrf_field() ?>
                        <table width="100%" class="table_form contentWrap">
                            <tr>
                                <th width="150"><?php echo L('menu_parentid') ?>：</th>
                                <td>
                                    <select name="info[parentid]" class="dfinput">
                                        <option value="0"><?php echo L('no_parent_menu') ?></option>
                                        <?php echo $select_categorys; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th> <?php echo L('chinese_name') ?>：</th>
                                <td><input type="text" name="language" id="language" class="input-text"></td>
                            </tr>
                            <tr>
                                <th><?php echo L('menu_name') ?>：</th>
                                <td><input type="text" name="info[name]" id="name" class="input-text"></td>
                            </tr>
                            <tr>
                                <th><?php echo L('module_name') ?>：</th>
                                <td><input type="text" name="info[m]" id="m" class="input-text"></td>
                            </tr>
                            <tr>
                                <th><?php echo L('file_name') ?>：</th>
                                <td><input type="text" name="info[c]" id="c" class="input-text"></td>
                            </tr>
                            <tr>
                                <th><?php echo L('action_name') ?>：</th>
                                <td><input type="text" name="info[a]" id="a" class="input-text"></td>
                            </tr>
                            <tr>
                                <th><?php echo L('att_data') ?>：</th>
                                <td><input type="text" name="info[data]" class="input-text"></td>
                            </tr>
                            <tr>
                                <th><?php echo L('menu_display') ?>：</th>
                                <td>
                                    <input type="radio" name="info[display]" value="1" checked> <?php echo L('yes') ?>&nbsp;&nbsp;
                                    <input type="radio" name="info[display]" value="0"> <?php echo L('no') ?>
                                </td>
                            </tr>
                            <tr style="display: none">
                                <th><?php echo L('show_in_model') ?>：</th>
                                <td>
                                    <?php foreach ($models as $_k => $_m) { ?>
                                        <input checked="checked" type="checkbox" name="info[<?php echo $_k ?>]" value="1"> <?php echo $_m ?>
                                    <?php } ?>
                                </td>
                            </tr>
                        </table>
                        <!--table_form_off-->
                </div>
                <div class="bk15"></div>
                <div class="btn-box">
                    <input type="submit" id="dosubmit" class="btn" name="dosubmit" value="<?php echo L('submit') ?>"/>
                </div>
            </div>
        </div>
    </div>
    </form>

<?php } elseif (ROUTE_A == 'edit') { ?>
    <div class="content">
        <div class="formbody">
            <div class="formtitle">
                <span>基本信息</span>
            </div>
            <script type="text/javascript">
                <!--
                $(function () {
                    $.formValidator.initConfig({
                        formid: "myform", autotip: true, onerror: function (msg, obj) {
                            window.top.art.dialog({content: msg, lock: true, width: '200', height: '50'}, function () {
                                this.close();
                                $(obj).focus();
                            })
                        }
                    });
                    $("#language").formValidator({
                        onshow: "<?php echo L("input") . L('chinese_name')?>",
                        onfocus: "<?php echo L("input") . L('chinese_name')?>",
                        oncorrect: "<?php echo L('input_right');?>"
                    }).inputValidator({min: 1, onerror: "<?php echo L("input") . L('chinese_name')?>"});
                    $("#name").formValidator({
                        onshow: "<?php echo L("input") . L('menu_name')?>",
                        onfocus: "<?php echo L("input") . L('menu_name')?>",
                        oncorrect: "<?php echo L('input_right');?>"
                    }).inputValidator({min: 1, onerror: "<?php echo L("input") . L('menu_name')?>"});
                    $("#m").formValidator({
                        onshow: "<?php echo L("input") . L('module_name')?>",
                        onfocus: "<?php echo L("input") . L('module_name')?>",
                        oncorrect: "<?php echo L('input_right');?>"
                    }).inputValidator({min: 1, onerror: "<?php echo L("input") . L('module_name')?>"});
                    $("#c").formValidator({
                        onshow: "<?php echo L("input") . L('file_name')?>",
                        onfocus: "<?php echo L("input") . L('file_name')?>",
                        oncorrect: "<?php echo L('input_right');?>"
                    }).inputValidator({min: 1, onerror: "<?php echo L("input") . L('file_name')?>"});
                    $("#a").formValidator({
                        tipid: 'a_tip',
                        onshow: "<?php echo L("input") . L('action_name')?>",
                        onfocus: "<?php echo L("input") . L('action_name')?>",
                        oncorrect: "<?php echo L('input_right');?>"
                    }).inputValidator({min: 1, onerror: "<?php echo L("input") . L('action_name')?>"});
                })
                //-->
            </script>
            <div class="common-form">
                <form name="myform" id="myform" action="?c=menu&a=edit" method="post">
                    <?php echo csrf_field() ?>
                    <table width="100%" class="table_form contentWrap">
                        <tr>
                            <th width="150"><?php echo L('menu_parentid') ?>：</th>
                            <td>
                                <select name="info[parentid]" class="dfinput">
                                    <option value="0"><?php echo L('no_parent_menu') ?></option>
                                    <?php echo $select_categorys; ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th> <?php echo L('for_chinese_lan') ?>：</th>
                            <td><input type="text" name="language" id="language" class="input-text"
                                       value="<?php echo L($name, '', '', 1) ?>"></td>
                        </tr>
                        <tr>
                            <th><?php echo L('menu_name') ?>：</th>
                            <td><input type="text" name="info[name]" id="name" class="input-text" value="<?php echo $name ?>">
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo L('module_name') ?>：</th>
                            <td><input type="text" name="info[m]" id="m" class="input-text" value="<?php echo $m ?>"></td>
                        </tr>
                        <tr>
                            <th><?php echo L('file_name') ?>：</th>
                            <td><input type="text" name="info[c]" id="c" class="input-text" value="<?php echo $c ?>"></td>
                        </tr>
                        <tr>
                            <th><?php echo L('action_name') ?>：</th>
                            <td><input type="text" name="info[a]" id="a" class="input-text" value="<?php echo $a ?>"></td>
                        </tr>
                        <tr>
                            <th><?php echo L('att_data') ?>：</th>
                            <td><input type="text" name="info[data]" class="input-text" value="<?php echo $data ?>"></td>
                        </tr>
                        <tr>
                            <th><?php echo L('menu_display') ?>：</th>
                            <td>
                                <input type="radio" name="info[display]" value="1" <?php if ($display) echo 'checked'; ?>> <?php echo L('yes') ?>&nbsp;&nbsp;
                                <input type="radio" name="info[display]" value="0" <?php if (!$display) echo 'checked'; ?>> <?php echo L('no') ?>
                            </td>
                        </tr>
                        <tr style="display: none">
                            <th><?php echo L('show_in_model') ?>：</th>
                            <td>
                                <?php foreach ($models as $_k => $_m) { ?>
                                    <input type="checkbox" name="info[<?php echo $_k ?>]" value="1"<?php if (${$_k}) { ?> checked<?php } ?>>
                                    <?php echo $_m ?>
                                <?php } ?>
                            </td>
                        </tr>

                    </table>
                    <!--table_form_off-->
            </div>
            <div class="bk15"></div>
            <input name="id" type="hidden" value="<?php echo $id ?>">
            <input type="submit" id="dosubmit" class="btn" name="dosubmit" value="<?php echo L('submit') ?>"/>
        </div>
    </div>
    </div>
    </form>
<?php } ?>
</body>
</html>