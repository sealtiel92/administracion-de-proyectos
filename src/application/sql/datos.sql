INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1,'admin','Administrator'),
(2,'members','General User'),
(3,'cliente','cliente');

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`,
 `email`, `activation_code`, `forgotten_password_code`, `created_on`,
  `last_login`, `active`, `first_name`, `last_name`, `phone`) 
VALUES ('1','127.0.0.1','administrator',
'$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36',
'','admin@admin.com','',NULL,'1268889823','1268889823','1', 'Admin','istrator','0');

insert into producto (nombre) values ('camisa');
insert into producto (nombre) values ('playera');


insert into detalle (idproducto,tipo,talla,marca,cantidad,color) values(1,'polo','M','fruit',100,'negra');
insert into detalle (idproducto,tipo,talla,marca,cantidad,color) values(2,'V','M','fruit',100,'blanco');

insert into users_groups (user_id, group_id) values(1,1);
