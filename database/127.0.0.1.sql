-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1
-- 生成日期: 2013 年 01 月 02 日 10:17
-- 服务器版本: 5.5.27
-- PHP 版本: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `web2`
--
CREATE DATABASE `web2` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `web2`;

-- --------------------------------------------------------

--
-- 表的结构 `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `cid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `did` int(10) unsigned NOT NULL COMMENT '评论的书籍',
  `uid` int(10) unsigned NOT NULL COMMENT '评论者',
  `content` varchar(150) COLLATE utf8_bin NOT NULL COMMENT '评论内容',
  `comtime` date NOT NULL COMMENT '评论时间',
  PRIMARY KEY (`cid`),
  UNIQUE KEY `cid` (`cid`),
  KEY `did` (`did`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='用户评论' AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `crew`
--

CREATE TABLE IF NOT EXISTS `crew` (
  `gid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `jointime` date NOT NULL COMMENT '加入时间',
  PRIMARY KEY (`gid`,`uid`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='组员列表';

-- --------------------------------------------------------

--
-- 表的结构 `document`
--

CREATE TABLE IF NOT EXISTS `document` (
  `did` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(20) COLLATE utf8_bin NOT NULL COMMENT '文献标题',
  `author` varchar(20) COLLATE utf8_bin NOT NULL COMMENT '文献作者',
  `pubdate` date NOT NULL COMMENT '出版时间',
  `description` varchar(150) COLLATE utf8_bin NOT NULL COMMENT '文献描述',
  `tag` varchar(100) COLLATE utf8_bin NOT NULL COMMENT '文献标签',
  `picture` varchar(50) COLLATE utf8_bin NOT NULL COMMENT '封面路径',
  `good` int(10) unsigned NOT NULL COMMENT '好评率',
  `bad` int(10) unsigned NOT NULL COMMENT '差评率',
  PRIMARY KEY (`did`),
  UNIQUE KEY `did` (`did`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='MyNote文献列表' AUTO_INCREMENT=32 ;

-- --------------------------------------------------------

--
-- 表的结构 `friend`
--

CREATE TABLE IF NOT EXISTS `friend` (
  `uid1` int(10) unsigned NOT NULL,
  `uid2` int(10) unsigned NOT NULL,
  `setime` date NOT NULL COMMENT '建立时间',
  PRIMARY KEY (`uid1`,`uid2`),
  KEY `uid2` (`uid2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='好友列表';

-- --------------------------------------------------------

--
-- 表的结构 `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `gid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL COMMENT '创建者ID',
  `name` varchar(20) COLLATE utf8_bin NOT NULL COMMENT '组名',
  `setime` date NOT NULL COMMENT '建立时间',
  `description` varchar(50) COLLATE utf8_bin NOT NULL COMMENT '简介',
  PRIMARY KEY (`gid`),
  UNIQUE KEY `gid` (`gid`),
  UNIQUE KEY `name` (`name`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='组列表' AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `note`
--

CREATE TABLE IF NOT EXISTS `note` (
  `uid` int(10) unsigned NOT NULL,
  `did` int(10) unsigned NOT NULL,
  `content` varchar(300) COLLATE utf8_bin NOT NULL COMMENT '笔记内容',
  `modtime` date NOT NULL COMMENT '修改时间',
  `shared` tinyint(1) NOT NULL COMMENT '是否共享',
  PRIMARY KEY (`uid`,`did`),
  KEY `did` (`did`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='笔记列表';

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_bin NOT NULL COMMENT '用户名',
  `password` varchar(15) COLLATE utf8_bin NOT NULL COMMENT '用户密码',
  `nick` varchar(20) COLLATE utf8_bin NOT NULL COMMENT '用户昵称',
  `email` varchar(25) COLLATE utf8_bin NOT NULL COMMENT '用户邮箱',
  `gender` tinyint(1) NOT NULL COMMENT '用户性别',
  `signature` varchar(150) COLLATE utf8_bin NOT NULL COMMENT '用户签名',
  `picture` varchar(50) COLLATE utf8_bin NOT NULL COMMENT '用户头像',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uid` (`uid`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='MyNote用户列表' AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`uid`, `name`, `password`, `nick`, `email`, `gender`, `signature`, `picture`) VALUES
(1, 'super', 'super', 'super', '', 1, '', '');

--
-- 限制导出的表
--

--
-- 限制表 `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`did`) REFERENCES `document` (`did`) ON DELETE CASCADE;

--
-- 限制表 `crew`
--
ALTER TABLE `crew`
  ADD CONSTRAINT `crew_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE,
  ADD CONSTRAINT `crew_ibfk_1` FOREIGN KEY (`gid`) REFERENCES `group` (`gid`) ON DELETE CASCADE;

--
-- 限制表 `friend`
--
ALTER TABLE `friend`
  ADD CONSTRAINT `friend_ibfk_2` FOREIGN KEY (`uid2`) REFERENCES `user` (`uid`) ON DELETE CASCADE,
  ADD CONSTRAINT `friend_ibfk_1` FOREIGN KEY (`uid1`) REFERENCES `user` (`uid`) ON DELETE CASCADE;

--
-- 限制表 `group`
--
ALTER TABLE `group`
  ADD CONSTRAINT `group_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE;

--
-- 限制表 `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `note_ibfk_2` FOREIGN KEY (`did`) REFERENCES `document` (`did`) ON DELETE CASCADE,
  ADD CONSTRAINT `note_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
