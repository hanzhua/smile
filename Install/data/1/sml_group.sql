/*
Navicat MySQL Data Transfer

Source Server         : MySQL__[127.0.0.1]
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : smile

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-01-12 22:11:24
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for sml_group
-- ----------------------------
DROP TABLE IF EXISTS `sml_group`;
CREATE TABLE `sml_group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `isdel` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0正常 1删除',
  `rules` text COMMENT '规则id',
  `ctime` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sml_group
-- ----------------------------
INSERT INTO `sml_group` VALUES ('1', '超级管理员', '0', '17011001,17011002,17011003,17011004,1,101,102,103,10301,104,10401,10402,10403,10404,10405,105,10501,10502,10503,106,10601,10602,10603,10604,2,201,20101,20102,20103,20104,202,20201,20202,20203,20204,3,301,30102,30103,30104,302,30201,30202,30203,303,30301,30302,30303,4,401,5,501,50101,50102,50103,50104,502,50201,503,50301,6,601,602,603,7,701', '2017-01-07 13:52:53');
INSERT INTO `sml_group` VALUES ('2', '权限管理员', '0', '17011001,17011002,17011003,17011004,1,11,12,13,1301,14,2,21,2101,2102,22,2201,2202,2204,3,31,3101,3102,3103', '0000-00-00 00:00:00');
INSERT INTO `sml_group` VALUES ('3', '管理员', '0', '17011001,17011002,17011003,17011004,1,11,12,13,1301,14,1401,1402,2,21,2101,2102,22,2201,2202,2204,4,41', '0000-00-00 00:00:00');
INSERT INTO `sml_group` VALUES ('4', '游客_123', '0', '17011001,17011002,17011003,17011004', '2017-01-07 15:31:22');
