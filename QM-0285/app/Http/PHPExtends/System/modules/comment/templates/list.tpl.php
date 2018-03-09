<?php
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header', 'admin');
?>

<div class="pad-lr-10">
    <form name="myform" id="myform" action="" method="get" >
        <input type="hidden" value="comment" name="m">
        <input type="hidden" value="comment_admin" name="c">
        <input type="hidden" value="del" name="a">
        <input type="hidden" value="<?php echo $tableid?>" name="tableid">
        <input type="hidden" value="1" name="dosubmit">
        <div class="table-list comment">
            <table width="100%">
                <thead>
                <tr>
                    <th width="330" align="left">用户</th>
                    <th align="left"><?php echo L('comment')?></th>
                </tr>
                </thead>
                <tbody class="add_comment">
                <?php
                if(is_array($items['comments'])) {
                    foreach($items['comments'] as $v) {
                        ?>
                        <tr id="tbody_<?php echo $v['id']?>">
                            <td>
                                <?php echo $v['passport']['nickname']?>
                                <br />
                                <?php echo $v['ip']?> (<?php echo $v['ip_location']?>)
                            </td>
                            <td>
                                <font color="#888888"><?php echo L('chez')?> <?php echo getChangeIntoTime('Y-m-d H:i:s', $v['create_time'])?> <?php echo L('release')?></font><br />
                                <?php echo $v['content']?>
                            </td>
                        </tr>
                    <?php }
                }
                ?>
                </tbody>
            </table>
            <div id="pages">
                <?php echo getCommentPage($items['cmt_sum'], $page_no) ?>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
    window.top.$('#display_center_id').css('display', 'none');
    function check(id, type, commentid) {
        if (type == -1 && !confirm('<?php echo L('are_you_sure_you_want_to_delete')?>')) {
            return false;
        }
        return true;
    }
    function show_tbl(obj) {
        var pdoname = $(obj).val();
        location.href = '?m=comment&c=comment_admin&a=listinfo&tableid=' + pdoname;
    }
    function confirm_delete() {
        if (confirm('<?php echo L('confirm_delete', array('message' => L('selected')));?>')) $('#myform').submit();
    }
</script>
</body>
</html>