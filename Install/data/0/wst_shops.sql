SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `wst_shops`;
CREATE TABLE `wst_shops` (
  `shopId` int(11) NOT NULL AUTO_INCREMENT,
  `shopSn` varchar(20) NOT NULL,
  `userId` int(11) NOT NULL,
  `areaIdPath` varchar(255) NOT NULL,
  `areaId` int(11) NOT NULL,
  `isSelf` tinyint(4) NOT NULL DEFAULT '0',
  `shopName` varchar(100) NOT NULL,
  `shopkeeper` varchar(50) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `shopCompany` varchar(255) NOT NULL,
  `shopImg` varchar(150) NOT NULL,
  `shopTel` varchar(40) NOT NULL,
  `shopQQ` varchar(50) DEFAULT NULL,
  `shopWangWang` varchar(50) DEFAULT NULL,
  `shopAddress` varchar(255) NOT NULL,
  `bankId` int(11) NOT NULL,
  `bankNo` varchar(20) NOT NULL,
  `bankUserName` varchar(50) NOT NULL,
  `isInvoice` tinyint(4) NOT NULL DEFAULT '0',
  `invoiceRemarks` varchar(255) DEFAULT NULL,
  `serviceStartTime` time NOT NULL DEFAULT '08:30:00',
  `serviceEndTime` time NOT NULL DEFAULT '22:30:00',
  `freight` int(11) DEFAULT '0',
  `shopAtive` tinyint(4) NOT NULL DEFAULT '1',
  `shopStatus` tinyint(4) NOT NULL DEFAULT '1',
  `statusDesc` varchar(255) DEFAULT NULL,
  `dataFlag` tinyint(4) NOT NULL DEFAULT '1',
  `createTime` datetime NOT NULL,
  PRIMARY KEY (`shopId`),
  KEY `shopStatus` (`shopStatus`,`dataFlag`) USING BTREE,
  KEY `areaIdPath` (`areaIdPath`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

INSERT INTO `wst_shops` VALUES ('1', 'S000000001', '1', '440000_440100_440106_', '440106', '1', 'WSTMart自营超市', 'wstmart', '13888888888', 'WSTMart自营超市', 'upload/shops/2016-10/5800ac97d0c24.png', '13888888888', '153289970', null, '燕岭路89号燕侨大厦', '24', '2343243124312412', '是暗室逢灯', '0', '', '08:30:00', '22:30:00', '5', '1', '1', '', '1', '2016-10-08 10:27:28');
