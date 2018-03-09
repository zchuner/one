<?php
use \App\Http\PHPExtends\System\extendLoad;

/**
 * 检查管理员名称
 * @param array $data 管理员数据
 * @return array|bool
 */
function checkuserinfo($data)
{
    if (!is_array($data)) {
        message(L('parameters_error'), 'back', 'error');
        return false;
    } elseif (!is_username($data['username'])) {
        message(L('username_illegal'), 'back', 'error');
        return false;
    } elseif (empty($data['email']) || !is_email($data['email'])) {
        message(L('email_illegal'), 'back', 'error');
        return false;
    } elseif (empty($data['roleid'])) {
        return false;
    }
    return $data;
}

/**
 * 检查管理员密码合法性
 * @param string $password 密码
 * @return bool
 */
function checkpasswd($password)
{
    if (!is_password($password)) {
        return false;
    }
    return true;
}

function system_information($data)
{
    $update = extendLoad::load_sys_class('update');
    $notice_url = $update->notice();
    $string = base64_decode('PHNjcmlwdCB0eXBlPSJ0ZXh0L2phdmFzY3JpcHQiPiQoIiNtYWluX2ZyYW1laWQiKS5yZW1vdmVDbGFzcygiZGlzcGxheSIpOzwvc2NyaXB0PjxkaXYgaWQ9InBocGNtc19ub3RpY2UiPjwvZGl2PjxzY3JpcHQgdHlwZT0idGV4dC9qYXZhc2NyaXB0IiBzcmM9Ik5PVElDRV9VUkwiPjwvc2NyaXB0Pg==');
    echo $data . str_replace('NOTICE_URL', $notice_url, $string);
}