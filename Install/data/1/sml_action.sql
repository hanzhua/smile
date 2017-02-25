/*
Navicat MySQL Data Transfer

Source Server         : MySQL__[127.0.0.1]
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : smile

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-01-12 22:09:24
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for sml_action
-- ----------------------------
DROP TABLE IF EXISTS `sml_action`;
CREATE TABLE `sml_action` (
  `id` int(16) unsigned NOT NULL COMMENT '菜单表',
  `pid` int(16) unsigned DEFAULT '0' COMMENT '所属菜单',
  `name` varchar(32) DEFAULT '' COMMENT '菜单名称',
  `public` varchar(32) DEFAULT '0' COMMENT '获取title标签的名称,  0 是其他标签的辨别条件',
  `sort` int(16) DEFAULT NULL COMMENT '排序',
  `url` varchar(255) DEFAULT '' COMMENT '模块、控制器、方法',
  `icon` varchar(16) DEFAULT '' COMMENT 'font-awesome图标',
  `Inid` int(16) unsigned DEFAULT '0' COMMENT 'ID增加规则字段：($Inid*10+1);',
  `isdel` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0正常1删除'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sml_action
-- ----------------------------
INSERT INTO `sml_action` VALUES 
('17011004', '0', '后台主页', '0', null, 'Admin/index', 'home', '0', '0'),
('17011001', '0', '登      录', 'log', null, '', '', '0', '0'),
('17011002', '0', '注      册', 'reg', null, '', '', '0', '0'),
('17011003', '0', 'AdminEx', 'main', null, '', '', '0', '0'),
('1', '0', '系统管理', '0', '1', '', 'cogs', '6', '0'),
('101', '1', '访客一览', '0', '101', 'Admin/visit', '', '0', '0'),
('102', '1', '登录日志', '0', '102', 'Admin/Log', '', '0', '0'),
('103', '1', '网站配置', '0', '103', 'Admin/adminer', '', '1', '0'),
('10301', '103', '配置设置', '0', null, 'Admin/adminset', '', '0', '0'),
('104', '1', '友情连接', '0', '104', 'Admin/link', '', '5', '0'),
('10401', '104', '添加友情', '0', null, 'Admin/linkde', '', '0', '0'),
('10402', '104', '修改友情', '0', null, 'Admin/linkde', '', '0', '0'),
('10403', '104', '删除友情', '0', null, 'Admin/linkdel', '', '0', '0'),
('10404', '104', '状态设置', '0', '10404', 'Admin/linkIsdel', '', '0', '0'),
('10405', '104', '更新排序', '0', '10405', 'Admin/linkSort', '', '0', '0'),
('105', '1', 'COMMON', '0', '105', '---/---', '', '3', '0'),
('10501', '105', '后台首页', '0', '10501', 'Admin/home', '', '0', '0'),
('10502', '105', '图片详情', '0', '10502', 'Admin/homeSee', '', '0', '0'),
('10503', '105', '个人设置', '0', '10503', 'Infor/perfect', '', '0', '0'),
('106', '1', '缓存管理', '0', '106', 'Admin/index', '', '4', '0'),
('10601', '106', '清除模板缓存', '0', '10601', 'Admin/clearCache', '', '0', '0'),
('10602', '106', '清除数据缓存', '0', '10602', 'Admin/clearData', '', '0', '0'),
('10603', '106', '清除日志缓存', '0', '10603', 'Admin/clearLogs', '', '0', '0'),
('10604', '106', '清除数据目录', '0', '10604', 'Admin/clearTemp', '', '0', '0'),
('2', '0', '基础设置', '0', '2', '', 'cog', '2', '0'),
('201', '2', '地区管理', '0', '201', 'Areas/index', 'globe', '4', '0'),
('20101', '201', '地区添加', '0', null, 'Areas/AreasAdd', '', '0', '0'),
('20102', '201', '地区修改', '0', null, 'Areas/AreasEdit', '', '0', '0'),
('20103', '201', '地区删除', '0', null, 'Areas/AreasDel', '', '0', '0'),
('20104', '201', '是否显示', '0', '20104', 'Areas/AreasShow', '', '0', '0'),
('202', '2', '类型管理', '0', '202', 'Cate/cate', 'puzzle-piece', '4', '0'),
('20201', '202', '类型添加', '0', null, 'Cate/catede', '', '0', '0'),
('20202', '202', '类型修改', '0', null, 'Cate/catede', '', '0', '0'),
('20203', '202', '类型删除', '0', null, 'Cate/catedel', '', '0', '0'),
('20204', '202', '修改名称', '0', null, 'Cate/EditName', '', '0', '0'),
('3', '0', '权限控制', '0', '3', '', 'key', '3', '0'),
('301', '3', '权限栏控制', '0', '301', 'Rule/action', 'unlock-alt', '3', '0'),
('30102', '301', '添加子菜单', '0', null, 'Rule/actionAdd', '', '0', '0'),
('30103', '301', '菜单栏修改', '0', null, 'Rule/actionde', '', '0', '0'),
('30104', '301', '菜单栏删除', '0', null, 'Rule/actiondel', '', '0', '0'),
('302', '3', '用户组权限', '0', '302', 'Rule/group', 'group', '3', '0'),
('30201', '302', '添加用户组', '0', null, 'Rule/groupde', '', '0', '0'),
('30202', '302', '用户组权限', '0', null, 'Rule/grouprule', '', '0', '0'),
('30203', '302', '删除用户组', '0', null, 'Rule/groupdel', '', '0', '0'),
('303', '3', '管理员设置', '0', '303', 'Rule/user', 'male', '3', '0'),
('30301', '303', '添加管理员', '0', null, 'Rule/userde', '', '0', '0'),
('30302', '303', '管理员删除', '0', null, 'Rule/userdel', '', '0', '0'),
('30303', '303', '管理员排序', '0', null, 'Rule/usersort', '', '0', '0'),
('4', '0', '会员管理', '0', '4', '', 'user', '1', '0'),
('401', '4', '会员列表', '0', '401', 'Admin/User/index', '', '0', '0'),
('5', '0', '文章管理', '0', '5', '', 'pencil', '3', '0'),
('501', '5', '文章列表', '0', '501', 'Article/lst', 'list-alt', '4', '0'),
('50101', '501', '添加文章', '0', null, 'Article/add', '', '0', '0'),
('50102', '501', '设置轮播图', '0', null, 'Article/doimg', '', '0', '0'),
('50103', '501', '取消轮播图', '0', null, 'Article/delimg', '', '0', '0'),
('50104', '501', '文章--置顶', '0', null, 'Article/EditTOP', '', '0', '0'),
('502', '5', '文章回收', '0', '502', 'Article/recovery', 'copy', '1', '0'),
('50201', '502', '彻底删除文章', '0', null, 'Article/is_del', '', '0', '0'),
('503', '5', '文章评论', '0', '503', 'Article/remark', 'paste', '1', '0'),
('50301', '503', '文章评论回复', '0', null, 'Article/relay', '', '0', '0'),
('6', '0', '车辆管理', '0', '6', '', 'truck', '3', '0'),
('601', '6', '基本信息', '0', '601', 'Car/CarInfo', '', '0', '0'),
('602', '6', '借车申请', '0', '602', 'Car/CarApply', '', '0', '0'),
('603', '6', '车辆补助', '0', '603', 'Car/CarBz', '', '0', '0'),
('7', '0', '商品管理', '0', '7', '', 'shopping-cart', '1', '0'),
('701', '7', '商品信息', '0', '701', 'SPGL/SPInfo', '', '0', '0');
