<?php
/**
 * Created by PhpStorm.
 * User: Rouyi
 * Date: 2017/8/8
 * Time: 18:58
 * Desc: 专题详情页模板
 */

$special = true;
$file_id = $rs['file_id'];
$author = $rs['author'];
$template = ($rs['file_id']) ? 'show_video' : 'show';
include getTemplate($template);