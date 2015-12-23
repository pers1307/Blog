/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50621
Source Host           : 127.0.0.1:3306
Source Database       : blog

Target Server Type    : MYSQL
Target Server Version : 50621
File Encoding         : 65001

Date: 2015-12-23 21:36:15
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `articles`
-- ----------------------------
DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `createAt` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(50) NOT NULL,
  `authorId` int(10) unsigned NOT NULL,
  `content` text NOT NULL,
  `logoId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`,`authorId`,`createAt`,`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of articles
-- ----------------------------

-- ----------------------------
-- Table structure for `authors`
-- ----------------------------
DROP TABLE IF EXISTS `authors`;
CREATE TABLE `authors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of authors
-- ----------------------------

-- ----------------------------
-- Table structure for `files`
-- ----------------------------
DROP TABLE IF EXISTS `files`;
CREATE TABLE `files` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `path` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of files
-- ----------------------------

-- ----------------------------
-- Table structure for `roles`
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', 'admin');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `roleId` int(10) NOT NULL DEFAULT '0',
  `login` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`,`roleId`,`login`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', '1', 'pers1307', '1');
