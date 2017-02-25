/*
Navicat MySQL Data Transfer

Source Server         : MySQL__[127.0.0.1]
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : smile

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-01-12 22:11:06
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for sml_cate
-- ----------------------------
DROP TABLE IF EXISTS `sml_cate`;
CREATE TABLE `sml_cate` (
  `id` int(16) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `pid` int(16) DEFAULT '0' COMMENT '父级ID',
  `name` varchar(32) DEFAULT NULL COMMENT '分类名称',
  `url` varchar(64) DEFAULT NULL COMMENT '文章类型',
  `type` int(16) DEFAULT '1' COMMENT '分类样式',
  `sort` int(16) DEFAULT '0' COMMENT '分类排序',
  `isdel` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sml_cate
-- ----------------------------
INSERT INTO `sml_cate` VALUES ('1', '0', 'SQL', 'Sql', '1', '1', '0');
INSERT INTO `sml_cate` VALUES ('2', '0', 'PHP', 'Php', '1', '3', '0');
INSERT INTO `sml_cate` VALUES ('3', '2', 'TP3.2', 'Php', '1', '0', '0');
INSERT INTO `sml_cate` VALUES ('4', '2', 'TP5.0', 'Php', '1', '0', '0');
INSERT INTO `sml_cate` VALUES ('5', '1', 'Oracle', 'Sql', '1', '0', '0');
INSERT INTO `sml_cate` VALUES ('6', '0', 'CSS', 'Css', '1', '0', '0');
INSERT INTO `sml_cate` VALUES ('7', '6', 'Bootstrap', 'Css', '1', '0', '0');
INSERT INTO `sml_cate` VALUES ('8', '0', 'HTML5', 'H5', '1', '0', '0');
INSERT INTO `sml_cate` VALUES ('9', '1', 'MySQL', 'Sql', '1', '0', '0');
INSERT INTO `sml_cate` VALUES ('10', '0', '随笔', 'Sb', '1', '0', '0');
INSERT INTO `sml_cate` VALUES ('11', '0', 'JAVA', 'Java', '1', '0', '0');
