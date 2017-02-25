/*
Navicat MySQL Data Transfer

Source Server         : MySQL__[127.0.0.1]
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : smile

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-01-19 11:40:41
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for sml_users
-- ----------------------------
DROP TABLE IF EXISTS `sml_users`;
CREATE TABLE `sml_users` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `tel` varchar(11) DEFAULT NULL COMMENT '电话',
  `qq` varchar(10) DEFAULT NULL COMMENT 'qq',
  `password` varchar(32) DEFAULT NULL COMMENT '密码',
  `city` varchar(64) DEFAULT NULL COMMENT '所在城市',
  `flag` tinyint(1) DEFAULT '0' COMMENT '状态: 0 -- 正常  1 -- 禁用',
  `group` tinyint(1) DEFAULT '0' COMMENT '用户组： 0是普通管理员； !=0 代表特殊管理员',
  `contact` varchar(32) DEFAULT NULL COMMENT '用户昵称',
  `sex` tinyint(1) DEFAULT NULL COMMENT '性别',
  `email` varchar(32) DEFAULT NULL COMMENT '邮箱',
  `pic` varchar(256) DEFAULT NULL COMMENT '用户头像',
  `ip` varchar(36) DEFAULT NULL COMMENT '注册时的IP地址',
  `createdate` datetime DEFAULT NULL COMMENT '注册时间,不能更改',
  `lastdate` datetime DEFAULT NULL COMMENT '最近一次登录时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1007 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sml_users
-- ----------------------------
INSERT INTO `sml_users` VALUES ('1001', '18821474547', '963249783', '4b8af08e011c961d9e86a11ab12b673f', null, '0', '1', '叶落知秋', null, '963249783@QQ.COM', './Uploads/assets/default.jpg', '127.0.0.1', '2016-08-21 04:15:36', '2017-01-19 11:33:22'),
('1002', '18827084384', '2505855078', '4b8af08e011c961d9e86a11ab12b673f', null, '0', '1', 'Administrator', null, '2505855078@qq.com', './Uploads/assets/2016-12-28/1002-148292936583795.png', '127.0.0.1', '2016-08-24 19:11:02', '2017-01-09 16:34:17'),
('1003', '13886247474', '973244962', '466d4a1803d3b263c3ce8d0cbe808566', null, '0', '1', '鬼舞', null, '973244962@qq.com', './Uploads/assets/2016-12-15/1003-148178503186387.png', '127.0.0.1', '2016-12-26 15:50:35', '2017-01-03 16:09:51'),
('1004', null, '22222', '466d4a1803d3b263c3ce8d0cbe808566', null, '0', '2', '鬼碟', null, null, './Uploads/assets/default.jpg', '127.0.0.1', '2016-12-07 11:15:51', '2017-01-06 13:42:04'),
('1005', '12345679810', '7349573945', '466d4a1803d3b263c3ce8d0cbe808566', null, '0', '3', '一剑封喉', null, '317283@163.com', './Uploads/assets/default.jpg', '0.0.0.0', '2016-12-16 21:56:50', '2016-12-16 22:00:50'),
('1006', null, '161217', '4d733146526755d5dad070e7f941a863', 'Address is none!', '0', '3', '123', null, '123@163.com', './Uploads/assets/default.jpg', '0.0.0.0', '2016-12-17 22:25:17', '2016-12-20 14:36:25');
