/*
Navicat MySQL Data Transfer

Source Server         : MySQL__[127.0.0.1]
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : smile

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-01-12 22:12:12
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for sml_remark
-- ----------------------------
DROP TABLE IF EXISTS `sml_remark`;
CREATE TABLE `sml_remark` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '评论信息的楼层数',
  `pid` int(16) DEFAULT '0' COMMENT '父类ID',
  `uid` int(16) NOT NULL DEFAULT '0' COMMENT '评论者的ID  同时也是上级ID',
  `name` varchar(32) NOT NULL COMMENT '评论者姓名',
  `email` varchar(64) NOT NULL COMMENT '评论者邮箱',
  `artid` int(16) NOT NULL COMMENT '文章ID',
  `author` int(16) DEFAULT NULL,
  `content` varchar(500) NOT NULL COMMENT '评论者内容',
  `isview` tinyint(16) NOT NULL DEFAULT '0' COMMENT '状态 0显示 1不显示',
  `ctime` datetime NOT NULL COMMENT '评论时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sml_remark
-- ---------------------------,
INSERT INTO `sml_remark` VALUES ('1', '0', '1001', '123', '123@163.com', '2', '1002', '很不错哦.....', '0', '2016-12-19 10:00:46'),
('2', '1', '1003', '123123', '123123@163.com', '2', '1002', '好时机款到发货斯蒂芬了', '0', '2016-12-19 10:28:23'),
('3', '2', '1001', '123', '123@163.com', '2', '1002', '很实用哦，望博主继续更新...', '0', '2016-12-19 11:30:58'),
('4', '3', '1003', '123123', '123123@163.com', '2', '1002', '玩儿完全特特特让他', '0', '2016-12-19 22:15:15');
