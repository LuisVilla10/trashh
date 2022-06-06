drop database if exists luis;
create database luis;
use luis;

create table Estudiante(nombre varchar(60), apellidos varchar(60), correo varchar(30) not null, edad int, sexo varchar(10), celular varchar(10), id int auto_increment, primary key(id) );
create user 'luis'@'%' identified by 'villa';
grant all privileges on luis.* to 'luis'@'%';
flush privileges;
