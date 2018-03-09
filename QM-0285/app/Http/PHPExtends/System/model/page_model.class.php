<?php
use \App\Http\PHPExtends\System\extendLoad;

extendLoad::load_sys_class('model', '', 0);

class page_model extends model
{
    public $table_name = '';

    public function __construct()
    {
        $this->db_config = extendLoad::load_config('database');
        $this->db_setting = 'default';
        $this->table_name = 'page';
        parent::__construct();
    }

    public function create_html($catid)
    {
        $this->html = extendLoad::load_app_class('html', 'content');
        $this->html->category($catid, 1);
    }
}