<?php
use \App\Http\PHPExtends\System\extendLoad;
include $this->admin_tpl('header');
?>
<div class="content">
    <div class="formbody">
        <div class="table-list">
            <form name="myform" action="?c=role&a=listorder" method="post">
                <table width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th width="10%"><?php echo L('userid')?></th>
                        <th width="10%" align="left" ><?php echo L('username')?></th>
                        <th width="10%" align="left" ><?php echo L('userinrole')?></th>
                        <th width="10%"  align="left" ><?php echo L('lastloginip')?></th>
                        <th width="20%"  align="left" ><?php echo L('lastlogintime')?></th>
                        <th width="15%"  align="left" ><?php echo L('email')?></th>
                        <th width="10%"><?php echo L('realname')?></th>
                        <th width="15%" ><?php echo L('operations_manage')?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $admin_founders = explode(',', extendLoad::load_config('system','admin_founders'));?>
                    <?php
                    if(is_array($infos)){
                        foreach($infos as $info){
                            ?>
                            <tr>
                                <td width="10%" align="center"><?php echo $info['userid']?></td>
                                <td width="10%" ><?php echo $info['username']?></td>
                                <td width="10%" ><?php echo $roles[$info['roleid']]?></td>
                                <td width="10%" ><?php echo $info['lastloginip']?></td>
                                <td width="20%"  ><?php echo $info['lastlogintime'] ? date('Y-m-d H:i:s',$info['lastlogintime']) : ''?></td>
                                <td width="15%"><?php echo $info['email']?></td>
                                <td width="10%"  align="center"><?php echo $info['realname']?></td>
                                <td width="15%"  align="center">
                                    <a href="?m=admin&c=admin_manage&a=edit&userid=<?php echo $info['userid']?>"><?php echo L('edit')?></a> |
                                    <?php if(!in_array($info['userid'],$admin_founders)) {?>
                                        <a href="javascript:confirmurl('?m=admin&c=admin_manage&a=delete&userid=<?php echo $info['userid']?>', '<?php echo L('admin_del_cofirm')?>')"><?php echo L('delete')?></a>
                                    <?php } else {?>
                                        <font color="#cccccc"><?php echo L('delete')?></font>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                    </tbody>
                </table>
                <div id="pages"> <?php echo $pages?></div>
            </form>
        </div>
    </div>
</div>

</body>
</html>