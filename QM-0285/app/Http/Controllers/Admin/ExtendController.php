<?php
/**
 * Created by PhpStorm.
 * User: Rouyi
 * Date: 2017/5/19
 * Time: 下午4:39
 */

namespace App\Http\Controllers\Admin;

use App\Http\PHPExtends\System\extendLoad;

class ExtendController extends extendLoad
{
    public function init()
    {
        extendLoad::creat_app();
    }
}