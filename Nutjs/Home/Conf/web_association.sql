-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-05-12 13:01:03
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
CREATE DATABASE IF NOT EXISTS `web_association` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `web_association`;

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

--
-- 转存表中的数据 `wa_invite_code`
--

INSERT INTO `wa_invite_code` (`invite_code`, `uid`, `date`) VALUES
('uZJsN', '', '0000-00-00 00:00:00'),
('V2KDn', '', '0000-00-00 00:00:00'),
('yaYsV', 'D900', '2016-05-12 12:03:04'),
('z2BLJ', 'D961', '2016-05-12 12:46:43'),
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
-- 表的结构 `wa_ns_buy`
--

CREATE TABLE IF NOT EXISTS `wa_ns_buy` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '字段的ID只',
  `works_id` bigint(20) unsigned NOT NULL COMMENT '课程ID',
  `uid` char(5) NOT NULL COMMENT '购买者的协会编号',
  `score` int(1) DEFAULT NULL COMMENT '作品评分',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='用户购买课程信息' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `wa_ns_buy`
--

INSERT INTO `wa_ns_buy` (`id`, `works_id`, `uid`, `score`) VALUES
(1, 1, 'D961', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `wa_ns_section`
--

CREATE TABLE IF NOT EXISTS `wa_ns_section` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '记录ID',
  `works_id` bigint(20) unsigned NOT NULL COMMENT '作品ID',
  `section_id` int(8) unsigned NOT NULL COMMENT '第几章',
  `section_name` varchar(64) NOT NULL COMMENT '章节名称',
  `update_date` date NOT NULL COMMENT '最后改动时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='作品章节列表' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `wa_ns_section`
--

INSERT INTO `wa_ns_section` (`id`, `works_id`, `section_id`, `section_name`, `update_date`) VALUES
(1, 1, 0, '序言', '2016-05-12'),
(2, 1, 1, 'Git分支使用情景', '2016-05-12'),
(3, 1, 2, '整理分支保持干净', '2016-05-12'),
(4, 1, 3, '远程合作流程', '2016-05-12');

-- --------------------------------------------------------

--
-- 表的结构 `wa_ns_update_log`
--

CREATE TABLE IF NOT EXISTS `wa_ns_update_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '记录ID',
  `works_id` bigint(20) NOT NULL COMMENT '作品ID',
  `log` varchar(250) NOT NULL COMMENT '更新说明',
  `date` date NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='作品更新日志' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `wa_ns_update_log`
--

INSERT INTO `wa_ns_update_log` (`id`, `works_id`, `log`, `date`) VALUES
(1, 1, '创建了序言和基本课程', '2016-05-12');

-- --------------------------------------------------------

--
-- 表的结构 `wa_ns_works_list`
--

CREATE TABLE IF NOT EXISTS `wa_ns_works_list` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '作品ID',
  `author_uid` char(5) NOT NULL COMMENT '作者的协会编号',
  `works_name` varchar(64) NOT NULL COMMENT '作品名称',
  `works_intro` varchar(250) NOT NULL COMMENT '作品简介',
  `works_state` int(1) NOT NULL COMMENT '作品状态,0-隐藏，1-更新中，2-已完结',
  `price` int(10) unsigned NOT NULL COMMENT '作品售价',
  `update_number` int(8) unsigned NOT NULL COMMENT '更新次数',
  `update_date` date NOT NULL COMMENT '最后更新时间',
  `create_date` date NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='NutStore作品信息表' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `wa_ns_works_list`
--

INSERT INTO `wa_ns_works_list` (`id`, `author_uid`, `works_name`, `works_intro`, `works_state`, `price`, `update_number`, `update_date`, `create_date`) VALUES
(1, 'D900', '进一步理解Git', '本课程仅仅是帮助开发者理解Git，而不是教开发者使用Git，因此本课程不会讲解基础的Git操作，除非有必要，Git手册中有的内容本课程几乎不会重复。', 2, 2333, 2, '2016-05-12', '2016-05-12'),
(2, 'D900', 'JavaScript高级特性', '讲解有趣的JavaScript高级特性，原理JavaScript陷阱！', 1, 1000, 0, '2016-05-12', '2016-05-12'),
(3, 'D900', '如何利用JavaScript写一个分布式爬虫', 'RT', 1, 9998, 0, '2016-05-12', '2016-05-12'),
(4, 'D961', '从xHTML过渡到HTML5', '如果你学会了xHTML想要过渡到最新的HTML5，那么本篇课程将会非常适合你', 1, 500, 0, '2016-05-12', '2016-05-12');

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

--
-- 转存表中的数据 `wa_nuts`
--

INSERT INTO `wa_nuts` (`uid`, `nuts`, `cumulative`) VALUES
('D961', 97666, 0);

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
('D093', 'hyF1qt7p6fkb8PT3SGUg', '2016-05-12 12:01:59'),
('D640', 'ZBH0iPhQpGlzw2PLneex', '2016-05-12 11:55:08'),
('D900', 'EaIqNhRdA15BJIPHrd54', '2016-05-12 12:58:27'),
('D951', 'ZHJENIba88QjfMHGP1dn', '2016-05-12 12:00:53'),
('D961', 'tZlXCVOlhG17kgAZ47Bc', '2016-05-12 12:58:50');

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
('200', 'D900', '626954412', '$1$zS5.Au3.$ZYYBUgTlcmMzviZhKRmJm1'),
('200', 'D961', '2826612628', '$1$hM0.WR0.$spmxfUUhXpc0iuO.AcT1d/');

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

--
-- 转存表中的数据 `wa_user_inf`
--

INSERT INTO `wa_user_inf` (`uid`, `name`, `nickname`, `gender`, `age`, `phone`, `school`, `wechat`) VALUES
('D900', '刘伯源', '花生PeA', 1, 21, '15336392006', 'ql', ''),
('D961', '士力架', '花生焦糖巧克力', 1, 20, '12345678910', 'sy', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
