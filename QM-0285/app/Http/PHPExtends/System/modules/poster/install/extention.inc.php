<?php
defined('INSTALL') or exit('Access Denied');

$parentid = $menu_db->insert(array('name'=>'poster', 'parentid'=>29, 'm'=>'poster', 'c'=>'space', 'a'=>'init', 'data'=>'', 'listorder'=>0, 'display'=>'1'), true);
$menu_db->insert(array('name'=>'add_space', 'parentid'=>$parentid, 'm'=>'poster', 'c'=>'space', 'a'=>'add', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'edit_space', 'parentid'=>$parentid, 'm'=>'poster', 'c'=>'space', 'a'=>'edit', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'del_space', 'parentid'=>$parentid, 'm'=>'poster', 'c'=>'space', 'a'=>'delete', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'poster_list', 'parentid'=>$parentid, 'm'=>'poster', 'c'=>'poster', 'a'=>'init', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'add_poster', 'parentid'=>$parentid, 'm'=>'poster', 'c'=>'poster', 'a'=>'add', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'edit_poster', 'parentid'=>$parentid, 'm'=>'poster', 'c'=>'poster', 'a'=>'edit', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'del_poster', 'parentid'=>$parentid, 'm'=>'poster', 'c'=>'poster', 'a'=>'delete', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'poster_stat', 'parentid'=>$parentid, 'm'=>'poster', 'c'=>'poster', 'a'=>'stat', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'poster_setting', 'parentid'=>$parentid, 'm'=>'poster', 'c'=>'space', 'a'=>'setting', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'create_poster_js', 'parentid'=>$parentid, 'm'=>'poster', 'c'=>'space', 'a'=>'create_js', 'data'=>'', 'listorder'=>0, 'display'=>'1'));
$menu_db->insert(array('name'=>'poster_template', 'parentid'=>$parentid, 'm'=>'poster', 'c'=>'space', 'a'=>'poster_template', 'data'=>'', 'listorder'=>0, 'display'=>'1'));
$language = array('poster'=>'广告', 'add_space'=>'添加版位', 'edit_space'=>'编辑版位', 'del_space'=>'删除版位', 'poster_list'=>'广告列表', 'add_poster'=>'添加广告', 'edit_poster'=>'编辑广告', 'del_poster'=>'删除广告', 'poster_stat'=>'广告统计', 'poster_setting'=>'模块配置', 'create_poster_js'=>'重新生成js', 'poster_template'=>'广告模板设置');