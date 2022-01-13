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

 Date: 13/01/2022 11:12:27
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
INSERT INTO `hasil` VALUES ('11000001', 'AIS System', 'C1', 0);
INSERT INTO `hasil` VALUES ('11000001', 'BANGUN PEMUDI PEMUDA', 'C2', 0);
INSERT INTO `hasil` VALUES ('11000001', 'Datang tak dijemput pulang tak di antar', 'C3', 0);
INSERT INTO `hasil` VALUES ('11000001', 'lagunya begini liriknya begitu', 'C3', 0);
INSERT INTO `hasil` VALUES ('11000002', 'AIS System', 'C2', 0);
INSERT INTO `hasil` VALUES ('11000002', 'BANGUN PEMUDI PEMUDA', 'C2', 0);
INSERT INTO `hasil` VALUES ('11000002', 'Datang tak dijemput pulang tak di antar', 'C1', 0);
INSERT INTO `hasil` VALUES ('11000002', 'lagunya begini liriknya begitu', 'C1', 0);
INSERT INTO `hasil` VALUES ('11000003', 'AIS System', 'C2', 0);
INSERT INTO `hasil` VALUES ('11000003', 'BANGUN PEMUDI PEMUDA', 'C2', 0);
INSERT INTO `hasil` VALUES ('11000003', 'Datang tak dijemput pulang tak di antar', 'C1', 0);
INSERT INTO `hasil` VALUES ('11000003', 'lagunya begini liriknya begitu', 'C1', 0);
INSERT INTO `hasil` VALUES ('11000004', 'Sutarmo', 'C2', 1);
INSERT INTO `hasil` VALUES ('11000004', 'Dedy Sunaryo', 'C1', 1);
INSERT INTO `hasil` VALUES ('11000004', 'Suranto', 'C1', 1);
INSERT INTO `hasil` VALUES ('11000004', 'Uus Yadi', 'C2', 1);
INSERT INTO `hasil` VALUES ('11000004', 'Hery', 'C1', 1);
INSERT INTO `hasil` VALUES ('11000004', 'Wiwin', 'C1', 1);
INSERT INTO `hasil` VALUES ('11000004', 'wahyu', 'C1', 1);
INSERT INTO `hasil` VALUES ('11000004', 'Siwi', 'C1', 1);
INSERT INTO `hasil` VALUES ('11000004', 'Putri', 'C1', 1);
INSERT INTO `hasil` VALUES ('11000004', 'Ari', 'C1', 1);
INSERT INTO `hasil` VALUES ('11000004', 'andi', 'C2', 1);
INSERT INTO `hasil` VALUES ('11000004', 'sitri', 'C1', 1);
INSERT INTO `hasil` VALUES ('11000004', 'Tejo', 'C1', 1);
INSERT INTO `hasil` VALUES ('11000004', 'Septi', 'C1', 1);
INSERT INTO `hasil` VALUES ('11000004', 'Juhermini', 'C1', 1);

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
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tjenisusaha
-- ----------------------------
INSERT INTO `tjenisusaha` VALUES (1, 'begkel Motor');
INSERT INTO `tjenisusaha` VALUES (2, 'Foto Copy');
INSERT INTO `tjenisusaha` VALUES (3, 'Gula Jawa');
INSERT INTO `tjenisusaha` VALUES (4, 'Jual Beli Pisang');
INSERT INTO `tjenisusaha` VALUES (5, 'Jual Ikan Keliling');
INSERT INTO `tjenisusaha` VALUES (6, 'Kelontong');
INSERT INTO `tjenisusaha` VALUES (7, 'Konter');
INSERT INTO `tjenisusaha` VALUES (8, 'Mainan Anak');
INSERT INTO `tjenisusaha` VALUES (9, 'Mia Ayam & Bakso');
INSERT INTO `tjenisusaha` VALUES (10, 'Potong Rambut');
INSERT INTO `tjenisusaha` VALUES (11, 'Salon Cewek');
INSERT INTO `tjenisusaha` VALUES (12, 'Sate Ayam');
INSERT INTO `tjenisusaha` VALUES (13, 'Selep Gabah');
INSERT INTO `tjenisusaha` VALUES (14, 'Tempe');

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
) ENGINE = InnoDB AUTO_INCREMENT = 46 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tnilai
-- ----------------------------
INSERT INTO `tnilai` VALUES (1, 1, 2, 25000.00, 1);
INSERT INTO `tnilai` VALUES (2, 1, 3, 50000.00, 1);
INSERT INTO `tnilai` VALUES (3, 1, 4, 2.00, 1);
INSERT INTO `tnilai` VALUES (4, 2, 2, 3000.00, 2);
INSERT INTO `tnilai` VALUES (5, 2, 3, 9000.00, 2);
INSERT INTO `tnilai` VALUES (6, 2, 4, 1.00, 2);
INSERT INTO `tnilai` VALUES (7, 3, 2, 2000.00, 3);
INSERT INTO `tnilai` VALUES (8, 3, 3, 12000.00, 3);
INSERT INTO `tnilai` VALUES (9, 3, 4, 1.00, 3);
INSERT INTO `tnilai` VALUES (10, 4, 2, 20000.00, 4);
INSERT INTO `tnilai` VALUES (11, 4, 3, 45000.00, 4);
INSERT INTO `tnilai` VALUES (12, 4, 4, 2.00, 4);
INSERT INTO `tnilai` VALUES (13, 5, 2, 1000.00, 5);
INSERT INTO `tnilai` VALUES (14, 5, 3, 6000.00, 5);
INSERT INTO `tnilai` VALUES (15, 5, 4, 1.00, 5);
INSERT INTO `tnilai` VALUES (16, 6, 2, 4500.00, 6);
INSERT INTO `tnilai` VALUES (17, 6, 3, 11500.00, 6);
INSERT INTO `tnilai` VALUES (18, 6, 4, 2.00, 6);
INSERT INTO `tnilai` VALUES (19, 7, 2, 5000.00, 7);
INSERT INTO `tnilai` VALUES (20, 7, 3, 20000.00, 7);
INSERT INTO `tnilai` VALUES (21, 7, 4, 2.00, 7);
INSERT INTO `tnilai` VALUES (22, 8, 2, 2500.00, 8);
INSERT INTO `tnilai` VALUES (23, 8, 3, 15000.00, 8);
INSERT INTO `tnilai` VALUES (24, 8, 4, 3.00, 8);
INSERT INTO `tnilai` VALUES (25, 9, 2, 5600.00, 9);
INSERT INTO `tnilai` VALUES (26, 9, 3, 17500.00, 9);
INSERT INTO `tnilai` VALUES (27, 9, 4, 3.00, 9);
INSERT INTO `tnilai` VALUES (28, 10, 2, 2450.00, 10);
INSERT INTO `tnilai` VALUES (29, 10, 3, 10500.00, 10);
INSERT INTO `tnilai` VALUES (30, 10, 4, 1.00, 10);
INSERT INTO `tnilai` VALUES (31, 11, 2, 24500.00, 11);
INSERT INTO `tnilai` VALUES (32, 11, 3, 43000.00, 11);
INSERT INTO `tnilai` VALUES (33, 11, 4, 2.00, 11);
INSERT INTO `tnilai` VALUES (34, 12, 2, 2000.00, 12);
INSERT INTO `tnilai` VALUES (35, 12, 3, 5600.00, 12);
INSERT INTO `tnilai` VALUES (36, 12, 4, 3.00, 12);
INSERT INTO `tnilai` VALUES (37, 13, 2, 2450.00, 13);
INSERT INTO `tnilai` VALUES (38, 13, 3, 5350.00, 13);
INSERT INTO `tnilai` VALUES (39, 13, 4, 1.00, 13);
INSERT INTO `tnilai` VALUES (40, 14, 2, 1500.00, 14);
INSERT INTO `tnilai` VALUES (41, 14, 3, 7500.00, 14);
INSERT INTO `tnilai` VALUES (42, 14, 4, 1.00, 14);
INSERT INTO `tnilai` VALUES (43, 15, 2, 2100.00, 15);
INSERT INTO `tnilai` VALUES (44, 15, 3, 6500.00, 15);
INSERT INTO `tnilai` VALUES (45, 15, 4, 1.00, 15);

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
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tumkm
-- ----------------------------
INSERT INTO `tumkm` VALUES (1, 'Sutarmo', 'Sutarmo', 'Desa Gendayaan', '-8.156265281745712, 110.8857988005227', 6, 'LOKAL');
INSERT INTO `tumkm` VALUES (2, 'Dedy Sunaryo', 'Dedy Sunaryo', 'Desa Sambiharjo', '-8.173118150419844, 110.87472603394724', 10, 'LOKAL');
INSERT INTO `tumkm` VALUES (3, 'Suranto', 'Suranto', 'Desa Gunturharjo', '-8.208371987092022, 110.90117946738884', 3, 'LOKAL');
INSERT INTO `tumkm` VALUES (4, 'Uus Yadi', 'Uus Yadi', 'Desa Paranggupito', '-8.16311676846661, 110.8517073161812', 7, 'LOKAL');
INSERT INTO `tumkm` VALUES (5, 'Hery', 'Hery', 'Desa Gunturharjo', '-8.166432890219763, 110.89093730524002', 5, 'LOKAL');
INSERT INTO `tumkm` VALUES (6, 'Wiwin', 'Wiwin', 'Desa Ketos', '-8.162889099368657, 110.85001216008504', 2, 'LOKAL');
INSERT INTO `tumkm` VALUES (7, 'wahyu', 'wahyu', 'Desa Gudangharjo', '-8.166628697193133, 110.85841954424575', 1, 'LOKAL');
INSERT INTO `tumkm` VALUES (8, 'Siwi', 'Siwi', 'Desa Gunturharjo', '-8.163082916801502, 110.85163355543689', 9, 'LOKAL');
INSERT INTO `tumkm` VALUES (9, 'Putri', 'Putri', 'Desa Jahunut', '-8.14463200518247, 110.85085571480938', 11, 'LOKAL');
INSERT INTO `tumkm` VALUES (10, 'Ari', 'Ari', 'Desa Ketos', '-8.160978797862295, 110.85138545110175', 12, 'LOKAL');
INSERT INTO `tumkm` VALUES (11, 'andi', 'andi', 'Desa Gendayaan', '-8.153142897921548, 110.88952170666168', 6, 'LOKAL');
INSERT INTO `tumkm` VALUES (12, 'sitri', 'sitri', 'Desa Gendayaan', '-8.143922297606323, 110.88331507498671', 13, 'LOKAL');
INSERT INTO `tumkm` VALUES (13, 'Tejo', 'Tejo', 'Desa Gendayaan', '-8.143797505070676, 110.88248090798137', 4, 'LOKAL');
INSERT INTO `tumkm` VALUES (14, 'Septi', 'Septi', 'Desa Gendayaan', '-8.15433437165339, 110.88699372464949', 8, 'LOKAL');
INSERT INTO `tumkm` VALUES (15, 'Juhermini', 'Juhermini', 'Desa Gendayaan', '-8.15912545427397, 110.88751541430473', 14, 'LOKAL');

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
