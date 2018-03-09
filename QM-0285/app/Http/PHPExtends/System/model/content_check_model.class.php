<?php
use \App\Http\PHPExtends\System\extendLoad;

extendLoad::load_sys_class('model', '', 0);

class content_check_model extends model
{
    public function __construct()
    {
        $this->db_config = extendLoad::load_config('database');
        $this->db_setting = 'default';
        $this->table_name = 'content_check';
        parent::__construct();
    }
}