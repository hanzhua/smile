/*
Navicat MySQL Data Transfer

Source Server         : MySQL__[127.0.0.1]
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : smile

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-01-12 22:11:56
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for sml_log_treetime
-- ----------------------------
DROP TABLE IF EXISTS `sml_log_treetime`;
CREATE TABLE `sml_log_treetime` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `uid` int(16) DEFAULT NULL COMMENT '事件人',
  `ctime` int(16) DEFAULT NULL COMMENT '操作事件时间',
  `content` varchar(64) DEFAULT NULL COMMENT '操作事件 对象',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sml_log_treetime
-- ----------------------------
INSERT INTO `sml_log_treetime` VALUES ('1', '1002', '1483618976', '查看了【个人设置】');
