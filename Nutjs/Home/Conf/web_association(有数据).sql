-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-01-27 06:02:33
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
-- 表的结构 `wa_invite_code`
--

CREATE TABLE IF NOT EXISTS `wa_invite_code` (
  `invite_code` char(5) NOT NULL COMMENT '邀请码',
  `uid` char(5) NOT NULL COMMENT '使用者的协会编号',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '使用时间',
  PRIMARY KEY (`invite_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `wa_invite_code`
--

INSERT INTO `wa_invite_code` (`invite_code`, `uid`, `date`) VALUES
('Ut4be', 'D308', '2016-01-27 01:20:31'),
('uxvR3', '', '0000-00-00 00:00:00'),
('uZJsN', '', '0000-00-00 00:00:00'),
('V2KDn', '', '0000-00-00 00:00:00'),
('v6YHK', 'D893', '2016-01-27 12:49:39'),
('X00Gj', 'D383', '2016-01-27 13:01:35'),
('yaYsV', '', '0000-00-00 00:00:00'),
('z2BLJ', '', '0000-00-00 00:00:00'),
('zs7OC', '', '0000-00-00 00:00:00');

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
  `nuts` int(8) unsigned NOT NULL COMMENT '当前的果仁',
  `cumulative` int(8) unsigned NOT NULL COMMENT '累计获得的果仁',
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

--
-- 转存表中的数据 `wa_token`
--

INSERT INTO `wa_token` (`uid`, `token`, `date`) VALUES
('D308', 'IbzQUlClPlAqG1pFeJAa', '2016-01-27 01:20:31'),
('D383', 'zMSYEwo6RQZ5wbN9uwo0', '2016-01-27 13:01:44'),
('D893', 'mWv4Rs6dIoMNJG7yhPcH', '2016-01-27 12:54:42');

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

--
-- 转存表中的数据 `wa_users`
--

INSERT INTO `wa_users` (`state`, `uid`, `qq`, `password`) VALUES
('200', 'D308', '626954412', '$1$/x0.an/.$EwX7jv.s/lWoR0QARAqDY1'),
('100', 'D383', '1600976855', '$1$iU..Dz0.$c4VNX58nRF8jDIfP6Uk8L.'),
('200', 'D893', '1612826240', '$1$es1.PE5.$1xGBQgCoTVd.IGVAruX1M1');

-- --------------------------------------------------------

--
-- 表的结构 `wa_user_inf`
--

CREATE TABLE IF NOT EXISTS `wa_user_inf` (
  `uid` char(5) NOT NULL COMMENT '协会编号',
  `name` varchar(20) NOT NULL COMMENT '用户姓名',
  `gender` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '性别：1=男 2=女',
  `age` int(1) unsigned NOT NULL COMMENT '年龄',
  `phone` varchar(16) NOT NULL COMMENT '手机号',
  `school` char(2) NOT NULL COMMENT '学校：ql青理 sk山科 sy石油',
  `wechat` varchar(16) NOT NULL COMMENT '微信号',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `wa_user_inf`
--

INSERT INTO `wa_user_inf` (`uid`, `name`, `gender`, `age`, `phone`, `school`, `wechat`) VALUES
('D308', '花生', 1, 21, '15336392006', 'ql', 'pea3nut'),
('D893', '张岩', 2, 19, '17854257608', 'sk', 'ZYqing964083');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
