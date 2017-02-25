/*
Navicat MySQL Data Transfer

Source Server         : MySQL__[127.0.0.1]
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : smile

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-01-12 22:11:14
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for sml_frilink
-- ----------------------------
DROP TABLE IF EXISTS `sml_frilink`;
CREATE TABLE `sml_frilink` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(32) NOT NULL COMMENT '标题',
  `content` varchar(256) NOT NULL COMMENT '描述',
  `ctime` datetime NOT NULL COMMENT '时间',
  `url` varchar(64) NOT NULL COMMENT '链接',
  `type` varchar(32) NOT NULL COMMENT '样式',
  `pic` varchar(64) DEFAULT NULL COMMENT '网址图像',
  `sort` int(16) DEFAULT '0' COMMENT '排序',
  `isdel` tinyint(1) DEFAULT '0' COMMENT '是否显示  0-显示  1-隐藏',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sml_frilink
-- ----------------------------
INSERT INTO `sml_frilink` VALUES ('1', '斗图啊', '斗图啊是一个在线制作搞笑表情的网站', '2016-11-24 22:04:29', 'http://www.doutua.com/', 'info', null, '4', '0');
INSERT INTO `sml_frilink` VALUES ('2', '里程密', '里程密开源PHP博客系统', '2016-10-01 22:04:34', 'http://www.lcm.wang/', 'info', null, '3', '0');
INSERT INTO `sml_frilink` VALUES ('3', '李宗洋博客', '个人博客，很有精华，希望大家可以从里面学到东西......', '2016-12-23 20:32:03', 'http://www.lizongyang.com', '', null, '2', '0');
INSERT INTO `sml_frilink` VALUES ('4', 'SmileEx', '微笑面对生活......', '2016-12-23 20:35:01', 'http://www.201314.com', '', null, '1', '0');
