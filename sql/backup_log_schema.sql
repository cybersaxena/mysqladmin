create database whorestore;

use whorestore;

CREATE TABLE IF NOT EXISTS `bitacora` (
  `nombre` varchar(20) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nomDB` varchar(45) DEFAULT NULL,
  `tipo` char(13) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;