/*
Navicat MySQL Data Transfer

Source Server         : MySQL__[127.0.0.1]
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : smile

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-01-19 10:43:04
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for sml_setup
-- ----------------------------
DROP TABLE IF EXISTS `sml_setup`;
CREATE TABLE `sml_setup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) DEFAULT NULL,
  `url` varchar(64) DEFAULT NULL,
  `keyword` varchar(255) DEFAULT '' COMMENT '网页关键词',
  `descript` varchar(255) DEFAULT '' COMMENT '描述',
  `name` varchar(32) DEFAULT '' COMMENT '联系人',
  `tel` varchar(15) DEFAULT '' COMMENT '电话',
  `qq` varchar(10) DEFAULT '' COMMENT 'qq',
  `logo` int(16) NOT NULL DEFAULT '0' COMMENT '网站logo(图片)',
  `foot` varchar(255) DEFAULT '' COMMENT '底部说明',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sml_setup
-- ----------------------------
INSERT INTO `sml_setup` VALUES ('1', '画中浅笑博客', 'http://127.0.0.1/smile', '浅笑,Smile,画中浅笑博客,PHP技术博客,Linux技术博客,C语言技术博客,Java技术博客,MySQL技术博客,Javascript技术博客', '画中浅笑博客 - 关注于PHP,Linix,Python,MySQL,Javascript技术开发，分享学习之路上的点点滴滴。', '画中浅笑', '18827084384', '2505855078', '0', '画中浅笑博客 托管于 阿里云 联系方式：QQ：2505855078 &lt;br/&gt;版权所有，保留一切权利 Copyright © 2014-2020 京ICP备16055311');
