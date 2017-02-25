/*
Navicat MySQL Data Transfer

Source Server         : MySQL__[127.0.0.1]
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : smile

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-01-19 11:35:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for sml_visit
-- ----------------------------
DROP TABLE IF EXISTS `sml_visit`;
CREATE TABLE `sml_visit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `domain_id` int(11) NOT NULL DEFAULT '0' COMMENT '域名编号',
  `ip` varchar(20) DEFAULT '' COMMENT 'ip地址',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '域名所有者的id',
  `address` varchar(64) DEFAULT NULL COMMENT '访客地址',
  `create_time` datetime NOT NULL,
  `browser` varchar(32) DEFAULT '' COMMENT '浏览器',
  `language` varchar(32) DEFAULT '' COMMENT '浏览器语言',
  `os_name` varchar(32) DEFAULT '' COMMENT '操作系统',
  PRIMARY KEY (`id`),
  KEY `ip` (`ip`),
  KEY `domain_id` (`domain_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sml_visit
-- ----------------------------
INSERT INTO `sml_visit` VALUES ('1', '10', '114.242.26.65', '1', null, '2016-10-17 08:36:53', 'Chrome', '简体中文', 'MAC'),
('2', '10', '114.242.26.65', '1', null, '2016-10-17 08:37:18', 'Chrome', '简体中文', 'MAC'),
('3', '18', '114.242.26.65', '1', null, '2016-10-17 08:40:21', 'Chrome', '简体中文', 'MAC'),
('4', '1', '114.242.26.65', '1', null, '2016-10-17 08:43:03', 'Chrome', '简体中文', 'MAC'),
('5', '11', '111.20.248.74', '1', null, '2016-10-17 08:49:30', 'Other', 'None', 'Other'),
('6', '12', '37.115.33.168', '1', null, '2016-10-17 09:06:28', 'Chrome', 'English', 'Windows'),
('7', '9', '114.242.26.65', '1', null, '2016-10-17 09:14:54', 'Chrome', '简体中文', 'MAC'),
('8', '10', '115.215.69.230', '1', null, '2016-10-17 09:52:05', 'MSIE', 'None', 'Windows'),
('9', '10', '115.215.69.230', '1', null, '2016-10-17 09:53:07', 'MSIE', 'None', 'Windows'),
('10', '24', '114.242.26.65', '2', null, '2016-10-17 10:59:07', 'Chrome', '简体中文', 'MAC'),
('11', '24', '114.242.26.65', '2', null, '2016-10-17 10:59:08', 'Chrome', '简体中文', 'MAC'),
('12', '24', '114.242.26.65', '2', null, '2016-10-17 10:59:15', 'Chrome', '简体中文', 'MAC'),
('13', '24', '114.242.26.65', '2', null, '2016-10-17 10:59:47', 'Chrome', '简体中文', 'MAC'),
('14', '24', '106.120.121.145', '2', null, '2016-10-17 11:18:03', 'MSIE', 'None', 'Windows'),
('15', '1', '82.80.230.228', '1', null, '2016-10-17 13:44:46', 'MSIE', 'None', 'Windows'),
('16', '24', '104.238.248.15', '2', null, '2016-10-17 14:01:18', 'MSIE', 'None', 'Windows'),
('17', '11', '103.242.202.196', '1', null, '2016-10-17 14:30:09', 'Other', 'None', 'Other'),
('18', '11', '111.20.248.74', '1', null, '2016-10-17 14:47:57', 'Other', 'None', 'Other'),
('19', '19', '123.125.71.106', '1', null, '2016-10-17 15:21:22', 'Other', '简体中文', 'Other'),
('20', '16', '123.125.71.42', '1', null, '2016-10-17 15:26:12', 'Safari', '简体中文', 'Linux'),
('21', '24', '113.108.80.206', '2', null, '2016-10-17 15:28:18', 'MSIE', '简体中文', 'Windows'),
('22', '24', '112.90.82.196', '2', null, '2016-10-17 15:28:20', 'Other', '简体中文', 'MAC'),
('23', '24', '101.226.33.216', '2', null, '2016-10-17 15:31:29', 'MSIE', '简体中文', 'Windows'),
('24', '24', '101.226.66.192', '2', null, '2016-10-17 15:34:39', 'MSIE', '简体中文', 'Windows'),
('25', '24', '106.120.121.158', '2', null, '2016-10-17 16:20:35', 'Other', 'None', 'Other'),
('26', '24', '106.120.121.158', '2', null, '2016-10-17 16:20:46', '获取浏览器信息失败！', 'None', 'None'),
('27', '19', '106.120.121.158', '1', null, '2016-10-17 16:33:08', 'Other', 'None', 'Other'),
('28', '19', '106.120.121.158', '1', null, '2016-10-17 16:33:10', '获取浏览器信息失败！', 'None', 'None'),
('29', '16', '139.59.149.57', '1', null, '2016-10-17 16:55:31', 'Firefox', 'None', 'Windows');
