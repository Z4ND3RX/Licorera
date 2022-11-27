CREATE DATABASE licorera;
USE licorera;

CREATE TABLE usuarios(
cedula BIGINT PRIMARY KEY NOT NULL,
nombre VARCHAR(25) NOT NULL,
apellido VARCHAR(25),
rol VARCHAR(25),
username VARCHAR(20) NOT NULL,
pass VARCHAR(250) NOT NULL
);

CREATE TABLE Productos(
codProducto BIGINT PRIMARY KEY NOT NULL,
nombreProducto VARCHAR(50) NOT NULL,
distribuidor VARCHAR(50) NOT NULL,
precioVenta DOUBLE NOT NULL,
precioCompra DOUBLE NOT NULL,
cantidadStock INT NOT NULL
);

CREATE TABLE carrito(
id_sesion VARCHAR(20) NOT NULL,
codProductoC BIGINT NOT NULL,
FOREIGN KEY (codProductoC) REFERENCES Productos (codProducto),
cantidad INT NOT NULL
);

CREATE TABLE facturas(
idVenta BIGINT AUTO_INCREMENT PRIMARY KEY NOT NULL,
descripcion TEXT NOT NULL,
fechaVenta DATE NOT NULL,
totalVenta DOUBLE NOT NULL
);

CREATE PROCEDURE insertarUsuario (ced BIGINT, nom VARCHAR(25), ape VARCHAR(25), r VARCHAR(25), userX VARCHAR(20), pss VARCHAR(250))
	INSERT INTO usuarios VALUES (ced, nom, ape, r, userX, pss);

CREATE PROCEDURE registrarProducto (cod BIGINT, nom VARCHAR(50), dist VARCHAR(50), pv DOUBLE, pc DOUBLE, cant INT)
	INSERT INTO Productos VALUES (cod, nom, dist, pv, pc, cant);

CREATE PROCEDURE eliminarProductoInventario (codP BIGINT)
	DELETE FROM Productos WHERE codProducto = codP;

CREATE PROCEDURE obtenerCantidadStock (codigo BIGINT)
	SELECT cantidadStock FROM Productos WHERE codProducto = codigo;
    
CREATE PROCEDURE actualizarCantidadStock (codigo BIGINT, cant INT)
	UPDATE Productos SET cantidadStock = cantidadStock - cant WHERE codProducto = codigo;
	
CREATE PROCEDURE actualizarProductoInventario (cod BIGINT, nom VARCHAR(50), dist VARCHAR(50), pv DOUBLE, pc DOUBLE, cant INT)
	UPDATE Productos SET codProducto = cod, nombreProducto = nom, distribuidor = dist, precioVenta = pv, precioCompra = pc, cantidadStock = cant WHERE codProducto = cod;
     
CREATE PROCEDURE agregarProductoCarrito (userX VARCHAR(20), codPro BIGINT, cant INT)
	INSERT INTO carrito VALUES (userX, codPro, cant);
    
CREATE PROCEDURE eliminarProductoCarrito (userX VARCHAR(20), codPC BIGINT)
	DELETE FROM carrito WHERE id_sesion = userX AND codProductoC = codPC;

CREATE PROCEDURE loguearse(userX VARCHAR(20), pss VARCHAR(250))
	SELECT * FROM usuarios WHERE username= userX AND pass= pss;
    
CREATE PROCEDURE validarProductoRegistrado (codPro BIGINT)
	SELECT * FROM Productos WHERE codProducto = codPro;
    
CREATE PROCEDURE validarProductoCarrito (codPro BIGINT, userX VARCHAR(20))
	SELECT * FROM carrito WHERE codProductoC = codPro AND id_sesion = userX;
    
CREATE PROCEDURE obtenerProductosCarrito (userX VARCHAR(20))
	SELECT c.codProductoC, p.nombreProducto, p.precioVenta, c.cantidad, (c.cantidad * p.precioVenta) total FROM Productos p JOIN carrito c ON p.codProducto = c.codProductoC WHERE c.id_sesion = userX;

CREATE PROCEDURE obtenerProductos()
	SELECT * FROM Productos;

CREATE PROCEDURE buscarProducto(codP BIGINT)
	SELECT * FROM Productos WHERE codProducto = codP;
    
CREATE PROCEDURE validarRolAdmin (userX VARCHAR(20))
	SELECT rol FROM usuarios where username = userX AND rol = "Administrador";
    
CREATE PROCEDURE eliminarTodoCarrito (userX VARCHAR(20))
	DELETE FROM carrito WHERE id_sesion = userX;
    
CREATE PROCEDURE insertarFactura (descr TEXT, fech DATE, tot DOUBLE)
	INSERT INTO facturas (Descripcion, fechaVenta, totalVenta) VALUES (descr, fech, tot);
    
CREATE PROCEDURE obtenerFacturas ()
	SELECT * FROM facturas;
    
CREATE PROCEDURE buscarTotalFacturas(inicio DATE, fin DATE)
	SELECT SUM(totalVenta) as totalVentas FROM facturas WHERE fechaVenta BETWEEN inicio AND fin;
    
CALL buscarTotalFacturas('2022-07-09', '2022-07-09');

UPDATE facturas SET fechaVenta = '2022-07-03' WHERE idVenta = 3;
    
CALL insertarUsuario ('1004778042', 'Andres', 'Ocampo', 'Administrador', 'z4nd3r', 'helado444');
CALL insertarUsuario ('0000', 'Prueba', 'Prueba', 'Cajero', 'prueba', 'prueba');
CALL registrarProducto (1, 'xd', 'xd', 1000, 1000, 8);
CALL actualizarCantidadStock (1, 3);