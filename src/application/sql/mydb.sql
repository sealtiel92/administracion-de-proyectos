drop database mydb;
create database mydb;
use mydb;

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `groups` VALUES (1,'admin','Administrator'),(2,'members','General User'),(3,'cliente','cliente');

DROP TABLE IF EXISTS `login_attempts`;

CREATE TABLE `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `producto`;
CREATE TABLE `producto` (
  `idproducto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idproducto`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `producto` VALUES (1,'camisa'),(2,'playera');


DROP TABLE IF EXISTS `detalle`;

CREATE TABLE `detalle` (
  `idproducto` int(11) NOT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  `talla` varchar(45) DEFAULT NULL,
  `marca` varchar(45) DEFAULT NULL,
  `existencias` int(11) DEFAULT NULL,
  `color` varchar(45) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  KEY `fk_detalle_producto1_idx` (`idproducto`),
  CONSTRAINT `fk_detalle_producto1` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `detalle` VALUES (1,'polo','M','fruit',100,'negra',20),(2,'V','M','fruit',100,'blanco',20),(1,'polo','CH','fruit',100,'negra',18),(2,'v','CH','fruit',100,'negra',18);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `users` VALUES (1,'127.0.0.1','administrator','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36','','admin@admin.com','',NULL,NULL,NULL,1268889823,1430362039,1,'Admin','istrator','0'),(2,'127.0.0.1','seat hh','$2y$08$tiZvgHOwIZ8pvxreIpI44OJOW..0nPwSk8FYDaMEWf0JceJfPgb4e',NULL,'sealtiel888@gmail.com',NULL,NULL,NULL,NULL,1430358959,NULL,1,'seat','hh','2288182818'),(3,'127.0.0.1','seat huerta','$2y$08$r2Dxr8reJ9vgZdtc1ZK39e5J8SNQXGcsCBaQlKE9twhiq//tOcxJK',NULL,'sealtiel92@hotmail.com',NULL,NULL,NULL,'68AWvlxaS6mg0CrMKbFRbe',1430359151,1430853988,1,'seat','huerta','2288182818');

DROP TABLE IF EXISTS `users_groups`;

CREATE TABLE `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `users_groups` VALUES (1,1,1),(2,2,2),(3,3,3);

DROP TABLE IF EXISTS `venta`;

CREATE TABLE `venta` (
  `idventa` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `monto` float DEFAULT NULL,
  PRIMARY KEY (`idventa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `pedido`;

CREATE TABLE `pedido` (
  `idpedido` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) unsigned NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `fechaI` date DEFAULT NULL,
  `fechaE` date DEFAULT NULL,
  `desc` text,
  PRIMARY KEY (`idpedido`),
  KEY `fk_pedido_users1_idx` (`users_id`),
  CONSTRAINT `fk_pedido_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `pedido` VALUES (1,3,100,'2015-05-04','2015-05-06','bordado en la espalda\r\nflisol grande bordado en la espalda\r\nflisol grande bordado en la espalda\r\nflisol grande bordado en la espalda\r\nflisol grande bordado en la espalda\r\nflisol grande bordado en la espalda\r\nflisol grande');


DROP TABLE IF EXISTS `tiene`;

CREATE TABLE `tiene` (
  `idventa` int(11) DEFAULT NULL,
  `idpedido` int(11) DEFAULT NULL,
  `edo` tinyint(1) DEFAULT NULL,
  KEY `fk_venta_has_pedido_pedido1_idx` (`idpedido`),
  KEY `fk_venta_has_pedido_venta1_idx` (`idventa`),
  CONSTRAINT `fk_venta_has_pedido_pedido1` FOREIGN KEY (`idpedido`) REFERENCES `pedido` (`idpedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_venta_has_pedido_venta1` FOREIGN KEY (`idventa`) REFERENCES `venta` (`idventa`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `utiliza`;

CREATE TABLE `utiliza` (
  `idproducto` int(11) DEFAULT NULL,
  `idpedido` int(11) DEFAULT NULL,
  KEY `fk_producto_has_pedido_pedido1_idx` (`idpedido`),
  KEY `fk_producto_has_pedido_producto1_idx` (`idproducto`),
  CONSTRAINT `fk_producto_has_pedido_pedido1` FOREIGN KEY (`idpedido`) REFERENCES `pedido` (`idpedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_producto_has_pedido_producto1` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


