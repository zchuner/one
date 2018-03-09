<?php
defined('UNINSTALL') or exit('Access Denied');
use \App\Http\PHPExtends\System\extendLoad;

$type_db = extendLoad::load_model('type_model');
$typeid = $type_db->delete(array('module' => 'link'));
if (!$typeid) return FALSE;