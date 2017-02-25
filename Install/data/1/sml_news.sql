/*
Navicat MySQL Data Transfer

Source Server         : MySQL__[127.0.0.1]
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : smile

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-01-12 22:12:05
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for sml_news
-- ----------------------------
DROP TABLE IF EXISTS `sml_news`;
CREATE TABLE `sml_news` (
  `id` int(16) NOT NULL,
  `title` varchar(64) DEFAULT NULL COMMENT '标题 哪方面的提醒',
  `user` varchar(64) DEFAULT NULL COMMENT '操作者是谁',
  `ctime` datetime DEFAULT NULL COMMENT '消息创建的时间',
  `isread` tinyint(1) DEFAULT '0' COMMENT '是否读过  0 未读， 1读过',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sml_news
-- ----------------------------
INSERT INTO `sml_news` VALUES ('1', 'CSS', '123', '2016-12-19 10:55:24', '0'),
('2', 'CSS', '123', '2016-12-19 11:26:13', '0'),
('3', 'CSS', '123123', '2016-12-19 11:37:42', '0');
