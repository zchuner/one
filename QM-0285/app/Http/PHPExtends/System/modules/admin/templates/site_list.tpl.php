<?php include $this->admin_tpl('header')?>
<div class="content">
    <div class="table-list">
        <table width="100%" cellspacing="0">
            <thead>
            <tr>
                <th width="80">Siteid</th>
                <th><?php echo L('site_name')?></th>
                <th><?php echo L('site_domain')?></th>
                <th width="150"><?php echo L('operations_manage')?></th>
            </tr>
            </thead>
            <tbody>
            <?php
            if(is_array($list)):
                foreach($list as $v):
                    ?>
                    <tr>
                        <td width="80" align="center"><?php echo $v['siteid']?></td>
                        <td align="center"><?php echo $v['name']?></td>
                        <td align="center"><?php echo $v['domain']?></td>
                        <td align="center">
                            <a href="?c=site&a=edit&siteid=<?php echo $v['siteid']?>"><?php echo L('edit')?></a>
                        </td>
                    </tr>
                    <?php
                endforeach;
            endif;
            ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>