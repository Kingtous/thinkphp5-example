/*
 Navicat Premium Data Transfer

 Source Server         : 阿里云MySQL
 Source Server Type    : MySQL
 Source Server Version : 50725
 Source Host           : 39.107.226.2:3306
 Source Schema         : d_kingtous_cn

 Target Server Type    : MySQL
 Target Server Version : 50725
 File Encoding         : 65001

 Date: 26/10/2019 13:28:52
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for data_token
-- ----------------------------
DROP TABLE IF EXISTS `data_token`;
CREATE TABLE `data_token` (
  `ID` int(8) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `Token` varchar(32) DEFAULT NULL,
  `Out_time` datetime DEFAULT NULL,
  `Last_login` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  CONSTRAINT `data_token_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `data_user` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for data_user
-- ----------------------------
DROP TABLE IF EXISTS `data_user`;
CREATE TABLE `data_user` (
  `ID` int(8) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `Nickname` varchar(50) DEFAULT NULL,
  `Phone` varchar(11) NOT NULL,
  `IsVIP` int(1) DEFAULT '0',
  `Passwd` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`ID`,`Phone`) USING BTREE,
  KEY `ID` (`ID`),
  KEY `Phone` (`Phone`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;
