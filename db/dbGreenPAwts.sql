/*crear bases de datos*/
create database `greenPawts`;

use `greenPawts`;

/*CRea la tabla*/
CREATE TABLE productos_mascotas (
id int primary key not null,
nombre_producto varchar(50) null,
precio_producto bigint(100) NULL,
cantidad_producto bigint(100) NULL,
stock_producto bigint(100) NULL,
creacion_producto date,
descripcion_producto varchar(50) NULL
);
/*INserta la informacion de la tabla*/
INSERT INTO productos_mascotas (
	id,
	nombre_producto,
	precio_producto,
	cantidad_producto,
	stock_producto,
	creacion_producto,
	descripcion_producto)
	
	/*Almacena los datos de la tabla*/
values(1,'champu gree pawts',15.000,4,10,'2022/06/12','champu anti-pulgas 600ml'),
(2,'champu gree pawts',13.000,5,10,'2022/02/12','acondionador desenrredante 600ml'),
(3,'champu gree pawts',15.000,4,10,'2022/05/12','javon antipulgas en barra');
