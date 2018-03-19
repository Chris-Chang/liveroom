/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-03-19 15:17:33
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for demo_admin
-- ----------------------------
DROP TABLE IF EXISTS `demo_admin`;
CREATE TABLE `demo_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL DEFAULT '',
  `password` char(32) NOT NULL DEFAULT '',
  `sex` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '0=>未知,1=>男,2=>女',
  `email` varchar(60) NOT NULL DEFAULT '',
  `remark` varchar(255) NOT NULL DEFAULT '',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of demo_admin
-- ----------------------------
INSERT INTO `demo_admin` VALUES ('1', 'chang', 'f379eaf3c831b04de153469d1bec345e', '0', 'chang@qq.com', 'I am chang', '0', '0');
INSERT INTO `demo_admin` VALUES ('2', 'zhi', 'f379eaf3c831b04de153469d1bec345e', '0', 'zhi@qq.com', 'I am zhi', '0', '0');

-- ----------------------------
-- Table structure for demo_logs
-- ----------------------------
DROP TABLE IF EXISTS `demo_logs`;
CREATE TABLE `demo_logs` (
  `id` int(11) NOT NULL,
  `content` varchar(255) NOT NULL DEFAULT '',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of demo_logs
-- ----------------------------

-- ----------------------------
-- Table structure for demo_menu
-- ----------------------------
DROP TABLE IF EXISTS `demo_menu`;
CREATE TABLE `demo_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '菜单名',
  `icon` varchar(40) NOT NULL DEFAULT '' COMMENT '图标名',
  `link` varchar(40) NOT NULL DEFAULT '',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of demo_menu
-- ----------------------------
INSERT INTO `demo_menu` VALUES ('1', '0', '首页', 'am-icon-home', '/admin/manage/home', '0', '0');
INSERT INTO `demo_menu` VALUES ('2', '0', '用户管理', 'am-icon-male', '', '0', '0');
INSERT INTO `demo_menu` VALUES ('3', '2', '用户列表', 'am-icon-list', '/admin/user/userlist', '0', '0');
INSERT INTO `demo_menu` VALUES ('4', '0', '菜单管理', '', '', '0', '0');
INSERT INTO `demo_menu` VALUES ('5', '0', '菜单列表', '', '/admin/menu/menulist', '0', '0');

-- ----------------------------
-- Table structure for demo_role
-- ----------------------------
DROP TABLE IF EXISTS `demo_role`;
CREATE TABLE `demo_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(60) NOT NULL DEFAULT '',
  `desc` varchar(255) NOT NULL DEFAULT '',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of demo_role
-- ----------------------------
INSERT INTO `demo_role` VALUES ('1', '超级管理员', '超级管理员', '0', '0');
INSERT INTO `demo_role` VALUES ('2', '菜单管理员', '菜单管理员', '0', '0');

-- ----------------------------
-- Table structure for demo_role_menu
-- ----------------------------
DROP TABLE IF EXISTS `demo_role_menu`;
CREATE TABLE `demo_role_menu` (
  `role_id` int(10) unsigned NOT NULL,
  `menu_id` int(10) unsigned NOT NULL,
  `create_time` int(10) unsigned NOT NULL,
  `update_time` int(10) unsigned NOT NULL,
  UNIQUE KEY `role_menu` (`role_id`,`menu_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of demo_role_menu
-- ----------------------------
INSERT INTO `demo_role_menu` VALUES ('1', '1', '0', '0');
INSERT INTO `demo_role_menu` VALUES ('1', '2', '0', '0');
INSERT INTO `demo_role_menu` VALUES ('1', '3', '0', '0');
INSERT INTO `demo_role_menu` VALUES ('1', '4', '0', '0');
INSERT INTO `demo_role_menu` VALUES ('1', '5', '0', '0');
INSERT INTO `demo_role_menu` VALUES ('2', '4', '0', '0');
INSERT INTO `demo_role_menu` VALUES ('2', '5', '0', '0');

-- ----------------------------
-- Table structure for demo_role_user
-- ----------------------------
DROP TABLE IF EXISTS `demo_role_user`;
CREATE TABLE `demo_role_user` (
  `role_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `create_time` int(10) unsigned NOT NULL,
  `update_time` int(10) unsigned NOT NULL,
  UNIQUE KEY `role_user` (`role_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of demo_role_user
-- ----------------------------
INSERT INTO `demo_role_user` VALUES ('1', '1', '0', '0');
INSERT INTO `demo_role_user` VALUES ('2', '2', '0', '0');

-- ----------------------------
-- Table structure for demo_user
-- ----------------------------
DROP TABLE IF EXISTS `demo_user`;
CREATE TABLE `demo_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL DEFAULT '',
  `password` char(32) NOT NULL DEFAULT '',
  `sex` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '0=>未知,1=>男,2=>女',
  `email` varchar(60) NOT NULL DEFAULT '',
  `remark` varchar(255) NOT NULL DEFAULT '',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `delete_time` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of demo_user
-- ----------------------------
INSERT INTO `demo_user` VALUES ('1', 'chang01', 'f379eaf3c831b04de153469d1bec345e', '0', 'chang01@qq.com', '', '0', '1520319995', null);
INSERT INTO `demo_user` VALUES ('2', 'chang02', 'f379eaf3c831b04de153469d1bec345e', '1', 'chang02@qq.com', '', '0', '1520319995', null);
INSERT INTO `demo_user` VALUES ('3', 'chang03', 'f379eaf3c831b04de153469d1bec345e', '2', 'chang03@qq.com', '', '0', '1520320212', '1520320212');
INSERT INTO `demo_user` VALUES ('4', 'chang04', 'f379eaf3c831b04de153469d1bec345e', '1', 'chang04@qq.com', '', '0', '1520320203', '1520320203');
INSERT INTO `demo_user` VALUES ('5', 'chang05', 'f379eaf3c831b04de153469d1bec345e', '2', 'chang05@qq.com', '', '1520304326', '1520320196', '1520320196');
INSERT INTO `demo_user` VALUES ('6', 'chang06', 'f379eaf3c831b04de153469d1bec345e', '1', 'chang06@qq.com', '', '1520304647', '1520320190', '1520320190');
