<?php
$show_validator = true;
include $this->admin_tpl('header');
?>
<script type="text/javascript">
    $(document).ready(function() {
        $.formValidator.initConfig({autotip:true,formid:"myform",onerror:function(msg){}});
        $("#password").formValidator({empty:true,onshow:"<?php echo L('not_change_the_password_please_leave_a_blank')?>",onfocus:"<?php echo L('password').L('between_6_to_20')?>"}).inputValidator({min:6,max:20,onerror:"<?php echo L('password').L('between_6_to_20')?>"});
        $("#pwdconfirm").formValidator({empty:true,onshow:"<?php echo L('not_change_the_password_please_leave_a_blank')?>",onfocus:"<?php echo L('input').L('passwords_not_match')?>",oncorrect:"<?php echo L('passwords_match')?>"}).compareValidator({desid:"password",operateor:"=",onerror:"<?php echo L('input').L('passwords_not_match')?>"});
        $("#email").formValidator({onshow:"<?php echo L('input').L('email')?>",onfocus:"<?php echo L('email').L('format_incorrect')?>",oncorrect:"<?php echo L('email').L('format_right')?>"}).regexValidator({regexp:"email",datatype:"enum",onerror:"<?php echo L('email').L('format_incorrect')?>"});
    })
</script>

<div class="content">
    <div class="formbody">
        <form name="myform" action="?a=edit" method="post" id="myform">
            <?php echo csrf_field()?>
            <input type="hidden" name="info[userid]" value="<?php echo $userid?>" />
            <input type="hidden" name="info[username]" value="<?php echo $username?>" />
            <table width="100%" class="table_form contentWrap">
                <tr>
                    <td width="80"><?php echo L('username')?></td>
                    <td><?php echo $username?></td>
                </tr>
                <tr>
                    <td><?php echo L('password')?></td>
                    <td><input type="password" name="info[password]" id="password" class="dfinput" /></td>
                </tr>
                <tr>
                    <td><?php echo L('cofirmpwd')?></td>
                    <td><input type="password" name="info[pwdconfirm]" id="pwdconfirm" class="dfinput" /></td>
                </tr>
                <tr>
                    <td><?php echo L('email')?></td>
                    <td>
                        <input type="text" name="info[email]" value="<?php echo $email?>" class="dfinput" id="email" size="30" />
                    </td>
                </tr>

                <tr>
                    <td><?php echo L('realname')?></td>
                    <td>
                        <input type="text" name="info[realname]" value="<?php echo $realname?>" class="dfinput" id="realname" />
                    </td>
                </tr>
                <?php if (session('admin')['roleid'] == 1) {?>
                    <tr>
                        <td><?php echo L('userinrole')?></td>
                        <td>
                            <select name="info[roleid]" class="dfinput">
                                <?php
                                foreach($roles as $role)
                                {
                                    ?>
                                    <option value="<?php echo $role['roleid']?>" <?php echo (($role['roleid'] == $roleid) ? 'selected' : '')?>><?php echo $role['rolename']?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                <?php }?>
            </table>
            <div class="bk15"></div>
            <input type="hidden" name="info[admin_manage_code]" value="<?php echo $admin_manage_code?>" id="admin_manage_code" />
            <input name="dosubmit" id="dosubmit" type="submit" class="btn" value="<?php echo L('submit')?>" />
        </form>
    </div>
</div>

</body>
</html>
