-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2017 �?12 �?26 �?14:21
-- 服务器版本: 5.5.53
-- PHP 版本: 5.6.27

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `demo_0285`
--

-- --------------------------------------------------------

--
-- 表的结构 `qm_admin`
--

CREATE TABLE IF NOT EXISTS `qm_admin` (
  `userid` mediumint(6) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `roleid` smallint(5) DEFAULT '0',
  `encrypt` varchar(6) DEFAULT NULL,
  `lastloginip` varchar(15) DEFAULT NULL,
  `lastlogintime` int(10) unsigned DEFAULT '0',
  `email` varchar(40) DEFAULT NULL,
  `realname` varchar(50) NOT NULL DEFAULT '',
  `card` varchar(255) NOT NULL,
  `lang` varchar(6) NOT NULL,
  `login_time` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`userid`),
  KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `qm_admin`
--

INSERT INTO `qm_admin` (`userid`, `username`, `password`, `roleid`, `encrypt`, `lastloginip`, `lastlogintime`, `email`, `realname`, `card`, `lang`, `login_time`) VALUES
(1, 'qimaweb', '4d42e6a8b41a15c4c124ebcb44808c97', 1, 'apahKl', '127.0.0.1', 1513320944, '1004854091@qq.com', '张海波', '', 'zh-cn', 1514257977),
(2, 'zhangchunli', '08a1ec5617575afc7a5a34cf022a79d4', 1, 'Fzs1z6', '192.168.1.194', 1499393046, '1091286929@qq.com', '张春丽', '', '', 1499394417);

-- --------------------------------------------------------

--
-- 表的结构 `qm_admin_role`
--

CREATE TABLE IF NOT EXISTS `qm_admin_role` (
  `roleid` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `rolename` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `listorder` smallint(5) unsigned NOT NULL DEFAULT '0',
  `disabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`roleid`),
  KEY `listorder` (`listorder`),
  KEY `disabled` (`disabled`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `qm_admin_role`
--

INSERT INTO `qm_admin_role` (`roleid`, `rolename`, `description`, `listorder`, `disabled`) VALUES
(1, '超级管理员', '超级管理员', 0, 0),
(2, '站点管理员', '站点管理员', 0, 0),
(3, '运营总监', '运营总监', 1, 0),
(4, '总编', '总编', 5, 0),
(5, '编辑', '编辑', 1, 0),
(7, '发布人员', '发布人员', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `qm_admin_role_priv`
--

CREATE TABLE IF NOT EXISTS `qm_admin_role_priv` (
  `roleid` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `m` char(20) NOT NULL,
  `c` char(20) NOT NULL,
  `a` char(20) NOT NULL,
  `data` char(30) NOT NULL DEFAULT '',
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0',
  KEY `roleid` (`roleid`,`m`,`c`,`a`,`siteid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `qm_admin_role_priv`
--

INSERT INTO `qm_admin_role_priv` (`roleid`, `m`, `c`, `a`, `data`, `siteid`) VALUES
(5, 'poster', 'space', 'init', '', 1),
(5, 'admin', 'module', '', '', 1),
(5, 'admin', 'module', 'init', '', 1),
(5, 'poster', 'poster', 'delete', '', 1),
(2, 'admin', 'copyfrom', 'init', '', 1),
(2, 'admin', 'cache_all', 'init', '', 1),
(2, 'admin', 'log', 'delete', '', 1),
(2, 'admin', 'log', 'init', '', 1),
(2, 'admin', 'database', 'import', '', 1),
(2, 'admin', 'database', 'export', '', 1),
(2, 'admin', 'database', 'export', '', 1),
(2, 'content', 'workflow', 'delete', '', 1),
(2, 'content', 'workflow', 'edit', '', 1),
(2, 'content', 'workflow', 'add', '', 1),
(2, 'content', 'workflow', 'init', '', 1),
(2, 'admin', 'menu', 'delete', '', 1),
(2, 'admin', 'menu', 'edit', '', 1),
(2, 'admin', 'menu', 'add', '', 1),
(2, 'admin', 'menu', 'init', '', 1),
(2, 'admin', 'extend_all', 'init', '', 1),
(2, 'admin', 'extend', 'init_extend', '', 1),
(2, 'admin', 'admin_manage', 'public_edit_info', '', 1),
(2, 'admin', 'admin_manage', 'public_edit_pwd', '', 1),
(2, 'admin', 'admin_manage', 'init', '', 1),
(2, 'admin', 'index', 'public_main', '', 1),
(2, 'content', 'type_manage', 'edit', '', 1),
(2, 'content', 'type_manage', 'delete', '', 1),
(2, 'content', 'type_manage', 'add', '', 1),
(2, 'content', 'type_manage', 'init', '', 1),
(2, 'content', 'sitemodel', 'export', '', 1),
(2, 'content', 'sitemodel', 'delete', '', 1),
(2, 'content', 'sitemodel', 'disabled', '', 1),
(2, 'content', 'sitemodel', 'edit', '', 1),
(2, 'content', 'sitemodel_field', 'init', '', 1),
(2, 'content', 'sitemodel', 'add', '', 1),
(2, 'content', 'sitemodel', 'init', '', 1),
(2, 'admin', 'category', 'batch_edit', '', 1),
(2, 'admin', 'category', 'count_items', '', 1),
(2, 'admin', 'category', 'add', 's=2', 1),
(2, 'admin', 'category', 'add', 's=1', 1),
(2, 'admin', 'category', 'public_cache', 'module=admin', 1),
(2, 'admin', 'category', 'edit', '', 1),
(2, 'admin', 'category', 'add', 's=0', 1),
(2, 'admin', 'category', 'init', 'module=admin', 1),
(2, 'admin', 'position', 'edit', '', 1),
(2, 'admin', 'position', 'add', '', 1),
(2, 'admin', 'position', 'init', '', 1),
(2, 'content', 'content_settings', 'init', '', 1),
(2, 'content', 'content', 'clear_data', '', 1),
(2, 'content', 'create_html', 'category', '', 1),
(2, 'content', 'create_html', 'update_urls', '', 1),
(2, 'content', 'create_html', 'show', '', 1),
(2, 'release', 'html', 'init', '', 1),
(2, 'special', 'special', 'import', '', 1),
(2, 'special', 'content', 'listorder', '', 1),
(2, 'special', 'content', 'delete', '', 1),
(2, 'special', 'content', 'edit', '', 1),
(2, 'special', 'content', 'init', '', 1),
(2, 'special', 'content', 'add', '', 1),
(2, 'special', 'content', 'init', '', 1),
(2, 'special', 'special', 'listorder', '', 1),
(2, 'special', 'special', 'delete', '', 1),
(2, 'special', 'special', 'elite', '', 1),
(2, 'special', 'special', 'init', '', 1),
(2, 'special', 'special', 'edit', '', 1),
(2, 'special', 'special', 'add', '', 1),
(2, 'special', 'special', 'init', '', 1),
(2, 'content', 'content', 'listorder', '', 1),
(2, 'content', 'content', 'delete', '', 1),
(2, 'content', 'content', 'add_othors', '', 1),
(2, 'content', 'content', 'remove', '', 1),
(2, 'content', 'push', 'init', '', 1),
(2, 'content', 'content', 'edit', '', 1),
(2, 'content', 'content', 'pass', '', 1),
(2, 'content', 'content', 'add', '', 1),
(2, 'content', 'content', 'init', '', 1),
(2, 'content', 'content', 'init', '', 1),
(2, 'content', 'content', 'init', '', 1),
(2, 'admin', 'module', 'init', '', 1),
(2, 'admin', 'module', '', '', 1),
(2, 'link', 'link', 'add_type', '', 1),
(2, 'link', 'link', 'add', '', 1),
(2, 'link', 'link', 'list_type', '', 1),
(2, 'link', 'link', 'setting', '', 1),
(2, 'link', 'link', 'delete', '', 1),
(2, 'link', 'link', 'check_register', '', 1),
(2, 'link', 'link', 'edit', '', 1),
(2, 'link', 'link', 'init', '', 1),
(2, 'poster', 'space', 'create_js', '', 1),
(2, 'poster', 'poster', 'edit', '', 1),
(2, 'poster', 'poster', 'add', '', 1),
(2, 'poster', 'space', 'poster_template', '', 1),
(2, 'poster', 'space', 'edit', '', 1),
(2, 'poster', 'space', 'setting', '', 1),
(2, 'poster', 'poster', 'init', '', 1),
(2, 'poster', 'space', 'add', '', 1),
(2, 'poster', 'poster', 'stat', '', 1),
(2, 'poster', 'space', 'delete', '', 1),
(2, 'poster', 'poster', 'delete', '', 1),
(2, 'poster', 'space', 'init', '', 1),
(2, 'admin', 'module', '', '', 1),
(2, 'admin', 'module', 'init', '', 1),
(2, 'admin', 'role', 'delete', '', 1),
(2, 'admin', 'role', 'member_manage', '', 1),
(2, 'admin', 'role', 'edit', '', 1),
(2, 'admin', 'role', 'role_priv', '', 1),
(2, 'admin', 'role', 'priv_setting', '', 1),
(2, 'admin', 'role', 'add', '', 1),
(2, 'admin', 'role', 'init', '', 1),
(2, 'admin', 'admin_manage', 'delete', '', 1),
(2, 'admin', 'admin_manage', 'edit', '', 1),
(2, 'admin', 'admin_manage', 'add', '', 1),
(2, 'admin', 'admin_manage', 'init', '', 1),
(2, 'admin', '', '', '', 1),
(2, 'admin', 'site', 'edit', '', 1),
(2, 'admin', 'site', 'init', '', 1),
(2, 'admin', 'admin', 'admin', '', 1),
(2, 'admin', 'setting', 'init', '', 1),
(7, 'link', 'link', 'add', '', 1),
(7, 'link', 'link', 'list_type', '', 1),
(7, 'link', 'link', 'setting', '', 1),
(7, 'content', 'content', 'init', '', 1),
(7, 'link', 'link', 'check_register', '', 1),
(7, 'link', 'link', 'add_type', '', 1),
(7, 'poster', 'space', 'poster_template', '', 1),
(7, 'link', 'link', 'edit', '', 1),
(7, 'content', 'content', 'init', '', 1),
(7, 'admin', 'module', '', '', 1),
(7, 'link', 'link', 'delete', '', 1),
(7, 'admin', 'site', 'init', '', 1),
(7, 'admin', 'admin_manage', 'edit', '', 1),
(7, 'admin', 'admin_manage', 'init', '', 1),
(7, 'admin', 'admin', 'admin', '', 1),
(7, 'admin', '', '', '', 1),
(7, 'admin', 'admin_manage', 'add', '', 1),
(7, 'admin', 'setting', 'init', '', 1),
(7, 'admin', 'role', 'add', '', 1),
(7, 'admin', 'role', 'edit', '', 1),
(7, 'admin', 'role', 'init', '', 1),
(7, 'admin', 'role', 'priv_setting', '', 1),
(7, 'admin', 'role', 'role_priv', '', 1),
(7, 'admin', 'admin_manage', 'delete', '', 1),
(7, 'admin', 'site', 'edit', '', 1),
(7, 'admin', 'role', 'member_manage', '', 1),
(7, 'poster', 'poster', 'edit', '', 1),
(7, 'poster', 'poster', 'add', '', 1),
(7, 'poster', 'space', 'create_js', '', 1),
(7, 'admin', 'module', 'init', '', 1),
(7, 'link', 'link', 'init', '', 1),
(7, 'content', 'content', 'init', '', 1),
(7, 'content', 'content', 'pass', '', 1),
(7, 'content', 'content', 'add', '', 1),
(7, 'content', 'push', 'init', '', 1),
(7, 'special', 'special', 'add', '', 1),
(7, 'content', 'content', 'remove', '', 1),
(7, 'content', 'content', 'edit', '', 1),
(7, 'special', 'special', 'init', '', 1),
(7, 'content', 'content', 'listorder', '', 1),
(7, 'content', 'content', 'add_othors', '', 1),
(7, 'content', 'content', 'delete', '', 1),
(7, 'poster', 'space', 'delete', '', 1),
(7, 'poster', 'space', 'edit', '', 1),
(7, 'poster', 'poster', 'delete', '', 1),
(7, 'poster', 'space', 'add', '', 1),
(7, 'poster', 'poster', 'init', '', 1),
(7, 'poster', 'space', 'setting', '', 1),
(7, 'poster', 'poster', 'stat', '', 1),
(7, 'admin', 'role', 'delete', '', 1),
(7, 'poster', 'space', 'init', '', 1),
(7, 'admin', 'module', '', '', 1),
(7, 'admin', 'module', 'init', '', 1),
(4, 'admin', 'admin_manage', 'public_edit_info', '', 1),
(4, 'admin', 'admin_manage', 'public_edit_pwd', '', 1),
(4, 'admin', 'admin_manage', 'init', '', 1),
(4, 'admin', 'index', 'public_main', '', 1),
(4, 'content', 'type_manage', 'edit', '', 1),
(4, 'content', 'type_manage', 'delete', '', 1),
(4, 'content', 'type_manage', 'add', '', 1),
(4, 'content', 'type_manage', 'init', '', 1),
(4, 'content', 'sitemodel', 'export', '', 1),
(4, 'content', 'sitemodel', 'delete', '', 1),
(4, 'content', 'sitemodel', 'disabled', '', 1),
(4, 'content', 'sitemodel', 'edit', '', 1),
(4, 'content', 'sitemodel_field', 'init', '', 1),
(4, 'content', 'sitemodel', 'add', '', 1),
(4, 'content', 'sitemodel', 'init', '', 1),
(4, 'admin', 'category', 'batch_edit', '', 1),
(4, 'admin', 'category', 'count_items', '', 1),
(4, 'admin', 'category', 'add', 's=2', 1),
(4, 'admin', 'category', 'add', 's=1', 1),
(4, 'admin', 'category', 'public_cache', 'module=admin', 1),
(4, 'admin', 'category', 'edit', '', 1),
(4, 'admin', 'category', 'add', 's=0', 1),
(4, 'admin', 'category', 'init', 'module=admin', 1),
(4, 'admin', 'position', 'edit', '', 1),
(4, 'admin', 'position', 'add', '', 1),
(4, 'admin', 'position', 'init', '', 1),
(4, 'content', 'content_settings', 'init', '', 1),
(4, 'content', 'content', 'clear_data', '', 1),
(4, 'content', 'create_html', 'category', '', 1),
(4, 'content', 'create_html', 'update_urls', '', 1),
(4, 'content', 'create_html', 'show', '', 1),
(4, 'release', 'html', 'init', '', 1),
(4, 'special', 'special', 'import', '', 1),
(4, 'special', 'content', 'listorder', '', 1),
(4, 'special', 'content', 'delete', '', 1),
(4, 'special', 'content', 'edit', '', 1),
(4, 'special', 'content', 'init', '', 1),
(4, 'special', 'content', 'add', '', 1),
(4, 'special', 'content', 'init', '', 1),
(4, 'special', 'special', 'listorder', '', 1),
(4, 'special', 'special', 'delete', '', 1),
(4, 'special', 'special', 'elite', '', 1),
(4, 'special', 'special', 'init', '', 1),
(4, 'special', 'special', 'edit', '', 1),
(4, 'special', 'special', 'add', '', 1),
(4, 'special', 'special', 'init', '', 1),
(4, 'content', 'content', 'listorder', '', 1),
(4, 'content', 'content', 'delete', '', 1),
(4, 'content', 'content', 'add_othors', '', 1),
(4, 'content', 'content', 'remove', '', 1),
(4, 'content', 'push', 'init', '', 1),
(4, 'content', 'content', 'edit', '', 1),
(4, 'content', 'content', 'pass', '', 1),
(4, 'content', 'content', 'add', '', 1),
(4, 'content', 'content', 'init', '', 1),
(4, 'content', 'content', 'init', '', 1),
(4, 'content', 'content', 'init', '', 1),
(4, 'admin', 'module', 'init', '', 1),
(4, 'admin', 'module', '', '', 1),
(4, 'link', 'link', 'add_type', '', 1),
(4, 'link', 'link', 'add', '', 1),
(4, 'link', 'link', 'list_type', '', 1),
(4, 'link', 'link', 'setting', '', 1),
(4, 'link', 'link', 'delete', '', 1),
(4, 'link', 'link', 'check_register', '', 1),
(4, 'link', 'link', 'edit', '', 1),
(4, 'link', 'link', 'init', '', 1),
(4, 'poster', 'space', 'create_js', '', 1),
(4, 'poster', 'poster', 'edit', '', 1),
(4, 'poster', 'poster', 'add', '', 1),
(4, 'poster', 'space', 'poster_template', '', 1),
(4, 'poster', 'space', 'edit', '', 1),
(4, 'poster', 'space', 'setting', '', 1),
(4, 'poster', 'poster', 'init', '', 1),
(4, 'poster', 'space', 'add', '', 1),
(4, 'poster', 'poster', 'stat', '', 1),
(4, 'poster', 'space', 'delete', '', 1),
(5, 'poster', 'space', 'delete', '', 1),
(5, 'poster', 'poster', 'stat', '', 1),
(5, 'poster', 'space', 'add', '', 1),
(5, 'poster', 'poster', 'init', '', 1),
(5, 'poster', 'space', 'setting', '', 1),
(5, 'poster', 'space', 'edit', '', 1),
(5, 'poster', 'space', 'poster_template', '', 1),
(5, 'poster', 'poster', 'add', '', 1),
(5, 'poster', 'poster', 'edit', '', 1),
(5, 'poster', 'space', 'create_js', '', 1),
(5, 'link', 'link', 'init', '', 1),
(5, 'link', 'link', 'edit', '', 1),
(5, 'link', 'link', 'check_register', '', 1),
(5, 'link', 'link', 'delete', '', 1),
(5, 'link', 'link', 'setting', '', 1),
(5, 'link', 'link', 'list_type', '', 1),
(5, 'link', 'link', 'add', '', 1),
(5, 'link', 'link', 'add_type', '', 1),
(5, 'admin', 'module', '', '', 1),
(5, 'admin', 'module', 'init', '', 1),
(5, 'content', 'content', 'init', '', 1),
(5, 'content', 'content', 'init', '', 1),
(5, 'content', 'content', 'init', '', 1),
(5, 'content', 'content', 'add', '', 1),
(5, 'admin', 'index', 'public_main', '', 1),
(5, 'admin', 'admin_manage', 'init', '', 1),
(5, 'admin', 'admin_manage', 'public_edit_pwd', '', 1),
(5, 'admin', 'admin_manage', 'public_edit_info', '', 1),
(7, 'special', 'special', 'edit', '', 1),
(7, 'special', 'special', 'init', '', 1),
(7, 'special', 'special', 'elite', '', 1),
(7, 'special', 'special', 'delete', '', 1),
(7, 'special', 'special', 'listorder', '', 1),
(7, 'special', 'content', 'init', '', 1),
(7, 'special', 'content', 'add', '', 1),
(7, 'special', 'content', 'init', '', 1),
(7, 'special', 'content', 'edit', '', 1),
(7, 'special', 'content', 'delete', '', 1),
(7, 'special', 'content', 'listorder', '', 1),
(7, 'special', 'special', 'import', '', 1),
(7, 'release', 'html', 'init', '', 1),
(7, 'content', 'create_html', 'show', '', 1),
(7, 'content', 'create_html', 'update_urls', '', 1),
(7, 'content', 'create_html', 'category', '', 1),
(7, 'content', 'content', 'clear_data', '', 1),
(7, 'content', 'content_settings', 'init', '', 1),
(7, 'admin', 'position', 'init', '', 1),
(7, 'admin', 'position', 'add', '', 1),
(7, 'admin', 'position', 'edit', '', 1),
(7, 'admin', 'category', 'init', 'module=admin', 1),
(7, 'admin', 'category', 'add', 's=0', 1),
(7, 'admin', 'category', 'edit', '', 1),
(7, 'admin', 'category', 'public_cache', 'module=admin', 1),
(7, 'admin', 'category', 'add', 's=1', 1),
(7, 'admin', 'category', 'add', 's=2', 1),
(7, 'admin', 'category', 'count_items', '', 1),
(7, 'admin', 'category', 'batch_edit', '', 1),
(7, 'content', 'sitemodel', 'init', '', 1),
(7, 'content', 'sitemodel', 'add', '', 1),
(7, 'content', 'sitemodel_field', 'init', '', 1),
(7, 'content', 'sitemodel', 'edit', '', 1),
(7, 'content', 'sitemodel', 'disabled', '', 1),
(7, 'content', 'sitemodel', 'delete', '', 1),
(7, 'content', 'sitemodel', 'export', '', 1),
(7, 'content', 'type_manage', 'init', '', 1),
(7, 'content', 'type_manage', 'add', '', 1),
(7, 'content', 'type_manage', 'delete', '', 1),
(7, 'content', 'type_manage', 'edit', '', 1),
(7, 'admin', 'index', 'public_main', '', 1),
(7, 'admin', 'admin_manage', 'init', '', 1),
(7, 'admin', 'admin_manage', 'public_edit_pwd', '', 1),
(7, 'admin', 'admin_manage', 'public_edit_info', '', 1),
(8, 'content', 'content', 'init', '', 1),
(8, 'content', 'content', 'init', '', 1),
(8, 'content', 'content', 'init', '', 1),
(8, 'content', 'content', 'add', '', 1),
(4, 'poster', 'poster', 'delete', '', 1),
(4, 'poster', 'space', 'init', '', 1),
(4, 'admin', 'module', '', '', 1),
(4, 'admin', 'module', 'init', '', 1),
(4, 'admin', 'role', 'delete', '', 1),
(4, 'admin', 'role', 'member_manage', '', 1),
(4, 'admin', 'role', 'edit', '', 1),
(4, 'admin', 'role', 'role_priv', '', 1),
(4, 'admin', 'role', 'priv_setting', '', 1),
(4, 'admin', 'role', 'add', '', 1),
(4, 'admin', 'role', 'init', '', 1),
(4, 'admin', 'admin_manage', 'delete', '', 1),
(4, 'admin', 'admin_manage', 'edit', '', 1),
(4, 'admin', 'admin_manage', 'add', '', 1),
(4, 'admin', 'admin_manage', 'init', '', 1),
(4, 'admin', '', '', '', 1),
(4, 'admin', 'site', 'edit', '', 1),
(4, 'admin', 'site', 'init', '', 1),
(4, 'admin', 'admin', 'admin', '', 1),
(4, 'admin', 'setting', 'init', '', 1);

-- --------------------------------------------------------

--
-- 表的结构 `qm_attachment`
--

CREATE TABLE IF NOT EXISTS `qm_attachment` (
  `aid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `module` char(15) NOT NULL,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `filename` char(50) NOT NULL,
  `filepath` char(200) NOT NULL,
  `filesize` int(10) unsigned NOT NULL DEFAULT '0',
  `fileext` char(10) NOT NULL,
  `isimage` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `isthumb` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `downloads` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `userid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `uploadtime` int(10) unsigned NOT NULL DEFAULT '0',
  `uploadip` char(15) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `authcode` char(32) NOT NULL,
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`aid`),
  KEY `authcode` (`authcode`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=77 ;

--
-- 转存表中的数据 `qm_attachment`
--

INSERT INTO `qm_attachment` (`aid`, `module`, `catid`, `filename`, `filepath`, `filesize`, `fileext`, `isimage`, `isthumb`, `downloads`, `userid`, `uploadtime`, `uploadip`, `status`, `authcode`, `siteid`) VALUES
(75, 'content', 4, 'Koala.jpg', '2017/1008/20171008080947478.jpg', 780831, 'jpg', 1, 0, 0, 1, 1507464587, '127.0.0.1', 1, '060016f10c5093b71602dd15e9cbe839', 1),
(76, 'content', 3, 'Penguins.jpg', '2017/1009/20171009022503556.jpg', 777835, 'jpg', 1, 0, 0, 1, 1507530303, '127.0.0.1', 0, '6d44d4b42d5d6e884859bc4b9b1fbf93', 1);

-- --------------------------------------------------------

--
-- 表的结构 `qm_attachment_index`
--

CREATE TABLE IF NOT EXISTS `qm_attachment_index` (
  `keyid` char(30) NOT NULL,
  `aid` char(10) NOT NULL,
  KEY `keyid` (`keyid`),
  KEY `aid` (`aid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `qm_attachment_index`
--

INSERT INTO `qm_attachment_index` (`keyid`, `aid`) VALUES
('c-4-23', '75');

-- --------------------------------------------------------

--
-- 表的结构 `qm_block`
--

CREATE TABLE IF NOT EXISTS `qm_block` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `siteid` smallint(5) unsigned DEFAULT '0',
  `name` char(50) DEFAULT NULL,
  `pos` char(30) DEFAULT NULL,
  `type` tinyint(1) DEFAULT '0',
  `data` text,
  `template` text,
  PRIMARY KEY (`id`),
  KEY `pos` (`pos`),
  KEY `type` (`type`),
  KEY `siteid` (`siteid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `qm_block_history`
--

CREATE TABLE IF NOT EXISTS `qm_block_history` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `blockid` int(10) unsigned DEFAULT '0',
  `data` text,
  `creat_at` int(10) unsigned DEFAULT '0',
  `userid` mediumint(8) unsigned DEFAULT '0',
  `username` char(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `qm_block_priv`
--

CREATE TABLE IF NOT EXISTS `qm_block_priv` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `roleid` tinyint(3) unsigned DEFAULT '0',
  `siteid` smallint(5) unsigned DEFAULT '0',
  `blockid` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `blockid` (`blockid`),
  KEY `roleid` (`roleid`,`siteid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `qm_cache`
--

CREATE TABLE IF NOT EXISTS `qm_cache` (
  `filename` char(50) NOT NULL,
  `path` char(50) NOT NULL,
  `data` mediumtext NOT NULL,
  PRIMARY KEY (`filename`,`path`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `qm_cache`
--

INSERT INTO `qm_cache` (`filename`, `path`, `data`) VALUES
('mood_program.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  1 => \n  array (\n    1 => \n    array (\n      ''use'' => ''1'',\n      ''name'' => ''震惊'',\n      ''pic'' => ''mood/a1.gif'',\n    ),\n    2 => \n    array (\n      ''use'' => ''1'',\n      ''name'' => ''不解'',\n      ''pic'' => ''mood/a2.gif'',\n    ),\n    3 => \n    array (\n      ''use'' => ''1'',\n      ''name'' => ''愤怒'',\n      ''pic'' => ''mood/a3.gif'',\n    ),\n    4 => \n    array (\n      ''use'' => ''1'',\n      ''name'' => ''杯具'',\n      ''pic'' => ''mood/a4.gif'',\n    ),\n    5 => \n    array (\n      ''use'' => ''1'',\n      ''name'' => ''无聊'',\n      ''pic'' => ''mood/a5.gif'',\n    ),\n    6 => \n    array (\n      ''use'' => ''1'',\n      ''name'' => ''高兴'',\n      ''pic'' => ''mood/a6.gif'',\n    ),\n    7 => \n    array (\n      ''use'' => ''1'',\n      ''name'' => ''支持'',\n      ''pic'' => ''mood/a7.gif'',\n    ),\n    8 => \n    array (\n      ''use'' => ''1'',\n      ''name'' => ''超赞'',\n      ''pic'' => ''mood/a8.gif'',\n    ),\n    9 => \n    array (\n      ''use'' => NULL,\n      ''name'' => '''',\n      ''pic'' => '''',\n    ),\n    10 => \n    array (\n      ''use'' => NULL,\n      ''name'' => '''',\n      ''pic'' => '''',\n    ),\n  ),\n);\n?>'),
('category_content.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  1 => ''1'',\n  2 => ''1'',\n  3 => ''1'',\n  4 => ''1'',\n  5 => ''1'',\n  6 => ''1'',\n  7 => ''1'',\n  8 => ''1'',\n  9 => ''1'',\n  11 => ''1'',\n  12 => ''1'',\n  13 => ''1'',\n  14 => ''1'',\n  15 => ''1'',\n  16 => ''1'',\n  17 => ''1'',\n  18 => ''1'',\n);\n?>'),
('category_content_1.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  1 => \n  array (\n    ''catid'' => ''1'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''2'',\n    ''parentid'' => ''0'',\n    ''arrparentid'' => ''0'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''1'',\n    ''catname'' => ''环境要闻'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => '''',\n    ''catdir'' => ''huanjing'',\n    ''url'' => ''http://0285.qimaweb.com/category/1/1.html'',\n    ''items'' => ''0'',\n    ''hits'' => ''0'',\n    ''setting'' => ''{"create_to_html_root":"0","workflowid":"","ishtml":"0","content_ishtml":"0","template_list":"default","category_template":"category","list_template":"list","show_template":"show","meta_title":"","meta_keywords":"","meta_description":"","presentpoint":"1","defaultchargepoint":"0","paytype":"0","repeatchargedays":"1","category_ruleid":"4","show_ruleid":"3"}'',\n    ''listorder'' => ''1'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''0'',\n    ''letter'' => ''huanjingyaowen'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''0'',\n    ''content_ishtml'' => ''0'',\n    ''category_ruleid'' => ''4'',\n    ''show_ruleid'' => ''3'',\n    ''workflowid'' => '''',\n    ''isdomain'' => ''0'',\n  ),\n  2 => \n  array (\n    ''catid'' => ''2'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''3'',\n    ''parentid'' => ''0'',\n    ''arrparentid'' => ''0'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''2'',\n    ''catname'' => ''环保视觉'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => '''',\n    ''catdir'' => ''shijue'',\n    ''url'' => ''http://0285.qimaweb.com/category/2/1.html'',\n    ''items'' => ''0'',\n    ''hits'' => ''0'',\n    ''setting'' => ''{"create_to_html_root":"0","workflowid":"","ishtml":"0","content_ishtml":"0","template_list":"default","category_template":"category_video","list_template":"list_video","show_template":"show_video","meta_title":"","meta_keywords":"","meta_description":"","presentpoint":"1","defaultchargepoint":"0","paytype":"0","repeatchargedays":"1","category_ruleid":"4","show_ruleid":"3"}'',\n    ''listorder'' => ''2'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''0'',\n    ''letter'' => ''huanbaoshijue'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''0'',\n    ''content_ishtml'' => ''0'',\n    ''category_ruleid'' => ''4'',\n    ''show_ruleid'' => ''3'',\n    ''workflowid'' => '''',\n    ''isdomain'' => ''0'',\n  ),\n  3 => \n  array (\n    ''catid'' => ''3'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''7'',\n    ''parentid'' => ''0'',\n    ''arrparentid'' => ''0'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''3'',\n    ''catname'' => ''环保直播'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => '''',\n    ''catdir'' => ''zhibo'',\n    ''url'' => ''http://0285.qimaweb.com/category/3/1.html'',\n    ''items'' => ''1'',\n    ''hits'' => ''0'',\n    ''setting'' => ''{"create_to_html_root":"0","workflowid":"","ishtml":"0","content_ishtml":"0","template_list":"default","category_template":"category_video","list_template":"list_video","show_template":"show_video_direct","meta_title":"","meta_keywords":"","meta_description":"","presentpoint":"1","defaultchargepoint":"0","paytype":"0","repeatchargedays":"1","category_ruleid":"4","show_ruleid":"3"}'',\n    ''listorder'' => ''3'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''0'',\n    ''letter'' => ''huanbaozhibo'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''0'',\n    ''content_ishtml'' => ''0'',\n    ''category_ruleid'' => ''4'',\n    ''show_ruleid'' => ''3'',\n    ''workflowid'' => '''',\n    ''isdomain'' => ''0'',\n  ),\n  4 => \n  array (\n    ''catid'' => ''4'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''2'',\n    ''parentid'' => ''0'',\n    ''arrparentid'' => ''0'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''4'',\n    ''catname'' => ''环保城市'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => '''',\n    ''catdir'' => ''chengshi'',\n    ''url'' => ''http://0285.qimaweb.com/category/4/1.html'',\n    ''items'' => ''1'',\n    ''hits'' => ''0'',\n    ''setting'' => ''{"create_to_html_root":"0","workflowid":"","ishtml":"0","content_ishtml":"0","template_list":"default","category_template":"category","list_template":"list","show_template":"show","meta_title":"","meta_keywords":"","meta_description":"","presentpoint":"1","defaultchargepoint":"0","paytype":"0","repeatchargedays":"1","category_ruleid":"4","show_ruleid":"3"}'',\n    ''listorder'' => ''4'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''0'',\n    ''letter'' => ''huanbaochengshi'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''0'',\n    ''content_ishtml'' => ''0'',\n    ''category_ruleid'' => ''4'',\n    ''show_ruleid'' => ''3'',\n    ''workflowid'' => '''',\n    ''isdomain'' => ''0'',\n  ),\n  5 => \n  array (\n    ''catid'' => ''5'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''2'',\n    ''parentid'' => ''0'',\n    ''arrparentid'' => ''0'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''5'',\n    ''catname'' => ''环保企业'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => '''',\n    ''catdir'' => ''qiye'',\n    ''url'' => ''http://0285.qimaweb.com/category/5/1.html'',\n    ''items'' => ''0'',\n    ''hits'' => ''0'',\n    ''setting'' => ''{"create_to_html_root":"0","workflowid":"","ishtml":"0","content_ishtml":"0","template_list":"default","category_template":"category","list_template":"list","show_template":"show","meta_title":"","meta_keywords":"","meta_description":"","presentpoint":"1","defaultchargepoint":"0","paytype":"0","repeatchargedays":"1","category_ruleid":"4","show_ruleid":"3"}'',\n    ''listorder'' => ''5'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''0'',\n    ''letter'' => ''huanbaoqiye'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''0'',\n    ''content_ishtml'' => ''0'',\n    ''category_ruleid'' => ''4'',\n    ''show_ruleid'' => ''3'',\n    ''workflowid'' => '''',\n    ''isdomain'' => ''0'',\n  ),\n  6 => \n  array (\n    ''catid'' => ''6'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''2'',\n    ''parentid'' => ''0'',\n    ''arrparentid'' => ''0'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''6'',\n    ''catname'' => ''案例库'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => '''',\n    ''catdir'' => ''case'',\n    ''url'' => ''http://0285.qimaweb.com/category/6/1.html'',\n    ''items'' => ''0'',\n    ''hits'' => ''0'',\n    ''setting'' => ''{"create_to_html_root":"0","workflowid":"","ishtml":"0","content_ishtml":"0","template_list":"default","category_template":"category","list_template":"list","show_template":"show","meta_title":"","meta_keywords":"","meta_description":"","presentpoint":"1","defaultchargepoint":"0","paytype":"0","repeatchargedays":"1","category_ruleid":"4","show_ruleid":"3"}'',\n    ''listorder'' => ''6'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''0'',\n    ''letter'' => ''anliku'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''0'',\n    ''content_ishtml'' => ''0'',\n    ''category_ruleid'' => ''4'',\n    ''show_ruleid'' => ''3'',\n    ''workflowid'' => '''',\n    ''isdomain'' => ''0'',\n  ),\n  7 => \n  array (\n    ''catid'' => ''7'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''2'',\n    ''parentid'' => ''0'',\n    ''arrparentid'' => ''0'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''7'',\n    ''catname'' => ''高层动态'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => '''',\n    ''catdir'' => ''gaoceng'',\n    ''url'' => ''http://0285.qimaweb.com/category/7/1.html'',\n    ''items'' => ''0'',\n    ''hits'' => ''0'',\n    ''setting'' => ''{"create_to_html_root":"0","workflowid":"","ishtml":"0","content_ishtml":"0","template_list":"default","category_template":"category","list_template":"list","show_template":"show","meta_title":"","meta_keywords":"","meta_description":"","presentpoint":"1","defaultchargepoint":"0","paytype":"0","repeatchargedays":"1","category_ruleid":"4","show_ruleid":"3"}'',\n    ''listorder'' => ''7'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''0'',\n    ''letter'' => ''gaocengdongtai'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''0'',\n    ''content_ishtml'' => ''0'',\n    ''category_ruleid'' => ''4'',\n    ''show_ruleid'' => ''3'',\n    ''workflowid'' => '''',\n    ''isdomain'' => ''0'',\n  ),\n  8 => \n  array (\n    ''catid'' => ''8'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''2'',\n    ''parentid'' => ''0'',\n    ''arrparentid'' => ''0'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''8'',\n    ''catname'' => ''地方动态'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => '''',\n    ''catdir'' => ''difang'',\n    ''url'' => ''http://0285.qimaweb.com/category/8/1.html'',\n    ''items'' => ''0'',\n    ''hits'' => ''0'',\n    ''setting'' => ''{"create_to_html_root":"0","workflowid":"","ishtml":"0","content_ishtml":"0","template_list":"default","category_template":"category","list_template":"list","show_template":"show","meta_title":"","meta_keywords":"","meta_description":"","presentpoint":"1","defaultchargepoint":"0","paytype":"0","repeatchargedays":"1","category_ruleid":"4","show_ruleid":"3"}'',\n    ''listorder'' => ''8'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''0'',\n    ''letter'' => ''difangdongtai'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''0'',\n    ''content_ishtml'' => ''0'',\n    ''category_ruleid'' => ''4'',\n    ''show_ruleid'' => ''3'',\n    ''workflowid'' => '''',\n    ''isdomain'' => ''0'',\n  ),\n  9 => \n  array (\n    ''catid'' => ''9'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''2'',\n    ''parentid'' => ''0'',\n    ''arrparentid'' => ''0'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''9'',\n    ''catname'' => ''法治环保中华行'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => '''',\n    ''catdir'' => ''zhonghuaxing'',\n    ''url'' => ''http://0285.qimaweb.com/category/9/1.html'',\n    ''items'' => ''0'',\n    ''hits'' => ''0'',\n    ''setting'' => ''{"create_to_html_root":"0","workflowid":"","ishtml":"0","content_ishtml":"0","template_list":"default","category_template":"category","list_template":"list","show_template":"show","meta_title":"","meta_keywords":"","meta_description":"","presentpoint":"1","defaultchargepoint":"0","paytype":"0","repeatchargedays":"1","category_ruleid":"4","show_ruleid":"3"}'',\n    ''listorder'' => ''9'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''0'',\n    ''letter'' => ''fazhihuanbaozhonghuaxing'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''0'',\n    ''content_ishtml'' => ''0'',\n    ''category_ruleid'' => ''4'',\n    ''show_ruleid'' => ''3'',\n    ''workflowid'' => '''',\n    ''isdomain'' => ''0'',\n  ),\n  11 => \n  array (\n    ''catid'' => ''11'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''7'',\n    ''parentid'' => ''0'',\n    ''arrparentid'' => ''0'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''11'',\n    ''catname'' => ''直播预告'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => '''',\n    ''catdir'' => ''yugao'',\n    ''url'' => ''http://0285.qimaweb.com/category/11/1.html'',\n    ''items'' => ''0'',\n    ''hits'' => ''0'',\n    ''setting'' => ''{"create_to_html_root":"0","workflowid":"","ishtml":"0","content_ishtml":"0","template_list":"default","category_template":"category_video","list_template":"list_video","show_template":"show_video_direct","meta_title":"","meta_keywords":"","meta_description":"","presentpoint":"1","defaultchargepoint":"0","paytype":"0","repeatchargedays":"1","category_ruleid":"4","show_ruleid":"3"}'',\n    ''listorder'' => ''11'',\n    ''ismenu'' => ''0'',\n    ''sethtml'' => ''0'',\n    ''letter'' => ''zhiboyugao'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''0'',\n    ''content_ishtml'' => ''0'',\n    ''category_ruleid'' => ''4'',\n    ''show_ruleid'' => ''3'',\n    ''workflowid'' => '''',\n    ''isdomain'' => ''0'',\n  ),\n  12 => \n  array (\n    ''catid'' => ''12'',\n    ''siteid'' => ''1'',\n    ''type'' => ''1'',\n    ''modelid'' => ''0'',\n    ''parentid'' => ''0'',\n    ''arrparentid'' => ''0'',\n    ''child'' => ''1'',\n    ''arrchildid'' => ''12,13,14,15,16'',\n    ''catname'' => ''关于我们'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => '''',\n    ''catdir'' => ''about'',\n    ''url'' => ''http://0285.qimaweb.com/category/12/1.html'',\n    ''items'' => ''0'',\n    ''hits'' => ''0'',\n    ''setting'' => ''{"ishtml":"0","template_list":"","meta_title":"","meta_keywords":"","meta_description":"","category_ruleid":"4","show_ruleid":"","repeatchargedays":"1"}'',\n    ''listorder'' => ''12'',\n    ''ismenu'' => ''0'',\n    ''sethtml'' => ''0'',\n    ''letter'' => ''guanyuwomen'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => NULL,\n    ''ishtml'' => ''0'',\n    ''content_ishtml'' => NULL,\n    ''category_ruleid'' => ''4'',\n    ''show_ruleid'' => '''',\n    ''workflowid'' => NULL,\n    ''isdomain'' => ''0'',\n  ),\n  13 => \n  array (\n    ''catid'' => ''13'',\n    ''siteid'' => ''1'',\n    ''type'' => ''1'',\n    ''modelid'' => ''0'',\n    ''parentid'' => ''12'',\n    ''arrparentid'' => ''0,12'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''13'',\n    ''catname'' => ''市场合作'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''about/'',\n    ''catdir'' => ''house'',\n    ''url'' => ''http://0285.qimaweb.com/category/13/1.html'',\n    ''items'' => ''0'',\n    ''hits'' => ''0'',\n    ''setting'' => ''{"ishtml":"0","template_list":"default","page_template":"page","meta_title":"","meta_keywords":"","meta_description":"","category_ruleid":"4","show_ruleid":"","repeatchargedays":"1"}'',\n    ''listorder'' => ''13'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''0'',\n    ''letter'' => ''shichanghezuo'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => NULL,\n    ''ishtml'' => ''0'',\n    ''content_ishtml'' => NULL,\n    ''category_ruleid'' => ''4'',\n    ''show_ruleid'' => '''',\n    ''workflowid'' => NULL,\n    ''isdomain'' => ''0'',\n  ),\n  14 => \n  array (\n    ''catid'' => ''14'',\n    ''siteid'' => ''1'',\n    ''type'' => ''1'',\n    ''modelid'' => ''0'',\n    ''parentid'' => ''12'',\n    ''arrparentid'' => ''0,12'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''14'',\n    ''catname'' => ''招贤纳士'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''about/'',\n    ''catdir'' => ''jobs'',\n    ''url'' => ''http://0285.qimaweb.com/category/14/1.html'',\n    ''items'' => ''0'',\n    ''hits'' => ''0'',\n    ''setting'' => ''{"ishtml":"0","template_list":"default","page_template":"page","meta_title":"","meta_keywords":"","meta_description":"","category_ruleid":"4","show_ruleid":"","repeatchargedays":"1"}'',\n    ''listorder'' => ''14'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''0'',\n    ''letter'' => ''zhaoxiannashi'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => NULL,\n    ''ishtml'' => ''0'',\n    ''content_ishtml'' => NULL,\n    ''category_ruleid'' => ''4'',\n    ''show_ruleid'' => '''',\n    ''workflowid'' => NULL,\n    ''isdomain'' => ''0'',\n  ),\n  15 => \n  array (\n    ''catid'' => ''15'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''9'',\n    ''parentid'' => ''12'',\n    ''arrparentid'' => ''0,12'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''15'',\n    ''catname'' => ''人员查询'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''about/'',\n    ''catdir'' => ''personnel'',\n    ''url'' => ''http://0285.qimaweb.com/category/15/1.html'',\n    ''items'' => ''0'',\n    ''hits'' => ''0'',\n    ''setting'' => ''{"create_to_html_root":"0","workflowid":"","ishtml":"0","content_ishtml":"0","template_list":"default","category_template":"category","list_template":"list_reporter","show_template":"show_reporter","meta_title":"","meta_keywords":"","meta_description":"","presentpoint":"1","defaultchargepoint":"0","paytype":"0","repeatchargedays":"1","category_ruleid":"4","show_ruleid":"3"}'',\n    ''listorder'' => ''15'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''0'',\n    ''letter'' => ''renyuanchaxun'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''0'',\n    ''content_ishtml'' => ''0'',\n    ''category_ruleid'' => ''4'',\n    ''show_ruleid'' => ''3'',\n    ''workflowid'' => '''',\n    ''isdomain'' => ''0'',\n  ),\n  16 => \n  array (\n    ''catid'' => ''16'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''10'',\n    ''parentid'' => ''12'',\n    ''arrparentid'' => ''0,12'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''16'',\n    ''catname'' => ''合作单位'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''about/'',\n    ''catdir'' => ''cooperate'',\n    ''url'' => ''http://0285.qimaweb.com/category/16/1.html'',\n    ''items'' => ''0'',\n    ''hits'' => ''0'',\n    ''setting'' => ''{"create_to_html_root":"0","workflowid":"","ishtml":"0","content_ishtml":"0","template_list":"default","category_template":"category","list_template":"list_sponsor","show_template":"show","meta_title":"","meta_keywords":"","meta_description":"","presentpoint":"1","defaultchargepoint":"0","paytype":"0","repeatchargedays":"1","category_ruleid":"4","show_ruleid":"3"}'',\n    ''listorder'' => ''16'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''0'',\n    ''letter'' => ''hezuodanwei'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''0'',\n    ''content_ishtml'' => ''0'',\n    ''category_ruleid'' => ''4'',\n    ''show_ruleid'' => ''3'',\n    ''workflowid'' => '''',\n    ''isdomain'' => ''0'',\n  ),\n  17 => \n  array (\n    ''catid'' => ''17'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''3'',\n    ''parentid'' => ''0'',\n    ''arrparentid'' => ''0'',\n    ''child'' => ''1'',\n    ''arrchildid'' => ''17,18'',\n    ''catname'' => ''视频专题'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => '''',\n    ''catdir'' => ''zhuanti'',\n    ''url'' => ''http://0285.qimaweb.com/category/17/1.html'',\n    ''items'' => ''0'',\n    ''hits'' => ''0'',\n    ''setting'' => ''{"create_to_html_root":"0","workflowid":"","ishtml":"0","content_ishtml":"0","template_list":"default","category_template":"category_video_special","list_template":"list_video","show_template":"show_video","meta_title":"","meta_keywords":"","meta_description":"","presentpoint":"1","defaultchargepoint":"0","paytype":"0","repeatchargedays":"1","category_ruleid":"4","show_ruleid":"3"}'',\n    ''listorder'' => ''17'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''0'',\n    ''letter'' => ''shipinzhuanti'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''0'',\n    ''content_ishtml'' => ''0'',\n    ''category_ruleid'' => ''4'',\n    ''show_ruleid'' => ''3'',\n    ''workflowid'' => '''',\n    ''isdomain'' => ''0'',\n  ),\n  18 => \n  array (\n    ''catid'' => ''18'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''3'',\n    ''parentid'' => ''17'',\n    ''arrparentid'' => ''0,17'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''18'',\n    ''catname'' => ''专题子目录'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''zhuanti/'',\n    ''catdir'' => ''zimulu'',\n    ''url'' => ''http://0285.qimaweb.com/category/18/1.html'',\n    ''items'' => ''0'',\n    ''hits'' => ''0'',\n    ''setting'' => ''{"create_to_html_root":"0","workflowid":"","ishtml":"0","content_ishtml":"0","template_list":"default","category_template":"category_video_special","list_template":"list_video","show_template":"show_video","meta_title":"","meta_keywords":"","meta_description":"","presentpoint":"1","defaultchargepoint":"0","paytype":"0","repeatchargedays":"1","category_ruleid":"4","show_ruleid":"3"}'',\n    ''listorder'' => ''18'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''0'',\n    ''letter'' => ''zhuantizimulu'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''0'',\n    ''content_ishtml'' => ''0'',\n    ''category_ruleid'' => ''4'',\n    ''show_ruleid'' => ''3'',\n    ''workflowid'' => '''',\n    ''isdomain'' => ''0'',\n  ),\n);\n?>'),
('sitelist.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  1 => \n  array (\n    ''siteid'' => ''1'',\n    ''name'' => ''中国行'',\n    ''dirname'' => '''',\n    ''domain'' => ''http://0285.qimaweb.com/'',\n    ''site_title'' => ''中国行'',\n    ''keywords'' => ''中国行'',\n    ''description'' => ''中国行'',\n    ''release_point'' => '''',\n    ''default_style'' => ''default'',\n    ''template'' => ''default'',\n    ''setting'' => ''{"upload_maxsize":"2048","upload_allowext":"jpg|jpeg|gif|bmp|png|doc|docx|xls|xlsx|ppt|pptx|pdf|txt|rar|zip|swf","watermark_enable":"0","watermark_minwidth":"300","watermark_minheight":"300","watermark_img":"statics\\\\\\\\/images\\\\\\\\/water\\\\\\\\/\\\\\\\\/mark.png","watermark_pct":"85","watermark_quality":"80","watermark_pos":"9"}'',\n    ''uuid'' => ''e18cb54c-3b8e-11e7-900a-086266531d9f'',\n    ''t_vod'' => ''{"APP_ID":"1253521278","SecretId":"AKIDX1Pejd3yOTPBpJlkhU7ZryufGgvydbBa","SecretKey":"MYZRJF9xd8WjmjieQ0PervoaE3oPpFj6","is_delete":"1"}'',\n    ''chang_yan'' => ''{"APP_ID":"cyrnDOzTs"}'',\n    ''t_lvb'' => ''{"APP_ID":"1251409829","player":{"width":"1200","height":"643"}}'',\n    ''url'' => ''http://0285.qimaweb.com/'',\n  ),\n);\n?>'),
('downservers.cache.php', 'caches_commons/caches_data/', '<?php\nreturn NULL;\n?>'),
('badword.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n);\n?>'),
('ipbanned.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n);\n?>'),
('keylink.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n);\n?>'),
('position.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  1 => \n  array (\n    ''posid'' => ''1'',\n    ''modelid'' => ''3'',\n    ''catid'' => ''0'',\n    ''name'' => ''特别推荐'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''0'',\n    ''siteid'' => ''1'',\n    ''thumb'' => '''',\n  ),\n);\n?>'),
('role_siteid.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  2 => \n  array (\n    0 => 1,\n  ),\n  4 => \n  array (\n    0 => 1,\n  ),\n  5 => \n  array (\n    0 => 1,\n  ),\n  7 => \n  array (\n    0 => 1,\n  ),\n);\n?>'),
('role.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  1 => ''超级管理员'',\n  2 => ''站点管理员'',\n  3 => ''运营总监'',\n  4 => ''总编'',\n  5 => ''编辑'',\n  7 => ''发布人员'',\n);\n?>'),
('urlrules_detail.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  1 => \n  array (\n    ''urlruleid'' => ''1'',\n    ''module'' => ''content'',\n    ''file'' => ''category'',\n    ''ishtml'' => ''1'',\n    ''urlrule'' => ''{$categorydir}{$catdir}/index.html|{$categorydir}{$catdir}/{$page}.html'',\n    ''example'' => ''news/china/1000.html'',\n  ),\n  6 => \n  array (\n    ''urlruleid'' => ''6'',\n    ''module'' => ''content'',\n    ''file'' => ''category'',\n    ''ishtml'' => ''0'',\n    ''urlrule'' => ''index.php?m=content&c=index&a=lists&catid={$catid}|index.php?m=content&c=index&a=lists&catid={$catid}&page={$page}'',\n    ''example'' => ''index.php?m=content&c=index&a=lists&catid=1&page=1'',\n  ),\n  12 => \n  array (\n    ''urlruleid'' => ''12'',\n    ''module'' => ''content'',\n    ''file'' => ''show'',\n    ''ishtml'' => ''1'',\n    ''urlrule'' => ''{$categorydir}{$catdir}/{$year}/{$month}{$day}/{$id}.html|{$categorydir}{$catdir}/{$year}/{$month}{$day}/{$id}_{$page}.html'',\n    ''example'' => ''it/product/2010/0720/1_2.html'',\n  ),\n  16 => \n  array (\n    ''urlruleid'' => ''16'',\n    ''module'' => ''content'',\n    ''file'' => ''show'',\n    ''ishtml'' => ''0'',\n    ''urlrule'' => ''index.php?m=content&c=index&a=show&catid={$catid}&id={$id}|index.php?m=content&c=index&a=show&catid={$catid}&id={$id}&page={$page}'',\n    ''example'' => ''index.php?m=content&c=index&a=show&catid=1&id=1'',\n  ),\n  17 => \n  array (\n    ''urlruleid'' => ''17'',\n    ''module'' => ''content'',\n    ''file'' => ''show'',\n    ''ishtml'' => ''0'',\n    ''urlrule'' => ''show-{$catid}-{$id}-{$page}.html'',\n    ''example'' => ''show-1-2-1.html'',\n  ),\n  18 => \n  array (\n    ''urlruleid'' => ''18'',\n    ''module'' => ''content'',\n    ''file'' => ''show'',\n    ''ishtml'' => ''0'',\n    ''urlrule'' => ''content-{$catid}-{$id}-{$page}.html'',\n    ''example'' => ''content-1-2-1.html'',\n  ),\n  30 => \n  array (\n    ''urlruleid'' => ''30'',\n    ''module'' => ''content'',\n    ''file'' => ''category'',\n    ''ishtml'' => ''0'',\n    ''urlrule'' => ''list-{$catid}-{$page}.html'',\n    ''example'' => ''list-1-1.html'',\n  ),\n);\n?>'),
('urlrules.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  1 => ''{$categorydir}{$catdir}/index.html|{$categorydir}{$catdir}/{$page}.html'',\n  6 => ''index.php?m=content&c=index&a=lists&catid={$catid}|index.php?m=content&c=index&a=lists&catid={$catid}&page={$page}'',\n  12 => ''{$categorydir}{$catdir}/{$year}/{$month}{$day}/{$id}.html|{$categorydir}{$catdir}/{$year}/{$month}{$day}/{$id}_{$page}.html'',\n  16 => ''index.php?m=content&c=index&a=show&catid={$catid}&id={$id}|index.php?m=content&c=index&a=show&catid={$catid}&id={$id}&page={$page}'',\n  17 => ''show-{$catid}-{$id}-{$page}.html'',\n  18 => ''content-{$catid}-{$id}-{$page}.html'',\n  30 => ''list-{$catid}-{$page}.html'',\n);\n?>'),
('modules.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  ''admin'' => \n  array (\n    ''module'' => ''admin'',\n    ''name'' => ''admin'',\n    ''url'' => '''',\n    ''iscore'' => ''1'',\n    ''version'' => ''1.0'',\n    ''description'' => '''',\n    ''setting'' => ''{"admin_email":"qimaweb@163.com","maxloginfailedtimes":"8","minrefreshtime":"2","mail_type":"1","mail_server":"smtp.qq.com","mail_port":"25","category_ajax":"0","mail_user":"xxx@qq.com","mail_auth":"1","mail_from":"xxx@qq.com","mail_password":"","errorlog_size":"20"}'',\n    ''listorder'' => ''0'',\n    ''disabled'' => ''0'',\n    ''installdate'' => ''2010-10-18'',\n    ''updatedate'' => ''2010-10-18'',\n  ),\n  ''special'' => \n  array (\n    ''module'' => ''special'',\n    ''name'' => ''专题'',\n    ''url'' => '''',\n    ''iscore'' => ''0'',\n    ''version'' => ''1.0'',\n    ''description'' => '''',\n    ''setting'' => '''',\n    ''listorder'' => ''0'',\n    ''disabled'' => ''0'',\n    ''installdate'' => ''2010-09-06'',\n    ''updatedate'' => ''2010-09-06'',\n  ),\n  ''content'' => \n  array (\n    ''module'' => ''content'',\n    ''name'' => ''内容模块'',\n    ''url'' => '''',\n    ''iscore'' => ''1'',\n    ''version'' => ''1.0'',\n    ''description'' => '''',\n    ''setting'' => '''',\n    ''listorder'' => ''0'',\n    ''disabled'' => ''0'',\n    ''installdate'' => ''2010-09-06'',\n    ''updatedate'' => ''2010-09-06'',\n  ),\n  ''search'' => \n  array (\n    ''module'' => ''search'',\n    ''name'' => ''全站搜索'',\n    ''url'' => '''',\n    ''iscore'' => ''0'',\n    ''version'' => ''1.0'',\n    ''description'' => '''',\n    ''setting'' => ''array (\n  \\''fulltextenble\\'' => \\''1\\'',\n  \\''relationenble\\'' => \\''1\\'',\n  \\''suggestenable\\'' => \\''1\\'',\n  \\''sphinxenable\\'' => \\''0\\'',\n  \\''sphinxhost\\'' => \\''10.228.134.102\\'',\n  \\''sphinxport\\'' => \\''9312\\'',\n)'',\n    ''listorder'' => ''0'',\n    ''disabled'' => ''0'',\n    ''installdate'' => ''2010-09-06'',\n    ''updatedate'' => ''2010-09-06'',\n  ),\n  ''attachment'' => \n  array (\n    ''module'' => ''attachment'',\n    ''name'' => ''附件'',\n    ''url'' => ''attachment'',\n    ''iscore'' => ''1'',\n    ''version'' => ''1.0'',\n    ''description'' => '''',\n    ''setting'' => '''',\n    ''listorder'' => ''0'',\n    ''disabled'' => ''0'',\n    ''installdate'' => ''2010-09-01'',\n    ''updatedate'' => ''2010-09-06'',\n  ),\n  ''block'' => \n  array (\n    ''module'' => ''block'',\n    ''name'' => ''碎片'',\n    ''url'' => '''',\n    ''iscore'' => ''1'',\n    ''version'' => ''1.0'',\n    ''description'' => '''',\n    ''setting'' => '''',\n    ''listorder'' => ''0'',\n    ''disabled'' => ''0'',\n    ''installdate'' => ''2010-09-01'',\n    ''updatedate'' => ''2010-09-06'',\n  ),\n  ''link'' => \n  array (\n    ''module'' => ''link'',\n    ''name'' => ''友情链接'',\n    ''url'' => '''',\n    ''iscore'' => ''0'',\n    ''version'' => ''1.0'',\n    ''description'' => '''',\n    ''setting'' => ''array (\n  1 => \n  array (\n    \\''is_post\\'' => \\''1\\'',\n    \\''enablecheckcode\\'' => \\''0\\'',\n  ),\n)'',\n    ''listorder'' => ''0'',\n    ''disabled'' => ''0'',\n    ''installdate'' => ''2010-09-06'',\n    ''updatedate'' => ''2010-09-06'',\n  ),\n  ''poster'' => \n  array (\n    ''module'' => ''poster'',\n    ''name'' => ''广告模块'',\n    ''url'' => ''poster/'',\n    ''iscore'' => ''0'',\n    ''version'' => ''1.0'',\n    ''description'' => ''广告模块'',\n    ''setting'' => ''{"enablehits":"1","ext":"","maxsize":""}'',\n    ''listorder'' => ''0'',\n    ''disabled'' => ''0'',\n    ''installdate'' => ''2017-05-23'',\n    ''updatedate'' => ''2017-05-23'',\n  ),\n);\n?>'),
('model.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  2 => \n  array (\n    ''modelid'' => ''2'',\n    ''siteid'' => ''1'',\n    ''name'' => ''新闻模型'',\n    ''description'' => ''新闻专用模型'',\n    ''tablename'' => ''news'',\n    ''setting'' => '''',\n    ''addtime'' => ''0'',\n    ''items'' => ''0'',\n    ''enablesearch'' => ''1'',\n    ''disabled'' => ''0'',\n    ''default_style'' => ''default'',\n    ''category_template'' => ''category'',\n    ''list_template'' => ''list'',\n    ''show_template'' => ''show'',\n    ''js_template'' => '''',\n    ''admin_add_template'' => ''content_add'',\n    ''admin_edit_template'' => ''content_edit'',\n    ''admin_list_template'' => ''content_list'',\n    ''member_add_template'' => '''',\n    ''member_list_template'' => '''',\n    ''sort'' => ''0'',\n    ''type'' => ''0'',\n  ),\n  3 => \n  array (\n    ''modelid'' => ''3'',\n    ''siteid'' => ''1'',\n    ''name'' => ''视频模型'',\n    ''description'' => ''视频专用模型'',\n    ''tablename'' => ''video'',\n    ''setting'' => '''',\n    ''addtime'' => ''0'',\n    ''items'' => ''0'',\n    ''enablesearch'' => ''1'',\n    ''disabled'' => ''0'',\n    ''default_style'' => ''default'',\n    ''category_template'' => ''category_video'',\n    ''list_template'' => ''list_video'',\n    ''show_template'' => ''show_video'',\n    ''js_template'' => '''',\n    ''admin_add_template'' => ''content_add_video'',\n    ''admin_edit_template'' => ''content_edit_video'',\n    ''admin_list_template'' => ''content_list_video'',\n    ''member_add_template'' => '''',\n    ''member_list_template'' => '''',\n    ''sort'' => ''0'',\n    ''type'' => ''0'',\n  ),\n  7 => \n  array (\n    ''modelid'' => ''7'',\n    ''siteid'' => ''1'',\n    ''name'' => ''直播模型'',\n    ''description'' => ''直播专用模型'',\n    ''tablename'' => ''direct'',\n    ''setting'' => '''',\n    ''addtime'' => ''0'',\n    ''items'' => ''0'',\n    ''enablesearch'' => ''1'',\n    ''disabled'' => ''0'',\n    ''default_style'' => ''default'',\n    ''category_template'' => ''category_video'',\n    ''list_template'' => ''list_video'',\n    ''show_template'' => ''show_video_direct'',\n    ''js_template'' => '''',\n    ''admin_add_template'' => '''',\n    ''admin_edit_template'' => '''',\n    ''admin_list_template'' => '''',\n    ''member_add_template'' => '''',\n    ''member_list_template'' => '''',\n    ''sort'' => ''0'',\n    ''type'' => ''0'',\n  ),\n  9 => \n  array (\n    ''modelid'' => ''9'',\n    ''siteid'' => ''1'',\n    ''name'' => ''工作人员名片'',\n    ''description'' => ''工作人员名片模型'',\n    ''tablename'' => ''jobs'',\n    ''setting'' => '''',\n    ''addtime'' => ''0'',\n    ''items'' => ''0'',\n    ''enablesearch'' => ''1'',\n    ''disabled'' => ''0'',\n    ''default_style'' => ''default'',\n    ''category_template'' => ''category'',\n    ''list_template'' => ''list_reporter'',\n    ''show_template'' => ''show_reporter'',\n    ''js_template'' => '''',\n    ''admin_add_template'' => '''',\n    ''admin_edit_template'' => '''',\n    ''admin_list_template'' => '''',\n    ''member_add_template'' => '''',\n    ''member_list_template'' => '''',\n    ''sort'' => ''0'',\n    ''type'' => ''0'',\n  ),\n  10 => \n  array (\n    ''modelid'' => ''10'',\n    ''siteid'' => ''1'',\n    ''name'' => ''合作单位模型'',\n    ''description'' => ''合作单位专用模型'',\n    ''tablename'' => ''sponsor'',\n    ''setting'' => '''',\n    ''addtime'' => ''0'',\n    ''items'' => ''0'',\n    ''enablesearch'' => ''1'',\n    ''disabled'' => ''0'',\n    ''default_style'' => ''default'',\n    ''category_template'' => ''category'',\n    ''list_template'' => ''list_sponsor'',\n    ''show_template'' => ''show'',\n    ''js_template'' => '''',\n    ''admin_add_template'' => '''',\n    ''admin_edit_template'' => '''',\n    ''admin_list_template'' => '''',\n    ''member_add_template'' => '''',\n    ''member_list_template'' => '''',\n    ''sort'' => ''0'',\n    ''type'' => ''0'',\n  ),\n);\n?>'),
('workflow_1.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  1 => \n  array (\n    ''workflowid'' => ''1'',\n    ''siteid'' => ''1'',\n    ''steps'' => ''1'',\n    ''workname'' => ''一级审核'',\n    ''description'' => ''审核一次'',\n    ''setting'' => '''',\n    ''flag'' => ''0'',\n  ),\n  2 => \n  array (\n    ''workflowid'' => ''2'',\n    ''siteid'' => ''1'',\n    ''steps'' => ''2'',\n    ''workname'' => ''二级审核'',\n    ''description'' => ''审核两次'',\n    ''setting'' => '''',\n    ''flag'' => ''0'',\n  ),\n  3 => \n  array (\n    ''workflowid'' => ''3'',\n    ''siteid'' => ''1'',\n    ''steps'' => ''3'',\n    ''workname'' => ''三级审核'',\n    ''description'' => ''审核三次'',\n    ''setting'' => '''',\n    ''flag'' => ''0'',\n  ),\n  4 => \n  array (\n    ''workflowid'' => ''4'',\n    ''siteid'' => ''1'',\n    ''steps'' => ''4'',\n    ''workname'' => ''四级审核'',\n    ''description'' => ''四级审核'',\n    ''setting'' => '''',\n    ''flag'' => ''0'',\n  ),\n);\n?>'),
('member_model.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  1 => \n  array (\n    ''modelid'' => ''1'',\n    ''siteid'' => ''1'',\n    ''name'' => ''普通会员'',\n    ''description'' => ''普通会员'',\n    ''tablename'' => ''member_detail'',\n    ''setting'' => '''',\n    ''addtime'' => ''0'',\n    ''items'' => ''0'',\n    ''enablesearch'' => ''1'',\n    ''disabled'' => ''0'',\n    ''default_style'' => '''',\n    ''category_template'' => '''',\n    ''list_template'' => '''',\n    ''show_template'' => '''',\n    ''js_template'' => '''',\n    ''admin_list_template'' => '''',\n    ''member_add_template'' => '''',\n    ''member_list_template'' => '''',\n    ''sort'' => ''0'',\n    ''type'' => ''2'',\n  ),\n);\n?>'),
('special.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  4 => \n  array (\n    ''id'' => ''4'',\n    ''siteid'' => ''1'',\n    ''title'' => ''测试的专题'',\n    ''url'' => ''http://0285.qimaweb.com/special/4.html'',\n    ''thumb'' => ''http://img.zcool.cn/community/014f55556813f00000012b20f7f806.jpg'',\n    ''banner'' => ''http://img.zcool.cn/community/014f55556813f00000012b20f7f806.jpg'',\n    ''ishtml'' => ''0'',\n  ),\n);\n?>'),
('common.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  ''admin_email'' => ''qimaweb@163.com'',\n  ''maxloginfailedtimes'' => ''8'',\n  ''minrefreshtime'' => ''2'',\n  ''mail_type'' => ''1'',\n  ''mail_server'' => ''smtp.qq.com'',\n  ''mail_port'' => ''25'',\n  ''category_ajax'' => ''0'',\n  ''mail_user'' => ''xxx@qq.com'',\n  ''mail_auth'' => ''1'',\n  ''mail_from'' => ''xxx@qq.com'',\n  ''mail_password'' => '''',\n  ''errorlog_size'' => ''20'',\n);\n?>'),
('type_content_1.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n);\n?>'),
('type_.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n);\n?>'),
('category_items_1.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  10 => ''0'',\n);\n?>'),
('category_items_2.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  1 => ''0'',\n  4 => ''1'',\n  5 => ''0'',\n  6 => ''0'',\n  7 => ''0'',\n  8 => ''0'',\n  9 => ''0'',\n);\n?>'),
('category_items_3.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  2 => ''0'',\n  17 => ''0'',\n  18 => ''0'',\n);\n?>'),
('category_items_11.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  9 => ''0'',\n);\n?>'),
('category_items_12.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n);\n?>'),
('category_items_13.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n);\n?>'),
('type_content.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n);\n?>'),
('vote.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n);\n?>'),
('link.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  1 => \n  array (\n    ''is_post'' => ''1'',\n    ''enablecheckcode'' => ''0'',\n  ),\n);\n?>'),
('poster_template_1.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  ''banner'' => \n  array (\n    ''name'' => ''矩形横幅'',\n    ''select'' => ''0'',\n    ''padding'' => ''0'',\n    ''size'' => ''1'',\n    ''option'' => ''0'',\n    ''num'' => ''1'',\n    ''type'' => \n    array (\n      ''images'' => ''图片'',\n      ''flash'' => ''动画'',\n    ),\n  ),\n  ''couplet'' => \n  array (\n    ''name'' => ''对联广告'',\n    ''align'' => ''align'',\n    ''select'' => ''0'',\n    ''padding'' => ''1'',\n    ''size'' => ''1'',\n    ''option'' => ''0'',\n    ''num'' => ''2'',\n    ''type'' => \n    array (\n      ''images'' => ''图片'',\n      ''flash'' => ''动画'',\n    ),\n  ),\n  ''fixure'' => \n  array (\n    ''name'' => ''固定位置'',\n    ''align'' => ''align'',\n    ''select'' => ''1'',\n    ''padding'' => ''1'',\n    ''size'' => ''1'',\n    ''option'' => ''0'',\n    ''num'' => ''1'',\n    ''type'' => \n    array (\n      ''images'' => ''图片'',\n      ''flash'' => ''动画'',\n    ),\n  ),\n  ''float'' => \n  array (\n    ''name'' => ''漂浮移动'',\n    ''select'' => ''0'',\n    ''padding'' => ''1'',\n    ''size'' => ''1'',\n    ''option'' => ''0'',\n    ''num'' => ''1'',\n    ''type'' => \n    array (\n      ''images'' => ''图片'',\n      ''flash'' => ''动画'',\n    ),\n  ),\n  ''imagechange'' => \n  array (\n    ''name'' => ''图片轮换广告'',\n    ''select'' => ''0'',\n    ''padding'' => ''0'',\n    ''size'' => ''1'',\n    ''option'' => ''1'',\n    ''num'' => ''1'',\n    ''type'' => \n    array (\n      ''images'' => ''图片'',\n    ),\n  ),\n  ''imagelist'' => \n  array (\n    ''name'' => ''图片列表广告'',\n    ''select'' => ''0'',\n    ''padding'' => ''0'',\n    ''size'' => ''1'',\n    ''option'' => ''1'',\n    ''num'' => ''1'',\n    ''type'' => \n    array (\n      ''images'' => ''图片'',\n    ),\n  ),\n  ''text'' => \n  array (\n    ''name'' => ''文字广告'',\n    ''select'' => ''0'',\n    ''padding'' => ''0'',\n    ''size'' => ''0'',\n    ''option'' => ''1'',\n    ''num'' => ''1'',\n    ''type'' => \n    array (\n      ''text'' => ''文字'',\n    ),\n  ),\n);\n?>'),
('category_items_4.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n);\n?>'),
('category_items_7.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  3 => ''1'',\n  11 => ''0'',\n);\n?>'),
('category_items_5.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n);\n?>'),
('poster.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  1 => \n  array (\n    ''enablehits'' => ''1'',\n    ''ext'' => '''',\n    ''maxsize'' => '''',\n  ),\n);\n?>'),
('category_items_6.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n);\n?>'),
('category_items_9.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  15 => ''0'',\n);\n?>'),
('category_items_10.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  16 => ''0'',\n);\n?>');

-- --------------------------------------------------------

--
-- 表的结构 `qm_category`
--

CREATE TABLE IF NOT EXISTS `qm_category` (
  `catid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `module` varchar(15) NOT NULL,
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `modelid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `parentid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `arrparentid` varchar(255) NOT NULL,
  `child` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `arrchildid` mediumtext NOT NULL,
  `catname` varchar(30) NOT NULL,
  `style` varchar(5) NOT NULL,
  `image` varchar(100) NOT NULL,
  `description` mediumtext NOT NULL,
  `parentdir` varchar(100) NOT NULL,
  `catdir` varchar(30) NOT NULL,
  `url` varchar(100) NOT NULL,
  `items` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `setting` mediumtext NOT NULL,
  `listorder` smallint(5) unsigned NOT NULL DEFAULT '0',
  `ismenu` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `sethtml` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `letter` varchar(30) NOT NULL,
  `usable_type` varchar(255) NOT NULL,
  PRIMARY KEY (`catid`),
  KEY `module` (`module`,`parentid`,`listorder`,`catid`),
  KEY `siteid` (`siteid`,`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- 转存表中的数据 `qm_category`
--

INSERT INTO `qm_category` (`catid`, `siteid`, `module`, `type`, `modelid`, `parentid`, `arrparentid`, `child`, `arrchildid`, `catname`, `style`, `image`, `description`, `parentdir`, `catdir`, `url`, `items`, `hits`, `setting`, `listorder`, `ismenu`, `sethtml`, `letter`, `usable_type`) VALUES
(1, 1, 'content', 0, 2, 0, '0', 0, '1', '环境要闻', '', '', '', '', 'huanjing', 'http://0285.qimaweb.com/category/1/1.html', 0, 0, '{"create_to_html_root":"0","workflowid":"","ishtml":"0","content_ishtml":"0","template_list":"default","category_template":"category","list_template":"list","show_template":"show","meta_title":"","meta_keywords":"","meta_description":"","presentpoint":"1","defaultchargepoint":"0","paytype":"0","repeatchargedays":"1","category_ruleid":"4","show_ruleid":"3"}', 1, 1, 0, 'huanjingyaowen', ''),
(2, 1, 'content', 0, 3, 0, '0', 0, '2', '环保视觉', '', '', '', '', 'shijue', 'http://0285.qimaweb.com/category/2/1.html', 0, 0, '{"create_to_html_root":"0","workflowid":"","ishtml":"0","content_ishtml":"0","template_list":"default","category_template":"category_video","list_template":"list_video","show_template":"show_video","meta_title":"","meta_keywords":"","meta_description":"","presentpoint":"1","defaultchargepoint":"0","paytype":"0","repeatchargedays":"1","category_ruleid":"4","show_ruleid":"3"}', 2, 1, 0, 'huanbaoshijue', ''),
(3, 1, 'content', 0, 7, 0, '0', 0, '3', '环保直播', '', '', '', '', 'zhibo', 'http://0285.qimaweb.com/category/3/1.html', 1, 0, '{"create_to_html_root":"0","workflowid":"","ishtml":"0","content_ishtml":"0","template_list":"default","category_template":"category_video","list_template":"list_video","show_template":"show_video_direct","meta_title":"","meta_keywords":"","meta_description":"","presentpoint":"1","defaultchargepoint":"0","paytype":"0","repeatchargedays":"1","category_ruleid":"4","show_ruleid":"3"}', 3, 1, 0, 'huanbaozhibo', ''),
(4, 1, 'content', 0, 2, 0, '0', 0, '4', '环保城市', '', '', '', '', 'chengshi', 'http://0285.qimaweb.com/category/4/1.html', 1, 0, '{"create_to_html_root":"0","workflowid":"","ishtml":"0","content_ishtml":"0","template_list":"default","category_template":"category","list_template":"list","show_template":"show","meta_title":"","meta_keywords":"","meta_description":"","presentpoint":"1","defaultchargepoint":"0","paytype":"0","repeatchargedays":"1","category_ruleid":"4","show_ruleid":"3"}', 4, 1, 0, 'huanbaochengshi', ''),
(5, 1, 'content', 0, 2, 0, '0', 0, '5', '环保企业', '', '', '', '', 'qiye', 'http://0285.qimaweb.com/category/5/1.html', 0, 0, '{"create_to_html_root":"0","workflowid":"","ishtml":"0","content_ishtml":"0","template_list":"default","category_template":"category","list_template":"list","show_template":"show","meta_title":"","meta_keywords":"","meta_description":"","presentpoint":"1","defaultchargepoint":"0","paytype":"0","repeatchargedays":"1","category_ruleid":"4","show_ruleid":"3"}', 5, 1, 0, 'huanbaoqiye', ''),
(6, 1, 'content', 0, 2, 0, '0', 0, '6', '案例库', '', '', '', '', 'case', 'http://0285.qimaweb.com/category/6/1.html', 0, 0, '{"create_to_html_root":"0","workflowid":"","ishtml":"0","content_ishtml":"0","template_list":"default","category_template":"category","list_template":"list","show_template":"show","meta_title":"","meta_keywords":"","meta_description":"","presentpoint":"1","defaultchargepoint":"0","paytype":"0","repeatchargedays":"1","category_ruleid":"4","show_ruleid":"3"}', 6, 1, 0, 'anliku', ''),
(7, 1, 'content', 0, 2, 0, '0', 0, '7', '高层动态', '', '', '', '', 'gaoceng', 'http://0285.qimaweb.com/category/7/1.html', 0, 0, '{"create_to_html_root":"0","workflowid":"","ishtml":"0","content_ishtml":"0","template_list":"default","category_template":"category","list_template":"list","show_template":"show","meta_title":"","meta_keywords":"","meta_description":"","presentpoint":"1","defaultchargepoint":"0","paytype":"0","repeatchargedays":"1","category_ruleid":"4","show_ruleid":"3"}', 7, 1, 0, 'gaocengdongtai', ''),
(8, 1, 'content', 0, 2, 0, '0', 0, '8', '地方动态', '', '', '', '', 'difang', 'http://0285.qimaweb.com/category/8/1.html', 0, 0, '{"create_to_html_root":"0","workflowid":"","ishtml":"0","content_ishtml":"0","template_list":"default","category_template":"category","list_template":"list","show_template":"show","meta_title":"","meta_keywords":"","meta_description":"","presentpoint":"1","defaultchargepoint":"0","paytype":"0","repeatchargedays":"1","category_ruleid":"4","show_ruleid":"3"}', 8, 1, 0, 'difangdongtai', ''),
(9, 1, 'content', 0, 2, 0, '0', 0, '9', '法治环保中华行', '', '', '', '', 'zhonghuaxing', 'http://0285.qimaweb.com/category/9/1.html', 0, 0, '{"create_to_html_root":"0","workflowid":"","ishtml":"0","content_ishtml":"0","template_list":"default","category_template":"category","list_template":"list","show_template":"show","meta_title":"","meta_keywords":"","meta_description":"","presentpoint":"1","defaultchargepoint":"0","paytype":"0","repeatchargedays":"1","category_ruleid":"4","show_ruleid":"3"}', 9, 1, 0, 'fazhihuanbaozhonghuaxing', ''),
(12, 1, 'content', 1, 0, 0, '0', 1, '12,13,14,15,16', '关于我们', '', '', '', '', 'about', 'http://0285.qimaweb.com/category/12/1.html', 0, 0, '{"ishtml":"0","template_list":"","meta_title":"","meta_keywords":"","meta_description":"","category_ruleid":"4","show_ruleid":"","repeatchargedays":"1"}', 12, 0, 0, 'guanyuwomen', ''),
(13, 1, 'content', 1, 0, 12, '0,12', 0, '13', '市场合作', '', '', '', 'about/', 'house', 'http://0285.qimaweb.com/category/13/1.html', 0, 0, '{"ishtml":"0","template_list":"default","page_template":"page","meta_title":"","meta_keywords":"","meta_description":"","category_ruleid":"4","show_ruleid":"","repeatchargedays":"1"}', 13, 1, 0, 'shichanghezuo', ''),
(11, 1, 'content', 0, 7, 0, '0', 0, '11', '直播预告', '', '', '', '', 'yugao', 'http://0285.qimaweb.com/category/11/1.html', 0, 0, '{"create_to_html_root":"0","workflowid":"","ishtml":"0","content_ishtml":"0","template_list":"default","category_template":"category_video","list_template":"list_video","show_template":"show_video_direct","meta_title":"","meta_keywords":"","meta_description":"","presentpoint":"1","defaultchargepoint":"0","paytype":"0","repeatchargedays":"1","category_ruleid":"4","show_ruleid":"3"}', 11, 0, 0, 'zhiboyugao', ''),
(14, 1, 'content', 1, 0, 12, '0,12', 0, '14', '招贤纳士', '', '', '', 'about/', 'jobs', 'http://0285.qimaweb.com/category/14/1.html', 0, 0, '{"ishtml":"0","template_list":"default","page_template":"page","meta_title":"","meta_keywords":"","meta_description":"","category_ruleid":"4","show_ruleid":"","repeatchargedays":"1"}', 14, 1, 0, 'zhaoxiannashi', ''),
(15, 1, 'content', 0, 9, 12, '0,12', 0, '15', '人员查询', '', '', '', 'about/', 'personnel', 'http://0285.qimaweb.com/category/15/1.html', 0, 0, '{"create_to_html_root":"0","workflowid":"","ishtml":"0","content_ishtml":"0","template_list":"default","category_template":"category","list_template":"list_reporter","show_template":"show_reporter","meta_title":"","meta_keywords":"","meta_description":"","presentpoint":"1","defaultchargepoint":"0","paytype":"0","repeatchargedays":"1","category_ruleid":"4","show_ruleid":"3"}', 15, 1, 0, 'renyuanchaxun', ''),
(16, 1, 'content', 0, 10, 12, '0,12', 0, '16', '合作单位', '', '', '', 'about/', 'cooperate', 'http://0285.qimaweb.com/category/16/1.html', 0, 0, '{"create_to_html_root":"0","workflowid":"","ishtml":"0","content_ishtml":"0","template_list":"default","category_template":"category","list_template":"list_sponsor","show_template":"show","meta_title":"","meta_keywords":"","meta_description":"","presentpoint":"1","defaultchargepoint":"0","paytype":"0","repeatchargedays":"1","category_ruleid":"4","show_ruleid":"3"}', 16, 1, 0, 'hezuodanwei', ''),
(17, 1, 'content', 0, 3, 0, '0', 1, '17,18', '视频专题', '', '', '', '', 'zhuanti', 'http://0285.qimaweb.com/category/17/1.html', 0, 0, '{"create_to_html_root":"0","workflowid":"","ishtml":"0","content_ishtml":"0","template_list":"default","category_template":"category_video_special","list_template":"list_video","show_template":"show_video","meta_title":"","meta_keywords":"","meta_description":"","presentpoint":"1","defaultchargepoint":"0","paytype":"0","repeatchargedays":"1","category_ruleid":"4","show_ruleid":"3"}', 17, 1, 0, 'shipinzhuanti', ''),
(18, 1, 'content', 0, 3, 17, '0,17', 0, '18', '专题子目录', '', '', '', 'zhuanti/', 'zimulu', 'http://0285.qimaweb.com/category/18/1.html', 0, 0, '{"create_to_html_root":"0","workflowid":"","ishtml":"0","content_ishtml":"0","template_list":"default","category_template":"category_video_special","list_template":"list_video","show_template":"show_video","meta_title":"","meta_keywords":"","meta_description":"","presentpoint":"1","defaultchargepoint":"0","paytype":"0","repeatchargedays":"1","category_ruleid":"4","show_ruleid":"3"}', 18, 1, 0, 'zhuantizimulu', '');

-- --------------------------------------------------------

--
-- 表的结构 `qm_category_priv`
--

CREATE TABLE IF NOT EXISTS `qm_category_priv` (
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `roleid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `is_admin` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `action` char(30) NOT NULL,
  KEY `catid` (`catid`,`roleid`,`is_admin`,`action`),
  KEY `siteid` (`siteid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `qm_category_priv`
--

INSERT INTO `qm_category_priv` (`catid`, `siteid`, `roleid`, `is_admin`, `action`) VALUES
(24, 1, 4, 1, 'delete'),
(20, 1, 4, 1, 'remove'),
(20, 1, 4, 1, 'push'),
(20, 1, 4, 1, 'listorder'),
(20, 1, 4, 1, 'delete'),
(20, 1, 4, 1, 'edit'),
(20, 1, 4, 1, 'add'),
(20, 1, 4, 1, 'init'),
(24, 1, 4, 1, 'init'),
(24, 1, 4, 1, 'listorder'),
(24, 1, 4, 1, 'add'),
(24, 1, 4, 1, 'edit'),
(24, 1, 4, 1, 'push'),
(21, 1, 4, 1, 'init'),
(21, 1, 4, 1, 'add'),
(21, 1, 4, 1, 'edit'),
(21, 1, 4, 1, 'delete'),
(21, 1, 4, 1, 'listorder'),
(21, 1, 4, 1, 'push'),
(21, 1, 4, 1, 'remove'),
(22, 1, 4, 1, 'init'),
(22, 1, 4, 1, 'add'),
(22, 1, 4, 1, 'edit'),
(22, 1, 4, 1, 'delete'),
(22, 1, 4, 1, 'listorder'),
(22, 1, 4, 1, 'push'),
(23, 1, 4, 1, 'delete'),
(23, 1, 4, 1, 'init'),
(23, 1, 4, 1, 'listorder'),
(23, 1, 4, 1, 'add'),
(23, 1, 4, 1, 'push'),
(23, 1, 4, 1, 'edit');

-- --------------------------------------------------------

--
-- 表的结构 `qm_content_check`
--

CREATE TABLE IF NOT EXISTS `qm_content_check` (
  `checkid` char(15) NOT NULL,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `title` char(80) NOT NULL,
  `username` char(20) NOT NULL,
  `inputtime` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  KEY `username` (`username`),
  KEY `checkid` (`checkid`),
  KEY `status` (`status`,`inputtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `qm_copyfrom`
--

CREATE TABLE IF NOT EXISTS `qm_copyfrom` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `sitename` varchar(30) NOT NULL,
  `siteurl` varchar(100) NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `listorder` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `qm_copyfrom`
--

INSERT INTO `qm_copyfrom` (`id`, `siteid`, `sitename`, `siteurl`, `thumb`, `listorder`) VALUES
(1, 1, '百度', 'http://www.baidu.com', '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `qm_direct`
--

CREATE TABLE IF NOT EXISTS `qm_direct` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `typeid` smallint(5) unsigned NOT NULL,
  `title` char(80) NOT NULL DEFAULT '',
  `style` char(24) NOT NULL DEFAULT '',
  `thumb` char(100) NOT NULL DEFAULT '',
  `keywords` char(40) NOT NULL DEFAULT '',
  `description` mediumtext NOT NULL,
  `posids` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `url` char(100) NOT NULL,
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `sysadd` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `islink` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `username` char(20) NOT NULL,
  `inputtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `author` varchar(255) NOT NULL DEFAULT '',
  `channel_id` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `status` (`status`,`listorder`,`id`),
  KEY `listorder` (`catid`,`status`,`listorder`,`id`),
  KEY `catid` (`catid`,`status`,`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `qm_direct`
--

INSERT INTO `qm_direct` (`id`, `catid`, `typeid`, `title`, `style`, `thumb`, `keywords`, `description`, `posids`, `url`, `listorder`, `status`, `sysadd`, `islink`, `username`, `inputtime`, `updatetime`, `author`, `channel_id`) VALUES
(1, 3, 0, '测试', '', '', '测试', '测试', 0, 'http://0285.qimaweb.com/show/3/1/1.html', 0, 99, 1, 0, 'qimaweb', 1509806864, 1509866600, '', '10905947996178996786');

-- --------------------------------------------------------

--
-- 表的结构 `qm_direct_data`
--

CREATE TABLE IF NOT EXISTS `qm_direct_data` (
  `id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `content` text NOT NULL,
  `paginationtype` tinyint(1) NOT NULL,
  `maxcharperpage` mediumint(6) NOT NULL,
  `template` varchar(30) NOT NULL,
  `paytype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `relation` varchar(255) NOT NULL DEFAULT '',
  `copyfrom` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `qm_direct_data`
--

INSERT INTO `qm_direct_data` (`id`, `content`, `paginationtype`, `maxcharperpage`, `template`, `paytype`, `relation`, `copyfrom`) VALUES
(1, '测试', 0, 10000, '', 0, '', '|0');

-- --------------------------------------------------------

--
-- 表的结构 `qm_hits`
--

CREATE TABLE IF NOT EXISTS `qm_hits` (
  `hitsid` char(30) NOT NULL,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `views` int(10) unsigned NOT NULL DEFAULT '0',
  `yesterdayviews` int(10) unsigned NOT NULL DEFAULT '0',
  `dayviews` int(10) unsigned NOT NULL DEFAULT '0',
  `weekviews` int(10) unsigned NOT NULL DEFAULT '0',
  `monthviews` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`hitsid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `qm_hits`
--

INSERT INTO `qm_hits` (`hitsid`, `catid`, `views`, `yesterdayviews`, `dayviews`, `weekviews`, `monthviews`, `updatetime`) VALUES
('special-c-2-1', 0, 10, 7, 3, 10, 10, 1500967169),
('c-3-27', 21, 6, 2, 1, 1, 1, 1502199133),
('c-3-54', 25, 13, 10, 2, 2, 2, 1502199263),
('special-c-2-2', 0, 10, 9, 1, 10, 10, 1500966927),
('special-c-3-3', 0, 22, 5, 17, 22, 22, 1502198334),
('special-c-3-4', 0, 42, 0, 42, 42, 42, 1502198336),
('c-7-1', 3, 98, 28, 70, 98, 98, 1509867611),
('c-2-23', 4, 113, 2, 61, 61, 61, 1514264525),
('special-c-4-5', 0, 0, 0, 0, 0, 0, 0),
('special-c-4-6', 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `qm_jobs`
--

CREATE TABLE IF NOT EXISTS `qm_jobs` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `typeid` smallint(5) unsigned NOT NULL,
  `title` char(80) NOT NULL DEFAULT '',
  `style` char(24) NOT NULL DEFAULT '',
  `thumb` char(100) NOT NULL DEFAULT '',
  `keywords` char(40) NOT NULL DEFAULT '',
  `description` char(255) NOT NULL DEFAULT '',
  `posids` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `url` char(100) NOT NULL,
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `sysadd` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `islink` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `username` char(20) NOT NULL,
  `inputtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `department` varchar(255) NOT NULL DEFAULT '',
  `post` varchar(255) NOT NULL DEFAULT '',
  `number` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `status` (`status`,`listorder`,`id`),
  KEY `listorder` (`catid`,`status`,`listorder`,`id`),
  KEY `catid` (`catid`,`status`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `qm_jobs_data`
--

CREATE TABLE IF NOT EXISTS `qm_jobs_data` (
  `id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `content` text NOT NULL,
  `paginationtype` tinyint(1) NOT NULL,
  `maxcharperpage` mediumint(6) NOT NULL,
  `template` varchar(30) NOT NULL,
  `paytype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `relation` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `qm_keyword`
--

CREATE TABLE IF NOT EXISTS `qm_keyword` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `keyword` char(100) NOT NULL,
  `pinyin` char(100) NOT NULL,
  `videonum` int(11) NOT NULL DEFAULT '0',
  `searchnums` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `keyword` (`keyword`,`siteid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=71 ;

--
-- 转存表中的数据 `qm_keyword`
--

INSERT INTO `qm_keyword` (`id`, `siteid`, `keyword`, `pinyin`, `videonum`, `searchnums`) VALUES
(1, 1, '兰迪', 'landi', 1, 0),
(2, 1, '英语', 'yingyu', 1, 0),
(3, 1, '学科', 'xueke', 1, 0),
(4, 1, '测试', 'ceshi', 26, 0),
(5, 1, 'trailer', 'trailer', 17, 0),
(6, 1, '测试新闻2', 'ceshixinwen2', 1, 0),
(7, 1, '测试新闻', 'ceshixinwen', 4, 0),
(8, 1, '重庆', 'zhongqing', 1, 0),
(9, 1, '“协税房屋查询系统”', 'xieshuifangwuchaxunxitong', 1, 0),
(10, 1, '重庆彭水县', 'zhongqingpengshuixian', 11, 0),
(11, 1, '政法队伍', 'zhengfaduiwu', 11, 0),
(12, 1, '', '', 7, 0),
(13, 1, '气功大师', 'qigongdashi', 6, 0),
(14, 1, '风水大师', 'fengshuidashi', 6, 0),
(15, 1, '环保部', 'huanbaobu', 14, 0),
(16, 1, '京津冀', 'jingjinji', 14, 0),
(17, 1, '散乱污', 'sanluanwu', 14, 0),
(18, 1, '诈骗分子', 'zhapianfenzi', 1, 0),
(19, 1, '电信诈骗', 'dianxinzhapian', 1, 0),
(20, 1, '窃取', 'qiequ', 1, 0),
(21, 1, '法制记者', 'fazhijizhe', 26, 0),
(22, 1, '德治小镇', 'dezhixiaozhen', 26, 0),
(23, 1, '社会活力', 'shehuihuoli', 7, 0),
(24, 1, '入错行', 'rucuoxing', 7, 0),
(25, 1, '收入分配', 'shourufenpei', 7, 0),
(26, 1, '上调', 'shangdiao', 6, 0),
(27, 1, '养老金', 'yanglaojin', 6, 0),
(28, 1, '实惠', 'shihui', 6, 0),
(29, 1, '重庆合川区', 'zhongqinghechuanqu', 14, 0),
(30, 1, '“政法干部”', 'zhengfaganbu', 14, 0),
(31, 1, '夏季高温', 'xiajigaowen', 17, 0),
(32, 1, '车辆自燃', 'cheliangziran', 17, 0),
(33, 1, '频发', 'pinfa', 17, 0),
(34, 1, '中央政法委', 'zhongyangzhengfawei', 20, 0),
(35, 1, '法学专家', 'faxuezhuanjia', 20, 0),
(36, 1, '司改', 'sigai', 20, 0),
(37, 1, '西成高铁', 'xichenggaotie', 9, 0),
(38, 1, '成都', 'chengdu', 9, 0),
(39, 1, '西安', 'xian', 9, 0),
(40, 1, '3小时', '3xiaoshi', 9, 0),
(41, 1, '白雪公主20170623C禁毒', 'baixuegongzhu20170623cjindu', 3, 0),
(42, 1, '禁毒日', 'jinduri', 2, 0),
(43, 1, '悔', 'hui', 6, 0),
(44, 1, '20170625A', '20170625a', 6, 0),
(45, 1, '广西', 'guangxi', 2, 0),
(46, 1, '冒充老总', 'maochonglaozong', 2, 0),
(47, 1, '建群', 'jianqun', 2, 0),
(48, 1, '诈骗窝点', 'zhapianwodian', 2, 0),
(49, 1, '试一试', 'shiyishi', 3, 0),
(50, 1, '国务院', 'guowuyuan', 2, 0),
(51, 1, '审计整改', 'shenjizhenggai', 2, 0),
(52, 1, '整改造假', 'zhenggaizaojia', 2, 0),
(53, 1, '婴幼儿托管', 'yingyouertuoguan', 4, 0),
(54, 1, '无托管招生资质', 'wutuoguanzhaoshengzizhi', 4, 0),
(55, 1, '贾跃亭', 'jiayueting', 5, 0),
(56, 1, '乐视', 'leshi', 5, 0),
(57, 1, '资产冻结', 'zichandongjie', 5, 0),
(58, 1, '食品安全', 'shipinanquan', 1, 0),
(59, 1, '反腐倡廉', 'fanfuchanglian', 1, 0),
(60, 1, '暴恐事件', 'baokongshijian', 1, 0),
(61, 1, '大学生事件', 'daxueshengshijian', 1, 0),
(62, 1, '体罚家暴', 'tifajiabao', 1, 0),
(63, 1, '版权侵权', 'banquanqinquan', 1, 0),
(64, 1, '红灯区', 'hongdengqu', 1, 0),
(65, 1, '信用卡', 'xinyongka', 1, 0),
(66, 1, '打架斗殴', 'dajiadouou', 1, 0),
(67, 1, '酒驾违章', 'jiujiaweizhang', 1, 0),
(68, 1, '安全播报第484期-​双11剁手', '', 1, 0),
(69, 1, '儿千佛山', 'erqianfoshan', 2, 0),
(70, 1, 'Wildlife', 'wildlife', 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `qm_keyword_data`
--

CREATE TABLE IF NOT EXISTS `qm_keyword_data` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tagid` int(10) unsigned NOT NULL DEFAULT '0',
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `contentid` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tagid` (`tagid`,`siteid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=113 ;

--
-- 转存表中的数据 `qm_keyword_data`
--

INSERT INTO `qm_keyword_data` (`id`, `tagid`, `siteid`, `contentid`) VALUES
(1, 1, 1, '1-12'),
(2, 2, 1, '1-12'),
(3, 3, 1, '1-12'),
(4, 4, 1, '3-2'),
(5, 4, 1, '1-2'),
(6, 5, 1, '1-3'),
(7, 6, 1, '2-2'),
(8, 7, 1, '1-2'),
(9, 8, 1, '2-2'),
(10, 9, 1, '2-2'),
(11, 10, 1, '16-3'),
(12, 11, 1, '16-3'),
(13, 12, 1, '17-3'),
(14, 10, 1, '17-3'),
(15, 11, 1, '17-3'),
(16, 10, 1, '18-3'),
(17, 11, 1, '18-3'),
(18, 12, 1, '18-3'),
(19, 13, 1, '3-2'),
(20, 14, 1, '3-2'),
(21, 15, 1, '4-2'),
(22, 16, 1, '4-2'),
(23, 17, 1, '4-2'),
(24, 18, 1, '5-2'),
(25, 19, 1, '5-2'),
(26, 20, 1, '5-2'),
(27, 21, 1, '23-3'),
(28, 22, 1, '23-3'),
(29, 21, 1, '22-3'),
(30, 22, 1, '22-3'),
(31, 10, 1, '19-3'),
(32, 11, 1, '19-3'),
(33, 23, 1, '6-2'),
(34, 24, 1, '6-2'),
(35, 25, 1, '6-2'),
(36, 26, 1, '24-3'),
(37, 27, 1, '24-3'),
(38, 28, 1, '24-3'),
(39, 29, 1, '25-3'),
(40, 30, 1, '25-3'),
(41, 31, 1, '28-3'),
(42, 32, 1, '28-3'),
(43, 33, 1, '28-3'),
(44, 31, 1, '29-3'),
(45, 32, 1, '29-3'),
(46, 33, 1, '29-3'),
(47, 31, 1, '30-3'),
(48, 32, 1, '30-3'),
(49, 33, 1, '30-3'),
(50, 31, 1, '31-3'),
(51, 32, 1, '31-3'),
(52, 33, 1, '31-3'),
(53, 29, 1, '26-3'),
(54, 30, 1, '26-3'),
(55, 34, 1, '7-2'),
(56, 35, 1, '7-2'),
(57, 36, 1, '7-2'),
(58, 12, 1, '8-2'),
(59, 37, 1, '32-3'),
(60, 38, 1, '32-3'),
(61, 39, 1, '32-3'),
(62, 40, 1, '32-3'),
(63, 41, 1, '37-3'),
(64, 41, 1, '38-3'),
(65, 42, 1, '39-3'),
(66, 43, 1, '40-3'),
(67, 44, 1, '40-3'),
(68, 45, 1, '51-3'),
(69, 46, 1, '51-3'),
(70, 47, 1, '51-3'),
(71, 48, 1, '51-3'),
(72, 49, 1, '9-2'),
(73, 50, 1, '9-2'),
(74, 51, 1, '9-2'),
(75, 52, 1, '9-2'),
(76, 53, 1, '10-2'),
(77, 54, 1, '10-2'),
(78, 55, 1, '52-3'),
(79, 56, 1, '52-3'),
(80, 57, 1, '52-3'),
(81, 10, 1, '36-3'),
(82, 11, 1, '36-3'),
(83, 21, 1, '35-3'),
(84, 22, 1, '35-3'),
(85, 29, 1, '34-3'),
(86, 30, 1, '34-3'),
(87, 31, 1, '33-3'),
(88, 32, 1, '33-3'),
(89, 33, 1, '33-3'),
(90, 29, 1, '27-3'),
(91, 30, 1, '27-3'),
(92, 58, 1, '11-2'),
(93, 59, 1, '12-2'),
(94, 60, 1, '13-2'),
(95, 61, 1, '14-2'),
(96, 62, 1, '15-2'),
(97, 63, 1, '16-2'),
(98, 64, 1, '17-2'),
(99, 65, 1, '18-2'),
(100, 66, 1, '19-2'),
(101, 67, 1, '20-2'),
(102, 12, 1, '21-2'),
(103, 68, 1, '22-2'),
(104, 55, 1, '53-3'),
(105, 56, 1, '53-3'),
(106, 57, 1, '53-3'),
(107, 12, 1, '54-3'),
(108, 69, 1, '55-3'),
(109, 69, 1, '56-3'),
(110, 70, 1, '57-3'),
(111, 7, 1, '23-2'),
(112, 4, 1, '1-7');

-- --------------------------------------------------------

--
-- 表的结构 `qm_link`
--

CREATE TABLE IF NOT EXISTS `qm_link` (
  `linkid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(5) unsigned DEFAULT '0',
  `typeid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `linktype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `logo` varchar(255) NOT NULL DEFAULT '',
  `introduce` text NOT NULL,
  `username` varchar(30) NOT NULL DEFAULT '',
  `listorder` smallint(5) unsigned NOT NULL DEFAULT '0',
  `elite` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `passed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`linkid`),
  KEY `typeid` (`typeid`,`passed`,`listorder`,`linkid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `qm_link`
--

INSERT INTO `qm_link` (`linkid`, `siteid`, `typeid`, `linktype`, `name`, `url`, `logo`, `introduce`, `username`, `listorder`, `elite`, `passed`, `addtime`) VALUES
(1, 1, 0, 0, '人民网', 'http://www.people.com.cn/', '', '', '', 0, 1, 1, 1495692185),
(2, 1, 0, 0, '新华网', 'http://www.xinhuanet.com/', '', '', '', 0, 1, 1, 1495692207),
(3, 1, 0, 0, '中国网', 'http://www.china.com.cn/', '', '', '', 0, 1, 1, 1495692227),
(5, 1, 0, 0, '法治中国', 'http://legalchinapress.com/', '', '', '', 0, 1, 1, 1499311021),
(6, 1, 0, 0, '央视网', 'http://www.cctv.com/', '', '', '', 0, 1, 1, 1507787126);

-- --------------------------------------------------------

--
-- 表的结构 `qm_log`
--

CREATE TABLE IF NOT EXISTS `qm_log` (
  `logid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `field` varchar(15) NOT NULL,
  `value` int(10) unsigned NOT NULL DEFAULT '0',
  `module` varchar(15) NOT NULL,
  `file` varchar(20) NOT NULL,
  `action` varchar(20) NOT NULL,
  `querystring` varchar(255) NOT NULL,
  `data` mediumtext NOT NULL,
  `userid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(20) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`logid`),
  KEY `module` (`module`,`file`,`action`),
  KEY `username` (`username`,`action`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=316 ;

--
-- 转存表中的数据 `qm_log`
--

INSERT INTO `qm_log` (`logid`, `field`, `value`, `module`, `file`, `action`, `querystring`, `data`, `userid`, `username`, `ip`, `time`) VALUES
(294, '', 0, 'content', '', 'sitemodel', '?m=content&c=sitemodel&a=add', '', 1, 'qimaweb', '127.0.0.1', '2017-12-26 14:08:11'),
(295, '', 0, 'content', '', 'sitemodel', '?m=content&c=sitemodel&a=import', '', 1, 'qimaweb', '127.0.0.1', '2017-12-26 14:09:06'),
(296, '', 0, 'content', '', 'sitemodel', '?m=content&c=sitemodel&a=import', '', 1, 'qimaweb', '127.0.0.1', '2017-12-26 14:09:21'),
(297, '', 0, 'content', '', 'sitemodel', '?m=content&c=sitemodel&a=import', '', 1, 'qimaweb', '127.0.0.1', '2017-12-26 14:10:57'),
(298, '', 0, 'content', '', 'sitemodel', '?m=content&c=sitemodel&a=import', '', 1, 'qimaweb', '127.0.0.1', '2017-12-26 14:10:58'),
(299, '', 0, 'content', '', 'sitemodel', '?m=content&c=sitemodel&a=import', '', 1, 'qimaweb', '127.0.0.1', '2017-12-26 14:11:16'),
(300, '', 0, 'content', '', 'sitemodel', '?m=content&c=sitemodel&a=import', '', 1, 'qimaweb', '127.0.0.1', '2017-12-26 14:11:17'),
(301, '', 0, 'content', '', 'sitemodel', '?m=content&c=sitemodel&a=import', '', 1, 'qimaweb', '127.0.0.1', '2017-12-26 14:11:28'),
(302, '', 0, 'content', '', 'sitemodel', '?m=content&c=sitemodel&a=delete', '', 1, 'qimaweb', '127.0.0.1', '2017-12-26 14:11:40'),
(303, '', 0, 'content', '', 'sitemodel', '?m=content&c=sitemodel&a=import', '', 1, 'qimaweb', '127.0.0.1', '2017-12-26 14:11:50'),
(304, '', 0, 'template', '', 'file', '?m=template&c=file&a=updatefilename', '', 1, 'qimaweb', '127.0.0.1', '2017-12-26 14:13:07'),
(305, '', 0, 'content', '', 'sitemodel', '?m=content&c=sitemodel&a=import', '', 1, 'qimaweb', '127.0.0.1', '2017-12-26 14:14:10'),
(306, '', 0, 'content', '', 'sitemodel', '?m=content&c=sitemodel&a=import', '', 1, 'qimaweb', '127.0.0.1', '2017-12-26 14:14:54'),
(307, '', 0, 'content', '', 'create_html', '?m=content&c=create_html&a=category', '', 1, 'qimaweb', '127.0.0.1', '2017-12-26 14:15:02'),
(308, '', 0, 'admin', '', 'category', '?m=admin&c=category&a=edit', '', 1, 'qimaweb', '127.0.0.1', '2017-12-26 14:15:16'),
(309, '', 0, 'admin', '', 'category', '?m=admin&c=category&a=edit', '', 1, 'qimaweb', '127.0.0.1', '2017-12-26 14:15:23'),
(310, '', 0, 'admin', '', 'category', '?m=admin&c=category&a=edit', '', 1, 'qimaweb', '127.0.0.1', '2017-12-26 14:15:29'),
(311, '', 0, 'admin', '', 'category', '?m=admin&c=category&a=edit', '', 1, 'qimaweb', '127.0.0.1', '2017-12-26 14:15:36'),
(312, '', 0, 'admin', '', 'category', '?m=admin&c=category&a=edit', '', 1, 'qimaweb', '127.0.0.1', '2017-12-26 14:18:36'),
(313, '', 0, 'admin', '', 'category', '?m=admin&c=category&a=edit', '', 1, 'qimaweb', '127.0.0.1', '2017-12-26 14:18:47'),
(314, '', 0, 'admin', '', 'category', '?m=admin&c=category&a=edit', '', 1, 'qimaweb', '127.0.0.1', '2017-12-26 14:19:03'),
(315, '', 0, 'admin', '', 'category', '?m=admin&c=category&a=edit', '', 1, 'qimaweb', '127.0.0.1', '2017-12-26 14:19:07');

-- --------------------------------------------------------

--
-- 表的结构 `qm_menu`
--

CREATE TABLE IF NOT EXISTS `qm_menu` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(40) NOT NULL DEFAULT '',
  `parentid` smallint(6) NOT NULL DEFAULT '0',
  `m` char(20) NOT NULL DEFAULT '',
  `c` char(20) NOT NULL DEFAULT '',
  `a` char(20) NOT NULL DEFAULT '',
  `data` char(100) NOT NULL DEFAULT '',
  `listorder` smallint(6) unsigned NOT NULL DEFAULT '0',
  `display` enum('1','0') NOT NULL DEFAULT '1',
  `project1` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `project2` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `project3` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `project4` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `project5` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `listorder` (`listorder`),
  KEY `parentid` (`parentid`),
  KEY `module` (`m`,`c`,`a`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1630 ;

--
-- 转存表中的数据 `qm_menu`
--

INSERT INTO `qm_menu` (`id`, `name`, `parentid`, `m`, `c`, `a`, `data`, `listorder`, `display`, `project1`, `project2`, `project3`, `project4`, `project5`) VALUES
(1, 'sys_setting', 0, 'admin', 'setting', 'init', '', 1, '1', 0, 1, 1, 1, 1),
(2, 'module', 0, 'admin', 'module', 'init', '', 2, '1', 1, 1, 1, 1, 1),
(4, 'content', 0, 'content', 'content', 'init', '', 4, '1', 1, 1, 1, 1, 1),
(30, 'correlative_setting', 1, 'admin', 'admin', 'admin', '', 0, '1', 1, 1, 1, 1, 1),
(31, 'menu_manage', 977, 'admin', 'menu', 'init', '', 8, '1', 1, 1, 1, 1, 1),
(32, 'posid_manage', 975, 'admin', 'position', 'init', '', 7, '1', 1, 1, 1, 1, 1),
(29, 'module_list', 2, 'admin', 'module', '', '', 0, '1', 1, 1, 1, 1, 1),
(1577, 'module_manage', 2, 'admin', 'module', '', '', 0, '1', 1, 1, 1, 1, 1),
(10, 'panel', 0, 'admin', 'index', 'public_main', '', 0, '1', 0, 1, 1, 1, 1),
(35, 'menu_add', 31, 'admin', 'menu', 'add', '', 0, '1', 1, 1, 1, 1, 1),
(54, 'admin_manage', 49, 'admin', 'admin_manage', 'init', '', 0, '1', 1, 1, 1, 1, 1),
(43, 'category_manage', 975, 'admin', 'category', 'init', 'module=admin', 4, '1', 1, 1, 1, 1, 1),
(42, 'add_category', 43, 'admin', 'category', 'add', 's=0', 1, '1', 1, 1, 1, 1, 1),
(44, 'edit_category', 43, 'admin', 'category', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(46, 'posid_add', 32, 'admin', 'position', 'add', '', 0, '0', 1, 1, 1, 1, 1),
(49, 'admin_setting', 1, 'admin', '', '', '', 0, '1', 1, 1, 1, 1, 1),
(50, 'role_manage', 49, 'admin', 'role', 'init', '', 0, '1', 1, 1, 1, 1, 1),
(51, 'role_add', 50, 'admin', 'role', 'add', '', 0, '1', 1, 1, 1, 1, 1),
(52, 'category_cache', 43, 'admin', 'category', 'public_cache', 'module=admin', 4, '1', 1, 1, 1, 1, 1),
(1622, 'del_poster', 1615, 'poster', 'poster', 'delete', '', 0, '0', 1, 1, 1, 1, 1),
(58, 'admin_add', 54, 'admin', 'admin_manage', 'add', '', 0, '1', 1, 1, 1, 1, 1),
(59, 'model_manage', 975, 'content', 'sitemodel', 'init', '', 5, '1', 1, 1, 1, 1, 1),
(64, 'site_management', 30, 'admin', 'site', 'init', '', 2, '1', 1, 1, 1, 1, 1),
(62, 'add_model', 59, 'content', 'sitemodel', 'add', '', 0, '0', 1, 1, 1, 1, 1),
(1618, 'del_space', 1615, 'poster', 'space', 'delete', '', 0, '0', 1, 1, 1, 1, 1),
(1623, 'poster_stat', 1615, 'poster', 'poster', 'stat', '', 0, '0', 1, 1, 1, 1, 1),
(1616, 'add_space', 1615, 'poster', 'space', 'add', '', 0, '0', 1, 1, 1, 1, 1),
(1619, 'poster_list', 1615, 'poster', 'poster', 'init', '', 0, '0', 1, 1, 1, 1, 1),
(814, 'site_edit', 64, 'admin', 'site', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(821, 'content_publish', 4, 'content', 'content', 'init', '', 0, '1', 1, 1, 1, 1, 1),
(822, 'content_manage', 821, 'content', 'content', 'init', '', 0, '1', 1, 1, 1, 1, 1),
(1624, 'poster_setting', 1615, 'poster', 'space', 'setting', '', 0, '0', 1, 1, 1, 1, 1),
(1617, 'edit_space', 1615, 'poster', 'space', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(852, 'priv_setting', 50, 'admin', 'role', 'priv_setting', '', 0, '0', 1, 1, 1, 1, 1),
(853, 'role_priv', 50, 'admin', 'role', 'role_priv', '', 0, '0', 1, 1, 1, 1, 1),
(868, 'special', 821, 'special', 'special', 'init', '', 0, '1', 1, 1, 1, 1, 1),
(873, 'release_manage', 4, 'release', 'html', 'init', '', 0, '1', 1, 1, 1, 1, 1),
(874, 'type_manage', 975, 'content', 'type_manage', 'init', '', 6, '1', 1, 1, 1, 1, 1),
(875, 'add_type', 874, 'content', 'type_manage', 'add', '', 0, '0', 1, 1, 1, 1, 1),
(1615, 'poster', 29, 'poster', 'space', 'init', '', 0, '1', 1, 1, 1, 1, 1),
(885, 'workflow', 977, 'content', 'workflow', 'init', '', 15, '1', 1, 1, 1, 1, 1),
(888, 'add_workflow', 885, 'content', 'workflow', 'add', '', 0, '1', 1, 1, 1, 1, 1),
(899, 'add_content', 822, 'content', 'content', 'add', '', 0, '0', 1, 1, 1, 1, 1),
(901, 'check_content', 822, 'content', 'content', 'pass', '', 0, '0', 1, 1, 1, 1, 1),
(905, 'create_content_html', 873, 'content', 'create_html', 'show', '', 2, '1', 1, 1, 1, 1, 1),
(906, 'update_urls', 873, 'content', 'create_html', 'update_urls', '', 1, '1', 1, 1, 1, 1, 1),
(914, 'database_toos', 977, 'admin', 'database', 'export', '', 6, '1', 1, 1, 1, 1, 1),
(915, 'database_export', 914, 'admin', 'database', 'export', '', 0, '1', 1, 1, 1, 1, 1),
(916, 'database_import', 914, 'admin', 'database', 'import', '', 0, '1', 1, 1, 1, 1, 1),
(926, 'add_special', 868, 'special', 'special', 'add', '', 0, '1', 1, 1, 1, 1, 1),
(927, 'edit_special', 868, 'special', 'special', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(928, 'special_list', 868, 'special', 'special', 'init', '', 0, '0', 1, 1, 1, 1, 1),
(929, 'special_elite', 868, 'special', 'special', 'elite', '', 0, '0', 1, 1, 1, 1, 1),
(930, 'delete_special', 868, 'special', 'special', 'delete', '', 0, '0', 1, 1, 1, 1, 1),
(934, 'special_listorder', 868, 'special', 'special', 'listorder', '', 0, '0', 1, 1, 1, 1, 1),
(935, 'special_content_list', 868, 'special', 'content', 'init', '', 0, '0', 1, 1, 1, 1, 1),
(936, 'special_content_add', 935, 'special', 'content', 'add', '', 0, '0', 1, 1, 1, 1, 1),
(937, 'special_content_list', 935, 'special', 'content', 'init', '', 0, '0', 1, 1, 1, 1, 1),
(938, 'special_content_edit', 935, 'special', 'content', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(939, 'special_content_delete', 935, 'special', 'content', 'delete', '', 0, '0', 1, 1, 1, 1, 1),
(940, 'special_content_listorder', 935, 'special', 'content', 'listorder', '', 0, '0', 1, 1, 1, 1, 1),
(941, 'special_content_import', 935, 'special', 'special', 'import', '', 0, '0', 1, 1, 1, 1, 1),
(961, 'position_edit', 32, 'admin', 'position', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(970, 'admininfo', 10, 'admin', 'admin_manage', 'init', '', 0, '1', 1, 1, 1, 1, 1),
(971, 'editpwd', 970, 'admin', 'admin_manage', 'public_edit_pwd', '', 1, '1', 1, 1, 1, 1, 1),
(972, 'editinfo', 970, 'admin', 'admin_manage', 'public_edit_info', '', 0, '1', 1, 1, 1, 1, 1),
(975, 'content_settings', 4, 'content', 'content_settings', 'init', '', 0, '1', 1, 1, 1, 1, 1),
(7, 'extend', 0, 'admin', 'extend', 'init_extend', '', 7, '1', 0, 1, 1, 1, 1),
(977, 'extend_all', 7, 'admin', 'extend_all', 'init', '', 0, '1', 1, 1, 1, 1, 1),
(1579, 'module_manage', 1577, 'admin', 'module', 'init', '', 0, '1', 1, 1, 1, 1, 1),
(997, 'log', 977, 'admin', 'log', 'init', '', 0, '1', 1, 1, 1, 1, 1),
(998, 'add_page', 43, 'admin', 'category', 'add', 's=1', 2, '1', 1, 1, 1, 1, 1),
(999, 'add_cat_link', 43, 'admin', 'category', 'add', 's=2', 2, '1', 1, 1, 1, 1, 1),
(1000, 'count_items', 43, 'admin', 'category', 'count_items', '', 5, '1', 1, 1, 1, 1, 1),
(1001, 'cache_all', 977, 'admin', 'cache_all', 'init', '', 0, '1', 1, 1, 1, 1, 1),
(1002, 'create_list_html', 873, 'content', 'create_html', 'category', '', 0, '1', 1, 1, 1, 1, 1),
(1011, 'edit_content', 822, 'content', 'content', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(1012, 'push_to_special', 822, 'content', 'push', 'init', '', 0, '0', 1, 1, 1, 1, 1),
(1023, 'delete_log', 997, 'admin', 'log', 'delete', '', 0, '0', 1, 1, 1, 1, 1),
(1040, 'admin_edit', 54, 'admin', 'admin_manage', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(1626, 'poster_template', 1615, 'poster', 'space', 'poster_template', '', 0, '1', 1, 1, 1, 1, 1),
(1042, 'admin_delete', 54, 'admin', 'admin_manage', 'delete', '', 0, '0', 1, 1, 1, 1, 1),
(1620, 'add_poster', 1615, 'poster', 'poster', 'add', '', 0, '0', 1, 1, 1, 1, 1),
(1050, 'role_edit', 50, 'admin', 'role', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(1621, 'edit_poster', 1615, 'poster', 'poster', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(1052, 'member_manage', 50, 'admin', 'role', 'member_manage', '', 0, '0', 1, 1, 1, 1, 1),
(1053, 'role_delete', 50, 'admin', 'role', 'delete', '', 0, '0', 1, 1, 1, 1, 1),
(1062, 'fields_manage', 59, 'content', 'sitemodel_field', 'init', '', 0, '0', 1, 1, 1, 1, 1),
(1063, 'edit_model_content', 59, 'content', 'sitemodel', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(1064, 'disabled_model', 59, 'content', 'sitemodel', 'disabled', '', 0, '0', 1, 1, 1, 1, 1),
(1065, 'delete_model', 59, 'content', 'sitemodel', 'delete', '', 0, '0', 1, 1, 1, 1, 1),
(1066, 'export_model', 59, 'content', 'sitemodel', 'export', '', 0, '0', 1, 1, 1, 1, 1),
(1067, 'delete', 874, 'content', 'type_manage', 'delete', '', 0, '0', 1, 1, 1, 1, 1),
(1068, 'edit', 874, 'content', 'type_manage', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(1072, 'edit_menu', 31, 'admin', 'menu', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(1073, 'delete_menu', 31, 'admin', 'menu', 'delete', '', 0, '0', 1, 1, 1, 1, 1),
(1074, 'edit_workflow', 885, 'content', 'workflow', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(1075, 'delete_workflow', 885, 'content', 'workflow', 'delete', '', 0, '0', 1, 1, 1, 1, 1),
(1625, 'create_poster_js', 1615, 'poster', 'space', 'create_js', '', 0, '1', 1, 1, 1, 1, 1),
(1239, 'copyfrom_manage', 977, 'admin', 'copyfrom', 'init', '', 0, '1', 1, 1, 1, 1, 1),
(1241, 'move_content', 822, 'content', 'content', 'remove', '', 0, '0', 1, 1, 1, 1, 1),
(1244, 'add_othors', 822, 'content', 'content', 'add_othors', '', 0, '1', 1, 1, 1, 1, 1),
(1348, 'delete_content', 822, 'content', 'content', 'delete', '', 0, '1', 1, 1, 1, 1, 1),
(1360, 'category_batch_edit', 43, 'admin', 'category', 'batch_edit', '', 6, '1', 1, 1, 1, 1, 1),
(1500, 'listorder', 822, 'content', 'content', 'listorder', '', 0, '0', 1, 1, 1, 1, 1),
(1501, 'a_clean_data', 873, 'content', 'content', 'clear_data', '', 0, '1', 0, 0, 0, 0, 0),
(1597, 'edit_link', 1595, 'link', 'link', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(1602, 'check_register', 1595, 'link', 'link', 'check_register', '', 0, '1', 1, 1, 1, 1, 1),
(1598, 'delete_link', 1595, 'link', 'link', 'delete', '', 0, '0', 1, 1, 1, 1, 1),
(1599, 'link_setting', 1595, 'link', 'link', 'setting', '', 0, '1', 1, 1, 1, 1, 1),
(1595, 'link', 29, 'link', 'link', 'init', '', 0, '1', 1, 1, 1, 1, 1),
(1601, 'list_type', 1595, 'link', 'link', 'list_type', '', 0, '1', 1, 1, 1, 1, 1),
(1596, 'add_link', 1595, 'link', 'link', 'add', '', 0, '0', 1, 1, 1, 1, 1),
(1600, 'add_type', 1595, 'link', 'link', 'add_type', '', 0, '1', 1, 1, 1, 1, 1),
(1627, 'attachment_manage', 821, 'attachment', 'manage', 'init', '', 0, '1', 1, 1, 1, 1, 1),
(1628, 'attachment_address_replace', 1627, 'attachment', 'address', 'init', '', 0, '1', 1, 1, 1, 1, 1),
(1629, 'attachment_address_update', 1627, 'attachment', 'address', 'update', '', 0, '0', 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `qm_model`
--

CREATE TABLE IF NOT EXISTS `qm_model` (
  `modelid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `name` char(30) NOT NULL,
  `description` char(100) NOT NULL,
  `tablename` char(20) NOT NULL,
  `setting` text NOT NULL,
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `items` smallint(5) unsigned NOT NULL DEFAULT '0',
  `enablesearch` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `disabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `default_style` char(30) NOT NULL,
  `category_template` char(30) NOT NULL,
  `list_template` char(30) NOT NULL,
  `show_template` char(30) NOT NULL,
  `js_template` varchar(30) NOT NULL,
  `admin_add_template` char(30) NOT NULL,
  `admin_edit_template` char(30) NOT NULL,
  `admin_list_template` char(30) NOT NULL,
  `member_add_template` varchar(30) NOT NULL,
  `member_list_template` varchar(30) NOT NULL,
  `sort` tinyint(3) NOT NULL,
  `type` tinyint(1) NOT NULL,
  PRIMARY KEY (`modelid`),
  KEY `type` (`type`,`siteid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `qm_model`
--

INSERT INTO `qm_model` (`modelid`, `siteid`, `name`, `description`, `tablename`, `setting`, `addtime`, `items`, `enablesearch`, `disabled`, `default_style`, `category_template`, `list_template`, `show_template`, `js_template`, `admin_add_template`, `admin_edit_template`, `admin_list_template`, `member_add_template`, `member_list_template`, `sort`, `type`) VALUES
(2, 1, '新闻模型', '新闻专用模型', 'news', '', 0, 0, 1, 0, 'default', 'category', 'list', 'show', '', 'content_add', 'content_edit', 'content_list', '', '', 0, 0),
(1, 1, '普通会员', '普通会员', 'member_detail', '', 0, 0, 1, 0, '', '', '', '', '', '', '', '', '', '', 0, 2),
(3, 1, '视频模型', '视频专用模型', 'video', '', 0, 0, 1, 0, 'default', 'category_video', 'list_video', 'show_video', '', 'content_add_video', 'content_edit_video', 'content_list_video', '', '', 0, 0),
(7, 1, '直播模型', '直播专用模型', 'direct', '', 0, 0, 1, 0, 'default', 'category_video', 'list_video', 'show_video_direct', '', '', '', '', '', '', 0, 0),
(9, 1, '工作人员名片', '工作人员名片模型', 'jobs', '', 0, 0, 1, 0, 'default', 'category', 'list_reporter', 'show_reporter', '', '', '', '', '', '', 0, 0),
(10, 1, '合作单位模型', '合作单位专用模型', 'sponsor', '', 0, 0, 1, 0, 'default', 'category', 'list_sponsor', 'show', '', '', '', '', '', '', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `qm_model_field`
--

CREATE TABLE IF NOT EXISTS `qm_model_field` (
  `fieldid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `modelid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `field` varchar(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `tips` text NOT NULL,
  `css` varchar(30) NOT NULL,
  `minlength` int(10) unsigned NOT NULL DEFAULT '0',
  `maxlength` int(10) unsigned NOT NULL DEFAULT '0',
  `pattern` varchar(255) NOT NULL,
  `errortips` varchar(255) NOT NULL,
  `formtype` varchar(20) NOT NULL,
  `setting` mediumtext NOT NULL,
  `formattribute` varchar(255) NOT NULL,
  `unsetgroupids` varchar(255) NOT NULL,
  `unsetroleids` varchar(255) NOT NULL,
  `iscore` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `issystem` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `isunique` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `isbase` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `issearch` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `isadd` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `isfulltext` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `isposition` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `listorder` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `disabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `isomnipotent` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`fieldid`),
  KEY `modelid` (`modelid`,`disabled`),
  KEY `field` (`field`,`modelid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=192 ;

--
-- 转存表中的数据 `qm_model_field`
--

INSERT INTO `qm_model_field` (`fieldid`, `modelid`, `siteid`, `field`, `name`, `tips`, `css`, `minlength`, `maxlength`, `pattern`, `errortips`, `formtype`, `setting`, `formattribute`, `unsetgroupids`, `unsetroleids`, `iscore`, `issystem`, `isunique`, `isbase`, `issearch`, `isadd`, `isfulltext`, `isposition`, `listorder`, `disabled`, `isomnipotent`) VALUES
(1, 2, 1, 'catid', '栏目', '', '', 1, 6, '/^[0-9]{1,6}$/', '请选择栏目', 'catid', 'array (\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 0, 0, 1, 0, 0),
(2, 2, 1, 'typeid', '类别', '', '', 0, 0, '', '', 'typeid', 'array (\n  ''minnumber'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 0, 0, 2, 0, 0),
(3, 2, 1, 'title', '标题', '', 'inputtitle', 1, 80, '', '请输入标题', 'title', '', '', '', '', 0, 1, 0, 1, 1, 1, 1, 1, 4, 0, 0),
(4, 2, 1, 'thumb', '缩略图', '', '', 0, 100, '', '', 'image', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''show_type'' => ''1'',\n  ''upload_maxsize'' => ''1024'',\n  ''upload_allowext'' => ''jpg|jpeg|gif|png|bmp'',\n  ''watermark'' => ''0'',\n  ''isselectimage'' => ''1'',\n  ''images_width'' => '''',\n  ''images_height'' => '''',\n)', '', '', '', 0, 1, 0, 0, 0, 1, 0, 1, 14, 0, 0),
(5, 2, 1, 'keywords', '关键词', '多关键词之间用空格或者“,”隔开', '', 0, 40, '', '', 'keyword', 'array (\r\n  ''size'' => ''100'',\r\n  ''defaultvalue'' => '''',\r\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 1, 0, 7, 0, 0),
(6, 2, 1, 'description', '摘要', '', '', 0, 255, '', '', 'textarea', '{"width":"97","height":"46","defaultvalue":"","enablehtml":"0"}', '', '', '', 0, 1, 0, 1, 0, 1, 1, 1, 10, 0, 0),
(7, 2, 1, 'updatetime', '更新时间', '', '', 0, 0, '', '', 'datetime', 'array (\r\n  ''dateformat'' => ''int'',\r\n  ''format'' => ''Y-m-d H:i:s'',\r\n  ''defaulttype'' => ''1'',\r\n  ''defaultvalue'' => '''',\r\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 12, 0, 0),
(8, 2, 1, 'content', '内容', '<div class="content_attr" style="display:none"><label><input name="add_introduce" type="checkbox"  value="1" checked>是否截取内容</label><input type="text" name="introcude_length" value="200" size="3">字符至内容摘要\r\n<label><input type=''checkbox'' name=''auto_thumb'' value="1" checked>是否获取内容第</label><input type="text" name="auto_thumb_no" value="1" size="2" class="">张图片作为标题图片\r\n</div>', '', 1, 999999, '', '内容不能为空', 'editor', '{"toolbar":"full","defaultvalue":"","enablekeylink":"1","replacenum":"2","link_mode":"0","enablesaveimage":"1","height":"","disabled_page":"0"}', '', '', '', 0, 0, 0, 1, 0, 1, 1, 0, 13, 0, 0),
(9, 2, 1, 'pages', '分页方式', '', '', 0, 0, '', '', 'pages', '', '', '-99', '-99', 0, 0, 0, 1, 0, 0, 0, 0, 16, 1, 0),
(10, 2, 1, 'inputtime', '发布时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''fieldtype'' => ''int'',\n  ''format'' => ''Y-m-d H:i:s'',\n  ''defaulttype'' => ''0'',\n)', '', '', '', 0, 1, 0, 0, 0, 0, 0, 1, 17, 0, 0),
(11, 2, 1, 'posids', '推荐位', '', '', 0, 0, '', '', 'posid', 'array (\n  ''cols'' => ''4'',\n  ''width'' => ''125'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 18, 0, 0),
(12, 2, 1, 'url', 'URL', '', '', 0, 100, '', '', 'text', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 50, 0, 0),
(13, 2, 1, 'listorder', '排序', '', '', 0, 6, '', '', 'number', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 51, 0, 0),
(14, 2, 1, 'status', '状态', '', '', 0, 2, '', '', 'box', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 55, 0, 0),
(15, 2, 1, 'template', '内容页模板', '', '', 0, 30, '', '', 'template', 'array (\n  ''size'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 53, 0, 0),
(18, 2, 1, 'relation', '相关文章', '', '', 0, 0, '', '', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''hidden\\'' name=\\''info[relation]\\'' id=\\''relation\\'' value=\\''{FIELD_VALUE}\\'' style=\\''50\\'' >\r\n<ul class="list-dot" id="relation_text"></ul>\r\n<div>\r\n<input type=\\''button\\'' value="添加相关" onclick="omnipotent(\\''selectid\\'',\\''?m=content&c=content&a=public_relationlist&modelid={MODELID}\\'',\\''添加相关文章\\'',1)" class="button" style="width:66px;">\r\n<span class="edit_content">\r\n<input type=\\''button\\'' value="显示已有" onclick="show_relation({MODELID},{ID})" class="button" style="width:66px;">\r\n</span>\r\n</div>'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n)', '', '2,6,4,5,1,17,18,7', '', 0, 0, 0, 0, 0, 0, 1, 0, 15, 0, 0),
(20, 2, 1, 'copyfrom', '来源', '', '', 0, 100, '', '', 'copyfrom', 'array (\n  ''defaultvalue'' => '''',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 8, 0, 0),
(21, 2, 1, 'username', '责任编辑', '', '', 0, 20, '', '', 'text', '{"size":"","defaultvalue":"","ispassword":"0"}', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 98, 0, 0),
(22, 2, 1, 'islink', '转向链接', '', '', 0, 0, '', '', 'islink', '', '', '', '', 0, 1, 0, 0, 0, 1, 0, 0, 30, 0, 0),
(23, 1, 1, 'birthday', '生日', '', '', 0, 0, '', '生日格式错误', 'datetime', 'array (\n  ''fieldtype'' => ''date'',\n  ''format'' => ''Y-m-d'',\n  ''defaulttype'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0),
(24, 3, 1, 'catid', '栏目', '', '', 1, 6, '/^[0-9]{1,6}$/', '请选择栏目', 'catid', 'array (\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 0, 0, 1, 0, 0),
(25, 3, 1, 'typeid', '类别', '', '', 0, 0, '', '', 'typeid', 'array (\n  ''minnumber'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 0, 0, 2, 0, 0),
(26, 3, 1, 'title', '标题', '', 'inputtitle', 1, 80, '', '请输入标题', 'title', '', '', '', '', 0, 1, 0, 1, 1, 1, 1, 1, 4, 0, 0),
(27, 3, 1, 'keywords', '关键词', '多关键词之间用空格或者“,”隔开', '', 0, 40, '', '', 'keyword', 'array (\r\n  ''size'' => ''100'',\r\n  ''defaultvalue'' => '''',\r\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 1, 0, 5, 0, 0),
(28, 3, 1, 'description', '摘要', '', '', 0, 255, '', '', 'textarea', '{"width":"97","height":"46","defaultvalue":"","enablehtml":"0"}', '', '', '', 0, 1, 0, 1, 0, 1, 1, 1, 10, 0, 0),
(29, 3, 1, 'updatetime', '更新时间', '', '', 0, 0, '', '', 'datetime', 'array (\r\n  ''dateformat'' => ''int'',\r\n  ''format'' => ''Y-m-d H:i:s'',\r\n  ''defaulttype'' => ''1'',\r\n  ''defaultvalue'' => '''',\r\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 12, 0, 0),
(30, 3, 1, 'content', '内容', '<div class="content_attr" style="display:none"><label><input name="add_introduce" type="checkbox"  value="1" checked>是否截取内容</label><input type="text" name="introcude_length" value="200" size="3">字符至内容摘要\r\n<label><input type=''checkbox'' name=''auto_thumb'' value="1" checked>是否获取内容第</label><input type="text" name="auto_thumb_no" value="1" size="2" class="">张图片作为标题图片\r\n</div>', '', 1, 999999, '', '内容不能为空', 'editor', '{"toolbar":"full","defaultvalue":"","enablekeylink":"1","replacenum":"2","link_mode":"0","enablesaveimage":"1","height":"","disabled_page":"0"}', '', '', '', 0, 0, 0, 1, 0, 1, 1, 0, 13, 1, 0),
(31, 3, 1, 'thumb', '缩略图', '', '', 0, 100, '', '', 'image', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''show_type'' => ''1'',\n  ''upload_maxsize'' => ''1024'',\n  ''upload_allowext'' => ''jpg|jpeg|gif|png|bmp'',\n  ''watermark'' => ''0'',\n  ''isselectimage'' => ''1'',\n  ''images_width'' => '''',\n  ''images_height'' => '''',\n)', '', '', '', 0, 1, 0, 0, 0, 1, 0, 1, 14, 0, 0),
(32, 3, 1, 'relation', '相关文章', '', '', 0, 0, '', '', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''hidden\\'' name=\\''info[relation]\\'' id=\\''relation\\'' value=\\''{FIELD_VALUE}\\'' style=\\''50\\'' >\r\n<ul class="list-dot" id="relation_text"></ul>\r\n<div>\r\n<input type=\\''button\\'' value="添加相关" onclick="omnipotent(\\''selectid\\'',\\''?m=content&c=content&a=public_relationlist&modelid={MODELID}\\'',\\''添加相关文章\\'',1)" class="button" style="width:66px;">\r\n<span class="edit_content">\r\n<input type=\\''button\\'' value="显示已有" onclick="show_relation({MODELID},{ID})" class="button" style="width:66px;">\r\n</span>\r\n</div>'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n)', '', '2,6,4,5,1,17,18,7', '', 0, 0, 0, 0, 0, 0, 1, 0, 15, 0, 0),
(33, 3, 1, 'pages', '分页方式', '', '', 0, 0, '', '', 'pages', '', '', '-99', '-99', 0, 0, 0, 1, 0, 0, 0, 0, 16, 1, 0),
(34, 3, 1, 'inputtime', '发布时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''fieldtype'' => ''int'',\n  ''format'' => ''Y-m-d H:i:s'',\n  ''defaulttype'' => ''0'',\n)', '', '', '', 0, 1, 0, 0, 0, 0, 0, 1, 17, 0, 0),
(35, 3, 1, 'posids', '推荐位', '', '', 0, 0, '', '', 'posid', 'array (\n  ''cols'' => ''4'',\n  ''width'' => ''125'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 18, 0, 0),
(37, 3, 1, 'url', 'URL', '', '', 0, 100, '', '', 'text', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 50, 0, 0),
(38, 3, 1, 'listorder', '排序', '', '', 0, 6, '', '', 'number', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 51, 0, 0),
(39, 3, 1, 'template', '内容页模板', '', '', 0, 30, '', '', 'template', 'array (\n  ''size'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 53, 0, 0),
(41, 3, 1, 'status', '状态', '', '', 0, 2, '', '', 'box', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 55, 0, 0),
(43, 3, 1, 'username', '责任编辑', '', '', 0, 20, '', '', 'text', '{"size":"","defaultvalue":"","ispassword":"0"}', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 98, 0, 0),
(44, 3, 1, 'islink', '转向链接', '', '', 0, 0, '', '', 'islink', '{"size":""}', '', '', '', 0, 1, 0, 0, 0, 1, 0, 0, 20, 0, 0),
(47, 3, 1, 'file_id', '视频ID', '', '', 0, 35, '', '', 'text', '{"size":"50","defaultvalue":"","ispassword":"0"}', '', '', '', 0, 1, 0, 0, 0, 1, 1, 1, 999, 0, 0),
(46, 3, 1, 'duration', '视频时长', '', '', 0, 10, '', '', 'number', '{"minnumber":"1","maxnumber":"","decimaldigits":"0","size":"","defaultvalue":"0","rangetype":"0"}', '', '', '', 0, 1, 0, 0, 0, 1, 0, 1, 999, 0, 0),
(123, 7, 1, 'listorder', '排序', '', '', 0, 6, '', '', 'number', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 51, 0, 0),
(124, 7, 1, 'template', '内容页模板', '', '', 0, 30, '', '', 'template', 'array (\n  ''size'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 53, 0, 0),
(122, 7, 1, 'url', 'URL', '', '', 0, 100, '', '', 'text', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 50, 0, 0),
(121, 7, 1, 'posids', '推荐位', '', '', 0, 0, '', '', 'posid', 'array (\n  ''cols'' => ''4'',\n  ''width'' => ''125'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 18, 0, 0),
(120, 7, 1, 'inputtime', '发布时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''fieldtype'' => ''int'',\n  ''format'' => ''Y-m-d H:i:s'',\n  ''defaulttype'' => ''0'',\n)', '', '', '', 0, 1, 0, 0, 0, 0, 0, 1, 17, 0, 0),
(119, 7, 1, 'pages', '分页方式', '', '', 0, 0, '', '', 'pages', '', '', '-99', '-99', 0, 0, 0, 1, 0, 0, 0, 0, 16, 1, 0),
(118, 7, 1, 'relation', '相关文章', '', '', 0, 0, '', '', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''hidden\\'' name=\\''info[relation]\\'' id=\\''relation\\'' value=\\''{FIELD_VALUE}\\'' style=\\''50\\'' >\r\n<ul class="list-dot" id="relation_text"></ul>\r\n<div>\r\n<input type=\\''button\\'' value="添加相关" onclick="omnipotent(\\''selectid\\'',\\''?m=content&c=content&a=public_relationlist&modelid={MODELID}\\'',\\''添加相关文章\\'',1)" class="button" style="width:66px;">\r\n<span class="edit_content">\r\n<input type=\\''button\\'' value="显示已有" onclick="show_relation({MODELID},{ID})" class="button" style="width:66px;">\r\n</span>\r\n</div>'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n)', '', '2,6,4,5,1,17,18,7', '', 0, 0, 0, 0, 0, 0, 1, 0, 15, 0, 0),
(117, 7, 1, 'thumb', '缩略图', '', '', 0, 100, '', '', 'image', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''show_type'' => ''1'',\n  ''upload_maxsize'' => ''1024'',\n  ''upload_allowext'' => ''jpg|jpeg|gif|png|bmp'',\n  ''watermark'' => ''0'',\n  ''isselectimage'' => ''1'',\n  ''images_width'' => '''',\n  ''images_height'' => '''',\n)', '', '', '', 0, 1, 0, 0, 0, 1, 0, 1, 14, 0, 0),
(116, 7, 1, 'content', '内容', '<div class="content_attr"><label><input name="add_introduce" type="checkbox"  value="1" checked>是否截取内容</label><input type="text" name="introcude_length" value="200" size="3">字符至内容摘要\r\n<label><input type=''checkbox'' name=''auto_thumb'' value="1" checked>是否获取内容第</label><input type="text" name="auto_thumb_no" value="1" size="2" class="">张图片作为标题图片\r\n</div>', '', 1, 999999, '', '内容不能为空', 'editor', 'array (\n  ''toolbar'' => ''full'',\n  ''defaultvalue'' => '''',\n  ''enablekeylink'' => ''1'',\n  ''replacenum'' => ''2'',\n  ''link_mode'' => ''0'',\n  ''enablesaveimage'' => ''1'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 1, 0, 13, 1, 0),
(115, 7, 1, 'updatetime', '更新时间', '', '', 0, 0, '', '', 'datetime', 'array (\r\n  ''dateformat'' => ''int'',\r\n  ''format'' => ''Y-m-d H:i:s'',\r\n  ''defaulttype'' => ''1'',\r\n  ''defaultvalue'' => '''',\r\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 12, 0, 0),
(114, 7, 1, 'description', '视频介绍', '', '', 0, 255, '', '', 'textarea', '{"width":"98","height":"46","defaultvalue":"","enablehtml":"0"}', '', '', '', 0, 1, 0, 1, 0, 1, 1, 1, 11, 0, 0),
(113, 7, 1, 'keywords', '关键词', '多关键词之间用空格或者“,”隔开', '', 0, 40, '', '', 'keyword', 'array (\r\n  ''size'' => ''100'',\r\n  ''defaultvalue'' => '''',\r\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 1, 0, 10, 0, 0),
(112, 7, 1, 'title', '标题', '', 'inputtitle', 1, 80, '', '请输入标题', 'title', '', '', '', '', 0, 1, 0, 1, 1, 1, 1, 1, 3, 0, 0),
(69, 3, 1, 'author', '作者', '', '', 0, 0, '', '', 'text', '{"size":"50","defaultvalue":"","ispassword":"0"}', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 6, 0, 0),
(70, 3, 1, 'copyfrom', '来源', '', '', 0, 0, '', '', 'copyfrom', '{"defaultvalue":""}', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 7, 0, 0),
(111, 7, 1, 'typeid', '类别', '', '', 0, 0, '', '', 'typeid', 'array (\n  ''minnumber'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 0, 0, 2, 0, 0),
(110, 7, 1, 'catid', '栏目', '', '', 1, 6, '/^[0-9]{1,6}$/', '请选择栏目', 'catid', 'array (\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 0, 0, 1, 0, 0),
(89, 2, 1, 'author', '作者', '', '', 0, 20, '', '', 'text', '{"size":"50","defaultvalue":"","ispassword":"0"}', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 9, 0, 0),
(125, 7, 1, 'status', '状态', '', '', 0, 2, '', '', 'box', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 55, 0, 0),
(126, 7, 1, 'username', '责任编辑', '', '', 0, 20, '', '', 'text', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 98, 0, 0),
(127, 7, 1, 'islink', '转向链接', '', '', 0, 0, '', '', 'islink', '', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 20, 0, 0),
(128, 7, 1, 'author', '作者', '', '', 0, 0, '', '', 'text', '{"size":"50","defaultvalue":"","ispassword":"0"}', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 4, 0, 0),
(129, 7, 1, 'copyfrom', '来源', '', '', 0, 0, '', '', 'copyfrom', '{"defaultvalue":""}', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 5, 0, 0),
(130, 7, 1, 'channel_id', '直播频道ID', '', '', 0, 0, '', '', 'text', '{"size":"50","defaultvalue":"","ispassword":"0"}', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 7, 0, 0),
(170, 9, 1, 'department', '部门', '', '', 0, 0, '', '', 'text', '{"size":"50","defaultvalue":"","ispassword":"0"}', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 3, 0, 0),
(167, 9, 1, 'status', '状态', '', '', 0, 2, '', '', 'box', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 55, 0, 0),
(166, 9, 1, 'template', '内容页模板', '', '', 0, 30, '', '', 'template', '{"size":"","defaultvalue":""}', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 53, 0, 0),
(165, 9, 1, 'listorder', '排序', '', '', 0, 6, '', '', 'number', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 51, 0, 0),
(163, 9, 1, 'posids', '推荐位', '', '', 0, 0, '', '', 'posid', '{"cols":"4","width":"125"}', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 18, 1, 0),
(164, 9, 1, 'url', 'URL', '', '', 0, 100, '', '', 'text', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 50, 0, 0),
(162, 9, 1, 'inputtime', '发布时间', '', '', 0, 0, '', '', 'datetime', '{"fieldtype":"int","format":"Y-m-d H:i:s","defaulttype":"0"}', '', '', '', 0, 1, 0, 0, 0, 0, 0, 1, 17, 0, 0),
(161, 9, 1, 'pages', '分页方式', '', '', 0, 0, '', '', 'pages', '', '', '-99', '-99', 0, 0, 0, 1, 0, 0, 0, 0, 16, 1, 0),
(160, 9, 1, 'relation', '相关文章', '', '', 0, 0, '', '', 'omnipotent', '{"formtext":"<input type=''hidden'' name=''info[relation]'' id=''relation'' value=''{FIELD_VALUE}'' style=''50'' >\\r\\n<ul class=\\"list-dot\\" id=\\"relation_text\\"><\\/ul>\\r\\n<div>\\r\\n<input type=''button'' value=\\"\\u6dfb\\u52a0\\u76f8\\u5173\\" onclick=\\"omnipotent(''selectid'',''?m=content&c=content&a=public_relationlist&modelid={MODELID}'',''\\u6dfb\\u52a0\\u76f8\\u5173\\u6587\\u7ae0'',1)\\" class=\\"button\\" style=\\"width:66px;\\">\\r\\n<span class=\\"edit_content\\">\\r\\n<input type=''button'' value=\\"\\u663e\\u793a\\u5df2\\u6709\\" onclick=\\"show_relation({MODELID},{ID})\\" class=\\"button\\" style=\\"width:66px;\\">\\r\\n<\\/span>\\r\\n<\\/div>","fieldtype":"varchar","minnumber":"1"}', '', '2,6,4,5,1,17,18,7', '', 0, 0, 0, 0, 0, 0, 1, 0, 15, 1, 0),
(159, 9, 1, 'thumb', '照片', '', '', 0, 100, '', '', 'image', '{"size":"50","defaultvalue":"","show_type":"1","upload_maxsize":"1024","upload_allowext":"jpg|jpeg|gif|png|bmp","watermark":"0","isselectimage":"1","images_width":"","images_height":""}', '', '', '', 0, 1, 0, 0, 0, 1, 0, 1, 14, 0, 0),
(158, 9, 1, 'content', '内容', '<div class="content_attr"><label><input name="add_introduce" type="checkbox"  value="1" checked>是否截取内容</label><input type="text" name="introcude_length" value="200" size="3">字符至内容摘要\r\n<label><input type=''checkbox'' name=''auto_thumb'' value="1" checked>是否获取内容第</label><input type="text" name="auto_thumb_no" value="1" size="2" class="">张图片作为标题图片\r\n</div>', '', 1, 999999, '', '内容不能为空', 'editor', '{"toolbar":"full","defaultvalue":"","enablekeylink":"1","replacenum":"2","link_mode":"0","enablesaveimage":"1"}', '', '', '', 0, 0, 0, 1, 0, 1, 1, 0, 13, 1, 0),
(157, 9, 1, 'updatetime', '更新时间', '', '', 0, 0, '', '', 'datetime', '{"dateformat":"int","format":"Y-m-d H:i:s","defaulttype":"1","defaultvalue":""}', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 12, 0, 0),
(171, 9, 1, 'post', '职务', '', '', 0, 0, '', '', 'text', '{"size":"50","defaultvalue":"","ispassword":"0"}', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 4, 0, 0),
(156, 9, 1, 'description', '简介', '', '', 0, 255, '', '', 'textarea', '{"width":"97","height":"188","defaultvalue":"","enablehtml":"0"}', '', '', '', 0, 1, 0, 1, 0, 1, 1, 1, 10, 0, 0),
(155, 9, 1, 'keywords', '关键词', '多关键词之间用空格或者“,”隔开', '', 0, 40, '', '', 'keyword', '{"size":"100","defaultvalue":""}', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 1, 0, 99, 1, 0),
(154, 9, 1, 'title', '姓名', '', 'inputtitle', 1, 80, '', '请输入标题', 'title', '', '', '', '', 0, 1, 0, 1, 1, 1, 1, 1, 2, 0, 0),
(153, 9, 1, 'typeid', '类别', '', '', 0, 0, '', '', 'typeid', '{"minnumber":"","defaultvalue":""}', '', '', '', 0, 1, 0, 1, 1, 1, 0, 0, 99, 0, 0),
(152, 9, 1, 'catid', '栏目', '', '', 1, 6, '/^[0-9]{1,6}$/', '请选择栏目', 'catid', '{"defaultvalue":""}', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 0, 0, 1, 0, 0),
(168, 9, 1, 'username', '责任编辑', '', '', 0, 20, '', '', 'text', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 98, 0, 0),
(169, 9, 1, 'islink', '转向链接', '', '', 0, 0, '', '', 'islink', '', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 20, 1, 0),
(172, 9, 1, 'number', '编号', '', '', 0, 0, '', '', 'text', '{"size":"50","defaultvalue":"","ispassword":"0"}', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 5, 0, 0),
(173, 10, 1, 'catid', '栏目', '', '', 1, 6, '/^[0-9]{1,6}$/', '请选择栏目', 'catid', '{"defaultvalue":""}', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 0, 0, 1, 0, 0),
(174, 10, 1, 'typeid', '类别', '', '', 0, 0, '', '', 'typeid', '{"minnumber":"","defaultvalue":""}', '', '', '', 0, 1, 0, 1, 1, 1, 0, 0, 2, 1, 0),
(175, 10, 1, 'title', '单位名称', '', 'inputtitle', 1, 80, '', '请输入标题', 'title', '', '', '', '', 0, 1, 0, 1, 1, 1, 1, 1, 4, 0, 0),
(176, 10, 1, 'keywords', '关键词', '多关键词之间用空格或者“,”隔开', '', 0, 40, '', '', 'keyword', '{"size":"100","defaultvalue":""}', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 1, 0, 7, 1, 0),
(177, 10, 1, 'description', '摘要', '', '', 0, 255, '', '', 'textarea', '{"width":"98","height":"46","defaultvalue":"","enablehtml":"0"}', '', '', '', 0, 1, 0, 1, 0, 1, 1, 1, 10, 1, 0),
(178, 10, 1, 'updatetime', '更新时间', '', '', 0, 0, '', '', 'datetime', '{"dateformat":"int","format":"Y-m-d H:i:s","defaulttype":"1","defaultvalue":""}', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 12, 0, 0),
(179, 10, 1, 'content', '内容', '<div class="content_attr"><label><input name="add_introduce" type="checkbox"  value="1" checked>是否截取内容</label><input type="text" name="introcude_length" value="200" size="3">字符至内容摘要\r\n<label><input type=''checkbox'' name=''auto_thumb'' value="1" checked>是否获取内容第</label><input type="text" name="auto_thumb_no" value="1" size="2" class="">张图片作为标题图片\r\n</div>', '', 1, 999999, '', '内容不能为空', 'editor', '{"toolbar":"full","defaultvalue":"","enablekeylink":"1","replacenum":"2","link_mode":"0","enablesaveimage":"1"}', '', '', '', 0, 0, 0, 1, 0, 1, 1, 0, 13, 1, 0),
(180, 10, 1, 'thumb', '单位LOGO', '', '', 0, 100, '', '', 'image', '{"size":"50","defaultvalue":"","show_type":"1","upload_maxsize":"1024","upload_allowext":"jpg|jpeg|gif|png|bmp","watermark":"0","isselectimage":"1","images_width":"","images_height":""}', '', '', '', 0, 1, 0, 0, 0, 1, 0, 1, 14, 0, 0),
(191, 10, 1, 'link', '合作单位网站', '', '', 0, 120, '', '', 'text', '{"size":"50","defaultvalue":"","ispassword":"0"}', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 5, 0, 0),
(181, 10, 1, 'relation', '相关文章', '', '', 0, 0, '', '', 'omnipotent', '{"formtext":"<input type=''hidden'' name=''info[relation]'' id=''relation'' value=''{FIELD_VALUE}'' style=''50'' >\\r\\n<ul class=\\"list-dot\\" id=\\"relation_text\\"><\\/ul>\\r\\n<div>\\r\\n<input type=''button'' value=\\"\\u6dfb\\u52a0\\u76f8\\u5173\\" onclick=\\"omnipotent(''selectid'',''?m=content&c=content&a=public_relationlist&modelid={MODELID}'',''\\u6dfb\\u52a0\\u76f8\\u5173\\u6587\\u7ae0'',1)\\" class=\\"button\\" style=\\"width:66px;\\">\\r\\n<span class=\\"edit_content\\">\\r\\n<input type=''button'' value=\\"\\u663e\\u793a\\u5df2\\u6709\\" onclick=\\"show_relation({MODELID},{ID})\\" class=\\"button\\" style=\\"width:66px;\\">\\r\\n<\\/span>\\r\\n<\\/div>","fieldtype":"varchar","minnumber":"1"}', '', '2,6,4,5,1,17,18,7', '', 0, 0, 0, 0, 0, 0, 1, 0, 15, 1, 0),
(182, 10, 1, 'pages', '分页方式', '', '', 0, 0, '', '', 'pages', '', '', '-99', '-99', 0, 0, 0, 1, 0, 0, 0, 0, 16, 1, 0),
(183, 10, 1, 'inputtime', '发布时间', '', '', 0, 0, '', '', 'datetime', '{"fieldtype":"int","format":"Y-m-d H:i:s","defaulttype":"0"}', '', '', '', 0, 1, 0, 0, 0, 0, 0, 1, 17, 0, 0),
(184, 10, 1, 'posids', '推荐位', '', '', 0, 0, '', '', 'posid', '{"cols":"4","width":"125"}', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 18, 1, 0),
(185, 10, 1, 'url', 'URL', '', '', 0, 100, '', '', 'text', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 50, 0, 0),
(186, 10, 1, 'listorder', '排序', '', '', 0, 6, '', '', 'number', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 51, 0, 0),
(187, 10, 1, 'template', '内容页模板', '', '', 0, 30, '', '', 'template', '{"size":"","defaultvalue":""}', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 53, 0, 0),
(188, 10, 1, 'status', '状态', '', '', 0, 2, '', '', 'box', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 55, 0, 0),
(189, 10, 1, 'username', '责任编辑', '', '', 0, 20, '', '', 'text', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 98, 0, 0),
(190, 10, 1, 'islink', '转向链接', '', '', 0, 0, '', '', 'islink', '', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 20, 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `qm_module`
--

CREATE TABLE IF NOT EXISTS `qm_module` (
  `module` varchar(15) NOT NULL,
  `name` varchar(20) NOT NULL,
  `url` varchar(50) NOT NULL,
  `iscore` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `version` varchar(50) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL,
  `setting` mediumtext NOT NULL,
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `disabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `installdate` date NOT NULL DEFAULT '0000-00-00',
  `updatedate` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`module`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `qm_module`
--

INSERT INTO `qm_module` (`module`, `name`, `url`, `iscore`, `version`, `description`, `setting`, `listorder`, `disabled`, `installdate`, `updatedate`) VALUES
('admin', 'admin', '', 1, '1.0', '', '{"admin_email":"qimaweb@163.com","maxloginfailedtimes":"8","minrefreshtime":"2","mail_type":"1","mail_server":"smtp.qq.com","mail_port":"25","category_ajax":"0","mail_user":"xxx@qq.com","mail_auth":"1","mail_from":"xxx@qq.com","mail_password":"","errorlog_size":"20"}', 0, 0, '2010-10-18', '2010-10-18'),
('special', '专题', '', 0, '1.0', '', '', 0, 0, '2010-09-06', '2010-09-06'),
('content', '内容模块', '', 1, '1.0', '', '', 0, 0, '2010-09-06', '2010-09-06'),
('search', '全站搜索', '', 0, '1.0', '', 'array (\n  ''fulltextenble'' => ''1'',\n  ''relationenble'' => ''1'',\n  ''suggestenable'' => ''1'',\n  ''sphinxenable'' => ''0'',\n  ''sphinxhost'' => ''10.228.134.102'',\n  ''sphinxport'' => ''9312'',\n)', 0, 0, '2010-09-06', '2010-09-06'),
('attachment', '附件', 'attachment', 1, '1.0', '', '', 0, 0, '2010-09-01', '2010-09-06'),
('block', '碎片', '', 1, '1.0', '', '', 0, 0, '2010-09-01', '2010-09-06'),
('link', '友情链接', '', 0, '1.0', '', 'array (\n  1 => \n  array (\n    ''is_post'' => ''1'',\n    ''enablecheckcode'' => ''0'',\n  ),\n)', 0, 0, '2010-09-06', '2010-09-06'),
('poster', '广告模块', 'poster/', 0, '1.0', '广告模块', '{"enablehits":"1","ext":"","maxsize":""}', 0, 0, '2017-05-23', '2017-05-23');

-- --------------------------------------------------------

--
-- 表的结构 `qm_news`
--

CREATE TABLE IF NOT EXISTS `qm_news` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `typeid` smallint(5) unsigned NOT NULL,
  `title` varchar(80) NOT NULL DEFAULT '',
  `style` char(24) NOT NULL DEFAULT '',
  `thumb` varchar(100) NOT NULL DEFAULT '',
  `keywords` char(40) NOT NULL DEFAULT '',
  `description` mediumtext NOT NULL,
  `posids` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `url` char(100) NOT NULL,
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `sysadd` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `islink` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `username` varchar(20) NOT NULL DEFAULT '',
  `inputtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `author` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `status` (`status`,`listorder`,`id`),
  KEY `listorder` (`catid`,`status`,`listorder`,`id`),
  KEY `catid` (`catid`,`status`,`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- 转存表中的数据 `qm_news`
--

INSERT INTO `qm_news` (`id`, `catid`, `typeid`, `title`, `style`, `thumb`, `keywords`, `description`, `posids`, `url`, `listorder`, `status`, `sysadd`, `islink`, `username`, `inputtime`, `updatetime`, `author`) VALUES
(23, 4, 0, '测试新闻', '', 'http://0285.qimaweb.com/attachment/2017/1008/20171008080947478.jpg', '测试新闻', 'Font Awesome为您提供可缩放的矢量图标，您可以使用CSS所提供的所有特性对它们进行更改，包括：大小、颜色、阴影或者其它任何支持的效果。   ', 0, 'http://0285.qimaweb.com/show/4/23/1.html', 0, 99, 1, 0, 'qimaweb', 1507464570, 1507465147, '');

-- --------------------------------------------------------

--
-- 表的结构 `qm_news_data`
--

CREATE TABLE IF NOT EXISTS `qm_news_data` (
  `id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `content` mediumtext NOT NULL,
  `paginationtype` tinyint(1) NOT NULL,
  `maxcharperpage` mediumint(6) NOT NULL,
  `template` varchar(30) NOT NULL,
  `paytype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `relation` varchar(255) NOT NULL DEFAULT '',
  `copyfrom` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `qm_news_data`
--

INSERT INTO `qm_news_data` (`id`, `content`, `paginationtype`, `maxcharperpage`, `template`, `paytype`, `relation`, `copyfrom`) VALUES
(23, 'Font Awesome为您提供可缩放的矢量图标，您可以使用CSS所提供的所有特性对它们进行更改，包括：大小、颜色、阴影或者其它任何支持的效果。<br />\r\nAdblock Plus 插件会通过设置&ldquo;Remove Social Media Buttons&rdquo;来移除 Font Awesome 的这些标志图标。 然而我们并不会用一些特殊方法来强行显示。如果您认为这是一个错误，请 向 Adblock Plus 报告这个问题。 在Adblock Plus修复这个问题之前，您需要自行修改这些图标的类名来解决这个问题。', 0, 0, '', 0, '', '|0');

-- --------------------------------------------------------

--
-- 表的结构 `qm_page`
--

CREATE TABLE IF NOT EXISTS `qm_page` (
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `title` varchar(160) NOT NULL,
  `style` varchar(24) NOT NULL,
  `keywords` varchar(40) NOT NULL,
  `content` text NOT NULL,
  `template` varchar(30) NOT NULL,
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  KEY `catid` (`catid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `qm_page`
--

INSERT INTO `qm_page` (`catid`, `title`, `style`, `keywords`, `content`, `template`, `updatetime`) VALUES
(13, '市场合作', ';', '', '市场合作市场合作市场合作市场合作', '', 0),
(15, '市场合作', ';', '', '市场合作', '', 0),
(16, '招贤纳士', ';', '', '招贤纳士', '', 0),
(17, '常见问题', ';', '', '常见问题', '', 0),
(19, '顾问理事会', ';', '', '顾问理事会', '', 0),
(12, '关于我们', ';', '', '关于我们关于我们关于我们关于我们', '', 0),
(14, '招贤纳士', ';', '', '<h1>招聘以下职位：</h1>\r\n<br />\r\n<h3>一、PHP程序员</h3>\r\n薪资待遇：<br />\r\n月薪13000，提供食宿，试用期1个月，试用期薪资8000<br />\r\n<br />\r\n', '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `qm_position`
--

CREATE TABLE IF NOT EXISTS `qm_position` (
  `posid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `modelid` smallint(5) unsigned DEFAULT '0',
  `catid` smallint(5) unsigned DEFAULT '0',
  `name` char(30) NOT NULL DEFAULT '',
  `maxnum` smallint(5) NOT NULL DEFAULT '20',
  `extention` char(100) DEFAULT NULL,
  `listorder` smallint(5) unsigned NOT NULL DEFAULT '0',
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `thumb` varchar(150) NOT NULL DEFAULT '',
  PRIMARY KEY (`posid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `qm_position`
--

INSERT INTO `qm_position` (`posid`, `modelid`, `catid`, `name`, `maxnum`, `extention`, `listorder`, `siteid`, `thumb`) VALUES
(1, 3, 0, '特别推荐', 20, '', 0, 1, '');

-- --------------------------------------------------------

--
-- 表的结构 `qm_position_data`
--

CREATE TABLE IF NOT EXISTS `qm_position_data` (
  `id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `posid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `module` char(20) DEFAULT NULL,
  `modelid` smallint(6) unsigned DEFAULT '0',
  `thumb` tinyint(1) NOT NULL DEFAULT '0',
  `data` mediumtext,
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '1',
  `listorder` mediumint(8) DEFAULT '0',
  `expiration` int(10) NOT NULL,
  `extention` char(30) DEFAULT NULL,
  `synedit` tinyint(1) DEFAULT '0',
  KEY `posid` (`posid`),
  KEY `listorder` (`listorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `qm_poster`
--

CREATE TABLE IF NOT EXISTS `qm_poster` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `name` varchar(40) NOT NULL,
  `spaceid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `type` varchar(10) NOT NULL,
  `setting` text NOT NULL,
  `startdate` int(10) unsigned NOT NULL DEFAULT '0',
  `enddate` int(10) unsigned NOT NULL DEFAULT '0',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `hits` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `clicks` smallint(5) unsigned NOT NULL DEFAULT '0',
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `disabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `spaceid` (`spaceid`,`siteid`,`disabled`,`listorder`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `qm_poster`
--

INSERT INTO `qm_poster` (`id`, `siteid`, `name`, `spaceid`, `type`, `setting`, `startdate`, `enddate`, `addtime`, `hits`, `clicks`, `listorder`, `disabled`) VALUES
(9, 1, '广告栏 位置可更换', 6, 'text', '{"1":{"title":"\\u5e7f\\u544a\\u680f \\u4f4d\\u7f6e\\u53ef\\u66f4\\u6362","linkurl":"https:\\/\\/www.qimaweb.com\\/"}}', 1499964992, 1501952160, 1499965020, 80, 2, 0, 0),
(7, 1, '首页广告位', 4, 'text', '{"1":{"title":"\\u9996\\u9875\\u5e7f\\u544a\\u4f4d","linkurl":"https:\\/\\/www.qimaweb.com\\/"}}', 1499964498, 1501951680, 1499964529, 197, 2, 0, 0),
(8, 1, 'BANNER位置可更换', 5, 'text', '{"1":{"title":"BANNER\\u4f4d\\u7f6e\\u53ef\\u66f4\\u6362","linkurl":"https:\\/\\/www.qimaweb.com\\/"}}', 1499964751, 1501951920, 1499964777, 84, 3, 0, 0),
(10, 1, '首页对联广告', 7, 'images', '{"1":{"linkurl":"https:\\/\\/www.qimaweb.com\\/","imageurl":"http:\\/\\/0284.qimaweb.com\\/attachment\\/2017\\/0714\\/20170714010426183.jpg","alt":"\\u5de6\\u8fb9"},"2":{"linkurl":"https:\\/\\/www.qimaweb.com\\/","imageurl":"http:\\/\\/0284.qimaweb.com\\/attachment\\/2017\\/0714\\/20170714010432572.jpg","alt":"\\u53f3\\u8fb9"}}', 1499965430, 1501952580, 1499965501, 186, 1, 0, 0),
(11, 1, '法治环保中华行', 4, 'text', '{"1":{"title":"\\u6c99\\u68d8\\u6d3b\\u6027\\u9176\\u6d17\\u6da4\\u5242\\u2014\\u2014\\u5f53\\u4e4b\\u65e0\\u6127\\u7684\\u73af\\u4fdd\\u536b\\u58eb\\u3000","linkurl":"http:\\/\\/www.xinhuanet.com\\/politics\\/dlfjdwn\\/zhuantipian\\/zlztp.htm"}}', 1507786662, 1509428220, 1507786704, 96, 1, 0, 0),
(12, 1, 'http://www.xinhuanet.com/politics/dlfjdw', 5, 'text', '{"1":{"title":"http:\\/\\/www.xinhuanet.com\\/politics\\/dlfjdwn\\/zhuantipian\\/zlztp.htm","linkurl":"http:\\/\\/www.xinhuanet.com\\/politics\\/dlfjdwn\\/zhuantipian\\/zlztp.htm"}}', 1507786721, 1510465121, 1507786731, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `qm_poster_201705`
--

CREATE TABLE IF NOT EXISTS `qm_poster_201705` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `spaceid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `username` char(20) NOT NULL,
  `area` char(40) NOT NULL,
  `ip` char(15) NOT NULL,
  `referer` char(120) NOT NULL,
  `clicktime` int(10) unsigned NOT NULL DEFAULT '0',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`,`type`,`ip`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- 转存表中的数据 `qm_poster_201705`
--

INSERT INTO `qm_poster_201705` (`id`, `pid`, `siteid`, `spaceid`, `username`, `area`, `ip`, `referer`, `clicktime`, `type`) VALUES
(37, 1, 1, 1, '', 'LAN', '127.0.0.1', 'http://192.168.1.113/admin/extend?m=poster&c=space&a=public_preview&spaceid=1', 1495614502, 0),
(38, 4, 1, 1, '', 'LAN', '192.168.1.113', 'http://192.168.1.113/admin/extend?m=poster&c=space&a=public_preview&spaceid=1', 1495619856, 0);

-- --------------------------------------------------------

--
-- 表的结构 `qm_poster_201707`
--

CREATE TABLE IF NOT EXISTS `qm_poster_201707` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `spaceid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `username` char(20) NOT NULL,
  `area` char(40) NOT NULL,
  `ip` char(15) NOT NULL,
  `referer` char(120) NOT NULL,
  `clicktime` int(10) unsigned NOT NULL DEFAULT '0',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`,`type`,`ip`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=561 ;

--
-- 转存表中的数据 `qm_poster_201707`
--

INSERT INTO `qm_poster_201707` (`id`, `pid`, `siteid`, `spaceid`, `username`, `area`, `ip`, `referer`, `clicktime`, `type`) VALUES
(1, 6, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1499963519, 0),
(2, 6, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1499963554, 0),
(3, 6, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1499963584, 0),
(4, 6, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1499963600, 0),
(5, 6, 1, 0, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1499963636, 1),
(6, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1499964551, 0),
(7, 7, 1, 0, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1499964554, 1),
(8, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1499964557, 0),
(9, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/admin/extend?m=poster&c=space&a=public_preview&spaceid=4', 1499964738, 0),
(10, 7, 1, 0, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/admin/extend?m=poster&c=space&a=public_preview&spaceid=4', 1499964740, 1),
(11, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/admin/extend?m=poster&c=space&a=public_preview&spaceid=5', 1499964913, 0),
(12, 8, 1, 0, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/admin/extend?m=poster&c=space&a=public_preview&spaceid=5', 1499964914, 1),
(13, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1499965225, 0),
(14, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1499965226, 0),
(15, 9, 1, 0, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1499965227, 1),
(16, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1499965242, 0),
(17, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1499965524, 0),
(18, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1499965635, 0),
(19, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1499965636, 0),
(20, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1499965643, 0),
(21, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1499965644, 0),
(22, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1499965849, 0),
(23, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1499965850, 0),
(24, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1499966015, 0),
(25, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1499966016, 0),
(26, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1499966050, 0),
(27, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1499966051, 0),
(28, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1499966072, 0),
(29, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1499966073, 0),
(30, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1499966107, 0),
(31, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1499966108, 0),
(32, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1499966162, 0),
(33, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1499966163, 0),
(34, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1499966179, 0),
(35, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1499966180, 0),
(36, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1499966196, 0),
(37, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1499966197, 0),
(38, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1499966203, 0),
(39, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1499966204, 0),
(40, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1499966212, 0),
(41, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1499966213, 0),
(42, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1499966256, 0),
(43, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1499966257, 0),
(44, 10, 1, 0, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1499966259, 1),
(45, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1499966262, 0),
(46, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1499966263, 0),
(47, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500008939, 0),
(48, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500008939, 0),
(49, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500008974, 0),
(50, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500008974, 0),
(51, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500014165, 0),
(52, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500014166, 0),
(53, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500014424, 0),
(54, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500014425, 0),
(55, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500014430, 0),
(56, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500014431, 0),
(57, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500014481, 0),
(58, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500014482, 0),
(59, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500020800, 0),
(60, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500020801, 0),
(61, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/10/1.html', 1500020814, 0),
(62, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500024056, 0),
(63, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500024057, 0),
(64, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500024120, 0),
(65, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500024121, 0),
(66, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500024135, 0),
(67, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500024136, 0),
(68, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500024139, 0),
(69, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500024140, 0),
(70, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500024143, 0),
(71, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500024144, 0),
(72, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500024147, 0),
(73, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500024148, 0),
(74, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500024164, 0),
(75, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500024165, 0),
(76, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500024217, 0),
(77, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500024218, 0),
(78, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500024264, 0),
(79, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500024264, 0),
(80, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500024270, 0),
(81, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500024270, 0),
(82, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500024346, 0),
(83, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500024347, 0),
(84, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500024410, 0),
(85, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500024411, 0),
(86, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500024439, 0),
(87, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500024440, 0),
(88, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500024459, 0),
(89, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500024459, 0),
(90, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500024510, 0),
(91, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500024511, 0),
(92, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500024559, 0),
(93, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500024560, 0),
(94, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500024572, 0),
(95, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500024573, 0),
(96, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500024633, 0),
(97, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500024634, 0),
(98, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500024661, 0),
(99, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500024662, 0),
(100, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500024690, 0),
(101, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500024691, 0),
(102, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500024810, 0),
(103, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500024811, 0),
(104, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500024842, 0),
(105, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500024842, 0),
(106, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500024908, 0),
(107, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500024908, 0),
(108, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500024918, 0),
(109, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500024918, 0),
(110, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500024932, 0),
(111, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500024932, 0),
(112, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500025220, 0),
(113, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500025221, 0),
(114, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500037665, 0),
(115, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500037665, 0),
(116, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500037789, 0),
(117, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500037789, 0),
(118, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500037829, 0),
(119, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500037829, 0),
(120, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500037886, 0),
(121, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500037886, 0),
(122, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500037970, 0),
(123, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500037970, 0),
(124, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500038274, 0),
(125, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500038275, 0),
(126, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500038281, 0),
(127, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500038282, 0),
(128, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500038471, 0),
(129, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500038472, 0),
(130, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500038539, 0),
(131, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500038540, 0),
(132, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500038610, 0),
(133, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500038611, 0),
(134, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500038675, 0),
(135, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500038676, 0),
(136, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500038690, 0),
(137, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500038691, 0),
(138, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500038821, 0),
(139, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500038822, 0),
(140, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500038832, 0),
(141, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500038833, 0),
(142, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500038845, 0),
(143, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500038846, 0),
(144, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500038865, 0),
(145, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500038866, 0),
(146, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500038941, 0),
(147, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500038942, 0),
(148, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500039361, 0),
(149, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500039362, 0),
(150, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500039640, 0),
(151, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500039640, 0),
(152, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500039856, 0),
(153, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500039856, 0),
(154, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500039971, 0),
(155, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500039972, 0),
(156, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500039994, 0),
(157, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500039995, 0),
(158, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500040036, 0),
(159, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500040036, 0),
(160, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500041791, 0),
(161, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500041792, 0),
(162, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500041918, 0),
(163, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500041919, 0),
(164, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500041932, 0),
(165, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500041933, 0),
(166, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500042770, 0),
(167, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500042770, 0),
(168, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500775262, 0),
(169, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500775263, 0),
(170, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500775921, 0),
(171, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500775922, 0),
(172, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500775975, 0),
(173, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500775976, 0),
(174, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500775996, 0),
(175, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500775997, 0),
(176, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500776027, 0),
(177, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500776028, 0),
(178, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500776066, 0),
(179, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500776067, 0),
(180, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500776131, 0),
(181, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500776132, 0),
(182, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500776141, 0),
(183, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500776142, 0),
(184, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500776148, 0),
(185, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500776171, 0),
(186, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500776172, 0),
(187, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500776243, 0),
(188, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500776244, 0),
(189, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500776409, 0),
(190, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500776409, 0),
(191, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500776434, 0),
(192, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500776434, 0),
(193, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500776485, 0),
(194, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500776485, 0),
(195, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500776507, 0),
(196, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500776507, 0),
(197, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500776524, 0),
(198, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500776524, 0),
(199, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500776550, 0),
(200, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500776550, 0),
(201, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500776572, 0),
(202, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500776572, 0),
(203, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500776605, 0),
(204, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500776605, 0),
(205, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500776680, 0),
(206, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500776680, 0),
(207, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500776862, 0),
(208, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500776862, 0),
(209, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500776867, 0),
(210, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500776867, 0),
(211, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php?m=admin', 1500776872, 0),
(212, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php?m=admin', 1500776872, 0),
(213, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500776903, 0),
(214, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500776903, 0),
(215, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500776944, 0),
(216, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500776944, 0),
(217, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500776991, 0),
(218, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500776991, 0),
(219, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500777013, 0),
(220, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500777013, 0),
(221, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500777106, 0),
(222, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500777107, 0),
(223, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500777108, 0),
(224, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500777108, 0),
(225, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500777196, 0),
(226, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500777196, 0),
(227, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500777222, 0),
(228, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500777222, 0),
(229, 10, 1, 7, '', 'LAN', '127.0.0.1', '', 1500777234, 0),
(230, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500777248, 0),
(231, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500777248, 0),
(232, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500777331, 0),
(233, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500777332, 0),
(234, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500777342, 0),
(235, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500777343, 0),
(236, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500777353, 0),
(237, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500777354, 0),
(238, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500777379, 0),
(239, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500777380, 0),
(240, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500782248, 0),
(241, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500782249, 0),
(242, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500871065, 0),
(243, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500871065, 0),
(244, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500872678, 0),
(245, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500872679, 0),
(246, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500872783, 0),
(247, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500872783, 0),
(248, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500872796, 0),
(249, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500872796, 0),
(250, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500872903, 0),
(251, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500872903, 0),
(252, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500872904, 0),
(253, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500872904, 0),
(254, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500872907, 0),
(255, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500872907, 0),
(256, 8, 1, 0, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500872912, 1),
(257, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500873118, 0),
(258, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500873119, 0),
(259, 9, 1, 0, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500873119, 1),
(260, 8, 1, 0, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500873121, 1),
(261, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500873359, 0),
(262, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500873359, 0),
(263, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500873366, 0),
(264, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500873366, 0),
(265, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500873466, 0),
(266, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500873466, 0),
(267, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500873476, 0),
(268, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500873476, 0),
(269, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500873547, 0),
(270, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500873547, 0),
(271, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500873644, 0),
(272, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500873644, 0),
(273, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500873721, 0),
(274, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500873722, 0),
(275, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500873803, 0),
(276, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500873804, 0),
(277, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500873859, 0),
(278, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500873860, 0),
(279, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500874120, 0),
(280, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500874121, 0),
(281, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500874164, 0),
(282, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500874165, 0),
(283, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500874224, 0),
(284, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500874225, 0),
(285, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500874268, 0),
(286, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500874268, 0),
(287, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500874306, 0),
(288, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500874307, 0),
(289, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500874737, 0),
(290, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500874737, 0),
(291, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500875348, 0),
(292, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500875349, 0),
(293, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500875421, 0),
(294, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500875422, 0),
(295, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500875455, 0),
(296, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500875456, 0),
(297, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500875546, 0),
(298, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500875547, 0),
(299, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500875580, 0),
(300, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500875581, 0),
(301, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500875602, 0),
(302, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500875603, 0),
(303, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500875652, 0),
(304, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500875653, 0),
(305, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500875714, 0),
(306, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500875715, 0),
(307, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500875725, 0),
(308, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500875726, 0),
(309, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500875732, 0),
(310, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500875733, 0),
(311, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500875740, 0),
(312, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500875741, 0),
(313, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500875771, 0),
(314, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500875772, 0),
(315, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500875781, 0),
(316, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500875782, 0),
(317, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500875792, 0),
(318, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500875793, 0),
(319, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500876607, 0),
(320, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500876608, 0),
(321, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/20/1.html', 1500877454, 0),
(322, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/20/1.html', 1500877454, 0),
(323, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500890123, 0),
(324, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500890125, 0),
(325, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500890214, 0),
(326, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500890214, 0),
(327, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500890407, 0),
(328, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500890407, 0),
(329, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500890409, 0),
(330, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500890409, 0),
(331, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500890478, 0),
(332, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500890478, 0),
(333, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/10/1.html', 1500890492, 0),
(334, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/10/1.html', 1500890493, 0),
(335, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/10/1.html', 1500890498, 0),
(336, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/10/1.html', 1500890499, 0),
(337, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500890524, 0),
(338, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500890525, 0),
(339, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php?m=special&c=index&a=show&id=1', 1500893576, 0),
(340, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php?m=special&c=index&a=show&id=1', 1500893577, 0),
(341, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php?m=special&c=index&a=show&id=1', 1500893874, 0),
(342, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php?m=special&c=index&a=show&id=1', 1500894064, 0),
(343, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php?m=special&c=index&a=show&id=1', 1500894091, 0),
(344, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php?m=special&c=index&a=show&id=1', 1500894093, 0),
(345, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php?m=special&c=index&a=show&id=1', 1500895073, 0),
(346, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500895900, 0),
(347, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500895901, 0),
(348, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php?m=special&c=index&id=2', 1500895914, 0),
(349, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php?m=special&c=index&id=2', 1500895915, 0),
(350, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php?m=special&c=index&id=2', 1500895916, 0),
(351, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php?m=special&c=index&id=2', 1500895917, 0),
(352, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php?m=special&c=index&id=2', 1500896133, 0),
(353, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php?m=special&c=index&id=2', 1500896134, 0),
(354, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php?m=special&c=index&id=2', 1500896690, 0),
(355, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php?m=special&c=index&id=2', 1500896700, 0),
(356, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php?m=special&c=index&id=2', 1500896701, 0),
(357, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php?m=special&c=index&specialid=2', 1500896757, 0),
(358, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php?m=special&c=index&specialid=2', 1500896759, 0),
(359, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php?m=special&c=index&specialid=2', 1500896760, 0),
(360, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php?m=special&c=index&specialid=2', 1500896772, 0),
(361, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php?m=special&c=index&specialid=2', 1500896773, 0),
(362, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500966132, 0),
(363, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500966132, 0),
(364, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/special/2.html', 1500966586, 0),
(365, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/special/2.html', 1500966587, 0),
(366, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/special/2.html', 1500966682, 0),
(367, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/special/2.html', 1500966683, 0),
(368, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/special/2.html', 1500966789, 0),
(369, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/special/2.html', 1500966790, 0),
(370, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/special/2.html', 1500966818, 0),
(371, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/special/2.html', 1500966819, 0),
(372, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/special/2.html', 1500967003, 0),
(373, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/special/2.html', 1500967004, 0),
(374, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/special/2.html', 1500967052, 0),
(375, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/special/2.html', 1500967053, 0),
(376, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/special/2.html', 1500967087, 0),
(377, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/special/2.html', 1500967088, 0),
(378, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/special/2.html', 1500967155, 0),
(379, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/special/2.html', 1500967156, 0),
(380, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php?m=special&c=index&a=type&specialid=2&typeid=60', 1500967210, 0),
(381, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/special/2.html', 1500967237, 0),
(382, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/special/2.html', 1500967238, 0),
(383, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/10/1.html', 1500967278, 0),
(384, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/10/1.html', 1500967279, 0),
(385, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/10/1.html', 1500967305, 0),
(386, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/10/1.html', 1500967305, 0),
(387, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/10/1.html', 1500967378, 0),
(388, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/10/1.html', 1500967378, 0),
(389, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500970366, 0),
(390, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500970366, 0),
(391, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/10/1.html', 1500970369, 0),
(392, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/10/1.html', 1500970369, 0),
(393, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500970822, 0),
(394, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500970823, 0),
(395, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500970936, 0),
(396, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500970937, 0),
(397, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500971073, 0),
(398, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500971074, 0),
(399, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500971156, 0),
(400, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500971157, 0),
(401, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500972046, 0),
(402, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500972047, 0),
(403, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500972063, 0),
(404, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500972064, 0),
(405, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500972073, 0),
(406, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500972074, 0),
(407, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500972080, 0),
(408, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500972081, 0),
(409, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500972097, 0),
(410, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500972098, 0),
(411, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500972106, 0),
(412, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500972107, 0),
(413, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500972145, 0),
(414, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500972146, 0),
(415, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500972174, 0),
(416, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500972175, 0),
(417, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500972199, 0),
(418, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500972200, 0),
(419, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500972213, 0),
(420, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500972214, 0),
(421, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500972231, 0),
(422, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500972232, 0),
(423, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500972260, 0),
(424, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500972261, 0),
(425, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500972345, 0),
(426, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500972346, 0),
(427, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500972400, 0),
(428, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500972401, 0),
(429, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500972450, 0),
(430, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500972451, 0),
(431, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500972488, 0),
(432, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500972489, 0),
(433, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500972530, 0),
(434, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500972531, 0),
(435, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500972575, 0),
(436, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500972576, 0),
(437, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500972630, 0),
(438, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500972631, 0),
(439, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500972716, 0),
(440, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500972717, 0),
(441, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500972766, 0),
(442, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500972767, 0),
(443, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500972835, 0),
(444, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500972836, 0),
(445, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500972853, 0),
(446, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500972854, 0),
(447, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500972901, 0),
(448, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500972902, 0),
(449, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500972944, 0),
(450, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500972945, 0),
(451, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500972975, 0),
(452, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500972976, 0),
(453, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500973000, 0),
(454, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500973001, 0),
(455, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500973010, 0),
(456, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500973011, 0),
(457, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500973127, 0),
(458, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500973128, 0),
(459, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500973147, 0),
(460, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500973148, 0),
(461, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500973211, 0),
(462, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500973212, 0),
(463, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500973291, 0),
(464, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500973292, 0),
(465, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500973318, 0),
(466, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500973319, 0),
(467, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500973371, 0),
(468, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500973373, 0),
(469, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500973478, 0),
(470, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500973479, 0),
(471, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500973526, 0),
(472, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500973527, 0),
(473, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500973544, 0),
(474, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500973545, 0),
(475, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500973606, 0),
(476, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500973607, 0),
(477, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500973626, 0),
(478, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500973627, 0),
(479, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500973639, 0),
(480, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500973640, 0),
(481, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500973659, 0),
(482, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500973660, 0),
(483, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500973678, 0),
(484, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500973679, 0),
(485, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500973806, 0),
(486, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500973807, 0),
(487, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500974008, 0),
(488, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500974009, 0),
(489, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500974025, 0),
(490, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500974026, 0),
(491, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500974332, 0),
(492, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500974333, 0),
(493, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500974383, 0),
(494, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500974384, 0),
(495, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500974414, 0),
(496, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500974415, 0),
(497, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500974434, 0),
(498, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500974435, 0),
(499, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500974466, 0),
(500, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500974467, 0),
(501, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500974511, 0),
(502, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500974512, 0),
(503, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500974525, 0),
(504, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500974526, 0),
(505, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500974575, 0),
(506, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500974576, 0),
(507, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500974623, 0),
(508, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500974624, 0),
(509, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500974646, 0),
(510, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500974647, 0),
(511, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500974654, 0),
(512, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500974702, 0),
(513, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500974703, 0),
(514, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500974716, 0),
(515, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500974717, 0),
(516, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500974725, 0),
(517, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/index.php', 1500974726, 0),
(518, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/10/1.html', 1500974743, 0),
(519, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/10/1.html', 1500974745, 0),
(520, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/10/1.html', 1500974749, 0),
(521, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/10/1.html', 1500974750, 0),
(522, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/10/1.html', 1500974754, 0),
(523, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/10/1.html', 1500974755, 0),
(524, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/10/1.html', 1500974767, 0),
(525, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/10/1.html', 1500974768, 0),
(526, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/10/1.html', 1500974890, 0),
(527, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/10/1.html', 1500974891, 0),
(528, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/10/1.html', 1500974933, 0),
(529, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/10/1.html', 1500974934, 0),
(530, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/10/1.html', 1500974981, 0),
(531, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/10/1.html', 1500974982, 0),
(532, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/10/1.html', 1500975004, 0),
(533, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/10/1.html', 1500975005, 0),
(534, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/10/1.html', 1500975040, 0),
(535, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/10/1.html', 1500975041, 0),
(536, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/10/1.html', 1500975050, 0),
(537, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/10/1.html', 1500975051, 0),
(538, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/10/1.html', 1500975104, 0),
(539, 9, 1, 6, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/10/1.html', 1500975105, 0),
(540, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500975134, 0);
INSERT INTO `qm_poster_201707` (`id`, `pid`, `siteid`, `spaceid`, `username`, `area`, `ip`, `referer`, `clicktime`, `type`) VALUES
(541, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500975135, 0),
(542, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500975139, 0),
(543, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500975140, 0),
(544, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500975142, 0),
(545, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500975143, 0),
(546, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500975147, 0),
(547, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500975148, 0),
(548, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500975151, 0),
(549, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500975152, 0),
(550, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500975185, 0),
(551, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500975186, 0),
(552, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500975194, 0),
(553, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500975195, 0),
(554, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500975281, 0),
(555, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500975282, 0),
(556, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500975285, 0),
(557, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500975286, 0),
(558, 8, 1, 5, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/category/4/1.html', 1500975295, 0),
(559, 10, 1, 7, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500975356, 0),
(560, 7, 1, 4, '', 'LAN', '127.0.0.1', 'http://0284.qimaweb.com/', 1500975357, 0);

-- --------------------------------------------------------

--
-- 表的结构 `qm_poster_201708`
--

CREATE TABLE IF NOT EXISTS `qm_poster_201708` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `spaceid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `username` char(20) NOT NULL,
  `area` char(40) NOT NULL,
  `ip` char(15) NOT NULL,
  `referer` char(120) NOT NULL,
  `clicktime` int(10) unsigned NOT NULL DEFAULT '0',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`,`type`,`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `qm_poster_201710`
--

CREATE TABLE IF NOT EXISTS `qm_poster_201710` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `spaceid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `username` char(20) NOT NULL,
  `area` char(40) NOT NULL,
  `ip` char(15) NOT NULL,
  `referer` char(120) NOT NULL,
  `clicktime` int(10) unsigned NOT NULL DEFAULT '0',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`,`type`,`ip`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=98 ;

--
-- 转存表中的数据 `qm_poster_201710`
--

INSERT INTO `qm_poster_201710` (`id`, `pid`, `siteid`, `spaceid`, `username`, `area`, `ip`, `referer`, `clicktime`, `type`) VALUES
(1, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/', 1509363439, 0),
(2, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/', 1509363442, 0),
(3, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/', 1509363461, 0),
(4, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/', 1509363468, 0),
(5, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/', 1509363581, 0),
(6, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/category/12/1.html', 1509363582, 0),
(7, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/category/12/1.html', 1509363618, 0),
(8, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/category/12/1.html', 1509363620, 0),
(9, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/category/12/1.html', 1509363622, 0),
(10, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/category/12/1.html', 1509363637, 0),
(11, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/category/12/1.html', 1509363674, 0),
(12, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/category/12/1.html', 1509363676, 0),
(13, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/category/12/1.html', 1509363693, 0),
(14, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/category/12/1.html', 1509363705, 0),
(15, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/category/12/1.html', 1509363706, 0),
(16, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/', 1509363708, 0),
(17, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/category/13/1.html', 1509363792, 0),
(18, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/', 1509363828, 0),
(19, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/index.php', 1509363832, 0),
(20, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/index.php', 1509363848, 0),
(21, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/category/13/1.html', 1509363853, 0),
(22, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/category/13/1.html', 1509363857, 0),
(23, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/category/13/1.html', 1509363872, 0),
(24, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/category/13/1.html', 1509363885, 0),
(25, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/category/13/1.html', 1509363887, 0),
(26, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/category/13/1.html', 1509363889, 0),
(27, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/category/13/1.html', 1509363914, 0),
(28, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/category/13/1.html', 1509363926, 0),
(29, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/category/14/1.html', 1509364022, 0),
(30, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/category/14/1.html', 1509364024, 0),
(31, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/category/14/1.html', 1509364035, 0),
(32, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/category/14/1.html', 1509364052, 0),
(33, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/category/14/1.html', 1509364054, 0),
(34, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/category/14/1.html', 1509364055, 0),
(35, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/category/14/1.html', 1509364080, 0),
(36, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/category/14/1.html', 1509364149, 0),
(37, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/category/14/1.html', 1509364184, 0),
(38, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/category/14/1.html', 1509364238, 0),
(39, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/category/14/1.html', 1509364392, 0),
(40, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/category/15/1.html', 1509364394, 0),
(41, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/category/11/1.html', 1509364404, 0),
(42, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/category/11/1.html', 1509364405, 0),
(43, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/category/15/1.html', 1509364424, 0),
(44, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/category/15/1.html', 1509364427, 0),
(45, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/category/15/1.html', 1509364446, 0),
(46, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/category/15/1.html', 1509364453, 0),
(47, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/', 1509364454, 0),
(48, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/', 1509364471, 0),
(49, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/', 1509364645, 0),
(50, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/', 1509364648, 0),
(51, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/', 1509364676, 0),
(52, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/', 1509364800, 0),
(53, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/', 1509364803, 0),
(54, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/category/2/1.html', 1509364805, 0),
(55, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/category/1/1.html', 1509364806, 0),
(56, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/', 1509364808, 0),
(57, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/', 1509364901, 0),
(58, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/', 1509364903, 0),
(59, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/', 1509364904, 0),
(60, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/index.php', 1509364926, 0),
(61, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/category/1/1.html', 1509364927, 0),
(62, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/', 1509364929, 0),
(63, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/', 1509364934, 0),
(64, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/category/2/1.html', 1509364984, 0),
(65, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/', 1509365021, 0),
(66, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/category/2/1.html', 1509365023, 0),
(67, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/', 1509365082, 0),
(68, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/', 1509365086, 0),
(69, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/', 1509365093, 0),
(70, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/', 1509365099, 0),
(71, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/', 1509365149, 0),
(72, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/', 1509365416, 0),
(73, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/', 1509365573, 0),
(74, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/category/6/1.html', 1509365574, 0),
(75, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/category/5/1.html', 1509365576, 0),
(76, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/category/4/1.html', 1509365579, 0),
(77, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/category/4/1.html', 1509365581, 0),
(78, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/show/4/23/1.html', 1509365583, 0),
(79, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/show/4/23/1.html', 1509365594, 0),
(80, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/category/6/1.html', 1509366625, 0),
(81, 11, 1, 4, '', '贵州省', '58.16.237.98', 'http://0285.qimaweb.com/category/9/1.html', 1509366628, 0),
(82, 11, 1, 4, '', '中国', '117.100.86.18', 'http://0285.qimaweb.com/', 1509412668, 0),
(83, 11, 1, 4, '', '中国', '117.100.86.18', 'http://0285.qimaweb.com/', 1509412670, 0),
(84, 11, 1, 4, '', '中国', '117.100.86.18', 'http://0285.qimaweb.com/category/3/1.html', 1509412672, 0),
(85, 11, 1, 4, '', '中国', '117.100.86.18', 'http://0285.qimaweb.com/show/3/57/1.html', 1509412676, 0),
(86, 11, 1, 4, '', '中国', '117.100.86.18', 'http://0285.qimaweb.com/', 1509412715, 0),
(87, 11, 1, 0, '', '中国', '117.100.86.18', 'http://0285.qimaweb.com/', 1509412759, 1),
(88, 11, 1, 4, '', '中国', '117.100.86.18', 'http://0285.qimaweb.com/show/4/23/1.html', 1509412903, 0),
(89, 11, 1, 4, '', '中国', '117.100.86.18', 'http://0285.qimaweb.com/category/3/1.html', 1509413055, 0),
(90, 11, 1, 4, '', '中国', '117.100.86.18', 'http://0285.qimaweb.com/category/9/1.html', 1509413191, 0),
(91, 11, 1, 4, '', '中国', '117.100.86.18', 'http://0285.qimaweb.com/category/8/1.html', 1509413196, 0),
(92, 11, 1, 4, '', '中国', '117.100.86.18', 'http://0285.qimaweb.com/category/8/1.html', 1509413216, 0),
(93, 11, 1, 4, '', '中国', '117.100.86.18', 'http://0285.qimaweb.com/category/2/1.html', 1509413257, 0),
(94, 11, 1, 4, '', '中国', '117.100.86.18', 'http://0285.qimaweb.com/category/1/1.html', 1509413258, 0),
(95, 11, 1, 4, '', '中国', '117.100.86.18', 'http://0285.qimaweb.com/', 1509413259, 0),
(96, 11, 1, 4, '', '中国', '117.100.86.18', 'http://0285.qimaweb.com/', 1509416458, 0),
(97, 11, 1, 4, '', '中国', '117.100.86.18', 'http://0285.qimaweb.com/show/3/57/1.html', 1509416475, 0);

-- --------------------------------------------------------

--
-- 表的结构 `qm_poster_201711`
--

CREATE TABLE IF NOT EXISTS `qm_poster_201711` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `spaceid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `username` char(20) NOT NULL,
  `area` char(40) NOT NULL,
  `ip` char(15) NOT NULL,
  `referer` char(120) NOT NULL,
  `clicktime` int(10) unsigned NOT NULL DEFAULT '0',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`,`type`,`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `qm_poster_201712`
--

CREATE TABLE IF NOT EXISTS `qm_poster_201712` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `spaceid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `username` char(20) NOT NULL,
  `area` char(40) NOT NULL,
  `ip` char(15) NOT NULL,
  `referer` char(120) NOT NULL,
  `clicktime` int(10) unsigned NOT NULL DEFAULT '0',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`,`type`,`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `qm_poster_space`
--

CREATE TABLE IF NOT EXISTS `qm_poster_space` (
  `spaceid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `name` char(50) NOT NULL,
  `type` char(30) NOT NULL,
  `path` char(40) NOT NULL,
  `width` smallint(4) unsigned NOT NULL DEFAULT '0',
  `height` smallint(4) unsigned NOT NULL DEFAULT '0',
  `setting` char(100) NOT NULL,
  `description` char(100) NOT NULL,
  `items` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `disabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`spaceid`),
  KEY `disabled` (`disabled`,`siteid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `qm_poster_space`
--

INSERT INTO `qm_poster_space` (`spaceid`, `siteid`, `name`, `type`, `path`, `width`, `height`, `setting`, `description`, `items`, `disabled`) VALUES
(5, 1, '频道页版位', 'text', 'poster_js/5.js', 0, 0, '{"paddleft":"","paddtop":""}', '', 2, 0),
(4, 1, '首页广告位', 'text', 'poster_js/4.js', 1000, 122, '{"paddleft":"","paddtop":""}', '', 2, 0),
(6, 1, '频道页版位2', 'text', 'poster_js/6.js', 0, 0, '{"paddleft":"","paddtop":""}', '', 1, 0),
(7, 1, '首页对联广告', 'couplet', 'poster_js/7.js', 100, 300, '{"paddleft":"0","paddtop":"200"}', '', 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `qm_praise`
--

CREATE TABLE IF NOT EXISTS `qm_praise` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `aid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文档ID',
  `cid` int(10) unsigned NOT NULL COMMENT '栏目ID',
  `ip` varchar(100) NOT NULL COMMENT 'IP',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- 转存表中的数据 `qm_praise`
--

INSERT INTO `qm_praise` (`id`, `aid`, `cid`, `ip`) VALUES
(23, 0, 4, '127.0.0.1');

-- --------------------------------------------------------

--
-- 表的结构 `qm_queue`
--

CREATE TABLE IF NOT EXISTS `qm_queue` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` char(5) DEFAULT NULL,
  `siteid` smallint(5) unsigned DEFAULT '0',
  `path` varchar(100) DEFAULT NULL,
  `status1` tinyint(1) DEFAULT '0',
  `status2` tinyint(1) DEFAULT '0',
  `status3` tinyint(1) DEFAULT '0',
  `status4` tinyint(1) DEFAULT '0',
  `times` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `siteid` (`siteid`),
  KEY `times` (`times`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `qm_release_point`
--

CREATE TABLE IF NOT EXISTS `qm_release_point` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `host` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `port` varchar(10) DEFAULT '21',
  `pasv` tinyint(1) DEFAULT '0',
  `ssl` tinyint(1) DEFAULT '0',
  `path` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `qm_reporter`
--

CREATE TABLE IF NOT EXISTS `qm_reporter` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `typeid` smallint(5) unsigned NOT NULL,
  `title` varchar(80) NOT NULL DEFAULT '',
  `style` char(24) NOT NULL DEFAULT '',
  `thumb` varchar(100) NOT NULL DEFAULT '',
  `keywords` char(40) NOT NULL DEFAULT '',
  `description` mediumtext NOT NULL,
  `posids` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `url` char(100) NOT NULL,
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `sysadd` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `username` char(20) NOT NULL,
  `inputtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `status` (`status`,`listorder`,`id`),
  KEY `listorder` (`catid`,`status`,`listorder`,`id`),
  KEY `catid` (`catid`,`status`,`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `qm_reporter_data`
--

CREATE TABLE IF NOT EXISTS `qm_reporter_data` (
  `id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `paginationtype` tinyint(1) NOT NULL,
  `maxcharperpage` mediumint(6) NOT NULL,
  `template` varchar(30) NOT NULL,
  `paytype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `post` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `qm_search`
--

CREATE TABLE IF NOT EXISTS `qm_search` (
  `searchid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `typeid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `adddate` int(10) unsigned NOT NULL,
  `data` text NOT NULL,
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`searchid`),
  KEY `typeid` (`typeid`,`id`),
  KEY `siteid` (`siteid`),
  FULLTEXT KEY `data` (`data`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=70 ;

--
-- 转存表中的数据 `qm_search`
--

INSERT INTO `qm_search` (`searchid`, `typeid`, `id`, `adddate`, `data`, `siteid`) VALUES
(55, 57, 54, 1500871105, '8888  ', 1),
(68, 69, 1, 1509806864, '测试 测试 ', 1),
(67, 0, 23, 1507464570, '测试新闻 测试新闻 图标 提供 这个 问题 测试 颜色 这些 新闻 效果 支持 其它 或者 阴影 任何 大小 所有 可以 使用 包括 矢量 特性 它们 进行 更改 错误 认为 一个 如果 这是 之前 报告 修复 需要 自行 修改 强行 显示 设置 方法 插件 通过 特殊 标志 然而 我们 不会 一些 解决', 1),
(41, 57, 27, 1497926638, '重庆合川区：70余人“政法干部”考察清平镇综治工 重庆合川区,“政法干部” 政法 考察 书记 干部 有关 成员 部门 同志 负责 治安 主任 近日 一行 社会 余人 工作', 1),
(36, 0, 1, 1499393416, '中国网  中国网', 1),
(69, 52, 6, 1513329288, '投稿测试2 青蛙', 1);

-- --------------------------------------------------------

--
-- 表的结构 `qm_session`
--

CREATE TABLE IF NOT EXISTS `qm_session` (
  `sessionid` char(32) NOT NULL,
  `userid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ip` char(15) NOT NULL,
  `lastvisit` int(10) unsigned NOT NULL DEFAULT '0',
  `roleid` tinyint(3) unsigned DEFAULT '0',
  `groupid` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `m` char(20) NOT NULL,
  `c` char(20) NOT NULL,
  `a` char(20) NOT NULL,
  `data` char(255) NOT NULL,
  PRIMARY KEY (`sessionid`),
  KEY `lastvisit` (`lastvisit`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `qm_site`
--

CREATE TABLE IF NOT EXISTS `qm_site` (
  `siteid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(30) DEFAULT '',
  `dirname` char(255) DEFAULT '',
  `domain` char(255) DEFAULT '',
  `site_title` char(255) DEFAULT '',
  `keywords` char(255) DEFAULT '',
  `description` char(255) DEFAULT '',
  `release_point` text,
  `default_style` char(50) DEFAULT NULL,
  `template` text,
  `setting` mediumtext,
  `uuid` char(40) DEFAULT '',
  `t_vod` mediumtext COMMENT '腾讯视频VOD',
  `chang_yan` mediumtext COMMENT '畅言配置',
  `t_lvb` mediumtext COMMENT '腾讯LVB直播',
  PRIMARY KEY (`siteid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `qm_site`
--

INSERT INTO `qm_site` (`siteid`, `name`, `dirname`, `domain`, `site_title`, `keywords`, `description`, `release_point`, `default_style`, `template`, `setting`, `uuid`, `t_vod`, `chang_yan`, `t_lvb`) VALUES
(1, '中国行', '', 'http://0285.qimaweb.com/', '中国行', '中国行', '中国行', '', 'default', 'default', '{"upload_maxsize":"2048","upload_allowext":"jpg|jpeg|gif|bmp|png|doc|docx|xls|xlsx|ppt|pptx|pdf|txt|rar|zip|swf","watermark_enable":"0","watermark_minwidth":"300","watermark_minheight":"300","watermark_img":"statics\\\\/images\\\\/water\\\\/\\\\/mark.png","watermark_pct":"85","watermark_quality":"80","watermark_pos":"9"}', 'e18cb54c-3b8e-11e7-900a-086266531d9f', '{"APP_ID":"1253521278","SecretId":"AKIDX1Pejd3yOTPBpJlkhU7ZryufGgvydbBa","SecretKey":"MYZRJF9xd8WjmjieQ0PervoaE3oPpFj6","is_delete":"1"}', '{"APP_ID":"cyrnDOzTs"}', '{"APP_ID":"1251409829","player":{"width":"1200","height":"643"}}');

-- --------------------------------------------------------

--
-- 表的结构 `qm_special`
--

CREATE TABLE IF NOT EXISTS `qm_special` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `aid` int(10) unsigned NOT NULL DEFAULT '0',
  `title` char(60) NOT NULL,
  `typeids` char(100) NOT NULL,
  `thumb` char(100) NOT NULL,
  `banner` char(100) NOT NULL,
  `description` char(255) NOT NULL,
  `url` char(100) NOT NULL,
  `ishtml` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ispage` tinyint(1) unsigned NOT NULL,
  `filename` char(40) NOT NULL,
  `pics` char(100) NOT NULL,
  `voteid` char(60) NOT NULL,
  `style` char(20) NOT NULL,
  `index_template` char(40) NOT NULL,
  `list_template` char(40) NOT NULL,
  `show_template` char(60) NOT NULL,
  `css` text NOT NULL,
  `username` char(40) NOT NULL,
  `userid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
  `listorder` smallint(5) unsigned NOT NULL,
  `elite` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `disabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `isvideo` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `disabled` (`disabled`,`siteid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `qm_special`
--

INSERT INTO `qm_special` (`id`, `siteid`, `aid`, `title`, `typeids`, `thumb`, `banner`, `description`, `url`, `ishtml`, `ispage`, `filename`, `pics`, `voteid`, `style`, `index_template`, `list_template`, `show_template`, `css`, `username`, `userid`, `createtime`, `listorder`, `elite`, `disabled`, `isvideo`) VALUES
(4, 1, 0, '测试的专题', '', 'http://img.zcool.cn/community/014f55556813f00000012b20f7f806.jpg', 'http://img.zcool.cn/community/014f55556813f00000012b20f7f806.jpg', '', 'http://0285.qimaweb.com/special/4.html', 0, 0, '', '', '', '', 'index', '', '', '', 'qimaweb', 0, 1513321078, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `qm_special_content`
--

CREATE TABLE IF NOT EXISTS `qm_special_content` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `specialid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `title` char(80) NOT NULL,
  `style` char(24) NOT NULL,
  `typeid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `thumb` char(100) NOT NULL,
  `keywords` char(40) NOT NULL,
  `description` char(255) NOT NULL,
  `url` char(100) NOT NULL,
  `curl` char(15) NOT NULL,
  `listorder` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `userid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` char(20) NOT NULL,
  `inputtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `searchid` int(8) unsigned NOT NULL DEFAULT '0',
  `islink` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `isdata` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `videoid` int(10) unsigned NOT NULL DEFAULT '0',
  `file_id` char(60) DEFAULT NULL COMMENT '视频ID',
  `recommend` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否推荐',
  PRIMARY KEY (`id`),
  KEY `specialid` (`specialid`,`typeid`,`isdata`),
  KEY `typeid` (`typeid`,`isdata`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `qm_special_content`
--

INSERT INTO `qm_special_content` (`id`, `specialid`, `title`, `style`, `typeid`, `thumb`, `keywords`, `description`, `url`, `curl`, `listorder`, `userid`, `username`, `inputtime`, `updatetime`, `searchid`, `islink`, `isdata`, `videoid`, `file_id`, `recommend`) VALUES
(6, 4, '投稿测试2', '', 70, '', '', '大青蛙带我去', 'http://0285.qimaweb.com/special/show/6/0.html', '', 0, 1, 'qimaweb', 1513329288, 1513329299, 69, 0, 1, 0, '', 1);

-- --------------------------------------------------------

--
-- 表的结构 `qm_special_c_data`
--

CREATE TABLE IF NOT EXISTS `qm_special_c_data` (
  `id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `author` char(40) NOT NULL,
  `content` text NOT NULL,
  `paginationtype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `maxcharperpage` mediumint(6) unsigned NOT NULL DEFAULT '0',
  `style` char(20) NOT NULL,
  `show_template` varchar(30) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `qm_special_c_data`
--

INSERT INTO `qm_special_c_data` (`id`, `author`, `content`, `paginationtype`, `maxcharperpage`, `style`, `show_template`) VALUES
(6, '', '大青蛙带我去', 0, 10000, '', '');

-- --------------------------------------------------------

--
-- 表的结构 `qm_sponsor`
--

CREATE TABLE IF NOT EXISTS `qm_sponsor` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `typeid` smallint(5) unsigned NOT NULL,
  `title` char(80) NOT NULL DEFAULT '',
  `style` char(24) NOT NULL DEFAULT '',
  `thumb` char(100) NOT NULL DEFAULT '',
  `keywords` char(40) NOT NULL DEFAULT '',
  `description` char(255) NOT NULL DEFAULT '',
  `posids` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `url` char(100) NOT NULL,
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `sysadd` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `islink` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `username` char(20) NOT NULL,
  `inputtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `link` varchar(120) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `status` (`status`,`listorder`,`id`),
  KEY `listorder` (`catid`,`status`,`listorder`,`id`),
  KEY `catid` (`catid`,`status`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `qm_sponsor_data`
--

CREATE TABLE IF NOT EXISTS `qm_sponsor_data` (
  `id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `content` text NOT NULL,
  `paginationtype` tinyint(1) NOT NULL,
  `maxcharperpage` mediumint(6) NOT NULL,
  `template` varchar(30) NOT NULL,
  `paytype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `relation` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `qm_type`
--

CREATE TABLE IF NOT EXISTS `qm_type` (
  `typeid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `module` char(15) NOT NULL,
  `modelid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `name` char(30) NOT NULL,
  `parentid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `typedir` char(20) NOT NULL,
  `url` char(100) NOT NULL,
  `template` char(30) NOT NULL,
  `listorder` smallint(5) unsigned NOT NULL DEFAULT '0',
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`typeid`),
  KEY `module` (`module`,`parentid`,`siteid`,`listorder`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=73 ;

--
-- 转存表中的数据 `qm_type`
--

INSERT INTO `qm_type` (`typeid`, `siteid`, `module`, `modelid`, `name`, `parentid`, `typedir`, `url`, `template`, `listorder`, `description`) VALUES
(52, 1, 'search', 0, '专题', 0, 'special', '', '', 4, '专题'),
(1, 1, 'search', 1, '新闻', 0, '', '', '', 1, '新闻模型搜索'),
(57, 1, 'search', 3, '视频模型', 0, '', '', '', 0, ''),
(69, 1, 'search', 7, '直播模型', 0, '', '', '', 0, ''),
(70, 1, 'special', 0, '测试', 4, 'test', 'http://0285.qimaweb.com/special/category/4/70.html', '', 1, ''),
(71, 1, 'special', 0, '测试2', 4, 'test2', 'http://0285.qimaweb.com/special/category/4/71.html', '', 2, ''),
(72, 1, 'special', 0, '测试3', 4, 'test3', 'http://0285.qimaweb.com/special/category/4/72.html', '', 3, '');

-- --------------------------------------------------------

--
-- 表的结构 `qm_video`
--

CREATE TABLE IF NOT EXISTS `qm_video` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `typeid` smallint(5) unsigned NOT NULL,
  `title` char(80) NOT NULL DEFAULT '',
  `style` char(24) NOT NULL DEFAULT '',
  `thumb` char(100) NOT NULL DEFAULT '',
  `keywords` char(40) NOT NULL DEFAULT '',
  `description` mediumtext NOT NULL,
  `posids` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `url` char(100) NOT NULL,
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `sysadd` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `islink` int(10) unsigned NOT NULL DEFAULT '0',
  `username` varchar(20) NOT NULL DEFAULT '',
  `inputtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `duration` int(10) unsigned NOT NULL DEFAULT '0',
  `file_id` varchar(35) NOT NULL DEFAULT '',
  `author` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `status` (`status`,`listorder`,`id`),
  KEY `listorder` (`catid`,`status`,`listorder`,`id`),
  KEY `catid` (`catid`,`status`,`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=58 ;

-- --------------------------------------------------------

--
-- 表的结构 `qm_video_data`
--

CREATE TABLE IF NOT EXISTS `qm_video_data` (
  `id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `content` mediumtext NOT NULL,
  `paginationtype` tinyint(1) NOT NULL,
  `maxcharperpage` mediumint(6) NOT NULL,
  `template` varchar(30) NOT NULL,
  `paytype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `relation` varchar(255) NOT NULL DEFAULT '',
  `copyfrom` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `qm_workflow`
--

CREATE TABLE IF NOT EXISTS `qm_workflow` (
  `workflowid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `steps` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `workname` varchar(20) NOT NULL,
  `description` varchar(255) NOT NULL,
  `setting` text NOT NULL,
  `flag` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`workflowid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `qm_workflow`
--

INSERT INTO `qm_workflow` (`workflowid`, `siteid`, `steps`, `workname`, `description`, `setting`, `flag`) VALUES
(1, 1, 1, '一级审核', '审核一次', '', 0),
(2, 1, 2, '二级审核', '审核两次', '', 0),
(3, 1, 3, '三级审核', '审核三次', '', 0),
(4, 1, 4, '四级审核', '四级审核', '', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
