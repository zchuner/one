<?php
use \App\Http\PHPExtends\System\extendLoad;

extendLoad::load_sys_class('model', '', 0);

class search_model extends model
{
    public $table_name = '';

    public function __construct()
    {
        $this->db_config = extendLoad::load_config('database');
        $this->db_setting = 'default';
        $this->table_name = 'search';
        parent::__construct();
    }

    /**
     * 添加到全站搜索、修改已有内容
     * @param $typeid
     * @param $id
     * @param $data
     * @param string $text 不分词的文本
     * @param int $adddate 添加时间
     * @param int $iscreateindex 是否是后台更新全文索引
     * @return mixed
     */
    public function update_search($typeid, $id = 0, $data = '', $text = '', $adddate = 0, $iscreateindex = 0)
    {
        $segment = extendLoad::load_sys_class('segment');
        //分词结果
        $fulltext_data = $segment->get_keyword($segment->split_result($data));
        $fulltext_data = $text . ' ' . $fulltext_data;
        if (!$iscreateindex) {
            $r = $this->get_one(array('typeid' => $typeid, 'id' => $id), 'searchid');
        }

        if ($r) {
            $searchid = $r['searchid'];
            $this->update(array('data' => $fulltext_data, 'adddate' => $adddate), array('typeid' => $typeid, 'id' => $id));
        } else {
            $siteid = param::get_cookie('siteid');
            $searchid = $this->insert(array('typeid' => $typeid, 'id' => $id, 'adddate' => $adddate, 'data' => $fulltext_data, 'siteid' => $siteid), true);
        }
        return $searchid;
    }

    /**
     * 删除全站搜索内容
     * @param int $typeid
     * @param int $id
     */
    public function delete_search($typeid, $id)
    {
        $this->delete(array('typeid' => $typeid, 'id' => $id));
    }
}