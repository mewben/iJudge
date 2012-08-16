/*
Navicat MySQL Data Transfer

Source Server         : bisudev.local
Source Server Version : 50524
Source Host           : 192.168.0.200:3306
Source Database       : judge

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2012-08-16 19:09:56
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `jg_contests`
-- ----------------------------
DROP TABLE IF EXISTS `jg_contests`;
CREATE TABLE `jg_contests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `banner` varchar(200) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `dependent` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `contests_name_index` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jg_contests
-- ----------------------------

-- ----------------------------
-- Table structure for `jg_criteria`
-- ----------------------------
DROP TABLE IF EXISTS `jg_criteria`;
CREATE TABLE `jg_criteria` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `percentage` int(11) NOT NULL,
  `contest_id` int(11) NOT NULL,
  `criteria_contest_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `criteria_name_index` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jg_criteria
-- ----------------------------

-- ----------------------------
-- Table structure for `jg_role_user`
-- ----------------------------
DROP TABLE IF EXISTS `jg_role_user`;
CREATE TABLE `jg_role_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `role_user_user_id_role_id_unique` (`user_id`,`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jg_role_user
-- ----------------------------
INSERT INTO `jg_role_user` VALUES ('3', '1', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for `jg_roles`
-- ----------------------------
DROP TABLE IF EXISTS `jg_roles`;
CREATE TABLE `jg_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jg_roles
-- ----------------------------
INSERT INTO `jg_roles` VALUES ('1', 'admin', 'Admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `jg_roles` VALUES ('2', 'member', 'Member', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for `jg_users`
-- ----------------------------
DROP TABLE IF EXISTS `jg_users`;
CREATE TABLE `jg_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `lastlogin` datetime NOT NULL,
  `active` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `profile_photo` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of jg_users
-- ----------------------------
INSERT INTO `jg_users` VALUES ('1', 'admin', '$2a$08$KuRhihoHklqQu9PAca136OiSaMdBljL/ipoubCvv9cQJLO.Z.ZLF2', 'admin@admin.com', 'admin', 'istrator', '0000-00-00 00:00:00', '1', '2007-06-12 02:56:50', '2012-08-15 03:21:44', null);
