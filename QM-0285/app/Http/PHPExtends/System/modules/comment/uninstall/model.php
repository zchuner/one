<?php
use \App\Http\PHPExtends\System\extendLoad;

defined('UNINSTALL') or exit('Access Denied');
$comment_table_db = extendLoad::load_model('comment_table_model');
$tablelist = $comment_table_db->select('', 'tableid');
foreach ($tablelist as $k => $v) {
    $comment_table_db->query("DROP TABLE IF EXISTS `" . $comment_table_db->db_tablepre . "comment_data_" . $v['tableid'] . "`;");
}
return array('comment', 'comment_check', 'comment_setting', 'comment_table');