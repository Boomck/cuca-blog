/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : cuca

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2019-01-03 18:40:22
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `comment`
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(6) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `essayid` int(6) NOT NULL,
  `username` varchar(40) NOT NULL,
  `content` varchar(300) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comment
-- ----------------------------
INSERT INTO `comment` VALUES ('000001', '18', '', 'qqwe', '2019-01-02 14:05:57');
INSERT INTO `comment` VALUES ('000002', '18', 'boomck', 'swa', '2019-01-02 14:17:06');
INSERT INTO `comment` VALUES ('000003', '18', 'boomck', 'swa', '2019-01-02 14:17:06');
INSERT INTO `comment` VALUES ('000004', '18', 'boomck', 'swa', '2019-01-02 14:17:06');
INSERT INTO `comment` VALUES ('000005', '18', 'boomck', 'swa', '2019-01-02 14:17:06');
INSERT INTO `comment` VALUES ('000006', '18', 'boomck', 'swa', '2019-01-02 14:17:06');
INSERT INTO `comment` VALUES ('000007', '18', 'boomck', 'wdwdwd', '2019-01-02 14:28:05');
INSERT INTO `comment` VALUES ('000008', '18', 'boomck', 'wdwdwdpajd', '2019-01-02 14:30:06');
INSERT INTO `comment` VALUES ('000009', '18', 'boomck', 'oiaoiahsd\r\n', '2019-01-02 14:31:35');
INSERT INTO `comment` VALUES ('000010', '18', 'boomck', 'oiaoiahsd\r\nasd', '2019-01-02 14:32:13');
INSERT INTO `comment` VALUES ('000011', '18', 'cc', 'kjaskdjas\r\naksdadwd\r\nasoaowhd', '2019-01-03 14:17:31');

-- ----------------------------
-- Table structure for `essay`
-- ----------------------------
DROP TABLE IF EXISTS `essay`;
CREATE TABLE `essay` (
  `id` int(6) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `title` varchar(90) NOT NULL,
  `content` varchar(600) NOT NULL,
  `imagepath` varchar(200) DEFAULT NULL,
  `date` datetime NOT NULL,
  `likecount` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of essay
-- ----------------------------
INSERT INTO `essay` VALUES ('000012', 'boomck', 'kkk', 'kkkk', '/tp5/public/uploads/20181231/c1ab7f473c4be2fa721b1f722133267e.jpg', '2018-12-31 17:32:58', '0');
INSERT INTO `essay` VALUES ('000013', 'boomck', 'mmm', 'mmmm', '', '2018-12-31 17:35:03', '0');
INSERT INTO `essay` VALUES ('000014', 'boomck', '', '', '', '2019-01-01 10:45:29', '0');
INSERT INTO `essay` VALUES ('000015', 'boomck', '', '', '', '2019-01-01 10:47:17', '0');
INSERT INTO `essay` VALUES ('000016', 'boomck', '', '', '', '2019-01-01 10:52:45', '0');
INSERT INTO `essay` VALUES ('000017', 'boomck', 'eee', 'eewq', '/tp5/public/uploads/20190101/3a76bdc64d3839157e3ee825e7c2b252.jpg&/tp5/public/uploads/20190101/4682c89bf450c0db49078b4c34baa777.jpg&/tp5/public/uploads/20190101/7c457c81e9a48675b50af9047183f986.jpg', '2019-01-01 11:09:20', '0');
INSERT INTO `essay` VALUES ('000018', 'boomck', 'lob', 'lob', '/tp5/public/uploads/20190101/789a0547a215bfe7182a1b949bee2b42.jpg&/tp5/public/uploads/20190101/d577632c868629df44b46cbf4664dfdd.jpg', '2019-01-01 23:11:56', '3');
INSERT INTO `essay` VALUES ('000019', 'cc', 'okok', 'mmasdmm', '/tp5/public/uploads/20190103/a7f35ce482fb4e3f28a6a0ee37fe95d9.jpg&/tp5/public/uploads/20190103/a4c0edb1e866e1453eaa6c2310b3d81e.jpg', '2019-01-03 14:14:41', '0');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(6) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `password` varchar(300) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `commentcount` int(4) NOT NULL DEFAULT '0',
  `email` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('000007', 'boomck', '202cb962ac59075b964b07152d234b70', '12312312311', '0', 'qwe@qq.com');
INSERT INTO `user` VALUES ('000008', 'cc', 'e0323a9039add2978bf5b49550572c7c', '12312312311', '0', 'cc@qq.com');
INSERT INTO `user` VALUES ('000009', 'qq', '099b3b060154898840f0ebdfb46ec78f', '32112312332', '0', 'qq@qq.com');
INSERT INTO `user` VALUES ('000010', 'ww', 'ad57484016654da87125db86f4227ea3', '32112312332', '0', 'qq@qq.com');
