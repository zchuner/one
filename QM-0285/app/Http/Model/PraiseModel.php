<?php
/**
 * 文档点赞模型
 * Created by PhpStorm.
 * User: Rouyi
 * Date: 2017/12/26
 * Time: 12:20
 * Email: 383442255@qq.com
 * WebSite: http://qimaweb.com
 */

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class PraiseModel extends Model
{
    protected $table = 'praise';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = [];
}