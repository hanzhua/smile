/*
Navicat MySQL Data Transfer

Source Server         : MySQL__[127.0.0.1]
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : smile

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-01-19 19:43:13
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for sml_users_sign
-- ----------------------------
DROP TABLE IF EXISTS `sml_users_sign`;
CREATE TABLE `sml_users_sign` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `sign_uid` int(16) DEFAULT NULL COMMENT '外键：users表的id',
  `sign_mon` int(6) DEFAULT NULL COMMENT '签到的年月号（判断是否是同年同月签到）',
  `sign_day` tinyint(2) DEFAULT NULL,
  `sign_num` tinyint(4) DEFAULT '0' COMMENT '连续签到的次数（与积分有关）',
  `sign_days` varchar(64) DEFAULT NULL COMMENT '保存已签到的日期号：1,2,3,13,14,(,分割)',
  `sign_date` datetime DEFAULT NULL COMMENT '签到的时间',
  `sign_score` int(16) DEFAULT NULL COMMENT '签到获取的积分',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sml_users_sign
-- ----------------------------
INSERT INTO `sml_users_sign` VALUES ('1', '1004', '201611', '30', '1', '4', '2016-11-30 13:59:44', '2');
INSERT INTO `sml_users_sign` VALUES ('2', '1001', '10', '15', '4', '1,2,3,4', '2016-10-15 14:26:49', '8');
INSERT INTO `sml_users_sign` VALUES ('3', '1004', '12', '3', '3', '1,2,3', '2016-12-03 12:10:57', '6');
INSERT INTO `sml_users_sign` VALUES ('4', '1002', '201601', '19', '7', null, '2017-01-19 15:03:57', null);
INSERT INTO `sml_users_sign` VALUES ('5', '1002', null, '18', '7', '1,2,3,4', '2017-01-19 15:08:13', '2');
INSERT INTO `sml_users_sign` VALUES ('6', '1002', null, null, '0', ',19', '2017-01-19 15:47:02', '2');
INSERT INTO `sml_users_sign` VALUES ('7', '1002', null, '1', '1', ',1', '2017-01-19 15:51:43', '2');
INSERT INTO `sml_users_sign` VALUES ('8', '1002', null, '19', '1', ',19', '2017-01-19 16:03:19', '2');
INSERT INTO `sml_users_sign` VALUES ('9', '1002', null, '19', '1', ',19', '2017-01-19 16:07:58', '2');
INSERT INTO `sml_users_sign` VALUES ('10', '1002', '201701', '19', '9', ',1,12,13,14,15,16,17,18,19', '2017-01-19 16:21:30', '27');
INSERT INTO `sml_users_sign` VALUES ('11', '1003', '201701', '19', '1', ',19', '2017-01-19 19:37:11', '2');
