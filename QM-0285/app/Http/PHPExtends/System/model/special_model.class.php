<?php
use \App\Http\PHPExtends\System\extendLoad;

extendLoad::load_sys_class('model', '', 0);

class special_model extends model
{
    function __construct()
    {
        $this->db_config = extendLoad::load_config('database');
        $this->db_setting = 'default';
        $this->table_name = 'special';
        parent::__construct();
    }
}