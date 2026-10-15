-- Migration for Relational Permasalahan
CREATE TABLE IF NOT EXISTS `isustrategisdaerah_permasalahan` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `IdIsuStrategis` int(11) NOT NULL,
  `Permasalahan` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `IdIsuStrategis` (`IdIsuStrategis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
