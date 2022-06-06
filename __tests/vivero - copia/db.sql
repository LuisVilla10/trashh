drop database if exists vivero;
CREATE DATABASE IF NOT EXISTS `vivero` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `vivero`;

CREATE TABLE `plantas` (
	`id` int(12) AUTO_INCREMENT,
	`nombre` varchar(50) NOT NULL,
	`descripcion` varchar(255) NOT NULL,
	`imagen` varchar(500) NOT NULL,
	 PRIMARY KEY (`id`)
);

create table `users` (
	`id` int(12) AUTO_INCREMENT, 
	`username` varchar(50) NOT NULL, 
	`password` varchar(255) NOT NULL, 
	`is_admin` boolean NOT NULL,
	PRIMARY KEY (`id`)
);
