<?php
use \App\Http\PHPExtends\System\extendLoad;

extendLoad::load_sys_class('model', '', 0);

class attachment_index_model extends model
{
    public function __construct()
    {
        $this->db_config = extendLoad::load_config('database');
        $this->db_setting = 'default';
        $this->table_name = 'attachment_index';
        parent::__construct();
    }
}