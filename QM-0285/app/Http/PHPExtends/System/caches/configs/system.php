<?php
return [
    'cookie_domain'             => '', //Cookie 作用域
    'cookie_path'               => '', //Cookie 作用路径
    'cookie_pre'                => 'gCWbU_', //Cookie 前缀，同一域名下安装多套系统时，请修改Cookie前缀
    'cookie_ttl'                => 0, //Cookie 生命周期，0 表示随浏览器进程
    'attachment_stat'           => '1',//是否记录附件使用状态 0 统计 1 统计， 注意: 本功能会加重服务器负担
    'admin_log'                 => 1, //是否记录后台操作日志
    'errorlog'                  => 1, //1、保存错误日志 | 0、在页面直接显示
    'auth_key'                  => 'E7tUpl9cI5DgmtG87H15', //密钥
    'lang'                      => 'zh-cn',  //网站语言包
    'lock_ex'                   => '1',  //写入缓存时是否建立文件互斥锁定（如果使用nfs建议关闭）
    'admin_founders'            => '1', //网站创始人ID，多个ID逗号分隔
    'execution_sql'             => 0, //EXECUTION_SQL
    'safe_card'                 => '0', //是否启用口令卡
    'tpl_root'                  => '', //模板路径
    'tpl_name'                  => 'default', //当前模板方案目录
    'tpl_css'                   => 'default', //当前样式目录
    'tpl_referesh'              => 1,
    'tpl_edit'                  => 0,//是否允许在线编辑模板
];