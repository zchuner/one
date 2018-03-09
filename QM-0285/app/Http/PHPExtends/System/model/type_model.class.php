<?php
use \App\Http\PHPExtends\System\extendLoad;

extendLoad::load_sys_class('model', '', 0);

class type_model extends model
{
    function __construct()
    {
        $this->db_config = extendLoad::load_config('database');
        $this->db_setting = 'default';
        $this->table_name = 'type';
        parent::__construct();
    }

    /**
     * 说明: 查询对应模块下的分类
     * @param int $siteid  站点ID
     * @return mixed
     */
    function get_types($siteid)
    {
        if (!ROUTE_M) return FALSE;
        return $this->select(array('module' => ROUTE_M, 'siteid' => $siteid), '*', '', $order = 'typeid ASC');
    }
}