/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100406
 Source Host           : localhost:3306
 Source Schema         : pemetaanfcm

 Target Server Type    : MySQL
 Target Server Version : 100406
 File Encoding         : 65001

 Date: 10/01/2022 15:20:37
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for hasil
-- ----------------------------
DROP TABLE IF EXISTS `hasil`;
CREATE TABLE `hasil`  (
  `Nomor` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NamaAnggota` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Keanggotaan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Sts` int(255) NOT NULL DEFAULT 1
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hasil
-- ----------------------------
INSERT INTO `hasil` VALUES ('11000001', 'AIS System', 'C1', 1);
INSERT INTO `hasil` VALUES ('11000001', 'BANGUN PEMUDI PEMUDA', 'C2', 1);
INSERT INTO `hasil` VALUES ('11000001', 'Datang tak dijemput pulang tak di antar', 'C3', 1);
INSERT INTO `hasil` VALUES ('11000001', 'lagunya begini liriknya begitu', 'C3', 1);

-- ----------------------------
-- Table structure for permission
-- ----------------------------
DROP TABLE IF EXISTS `permission`;
CREATE TABLE `permission`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `permissionname` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `link` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ico` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `menusubmenu` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `multilevel` bit(1) NULL DEFAULT NULL,
  `separator` bit(1) NULL DEFAULT NULL,
  `order` int(255) NULL DEFAULT NULL,
  `status` bit(1) NULL DEFAULT NULL,
  `AllowMobile` bit(1) NULL DEFAULT NULL,
  `MobileRoute` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `MobileLogo` int(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permission
-- ----------------------------
INSERT INTO `permission` VALUES (2, 'Daftar UMKM', 'umkm', 'fa-pencil-square-o', '0', b'0', b'0', 2, b'1', NULL, NULL, NULL);
INSERT INTO `permission` VALUES (3, 'Daftar Kriteria', 'kriteria', 'fa-pencil-square-o', '0', b'0', b'0', 3, b'1', NULL, NULL, NULL);
INSERT INTO `permission` VALUES (4, 'Nilai', 'nilai', 'fa-check-square-o', '0', b'0', b'0', 5, b'1', NULL, NULL, NULL);
INSERT INTO `permission` VALUES (5, 'Perhitungan', 'proses', 'fa-spinner', '0', b'0', b'0', 6, b'1', NULL, NULL, NULL);
INSERT INTO `permission` VALUES (6, 'Daftar Jenis Usaha', 'jenisusaha', 'fa-bell-o', '0', b'0', b'0', 1, b'1', NULL, NULL, NULL);

-- ----------------------------
-- Table structure for permissionrole
-- ----------------------------
DROP TABLE IF EXISTS `permissionrole`;
CREATE TABLE `permissionrole`  (
  `roleid` int(11) NOT NULL,
  `permissionid` int(11) NOT NULL
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permissionrole
-- ----------------------------
INSERT INTO `permissionrole` VALUES (1, 1);
INSERT INTO `permissionrole` VALUES (1, 2);
INSERT INTO `permissionrole` VALUES (1, 3);
INSERT INTO `permissionrole` VALUES (1, 4);
INSERT INTO `permissionrole` VALUES (1, 5);
INSERT INTO `permissionrole` VALUES (2, 2);
INSERT INTO `permissionrole` VALUES (1, 6);
INSERT INTO `permissionrole` VALUES (2, 6);

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rolename` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'Admin');
INSERT INTO `roles` VALUES (2, 'Operator');

-- ----------------------------
-- Table structure for tjenisusaha
-- ----------------------------
DROP TABLE IF EXISTS `tjenisusaha`;
CREATE TABLE `tjenisusaha`  (
  `ID` int(255) NOT NULL AUTO_INCREMENT,
  `JenisUsaha` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tjenisusaha
-- ----------------------------
INSERT INTO `tjenisusaha` VALUES (1, 'Konstruksi');
INSERT INTO `tjenisusaha` VALUES (2, 'Software House');

-- ----------------------------
-- Table structure for tkriteria
-- ----------------------------
DROP TABLE IF EXISTS `tkriteria`;
CREATE TABLE `tkriteria`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NamaKriteria` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tkriteria
-- ----------------------------
INSERT INTO `tkriteria` VALUES (2, 'Asset');
INSERT INTO `tkriteria` VALUES (3, 'Omset per Tahun');
INSERT INTO `tkriteria` VALUES (4, 'Jumlah Tenaga Kerja');

-- ----------------------------
-- Table structure for tnilai
-- ----------------------------
DROP TABLE IF EXISTS `tnilai`;
CREATE TABLE `tnilai`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `KodeUMKM` int(255) NOT NULL,
  `KodeKriteria` int(255) NOT NULL,
  `Nilai` double(22, 2) NOT NULL,
  `Indexs` int(255) NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tnilai
-- ----------------------------
INSERT INTO `tnilai` VALUES (1, 1, 2, 1000000.00, 0);
INSERT INTO `tnilai` VALUES (2, 1, 3, 15000000.00, 0);
INSERT INTO `tnilai` VALUES (3, 1, 4, 1.00, 0);
INSERT INTO `tnilai` VALUES (4, 2, 2, 15000000.00, 0);
INSERT INTO `tnilai` VALUES (5, 2, 3, 10000000.00, 0);
INSERT INTO `tnilai` VALUES (6, 2, 4, 15.00, 0);
INSERT INTO `tnilai` VALUES (7, 3, 2, 10000.00, 0);
INSERT INTO `tnilai` VALUES (8, 3, 3, 155000.00, 0);
INSERT INTO `tnilai` VALUES (9, 3, 4, 10.00, 0);
INSERT INTO `tnilai` VALUES (10, 4, 2, 10000.00, 0);
INSERT INTO `tnilai` VALUES (11, 4, 3, 150000.00, 0);
INSERT INTO `tnilai` VALUES (12, 4, 4, 1.00, 0);

-- ----------------------------
-- Table structure for tumkm
-- ----------------------------
DROP TABLE IF EXISTS `tumkm`;
CREATE TABLE `tumkm`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NamaPerusahaa` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NamaPemilik` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Alamat` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `GPS` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `JenisUsaha` int(255) NOT NULL,
  `Pemasaran` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tumkm
-- ----------------------------
INSERT INTO `tumkm` VALUES (1, 'AIS System', 'Prasetyo Aji Wibowo', 'AIS System, Nusukan, Surakarta City, Central Java, Indonesia', '-7.546688400000001,110.8330098', 2, 'Lokal');
INSERT INTO `tumkm` VALUES (2, 'BANGUN PEMUDI PEMUDA', 'HARTANTO BAKERY', 'Nusukan Traditional Market, Nusukan, Surakarta City, Central Java, Indonesia', '-7.546849799999999,110.8210952', 1, 'Regional');
INSERT INTO `tumkm` VALUES (3, 'Datang tak dijemput pulang tak di antar', 'jailani', 'Astana Bibis Luhur, Jalan Walanda Maramis, Nusukan, Surakarta City, Central Java, Indonesia', '-7.5479394,110.8340485', 1, 'Lokal');
INSERT INTO `tumkm` VALUES (4, 'lagunya begini liriknya begitu', 'Ranti', 'Malang Town Square, Jalan Veteran Malang, Penanggungan, Malang City, East Java, Indonesia', '-7.956978599999999,112.6185925', 2, 'Lokal');

-- ----------------------------
-- Table structure for userrole
-- ----------------------------
DROP TABLE IF EXISTS `userrole`;
CREATE TABLE `userrole`  (
  `userid` int(11) NOT NULL,
  `roleid` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`userid`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of userrole
-- ----------------------------
INSERT INTO `userrole` VALUES (14, 1);
INSERT INTO `userrole` VALUES (43, 2);
INSERT INTO `userrole` VALUES (52, 1);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(75) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama` varchar(75) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `createdby` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `createdon` datetime(0) NULL DEFAULT NULL,
  `HakAkses` int(255) NULL DEFAULT NULL,
  `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `verified` bit(1) NULL DEFAULT NULL,
  `ip` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `browser` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 44 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (14, 'admin', 'admin', 'a9bdd47d7321d4089b3b00561c9c621848bd6f6e2f745a53d54913d613789c23945b66de6ded1eb336a7d526f9349a9d964d6f6c3a40e2ac90b4b16c0121f7895Xg53McbkyQ/NmW60Sf4cu3wJsi/8cyZXxeXV7g6b04=', 'mnl', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `users` VALUES (43, 'operator', 'Operator', 'a9bdd47d7321d4089b3b00561c9c621848bd6f6e2f745a53d54913d613789c23945b66de6ded1eb336a7d526f9349a9d964d6f6c3a40e2ac90b4b16c0121f7895Xg53McbkyQ/NmW60Sf4cu3wJsi/8cyZXxeXV7g6b04=', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
