-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-02-18 14:46:01
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `web_association`
--

-- --------------------------------------------------------

--
-- 表的结构 `wa_clock`
--

CREATE TABLE IF NOT EXISTS `wa_clock` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uid` char(5) NOT NULL COMMENT '签到用户的协会编号',
  `date` date NOT NULL COMMENT '签到时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wa_invite_code`
--

CREATE TABLE IF NOT EXISTS `wa_invite_code` (
  `invite_code` char(5) NOT NULL COMMENT '邀请码',
  `uid` char(5) NOT NULL COMMENT '使用者的协会编号',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '使用时间',
  PRIMARY KEY (`invite_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `wa_msg`
--

CREATE TABLE IF NOT EXISTS `wa_msg` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '消息id',
  `uid` char(5) NOT NULL COMMENT '协会编号',
  `msg` text NOT NULL COMMENT '消息',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '发送日期',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wa_nuts`
--

CREATE TABLE IF NOT EXISTS `wa_nuts` (
  `uid` char(5) NOT NULL COMMENT '协会编号',
  `nuts` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '当前的果仁',
  `cumulative` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '累计获得的果仁',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `wa_token`
--

CREATE TABLE IF NOT EXISTS `wa_token` (
  `uid` char(5) NOT NULL COMMENT '协会编号',
  `token` char(20) NOT NULL COMMENT '登录令牌',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '最后登录时间',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `token` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `wa_users`
--

CREATE TABLE IF NOT EXISTS `wa_users` (
  `state` char(3) NOT NULL DEFAULT '000' COMMENT '用户当前的状态',
  `uid` char(5) NOT NULL COMMENT '协会编号',
  `qq` varchar(16) NOT NULL COMMENT '会员QQ号',
  `password` varchar(64) NOT NULL COMMENT '密码的哈希值',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `wa_user_inf`
--

CREATE TABLE IF NOT EXISTS `wa_user_inf` (
  `uid` char(5) NOT NULL COMMENT '协会编号',
  `name` varchar(20) NOT NULL COMMENT '用户姓名',
  `nickname` varchar(64) NOT NULL COMMENT '昵称',
  `gender` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '性别：1=男 2=女',
  `age` int(1) unsigned NOT NULL COMMENT '年龄',
  `phone` varchar(16) NOT NULL COMMENT '手机号',
  `school` char(2) NOT NULL COMMENT '学校：ql青理 sk山科 sy石油',
  `wechat` varchar(16) NOT NULL COMMENT '微信号',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
