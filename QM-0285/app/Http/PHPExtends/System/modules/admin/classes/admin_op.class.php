<?php
use \App\Http\PHPExtends\System\extendLoad;

class admin_op
{
    public function __construct()
    {
        $this->db = extendLoad::load_model('admin_model');
    }

    /**
     * 修改密码
     * @param $userid
     * @param $password
     * @return bool
     */
    public function edit_password($userid, $password)
    {
        $userid = intval($userid);
        if($userid < 1) return false;
        if(!is_password($password)) {
            showmessage(L('pwd_incorrect'));
            return false;
        }
        $passwordinfo = password($password);
        return $this->db->update($passwordinfo, array('userid'=>$userid));
    }

    /**
     * 检查用户名重名
     * @param string $username
     * @return bool
     */
    public function checkname($username)
    {
        $username =  trim($username);
        if ($this->db->get_one(array('username'=>$username), 'userid')){
            return false;
        }
        return true;
    }
}