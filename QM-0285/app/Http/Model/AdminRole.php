<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class AdminRole extends Model
{
    protected $table = 'admin_role';
    protected $primaryKey = 'roleid';
    public $timestamps = false;
    protected $guarded = [];
}
