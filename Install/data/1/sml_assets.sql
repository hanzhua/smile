/*
Navicat MySQL Data Transfer

Source Server         : MySQL__[127.0.0.1]
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : smile

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-01-19 10:43:45
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for sml_assets
-- ----------------------------
DROP TABLE IF EXISTS `sml_assets`;
CREATE TABLE `sml_assets` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `domain` varchar(64) CHARACTER SET latin1 NOT NULL DEFAULT '' COMMENT '域名',
  `uid` int(16) NOT NULL COMMENT '上传者id',
  `savepath` varchar(64) NOT NULL DEFAULT '' COMMENT '目录名称',
  `savename` varchar(64) NOT NULL DEFAULT '' COMMENT '上传后的文件名称',
  `createtime` datetime NOT NULL COMMENT '创建时间',
  `isdel` tinyint(1) NOT NULL DEFAULT '0' COMMENT '删除状态： 0 默认，  1 删除',
  `name` varchar(64) CHARACTER SET latin1 NOT NULL DEFAULT '' COMMENT '源文件名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sml_assets
-- ----------------------------
INSERT INTO `sml_assets` VALUES ('1', 'http://localhost/smile', '1002', './Uploads/assets/2016-12-28/', '586367f792d21.png', '2016-12-16 17:18:22', '0', 'default.jpg'),
('2', 'http://smile.com/smile', '1002', './Uploads/assets/2016-12-28/', '58637a30ba54c.png', '2016-12-28 16:39:12', '0', '??????20160906222430.png'),
('3', 'http://smile.com/smile', '1002', './Uploads/assets/2016-12-28/', '58637c6006b1a.png', '2016-12-28 16:48:32', '0', 'bg.png'),
('4', 'http://smile.com/smile', '1002', './Uploads/assets/2016-12-28/', '586383da6df44.jpg', '2016-12-28 17:20:26', '0', '????-????.jpg'),
('5', 'http://smile.com/smile', '1002', './Uploads/assets/2016-12-28/', '5863845ebfba9.png', '2016-12-28 17:22:38', '0', 'wxfove1208.png'),
('6', 'http://smile.com/smile', '1002', './Uploads/assets/2016-12-28/', '586385df314e2.jpg', '2016-12-28 17:29:03', '0', '11.jpg'),
('7', 'http://smile.com/smile', '1002', './Uploads/assets/2016-12-28/', '5863869104509.jpg', '2016-12-28 17:32:01', '0', 'blog-wide-img.jpg'),
('8', 'http://smile.com/smile', '1002', './Uploads/assets/2016-12-28/', '58639a8022273.jpg', '2016-12-28 18:57:04', '0', '11.jpg'),
('9', 'http://smile.com/smile', '1002', './Uploads/assets/2016-12-28/', '58639aae0b7ac.png', '2016-12-28 18:57:50', '0', 'clock.png'),
('10', 'http://smile.com/smile', '1002', './Uploads/assets/2016-12-28/', '58639acd3df4b.jpg', '2016-12-28 18:58:21', '0', '5.jpg'),
('11', 'http://smile.com/smile', '1002', './Uploads/assets/2016-12-28/', '5863c276bd64a.jpg', '2016-12-28 21:47:35', '0', 'sm-img-1.jpg'),
('12', 'http://smile.com/smile', '1002', './Uploads/assets/2016-12-28/', '5863c3c0a4a70.jpg', '2016-12-28 21:53:04', '0', 'image3.jpg'),
('13', 'http://smile.com/smile', '1002', './Uploads/assets/2016-12-28/', '5863c58be3439.jpg', '2016-12-28 22:00:44', '0', 'image1.jpg'),
('14', 'http://smile.com/smile', '1002', './Uploads/assets/2016-12-28/', '5863c7c1bf9d9.png', '2016-12-28 22:10:10', '0', 'glyphicon.png'),
('15', 'http://smile.com/smile', '1002', './Uploads/assets/2016-12-28/', '5863c89b2999c.jpg', '2016-12-28 22:13:47', '0', 'blog-thumb-1.jpg'),
('16', 'http://smile.com/smile', '1002', './Uploads/assets/2016-12-28/', '5863c9b6ebc74.png', '2016-12-28 22:18:31', '0', '20161016095543_16660.png'),
('17', 'http://smile.com/smile', '1002', './Uploads/assets/2016-12-28/', '5863ca66930e7.jpg', '2016-12-28 22:21:27', '0', 'intro-bg.jpg'),
('18', 'http://smile.com/smile', '1002', './Uploads/assets/2016-12-28/', '5863cb0338cc9.jpg', '2016-12-28 22:24:03', '0', 'banner-bg.jpg'),
('19', 'http://smile.com/smile', '1002', './Uploads/assets/2016-12-28/', '5863cc90ea2af.jpg', '2016-12-28 22:30:41', '0', '2.jpg'),
('20', 'http://smile.com/smile', '1002', './Uploads/assets/2016-12-28/', '5863ce7044620.jpg', '2016-12-28 22:38:40', '0', '4.jpg'),
('21', 'http://smile.com/smile', '1002', './Uploads/assets/2016-12-28/', '5863cefcc56d2.jpg', '2016-12-28 22:41:01', '0', 'expo-lyft.jpg'),
('22', 'http://smile.com/smile', '1002', './Uploads/assets/2016-12-28/', '5863d01d2d342.png', '2016-12-28 22:45:49', '0', '??????20160906222714.png'),
('23', 'http://smile.com/smile', '1001', './Uploads/assets/2016-12-29/', '5864a83121919.jpg', '2016-12-29 14:07:45', '0', 'lypl.jpg'),
('24', 'http://smile.com/smile', '1002', './Uploads/assets/2017-01-04/', '586c750ba385d.jpg', '2017-01-04 12:07:40', '0', 'bg.jpg'),
('25', 'http://127.0.0.1/smile', '1001', './Uploads/assets/2017-01-18/', '587f28946577d.jpg', '2017-01-18 16:34:28', '0', 'bkPicture.jpg'),
('26', 'http://localhost/smile', '1007', './Uploads/assets/2017-01-18/', '587f369d7f04d.jpg', '2017-01-18 17:34:21', '0', 'Loginer.jpg'),
('27', 'http://localhost/smile', '1007', './Uploads/assets/2017-01-18/', '587f3720e6dc8.jpg', '2017-01-18 17:36:33', '0', 'Launcher.jpg'),
('28', 'http://localhost/smile', '1007', './Uploads/assets/2017-01-18/', '587f37d4a485c.jpg', '2017-01-18 17:39:32', '0', 'bkPicture.jpg'),
('29', 'http://localhost/smile', '1007', './Uploads/assets/2017-01-18/', '587f72e225a25.jpg', '2017-01-18 21:51:30', '0', '57c3a3b737a78.jpg'),
('30', 'http://localhost/smile', '1007', './Uploads/assets/2017-01-18/', '587f7452096e8.jpg', '2017-01-18 21:57:38', '0', '57c3a48e26e16.jpg'),
('31', 'http://localhost/smile', '1007', './Uploads/assets/2017-01-18/', '587f7530e09e1.jpg', '2017-01-18 22:01:21', '0', '57c3a45d3c2b8.jpg'),
('32', 'http://smile.com/smile', '1006', './Uploads/assets/2017-01-19/', '588024a2cc905.jpg', '2017-01-19 10:29:55', '0', '57c3a48e26e16.jpg');
