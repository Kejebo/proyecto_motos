-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-07-2020 a las 05:34:53
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_tallermotos`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_compra` (`id` INT)  begin
		delete from compras where id_compra=id;
	end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_compra_material` (`id` INT)  begin
		delete from compras_materiales where id_compra=id;
	end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_detalle_reparacion` (`id` INT)  begin
		delete from detalle_reparaciones where id_reparacion=id;
	end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_proveedor` (IN `id` INT)  begin
		UPDATE proveedores p set p.estado=0  where id_proveedor=id; 
	end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_reparacion` (`id` INT)  begin
		delete from reparaciones where id_reparacion=id;
	end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_venta` (`id` INT)  begin
		delete from ventas where id_venta=id;
	end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_venta_material` (`id` INT)  begin
		delete from ventas_materiales where id_venta=id;
	end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_categorias_motos` ()  begin
	select * from  categorias_motos;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_categorias_motos_activas` ()  begin
	select * from categorias_motos where estado_categoria_moto = true;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_categorias_motos_inactivas` ()  begin
	select * from categorias_motos where estado_categoria_moto = false;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_cilindrajes` ()  begin
	select * from  cilindrajes;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_cilindrajes_activos` ()  begin
	select * from cilindrajes where estado_cilindraje = true;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_cilindrajes_inactivos` ()  begin
	select * from cilindrajes where estado_cilindraje = false;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_cliente` (`id` VARCHAR(50))  begin
select * from clientes where correo=id;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_clientes` ()  begin
	select * from clientes;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_clientes_activos` ()  begin
	select * from clientes where estado_cliente = true;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_clientes_inactivos` ()  begin
	select * from clientes where estado_cliente = false;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_compra` (IN `id` INT)  begin
		select c.id_compra as id,factura as factura, p.nombre as proveedor, u.nombre_completo as usuario, c.fecha as fecha,c_m.precio*c_m.cantidad as saldo 
        , c_m.precio as precio, c_m.cantidad as cantidad, 
        concat(m.nombre,' ',mm.nombre_marca,' ',if(m.presentacion>0,m.presentacion,''),' ',me.nombre_medida) as nombre_material, m.id_material as material from compras_materiales c_m
            inner join compras c on c.id_compra=c_m.id_compra
            inner join materiales m on m.id_material = c_m.id_material
            inner join marcas_materiales mm on mm.id_marca_material=m.id_marca_material
            inner join categorias_material cm on cm.id_categoria=m.id_categoria
			inner join medidas me on me.id_medida=cm.id_medida
            inner join proveedores p on p.id_proveedor=c.id_proveedor
            inner join usuarios u on u.id_usuario=c.id_usuario
            where c_m.id_compra=id
			order by m.id_material
            desc;

		end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_compras` ()  begin
		select c.id_compra as id,factura as factura, p.nombre as proveedor, c.fecha as fecha, u.nombre_completo as usuario, sum(c_m.precio*c_m.cantidad) as saldo from compras c
            inner join compras_materiales c_m on c_m.id_compra=c.id_compra
            inner join materiales m on m.id_material = c_m.id_material
            inner join proveedores p on p.id_proveedor=c.id_proveedor
            inner join usuarios u on u.id_usuario=c.id_usuario
			group by c.id_compra
			order by c.id_compra
            desc;

		end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_compras_periodo` (IN `inicio` DATE, IN `final` DATE)  NO SQL
begin
		select c.id_compra as id,factura as factura, p.nombre as proveedor, c.fecha as fecha, u.nombre_completo as usuario, sum(c_m.precio*c_m.cantidad) as saldo from compras c
            inner join compras_materiales c_m on c_m.id_compra=c.id_compra
            inner join materiales m on m.id_material = c_m.id_material
            inner join proveedores p on p.id_proveedor=c.id_proveedor 
            inner join usuarios u on u.id_usuario=c.id_usuario where c.fecha BETWEEN inicio and final
			group by c.id_compra
			order by c.id_compra
            desc;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_compra_anual` (IN `fecha` INT)  NO SQL
begin
		select c.id_compra as id,factura as factura, p.nombre as proveedor, c.fecha as fecha,sum(c_m.precio*c_m.cantidad) as saldo, u.nombre_completo as usuario from compras c
            inner join compras_materiales c_m on c_m.id_compra=c.id_compra
            inner join materiales m on m.id_material = c_m.id_material
            inner join proveedores p on p.id_proveedor=c.id_proveedor 
            inner join usuarios u on u.id_usuario=c.id_usuario WHERE year(c.fecha)=fecha
			group by c.id_compra
			order by c.id_compra
            desc;

		end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_compra_diaria` (IN `fecha` DATE)  NO SQL
begin
		select c.id_compra as id,factura as factura, p.nombre as proveedor, c.fecha as fecha,u.nombre_completo as usuario, sum(c_m.precio*c_m.cantidad) as saldo from compras c
            inner join compras_materiales c_m on c_m.id_compra=c.id_compra
            inner join materiales m on m.id_material = c_m.id_material
            inner join proveedores p on p.id_proveedor=c.id_proveedor 
            inner join usuarios u on u.id_usuario =c.id_usuario  where c.fecha=fecha
			group by c.id_compra
			order by c.id_compra
            desc;

		end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_compra_mensual` (IN `fecha` DATE)  NO SQL
begin
		select c.id_compra as id,factura as factura, p.nombre as proveedor, c.fecha as fecha, u.nombre_completo as usuario, sum(c_m.precio*c_m.cantidad) as saldo from compras c
            inner join compras_materiales c_m on c_m.id_compra=c.id_compra
            inner join materiales m on m.id_material = c_m.id_material
            inner join proveedores p on p.id_proveedor=c.id_proveedor 
            inner join usuarios u on u.id_usuario=c.id_usuario WHERE MONTH(c.fecha)= MONTH(fecha) AND year(c.fecha)= year(fecha)
			group by c.id_compra
			order by c.id_compra
            desc;

		end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_detalle_compra` (`id` INT)  begin
		select c.id_compra as id,factura as factura, c_m.precio as precio, c_m.cantidad as cantidad, 
        concat(m.nombre,' ',mm.nombre_marca,' ',if(m.presentacion>0,m.presentacion,''),' ',me.nombre_medida) as nombre_material, m.id_material as material from compras_materiales c_m
            inner join compras c on c.id_compra=c_m.id_compra
            inner join materiales m on m.id_material = c_m.id_material
            inner join marcas_materiales mm on mm.id_marca_material=m.id_marca_material
            inner join categorias_material cm on cm.id_categoria=m.id_categoria
			inner join medidas me on me.id_medida=cm.id_medida where c.id_compra=id
			order by m.id_material
            desc;

		end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_detalle_reparacion` (IN `id` INT)  begin
	select m.nombre as nombre, me.nombre_medida as medida,m.cantidad_inicial as cantidad,m.cantidad_inicial*m.presentacion as total 
		,COALESCE(m.presentacion,0) as monto, mm.nombre_marca as marca, d.cantidad as cant, m.id_material as id_material from detalle_reparacion d 
    inner join materiales m on m.id_material=d.id_material
     inner join marcas_materiales mm on mm.id_marca_material=m.id_marca_material
		inner join categorias_material cm on cm.id_categoria=m.id_categoria
		inner join medidas me on me.id_medida=cm.id_medida
    where d.id_reparacion=id
    order by m.id_material desc;
	end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_detalle_trabajo` (IN `id` INT)  begin
	select t.nombre_trabajo as nombre_trabajo, t.id_trabajo as id_trabajo from detalle_trabajo d 
	inner join trabajos t on t.id_trabajo=d.id_trabajo
    where d.id_reparacion=id
    order by t.id_trabajo desc;
	end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_detalle_venta` (`id` INT)  begin
		select  v.id_venta as id, v_m.precio*v_m.cantidad as saldo 
        , v_m.precio as precio, v_m.cantidad as cantidad, 
        concat(m.nombre,' ',mm.nombre_marca,' ',if(m.presentacion>0,m.presentacion,''),' ',me.nombre_medida) as nombre_material, m.id_material as material  
        from ventas_materiales v_m
            inner join ventas v on v_m.id_venta=v.id_venta
			inner join materiales m on m.id_material = v_m.id_material
            inner join marcas_materiales mm on mm.id_marca_material=m.id_marca_material
            inner join categorias_material cm on cm.id_categoria=m.id_categoria
			inner join medidas me on me.id_medida=cm.id_medida
            where v.id_venta=id
			order by m.id_material
            desc;

		end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_inventario` ()  begin
        select  m.precio_venta as venta, m.precio_compra as compra,m.id_material as id, m.nombre as nombre, m.unidad as medida,m.cantidad_inicial as cantidad,m.cantidad_inicial*m.presentacion as total 
		,if(m.presentacion>0,m.presentacion,'') as monto, mm.nombre_marca as marca,m.cantidad_inicial+coalesce(compra,0)-coalesce(venta,0)-coalesce(reparacion,0) as saldo 

		from materiales m 
        inner join marcas_materiales mm on mm.id_marca_material=m.id_marca_material
		inner join categorias_material cm on cm.id_categoria=m.id_categoria
		inner join medidas me on me.id_medida=cm.id_medida
		left outer join(select sum(detalle.cantidad) as reparacion, detalle.id_material
		from reparaciones r inner join detalle_reparacion detalle ON detalle.id_reparacion=r.id_reparacion
		group by detalle.id_material) m1 on
		 m.id_material=m1.id_material

		left outer join(select sum(m_v.cantidad) as venta, m_v.id_material
		from ventas v inner join ventas_materiales m_v ON m_v.id_venta=v.id_venta
		group by m_v.id_material) m3 on
		 m.id_material=m3.id_material

		left outer join(select sum(c_m.cantidad) as compra,c_m.id_material
		from compras c inner join compras_materiales c_m ON c_m.id_compra=c.id_compra
		group by c_m.id_material) m2 on
		 m.id_material=m2.id_material
		where m.estado =1;
	end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_marcas_motos` ()  begin
	select * from  marcas_motos;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_marcas_motos_activas` ()  begin
	select * from marcas_motos where estado_marca_moto = true;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_marcas_motos_categorias_motos` ()  begin
	select * from  marcas_motos_categorias_motos;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_marcas_motos_inactivas` ()  begin
	select * from marcas_motos where estado_marca_moto = false;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_marcas_repuesto` ()  begin
	select * from  marcas_repuestos;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_marcas_repuestos_activos` ()  begin
	select * from marcas_repuestos where estado_marca_repuesto = true;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_marcas_repuestos_inactivas` ()  begin
	select * from marcas_repuesto where estado_marca_repuesto = false;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_marca_moto_categoria_moto` (`id` INT)  begin
	select * from  marcas_motos_categorias_motos inner join marcas_motos on 
    marcas_motos.id_marca_moto = marcas_motos_categorias_motos.id_marca_moto 
    inner join categorias_motos on categorias_motos.id_categoria_moto = 
    marcas_motos_categorias_motos.id_categoria_moto where id_marca_moto = id;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_material` (`id` INT)  begin
		select * from materiales m 
		inner join marcas_materiales mm 
		inner join medidas me 
		inner join categorias_material cm where
		mm.id_marca_material= m.id_marca_material and cm.id_medida=me.id_medida and m.id_categoria=cm.id_categoria and m.id_material=id;
	 end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_mes` (IN `fecha` DATE)  NO SQL
BEGIN
	    SET lc_time_names = 'es_CR';

	SELECT DATE_FORMAT(fecha,'%M') as mes;
    
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_modelos_motos` ()  begin
	select * from  modelos_motos;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_modelos_motos_activos` ()  begin
	select * from modelos_motos where estado_modelo_moto = true;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_modelos_motos_inactivos` ()  begin
	select * from modelos_motos where estado_modelo_moto = false;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_moto` (`id` INT)  begin
	select * from  motos 
    inner join clientes on clientes.id_cliente = motos.id_cliente
    inner join marcas_motos ma on ma.id_marca_moto = motos.id_marca_moto inner join
    modelos_motos mm on mm.id_modelo_moto = motos.id_modelo_moto inner join
    transmisiones on transmisiones.id_transmision = motos.id_transmision inner join
    cilindrajes on cilindrajes.id_cilindraje = motos.id_cilindraje inner join
    combustible combus on combus.id_combustible = motos.id_combustible where motos.id_moto=id; 
    end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_motos` ()  begin
	select * from  motos inner join clientes on clientes.id_cliente = motos.id_cliente
    inner join marcas_motos on marcas_motos.id_marca_moto = motos.id_marca_moto inner join
    modelos_motos on modelos_motos.id_modelo_moto = motos.id_modelo_moto inner join
    transmisiones on transmisiones.id_transmision = motos.id_transmision inner join
    cilindrajes on cilindrajes.id_cilindraje = motos.id_cilindraje inner join
    categorias_motos on categorias_motos.id_categoria_moto = motos.id_categoria_moto;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_motos_activas` ()  begin
	select clientes.nombre_cliente as cliente, concat(ma.nombre_marca,' ',mm.nombre_modelo,' ',mm.ano) as moto ,
    combus.tipo_combustible as gasolina, motos.numero_placa as placa, motos.id_moto as id,
    motos.kilometraje as kilometraje, transmisiones.nombre_transmision as transmision from  motos 
    inner join clientes on clientes.id_cliente = motos.id_cliente
    inner join marcas_motos ma on ma.id_marca_moto = motos.id_marca_moto inner join
    modelos_motos mm on mm.id_modelo_moto = motos.id_modelo_moto inner join
    transmisiones on transmisiones.id_transmision = motos.id_transmision inner join
    cilindrajes on cilindrajes.id_cilindraje = motos.id_cilindraje inner join
    combustible combus on combus.id_combustible = motos.id_combustible where estado_moto = true 
    order by motos.id_moto asc;
    end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_motos_cliente` (IN `id` INT)  begin
	select clientes.nombre_cliente as cliente, concat(ma.nombre_marca,' ',mm.nombre_modelo,' ',mm.ano) as moto ,
    combus.tipo_combustible as gasolina, motos.numero_placa as placa, cilindrajes.tamano_cilindraje as cilindraje, motos.id_moto as id, motos.nuevo_kilometraje as nuevo_kilometraje,
    motos.kilometraje as kilometraje, transmisiones.nombre_transmision as transmision from  motos 
    inner join clientes on clientes.id_cliente = motos.id_cliente
    inner join marcas_motos ma on ma.id_marca_moto = motos.id_marca_moto inner join
    modelos_motos mm on mm.id_modelo_moto = motos.id_modelo_moto inner join
    transmisiones on transmisiones.id_transmision = motos.id_transmision inner join
    cilindrajes on cilindrajes.id_cilindraje = motos.id_cilindraje inner join
    combustible combus on combus.id_combustible = motos.id_combustible where estado_moto = true and motos.id_cliente=id
    order by motos.id_moto asc;
    end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_motos_inactivas` ()  begin
	select * from  motos inner join clientes on clientes.id_cliente = motos.id_cliente
    inner join marcas_motos on marcas_motos.id_marca_moto = motos.id_marca_moto inner join
    modelos_motos on modelos_motos.id_modelo_moto = motos.id_modelo_moto inner join
    transmisiones on transmisiones.id_transmision = motos.id_transmision inner join
    cilindrajes on cilindrajes.id_cilindraje = motos.id_cilindraje inner join
    categorias_motos on categorias_motos.id_categoria_moto = motos.id_categoria_moto where estado_moto = false;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_reparacion` (IN `id` INT)  NO SQL
begin
	select r.id_reparacion as id, r.fecha_entrada as fecha_entrada,r.fecha_salida as fecha_salida,clientes.nombre_cliente as cliente, clientes.id_cliente as id_cliente,concat(ma.nombre_marca,' ',mm.nombre_modelo,' ',mm.ano) as moto , r.descripcion as descripcion, u.nombre_completo as usuario, r.precio as precio,
    m.numero_placa as placa, r.precio as monto, m.id_moto as id_moto, r.kilometraje_entrada as kilometraje_entrada,r.kilometraje_entrada as kilometraje_salida,m.nuevo_kilometraje as cita, r.estado as estado from  reparaciones r 
    inner join motos m on r.id_moto=m.id_moto
    inner join clientes on clientes.id_cliente = m.id_cliente
    inner join marcas_motos ma on ma.id_marca_moto = m.id_marca_moto inner join
    modelos_motos mm on mm.id_modelo_moto = m.id_modelo_moto
    INNER JOIN usuarios u on u.id_usuario=r.id_usuario
    where r.id_reparacion=id;  
	end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_reparaciones` ()  begin
	select r.id_reparacion as id, fecha_entrada as fecha,clientes.nombre_cliente as cliente, concat(ma.nombre_marca,' ',mm.nombre_modelo,' ',mm.ano) as moto ,
    m.numero_placa as placa, r.precio as monto, r.estado as estado from  reparaciones r 
    inner join motos m on r.id_moto=m.id_moto
    inner join clientes on clientes.id_cliente = m.id_cliente
    inner join marcas_motos ma on ma.id_marca_moto = m.id_marca_moto inner join
    modelos_motos mm on mm.id_modelo_moto = m.id_modelo_moto
    order by r.id_reparacion asc;
    end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_reparaciones_anual` (IN `fecha` INT)  NO SQL
begin
	select r.id_reparacion as id, fecha_entrada as fecha,clientes.nombre_cliente as cliente, concat(ma.nombre_marca,' ',mm.nombre_modelo,' ',mm.ano) as moto ,
    m.numero_placa as placa, r.precio as monto, r.estado as estado from  reparaciones r 
    inner join motos m on r.id_moto=m.id_moto
    inner join clientes on clientes.id_cliente = m.id_cliente
    inner join marcas_motos ma on ma.id_marca_moto = m.id_marca_moto inner join
    modelos_motos mm on mm.id_modelo_moto = m.id_modelo_moto where year(r.fecha_entrada)=fecha
    order by r.id_reparacion asc;
    end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_reparaciones_diaria` (IN `fecha` DATE)  NO SQL
begin
	select r.id_reparacion as id, r.fecha_entrada as fecha,clientes.nombre_cliente as cliente, concat(ma.nombre_marca,' ',mm.nombre_modelo,' ',mm.ano) as moto ,
    m.numero_placa as placa, r.precio as monto, r.estado as estado from  reparaciones r 
    inner join motos m on r.id_moto=m.id_moto
    inner join clientes on clientes.id_cliente = m.id_cliente
    inner join marcas_motos ma on ma.id_marca_moto = m.id_marca_moto inner join
    modelos_motos mm on mm.id_modelo_moto = m.id_modelo_moto WHERE r.fecha_entrada=fecha
    order by r.id_reparacion asc;
    end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_reparaciones_mensual` (IN `fecha` DATE)  NO SQL
begin
	select r.id_reparacion as id, r.fecha_entrada as fecha,clientes.nombre_cliente as cliente, concat(ma.nombre_marca,' ',mm.nombre_modelo,' ',mm.ano) as moto ,
    m.numero_placa as placa, r.precio as monto, r.estado as estado from  reparaciones r 
    inner join motos m on r.id_moto=m.id_moto
    inner join clientes on clientes.id_cliente = m.id_cliente
    inner join marcas_motos ma on ma.id_marca_moto = m.id_marca_moto inner join
    modelos_motos mm on mm.id_modelo_moto = m.id_modelo_moto WHERE  month(r.fecha_entrada) = month(fecha) and year(r.fecha_entrada)= year(fecha)
    order by r.id_reparacion asc;
    end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_reparaciones_periodica` (IN `inicio` DATE, IN `final` DATE)  NO SQL
begin
	select r.id_reparacion as id, fecha_entrada as fecha,clientes.nombre_cliente as cliente, concat(ma.nombre_marca,' ',mm.nombre_modelo,' ',mm.ano) as moto ,
    m.numero_placa as placa, r.precio as monto, r.estado as estado from  reparaciones r 
    inner join motos m on r.id_moto=m.id_moto
    inner join clientes on clientes.id_cliente = m.id_cliente
    inner join marcas_motos ma on ma.id_marca_moto = m.id_marca_moto inner join
    modelos_motos mm on mm.id_modelo_moto = m.id_modelo_moto where r.fecha_entrada BETWEEN inicio and final
    order by r.id_reparacion asc;
    end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_reparacion_moto` (`placa_moto` INT)  begin
	select r.id_reparacion as id, fecha_entrada as fecha,clientes.nombre_cliente as cliente, clientes.id_cliente as id_cliente,concat(ma.nombre_marca,' ',mm.nombre_modelo,' ',mm.ano) as moto ,
    m.numero_placa as placa, r.precio as monto, m.id_moto as id_moto, r.kilometraje_entrada as kilometraje from  reparaciones r 
    inner join motos m on r.id_moto=m.id_moto
    inner join clientes on clientes.id_cliente = m.id_cliente
    inner join marcas_motos ma on ma.id_marca_moto = m.id_marca_moto inner join
    modelos_motos mm on mm.id_modelo_moto = m.id_modelo_moto where m.numero_placa = placa_moto; 
    end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_saldo` (`id` INT)  begin
        select m.cantidad_inicial+coalesce(compra,0)-coalesce(venta,0)-coalesce(reparacion,0) as saldo 
		from materiales m 
        inner join marcas_materiales mm on mm.id_marca_material=m.id_marca_material
		inner join categorias_material cm on cm.id_categoria=m.id_categoria
		inner join medidas me on me.id_medida=cm.id_medida
		left outer join(select sum(detalle.cantidad) as reparacion, detalle.id_material
		from reparaciones r inner join detalle_reparaciones detalle ON detalle.id_reparacion=r.id_reparacion
		group by detalle.id_material) m1 on
		 m.id_material=m1.id_material

		left outer join(select sum(m_v.cantidad) as venta, m_v.id_material
		from ventas v inner join ventas_materiales m_v ON m_v.id_venta=v.id_venta
		group by m_v.id_material) m3 on
		 m.id_material=m3.id_material

		left outer join(select sum(c_m.cantidad) as compra,c_m.id_material
		from compras c inner join compras_materiales c_m ON c_m.id_compra=c.id_compra
		group by c_m.id_material) m2 on
		 m.id_material=m2.id_material
		where m.id_material=id;
	end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_transmisiones` ()  begin
	select * from  transmisiones;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_transmisiones_activas` ()  begin
	select * from transmisiones where estado_transmision = true;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_transmisiones_inactivas` ()  begin
	select * from transmisiones where estado_transmision = false;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_ultimo_cliente` ()  begin
select * from clientes order by id_cliente desc limit 1;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_ultimo_usuario` ()  begin
select * from usuarios order by id_usuario desc limit 1;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_usuario` (IN `correo` VARCHAR(100), IN `pass` VARCHAR(30))  begin
select * from usuarios where correo_electronico = correo and clave = pass  and estado = 1;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_usuario_cambio` (`correo` VARCHAR(100))  begin
select * from usuarios where correo_electronico = correo and estado_cambio = 0 and estado = 1;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_venta` (IN `id` INT)  begin
		select  v.id_venta as id, c.nombre_cliente as cliente, v.fecha as fecha,v_m.precio*v_m.cantidad as saldo 
        , v_m.precio as precio, v_m.cantidad as cantidad, 
        concat(m.nombre,' ',mm.nombre_marca,' ',if(m.presentacion>0,m.presentacion,''),' ',me.nombre_medida) as nombre_material, m.id_material as material,u.nombre_completo as usuario  
        from ventas_materiales v_m
            inner join ventas v on v_m.id_venta=v.id_venta
			inner join materiales m on m.id_material = v_m.id_material
            inner join marcas_materiales mm on mm.id_marca_material=m.id_marca_material
            inner join categorias_material cm on cm.id_categoria=m.id_categoria
			inner join medidas me on me.id_medida=cm.id_medida
            INNER JOIN usuarios u on u.id_usuario=v.id_usuario
            inner join clientes c on c.id_cliente=v.id_cliente
            where v.id_venta=id
			order by m.id_material
            desc;

		end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_ventas` ()  NO SQL
begin
		select v.id_venta as id, v.fecha as fecha,c.nombre_cliente as cliente,u.nombre_completo as usuario, sum(m.precio_venta*v_m.cantidad) as saldo from ventas v
            inner join ventas_materiales v_m on v_m.id_venta=v.id_venta
            inner join materiales m on m.id_material = v_m.id_material
            inner join clientes c on c.id_cliente=v.id_cliente
            inner join usuarios u on u.id_usuario=v.id_usuario
		group by v.id_venta
			order by v.id_venta desc;
            end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_ventas_anual` (IN `ano` INT)  NO SQL
begin
		select v.id_venta as id, v.fecha as fecha,c.nombre_cliente as cliente, u.nombre_completo as usuario, sum(m.precio_venta*v_m.cantidad) as saldo from ventas v
            inner join ventas_materiales v_m on v_m.id_venta=v.id_venta
            inner join materiales m on m.id_material = v_m.id_material
            inner join clientes c on c.id_cliente=v.id_cliente
            inner join usuarios u on u.id_usuario=v.id_usuario
		where year(v.fecha)= ano	group by v.id_venta
			order by v.id_venta
            desc;
            end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_ventas_diarias` (IN `dia` DATE)  begin
		select v.id_venta as id, v.fecha as fecha,c.nombre_cliente as cliente, u.nombre_completo as usuario, sum(m.precio_venta*v_m.cantidad) as saldo from ventas v
            inner join ventas_materiales v_m on v_m.id_venta=v.id_venta
            inner join materiales m on m.id_material = v_m.id_materia
            inner join usuarios u on u.id_usuario=v.id_usuario
            inner join clientes c on c.id_cliente=v.id_cliente
		where v.fecha=dia	group by v.id_venta
			order by v.id_venta
            desc;

		end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_ventas_mensual` (IN `dia` DATE)  NO SQL
begin
		select v.id_venta as id, v.fecha as fecha,c.nombre_cliente as cliente, u.nombre_completo as usuario, sum(m.precio_venta*v_m.cantidad) as saldo from ventas v
            inner join ventas_materiales v_m on v_m.id_venta=v.id_venta
            inner join materiales m on m.id_material = v_m.id_material
            inner join clientes c on c.id_cliente=v.id_cliente
            inner join usuarios u on u.id_usuario=v.id_usuario
		where MONTH(v.fecha)=Month(dia) AND year(v.fecha)= year(dia)	group by v.id_venta
			order by v.id_venta
            desc;
            END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_ventas_periodo` (IN `inicio` DATE, IN `final` DATE)  NO SQL
begin
		select v.id_venta as id, v.fecha as fecha,c.nombre_cliente as cliente, u.nombre_completo as usuario, sum(m.precio_venta*v_m.cantidad) as saldo from ventas v
            inner join ventas_materiales v_m on v_m.id_venta=v.id_venta
            inner join materiales m on m.id_material = v_m.id_material
            inner join clientes c on c.id_cliente=v.id_cliente
            inner join usuarios u on u.id_usuario=v.id_usuario
		where v.fecha BETWEEN inicio AND final	
        group by v.id_venta
			order by v.id_venta
            desc;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_detalle_reparacion` (`id_moto` INT, `id_reparacion` INT, `id_material` INT, `cantidad` INT)  begin
		insert into detalle_reparaciones(id_moto,id_reparacion,id_material,cantidad) values(id_moto,id_reparacion,id_material,cantidad);
	end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_categorias_motos` (`nombre_cate` VARCHAR(50))  begin
	insert  into categorias_motos(nombre_categoria_moto) values(nombre_cate);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_cilindrajes` (`tam_cilindraje` INT)  begin
	insert  into cilindrajes(tamano_cilindraje) values(tam_cilindraje);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_clientes` (IN `cedula_juri` VARCHAR(15), IN `nombre_client` VARCHAR(50), IN `correo_insti` VARCHAR(50), IN `telefono_insti` VARCHAR(15), IN `clave` VARCHAR(20))  begin
	insert  into clientes(cedula_juridica,
    nombre_cliente,
    correo,telefono,clave) 
    values(cedula_juri,nombre_client,
    correo_insti,telefono_insti,clave);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_compra` (`id_proveedor` INT, `id_usuario` INT, `factura` INT, `fecha` DATE)  begin
		insert into compras(id_proveedor,id_usuario,fecha,factura) values(id_proveedor,id_usuario, fecha,factura);
    end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_compra_material` (`id_compra` INT, `id_material` INT, `precio` INT, `cantidad` INT)  begin
		insert into compras_materiales(id_compra,id_material,precio,cantidad) values(id_compra,id_material,precio,cantidad);
    end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_detalle_reparacion` (`id_reparacion` INT, `id_material` INT, `cantidad` INT)  begin 
		insert into detalle_reparacion(id_reparacion,id_material,cantidad) values(id_reparacion,id_material,cantidad);
	end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_marcas_motos` (`nombre_marc` VARCHAR(25))  begin
	insert  into marcas_motos(nombre_marca) values(nombre_marc);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_marcas_motos_categorias_motos` (`id_marca` INT, `id_categoria` INT)  begin
	insert  into marcas_motos_categorias_motos(id_marca_moto,id_categoria_moto) 
    values(id_marca, id_categoria);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_marcas_repuesto` (`nombre_marca` VARCHAR(25))  begin
	insert  into marcas_repuesto(nombre_marca_respuesto) values(nombre_marca);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_marca_producto` (`nombre` VARCHAR(40))  begin
		insert into marcas_productos(nombre) values(nombre);
        
	end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_material` (IN `nombre` VARCHAR(50), IN `marca` INT, IN `id_categoria` INT, IN `cantidad` INT, IN `presentacion` DOUBLE, IN `medida` VARCHAR(10), IN `precio_compra` INT, IN `precio_venta` INT, IN `cant_minima` INT)  begin
		insert into materiales(nombre,id_marca_material,id_categoria,cantidad_inicial, presentacion,precio_compra,precio_venta,cantidad_minima,unidad) 
        values(nombre,marca,id_categoria,cantidad,presentacion,precio_compra,precio_venta,cant_minima,medida);
	end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_modelos_motos` (IN `nombre_mode` VARCHAR(50), IN `ano` INT)  begin
	insert  into modelos_motos(nombre_modelo,ano) values(nombre_mode, ano);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_motos` (IN `id_client` INT, IN `id_marca_mot` INT, IN `id_modelo_mot` INT, IN `id_transmi` INT, IN `id_cilin` INT, IN `num_chasis` VARCHAR(17), IN `num_placa` VARCHAR(10), IN `kilometra` INT, IN `combustible` INT)  begin
	insert  into motos(id_cliente,id_marca_moto,id_modelo_moto,id_transmision,id_cilindraje,
    numero_chasis,numero_placa,kilometraje,id_combustible) 
    values(id_client, id_marca_mot, id_modelo_mot, id_transmi,
	id_cilin,num_chasis, num_placa,
	kilometra,combustible);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_proveedores` (`nombre` VARCHAR(50), `telefono` VARCHAR(15), `email` VARCHAR(30), `cedula` VARCHAR(20))  begin
		insert into proveedores(nombre,telefono,correo,cedula_juridica) values(nombre,telefono,email,cedula);
    end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_reparacion` (`id_cliente` INT, `id_usuario` INT, `cambio` TEXT, `precio` INT)  begin
		insert into reparaciones(id_cliente,id_usuario,cambio,fecha_entrada,precio) values(id_cliente,id_usuario,cambio,now(),precio);
    end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_transmisiones` (`nombre_trans` VARCHAR(10))  begin
	insert  into transmisiones(nombre_transmision) values(nombre_trans);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_usuarios` (`nombre` VARCHAR(100), `correo` VARCHAR(100), `tipo` VARCHAR(20), `clave` VARCHAR(30))  begin
	insert into usuarios(nombre_completo,correo_electronico,tipo,clave) values(nombre,correo,tipo,clave);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_venta` (`cliente` INT, `id_usuario` INT, `fecha` DATE)  begin
		insert into ventas(id_cliente,id_usuario,fecha) values(cliente,id_usuario, fecha);
    end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_venta_material` (`id_venta` INT, `id_material` INT, `cantidad` INT, `precio` INT)  begin
		insert into ventas_materiales(id_venta,id_material,cantidad,precio) values(id_venta,id_material,cantidad,precio);
    end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_categorias_motos` (`nombre_categoria` VARCHAR(50), `estado` BOOLEAN, `id` INT)  begin
	update categorias_motos set nombre_categoria_moto = nombre_categoria, estado_categoria_moto = 
    estado where id_categoria_moto = id;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_cilindrajes` (`tam_cilindraje` VARCHAR(25), `estado` BOOLEAN, `id` INT)  begin
	update cilindrajes set tamano_cilindraje = tam_cilindraje, estado_cilindraje = estado where id_cilindraje = id;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_clientes` (`cedula_juri` VARCHAR(10), `nombre_client` VARCHAR(100), `contra` VARCHAR(12), `correo_insti` VARCHAR(50), `telefono_insti` VARCHAR(8), `celular_repre` VARCHAR(8), `estado` BOOLEAN, `id` INT)  begin
	update clientes Set cedula_juridica = cedula_juri,nombre_cliente = nombre_client,
    contrasena = contra, correo = correo_insti,
    telefono_institucion = telefono_insti, celular_representante = celular_repre, estado_usuario 
    = estado where id_cliente = id;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_codigo_contrasena` (`contra` VARCHAR(20), `id` INT)  begin
update usuarios set clave = contra where id_usuario = id and estado_cambio=true;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_codigo_usuario` (`codigo` VARCHAR(100), `id` INT)  begin
update usuarios set codigo_cambio = codigo where id_usuario = id and estado_cambio = 0;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_codigo_usuario_negativo` (`id` INT)  begin
update usuarios set codigo_cambio = null where id_usuario = id;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_compra` (`id` INT, `proveedor` INT, `factura` INT, `fecha` DATE)  begin
		update compras c set c.id_proveedor=proveedor, c.factura=factura, c.fecha=fecha where c.id_compra=id;
	end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_estado_cambio` (`id` INT)  begin
update usuarios set estado_cambio = 1, codigo_cambio= null where id_usuario = id;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_estado_cambio_negativo` (`id` INT)  begin
update usuarios set estado_cambio = 0 where id_usuario = id;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_marcas_motos` (`nombre_marc` VARCHAR(25), `estado` BOOLEAN, `id` INT)  begin
	update marcas_motos set nombre_marca = nombre_marc, estado_marca_moto = estado where id_marca_moto = id;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_marcas_repuesto` (`nombre_marca` VARCHAR(25), `estado` BOOLEAN, `id` INT)  begin
	update marcas_repuesto set nombre_marca_repuesto = nombre_marca, estado_marca_repuesto = estado where id_marca_repuesto = id;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_material` (`id` INT, `nombre` VARCHAR(20), `id_marca` INT, `id_categoria` INT, `cantidad` INT, `minima` INT, `venta` INT, `compra` INT)  begin
        update materiales m set m.nombre=nombre, m.id_marca_material=id_marca, m.id_categoria=id_categoria,m.cantidad_minima=minima,
        m.precio_compra=compra,m.precio_venta=venta,m.cantidad_inicial=cantidad where m.id_material=id;
        end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_material_estado` (`id` INT)  begin
		update materiales m set m.estado=0 where m.id_material=id;
	end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_modelos_motos` (`nombre_modelo` VARCHAR(25), `estado` BOOLEAN, `id` INT)  begin
	update modelos_motos set nombre_modelo_moto = nombre_modelo, 
    estado_modelo_moto = estado where id_modelo_moto = id;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_motos` (`id_client` INT, `id_marca_mot` INT, `id_modelo_mot` INT, `id_transmi` INT, `id_cilin` INT, `num_chasis` VARCHAR(17), `num_placa` VARCHAR(20), `kilometra` INT, `combustible` INT, `id` INT)  begin
	update motos set id_cliente = id_client, id_marca_moto = id_marca_mot,
    id_modelo_moto = id_modelo_mot, id_transmision = id_transmi, id_cilindraje = 
    id_cilin, numero_chasis = num_chasis, numero_placa =
    num_placa, kilometraje = kilometra, id_combustible = combustible where id_moto = id;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_precio_compra` (`id` INT, `precio_compra` INT)  begin
		update materiales m set m.precio_compra=precio_compra where m.id_material=id;
	end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_reparacion` (`id` INT, `precio` INT, `cambio` TEXT, `fecha` DATE)  begin
		update reparaciones r set r.fecha_entrada=fecha, r.precio=precio, r.cambio=cambio  where r.id_reparacion = id;
    end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_salida_reparacion` (`id` INT, `fecha` DATE)  begin
		update reparaciones r set r.fecha_salida=fecha where r.id_reparacion = id;
    end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_transmision` (`nombre_trans` VARCHAR(10), `estado` BOOLEAN, `id` INT)  begin
	update transmisiones set nombre_transmision = nombre_trans, estado_transmision = estado where id_transmision = id;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_venta` (`id` INT, `cliente` VARCHAR(50))  begin
		update ventas v set v.cliente=cliente where v.id_venta=id;
	end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `validar_codigo` (`codigo` VARCHAR(100), `id` INT)  begin
select * from usuarios where codigo_cambio = codigo and id_usuario = id and estado_cambio = 0;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_material`
--

CREATE TABLE `categorias_material` (
  `id_categoria` int(11) NOT NULL,
  `id_medida` int(11) DEFAULT NULL,
  `nombre_categoria` varchar(30) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias_material`
--

INSERT INTO `categorias_material` (`id_categoria`, `id_medida`, `nombre_categoria`, `estado`) VALUES
(1, 1, 'Cables', 1),
(2, 2, 'Aceite', 1),
(4, 1, 'Arandela', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cilindrajes`
--

CREATE TABLE `cilindrajes` (
  `id_cilindraje` int(11) NOT NULL,
  `tamano_cilindraje` int(11) DEFAULT NULL,
  `estado_cilindraje` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cilindrajes`
--

INSERT INTO `cilindrajes` (`id_cilindraje`, `tamano_cilindraje`, `estado_cilindraje`) VALUES
(1, 500, 1),
(2, 225, 1),
(3, 1400, 1),
(4, 700, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `cedula_juridica` varchar(15) DEFAULT NULL,
  `nombre_cliente` varchar(50) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `clave` varchar(20) NOT NULL,
  `estado_cliente` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `cedula_juridica`, `nombre_cliente`, `correo`, `telefono`, `clave`, `estado_cliente`) VALUES
(2, '702380402', 'Kendrick Jenkins', 'kenjen041@gmail.com', ' 8359-51-76', '23', 1),
(3, '20393818', 'Jose', 'rOW@GMAIL.COM', '27587676', '1234', 1),
(7, '123', 'Juan', 'juancito', '25252', '123', 1),
(12, '20393818', 'Jani', 'J@gmail.com', '83595176', '123', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `combustible`
--

CREATE TABLE `combustible` (
  `id_combustible` int(11) NOT NULL,
  `tipo_combustible` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `combustible`
--

INSERT INTO `combustible` (`id_combustible`, `tipo_combustible`) VALUES
(1, 'Gasolina'),
(2, 'Diesel'),
(3, 'Electrico'),
(4, 'Helio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id_compra` int(11) NOT NULL,
  `id_proveedor` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `factura` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id_compra`, `id_proveedor`, `id_usuario`, `fecha`, `factura`) VALUES
(55, 3, 3, '2020-03-31', 1),
(56, 3, 3, '2020-03-31', 12),
(57, 3, 3, '2020-03-31', 1029),
(58, 3, 3, '2020-03-31', 202019),
(59, 3, 3, '2020-04-25', 1029),
(60, 4, 3, '2020-05-20', 354635462),
(61, 3, 3, '2020-05-20', 53245743),
(62, 3, 3, '2020-05-20', 6426373),
(63, 3, 3, '2020-05-20', 6426373),
(64, 3, 3, '2020-05-20', 6426373),
(65, 3, 3, '2020-05-20', 6426373),
(66, 3, 3, '2020-05-20', 678953231),
(67, 3, 3, '2020-05-20', 9079),
(68, 3, 3, '2020-05-20', 9079),
(69, 3, 3, '2020-05-20', 9079),
(70, 3, 3, '2020-05-20', 9079),
(71, 3, 3, '2020-05-20', 97970),
(72, 3, 3, '2020-05-20', 8079),
(73, 3, 3, '2020-05-20', 8079),
(74, 3, 3, '2020-05-20', 80707),
(75, 3, 3, '2020-05-20', 80707),
(76, 3, 3, '2020-05-20', 80707),
(77, 3, 3, '2020-05-20', 7997080),
(78, 3, 3, '2020-05-20', 7997080),
(79, 3, 3, '2020-05-20', 908),
(80, 3, 3, '2020-05-20', 7980);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras_materiales`
--

CREATE TABLE `compras_materiales` (
  `id_compra` int(11) DEFAULT NULL,
  `id_material` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compras_materiales`
--

INSERT INTO `compras_materiales` (`id_compra`, `id_material`, `cantidad`, `precio`) VALUES
(56, 6, 11, 1200),
(56, 7, 10, 2000),
(57, 6, 10, 1000),
(55, 7, 10, 10000),
(59, 7, 7, 6000),
(58, 7, 18, 100),
(58, 6, 11, 200),
(58, 6, 5, 1000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_reparacion`
--

CREATE TABLE `detalle_reparacion` (
  `id_reparacion` int(11) DEFAULT NULL,
  `id_material` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `presentacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_reparacion`
--

INSERT INTO `detalle_reparacion` (`id_reparacion`, `id_material`, `cantidad`, `presentacion`) VALUES
(37, 6, 15, 0),
(39, 7, 0, 0),
(36, 7, 12, 0),
(35, 6, 5, 0),
(22, 8, 1200, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_trabajo`
--

CREATE TABLE `detalle_trabajo` (
  `id_reparacion` int(11) DEFAULT NULL,
  `id_trabajo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_trabajo`
--

INSERT INTO `detalle_trabajo` (`id_reparacion`, `id_trabajo`) VALUES
(37, 1),
(39, 2),
(36, 1),
(36, 3),
(39, 1),
(39, 1),
(39, 1),
(35, 1),
(22, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id_empresa` int(11) NOT NULL,
  `nombre` varchar(40) DEFAULT NULL,
  `logo` text DEFAULT NULL,
  `correo` varchar(30) DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `cedula_juridica` varchar(30) DEFAULT NULL,
  `telefono` varchar(16) NOT NULL,
  `contrasena` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id_empresa`, `nombre`, `logo`, `correo`, `direccion`, `cedula_juridica`, `telefono`, `contrasena`) VALUES
(1, 'Migthy motors', 'assets/logo/193Captura de pantalla (45).png', 'mannolo@gmail.com', 'B° San Rafael', '20393818', '83595176', '1234');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas_materiales`
--

CREATE TABLE `marcas_materiales` (
  `id_marca_material` int(11) NOT NULL,
  `nombre_marca` varchar(40) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `marcas_materiales`
--

INSERT INTO `marcas_materiales` (`id_marca_material`, `nombre_marca`, `estado`) VALUES
(1, 'Suzuki', 1),
(2, 'Fox', 1),
(5, 'Fire', 1),
(6, 'OP', 1),
(7, 'Firestone', 1),
(8, 'Super Pro', 1),
(9, 'Mannol', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas_motos`
--

CREATE TABLE `marcas_motos` (
  `id_marca_moto` int(11) NOT NULL,
  `nombre_marca` varchar(25) DEFAULT NULL,
  `estado_marca_moto` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `marcas_motos`
--

INSERT INTO `marcas_motos` (`id_marca_moto`, `nombre_marca`, `estado_marca_moto`) VALUES
(1, 'Suzuki', 1),
(2, 'Serpentor', 1),
(3, 'Toyota', 1),
(4, 'Zonda', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas_motos_categorias_motos`
--

CREATE TABLE `marcas_motos_categorias_motos` (
  `id_marca_moto` int(11) DEFAULT NULL,
  `nombre_marca` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas_repuestos`
--

CREATE TABLE `marcas_repuestos` (
  `id_marca_repuestos` int(11) NOT NULL,
  `nombre_marca_repuesto` varchar(25) DEFAULT NULL,
  `estado_marca_repuesto` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materiales`
--

CREATE TABLE `materiales` (
  `id_material` int(11) NOT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `unidad` varchar(6) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `id_marca_material` int(11) DEFAULT NULL,
  `cantidad_inicial` int(11) DEFAULT NULL,
  `presentacion` double DEFAULT NULL,
  `precio_compra` int(11) DEFAULT NULL,
  `precio_venta` int(11) DEFAULT NULL,
  `cantidad_minima` int(11) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `materiales`
--

INSERT INTO `materiales` (`id_material`, `id_categoria`, `unidad`, `nombre`, `id_marca_material`, `cantidad_inicial`, `presentacion`, `precio_compra`, `precio_venta`, `cantidad_minima`, `estado`) VALUES
(1, 2, 'ml', 'Aceite', 1, 20, 450, 1100, 1500, 5, 0),
(2, 1, 'unid', 'Gas', 2, 20, 0, 200, 400, 4, 0),
(5, 2, 'Lt', 'Aceite', 2, 15, 1, 2000, 3000, 5, 0),
(6, 1, 'unid', 'Cable de frenos', 2, 10, 0, 2000, 5000, 2, 1),
(7, 2, 'ml', 'Aceite de moto', 1, 12, 200, 2000, 2200, 11, 1),
(8, 2, 'Lt', 'Aceite 10w40', 9, 10, 1, 4000, 5000, 2, 1),
(9, 4, 'unid', 'Tonillo', 5, 400, 0, 50, 300, 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medidas`
--

CREATE TABLE `medidas` (
  `id_medida` int(11) NOT NULL,
  `nombre_medida` varchar(50) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `medidas`
--

INSERT INTO `medidas` (`id_medida`, `nombre_medida`, `estado`) VALUES
(1, 'unid', 1),
(2, 'mili', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelos_motos`
--

CREATE TABLE `modelos_motos` (
  `id_modelo_moto` int(11) NOT NULL,
  `nombre_modelo` varchar(50) DEFAULT NULL,
  `ano` int(11) NOT NULL,
  `estado_modelo_moto` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `modelos_motos`
--

INSERT INTO `modelos_motos` (`id_modelo_moto`, `nombre_modelo`, `ano`, `estado_modelo_moto`) VALUES
(1, 'Katana', 2019, 1),
(2, 'Defender', 2018, 1),
(3, 'Talon', 1985, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motos`
--

CREATE TABLE `motos` (
  `id_moto` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_marca_moto` int(11) DEFAULT NULL,
  `id_modelo_moto` int(11) DEFAULT NULL,
  `id_transmision` int(11) DEFAULT NULL,
  `id_cilindraje` int(11) DEFAULT NULL,
  `id_combustible` int(11) NOT NULL,
  `numero_chasis` varchar(17) DEFAULT NULL,
  `numero_placa` varchar(10) DEFAULT NULL,
  `imagen_moto` text DEFAULT NULL,
  `kilometraje` int(11) DEFAULT NULL,
  `nuevo_kilometraje` int(11) NOT NULL DEFAULT 0,
  `estado_moto` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `motos`
--

INSERT INTO `motos` (`id_moto`, `id_cliente`, `id_marca_moto`, `id_modelo_moto`, `id_transmision`, `id_cilindraje`, `id_combustible`, `numero_chasis`, `numero_placa`, `imagen_moto`, `kilometraje`, `nuevo_kilometraje`, `estado_moto`) VALUES
(1, 2, 1, 2, 1, 2, 2, '96987', '4657687', NULL, 10020, 11000, 1),
(2, 2, 2, 2, 1, 1, 2, '4151', '31131', NULL, 16000, 17000, 1),
(3, 3, 3, 1, 3, 2, 1, '7908', '3029245', NULL, 22, 32, 1),
(4, 3, 4, 1, 1, 3, 2, '4151', '200019', NULL, 20, 0, 1),
(5, 2, 4, 3, 2, 3, 4, '0790', '09768574', NULL, 200, 0, 1),
(6, 7, 1, 1, 2, 3, 1, '123', '8585', NULL, 11500, 15000, 1),
(7, 7, 2, 2, 1, 1, 2, '0022', '6954', NULL, 2000, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id_proveedor` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `correo` varchar(30) DEFAULT NULL,
  `cedula_juridica` varchar(20) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id_proveedor`, `nombre`, `telefono`, `correo`, `cedula_juridica`, `estado`) VALUES
(3, 'Kendrick Jenkins', ' 83595176', 'fwqfeq', '4121414', 1),
(4, 'Plomero', ' 8359-51-76', 'rOW@GMAIL.COM', '4121414', 1),
(5, 'Culi', ' 8359-51-76', 'rOW@GMAIL.COM', '4121414', 1),
(17, 'Piccolo', '536486', 'grwgrwg', '900921', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reparaciones`
--

CREATE TABLE `reparaciones` (
  `id_reparacion` int(11) NOT NULL,
  `id_moto` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `fecha_entrada` date DEFAULT NULL,
  `fecha_salida` date DEFAULT NULL,
  `descripcion` text CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `precio` int(11) DEFAULT NULL,
  `kilometraje_entrada` varchar(15) NOT NULL,
  `kilometraje_salida` varchar(15) NOT NULL,
  `estado` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reparaciones`
--

INSERT INTO `reparaciones` (`id_reparacion`, `id_moto`, `id_usuario`, `fecha_entrada`, `fecha_salida`, `descripcion`, `precio`, `kilometraje_entrada`, `kilometraje_salida`, `estado`) VALUES
(22, 1, 3, '2020-04-22', '2020-04-25', 'Rayos Quebrados', 20000, '10020', '10020', 'Finalizado'),
(35, 2, 3, '2020-04-25', '0000-00-00', '', 0, '15698', '', 'Finalizado'),
(36, 3, 3, '2020-04-25', '2020-04-26', 'Nada', 2000, '2500', '2501', 'Finalizado'),
(37, 3, 3, '2020-04-25', '2020-04-26', 'Daños de discos', 40000, '5000', '40000', 'Finalizado'),
(38, 3, 3, '2020-05-15', '2020-05-16', 'Radiador taqueado', 300000, '20', '22', 'Espera'),
(39, 6, 3, '2020-06-28', '2020-06-29', '', 3000, '10000', '11500', 'Espera');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajos`
--

CREATE TABLE `trabajos` (
  `id_trabajo` int(11) NOT NULL,
  `nombre_trabajo` varchar(100) DEFAULT NULL,
  `precio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `trabajos`
--

INSERT INTO `trabajos` (`id_trabajo`, `nombre_trabajo`, `precio`) VALUES
(1, 'Cambio Aceite', 5000),
(2, 'Cambio de Luces', 10000),
(3, 'Cambio de Motor', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transmisiones`
--

CREATE TABLE `transmisiones` (
  `id_transmision` int(11) NOT NULL,
  `nombre_transmision` varchar(10) DEFAULT NULL,
  `estado_transmision` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `transmisiones`
--

INSERT INTO `transmisiones` (`id_transmision`, `nombre_transmision`, `estado_transmision`) VALUES
(1, 'Automatico', 1),
(2, 'Manual', 1),
(3, 'Semiautoma', 1),
(8, 'Electrico', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_completo` varchar(70) DEFAULT NULL,
  `correo_electronico` varchar(100) NOT NULL,
  `tipo` varchar(20) DEFAULT NULL,
  `clave` varchar(30) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT 1,
  `codigo_cambio` varchar(100) NOT NULL,
  `estado_cambio` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_completo`, `correo_electronico`, `tipo`, `clave`, `estado`, `codigo_cambio`, `estado_cambio`) VALUES
(3, 'Culi', '0', NULL, 'Zoidse', 1, '', ''),
(4, 'Pedro', 'wrdkillvibe@gmail.com', 'administrador', '147', 1, '', '0'),
(8, 'Juan', 'juancito', 'cliente', '123', 1, '', ''),
(12, 'Kendrick', 'kenjen041@gmail.com', 'cliente', '123', 1, '', ''),
(16, 'Plantitac', 'mannolo@gmail.com', 'Tecnico', '123', 1, '', ''),
(17, 'Jani', 'J@gmail.com', 'cliente', '123', 1, '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_venta`, `id_usuario`, `id_cliente`, `fecha`) VALUES
(3, 3, 2, '2020-03-30'),
(4, 3, 2, '2020-03-31'),
(5, 3, 2, '2020-05-20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_materiales`
--

CREATE TABLE `ventas_materiales` (
  `id_venta` int(11) DEFAULT NULL,
  `id_material` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ventas_materiales`
--

INSERT INTO `ventas_materiales` (`id_venta`, `id_material`, `cantidad`, `precio`) VALUES
(4, 6, 10, 5000),
(3, 7, 4, 2200),
(3, 6, 10, 5000),
(5, 8, 8, 5000),
(5, 6, 11, 5000);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias_material`
--
ALTER TABLE `categorias_material`
  ADD PRIMARY KEY (`id_categoria`),
  ADD KEY `id_medida` (`id_medida`);

--
-- Indices de la tabla `cilindrajes`
--
ALTER TABLE `cilindrajes`
  ADD PRIMARY KEY (`id_cilindraje`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indices de la tabla `combustible`
--
ALTER TABLE `combustible`
  ADD PRIMARY KEY (`id_combustible`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `id_proveedor` (`id_proveedor`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `compras_materiales`
--
ALTER TABLE `compras_materiales`
  ADD KEY `id_material` (`id_material`),
  ADD KEY `id_compra` (`id_compra`);

--
-- Indices de la tabla `detalle_reparacion`
--
ALTER TABLE `detalle_reparacion`
  ADD KEY `id_reparacion` (`id_reparacion`),
  ADD KEY `id_material` (`id_material`);

--
-- Indices de la tabla `detalle_trabajo`
--
ALTER TABLE `detalle_trabajo`
  ADD KEY `id_reparacion` (`id_reparacion`),
  ADD KEY `id_trabajo` (`id_trabajo`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Indices de la tabla `marcas_materiales`
--
ALTER TABLE `marcas_materiales`
  ADD PRIMARY KEY (`id_marca_material`);

--
-- Indices de la tabla `marcas_motos`
--
ALTER TABLE `marcas_motos`
  ADD PRIMARY KEY (`id_marca_moto`);

--
-- Indices de la tabla `marcas_motos_categorias_motos`
--
ALTER TABLE `marcas_motos_categorias_motos`
  ADD KEY `id_marca_moto` (`id_marca_moto`);

--
-- Indices de la tabla `marcas_repuestos`
--
ALTER TABLE `marcas_repuestos`
  ADD PRIMARY KEY (`id_marca_repuestos`);

--
-- Indices de la tabla `materiales`
--
ALTER TABLE `materiales`
  ADD PRIMARY KEY (`id_material`),
  ADD KEY `id_marca_material` (`id_marca_material`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `medidas`
--
ALTER TABLE `medidas`
  ADD PRIMARY KEY (`id_medida`);

--
-- Indices de la tabla `modelos_motos`
--
ALTER TABLE `modelos_motos`
  ADD PRIMARY KEY (`id_modelo_moto`);

--
-- Indices de la tabla `motos`
--
ALTER TABLE `motos`
  ADD PRIMARY KEY (`id_moto`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_marca_moto` (`id_marca_moto`),
  ADD KEY `id_modelo_moto` (`id_modelo_moto`),
  ADD KEY `id_transmision` (`id_transmision`),
  ADD KEY `id_cilindraje` (`id_cilindraje`),
  ADD KEY `id_combustible` (`id_combustible`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `reparaciones`
--
ALTER TABLE `reparaciones`
  ADD PRIMARY KEY (`id_reparacion`),
  ADD KEY `id_moto` (`id_moto`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `trabajos`
--
ALTER TABLE `trabajos`
  ADD PRIMARY KEY (`id_trabajo`);

--
-- Indices de la tabla `transmisiones`
--
ALTER TABLE `transmisiones`
  ADD PRIMARY KEY (`id_transmision`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `correo_electronico` (`correo_electronico`),
  ADD UNIQUE KEY `nombre_completo` (`nombre_completo`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `ventas_materiales`
--
ALTER TABLE `ventas_materiales`
  ADD KEY `id_venta` (`id_venta`),
  ADD KEY `id_material` (`id_material`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias_material`
--
ALTER TABLE `categorias_material`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `cilindrajes`
--
ALTER TABLE `cilindrajes`
  MODIFY `id_cilindraje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `combustible`
--
ALTER TABLE `combustible`
  MODIFY `id_combustible` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `marcas_materiales`
--
ALTER TABLE `marcas_materiales`
  MODIFY `id_marca_material` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `marcas_motos`
--
ALTER TABLE `marcas_motos`
  MODIFY `id_marca_moto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `marcas_repuestos`
--
ALTER TABLE `marcas_repuestos`
  MODIFY `id_marca_repuestos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `materiales`
--
ALTER TABLE `materiales`
  MODIFY `id_material` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `medidas`
--
ALTER TABLE `medidas`
  MODIFY `id_medida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `modelos_motos`
--
ALTER TABLE `modelos_motos`
  MODIFY `id_modelo_moto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `motos`
--
ALTER TABLE `motos`
  MODIFY `id_moto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `reparaciones`
--
ALTER TABLE `reparaciones`
  MODIFY `id_reparacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `trabajos`
--
ALTER TABLE `trabajos`
  MODIFY `id_trabajo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `transmisiones`
--
ALTER TABLE `transmisiones`
  MODIFY `id_transmision` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categorias_material`
--
ALTER TABLE `categorias_material`
  ADD CONSTRAINT `categorias_material_ibfk_1` FOREIGN KEY (`id_medida`) REFERENCES `medidas` (`id_medida`);

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`),
  ADD CONSTRAINT `compras_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `compras_materiales`
--
ALTER TABLE `compras_materiales`
  ADD CONSTRAINT `compras_materiales_ibfk_1` FOREIGN KEY (`id_material`) REFERENCES `materiales` (`id_material`),
  ADD CONSTRAINT `compras_materiales_ibfk_2` FOREIGN KEY (`id_compra`) REFERENCES `compras` (`id_compra`);

--
-- Filtros para la tabla `detalle_reparacion`
--
ALTER TABLE `detalle_reparacion`
  ADD CONSTRAINT `detalle_reparacion_ibfk_1` FOREIGN KEY (`id_reparacion`) REFERENCES `reparaciones` (`id_reparacion`),
  ADD CONSTRAINT `detalle_reparacion_ibfk_2` FOREIGN KEY (`id_material`) REFERENCES `materiales` (`id_material`);

--
-- Filtros para la tabla `detalle_trabajo`
--
ALTER TABLE `detalle_trabajo`
  ADD CONSTRAINT `detalle_trabajo_ibfk_1` FOREIGN KEY (`id_reparacion`) REFERENCES `reparaciones` (`id_reparacion`),
  ADD CONSTRAINT `detalle_trabajo_ibfk_2` FOREIGN KEY (`id_trabajo`) REFERENCES `trabajos` (`id_trabajo`);

--
-- Filtros para la tabla `marcas_motos_categorias_motos`
--
ALTER TABLE `marcas_motos_categorias_motos`
  ADD CONSTRAINT `marcas_motos_categorias_motos_ibfk_1` FOREIGN KEY (`id_marca_moto`) REFERENCES `marcas_motos` (`id_marca_moto`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `materiales`
--
ALTER TABLE `materiales`
  ADD CONSTRAINT `materiales_ibfk_1` FOREIGN KEY (`id_marca_material`) REFERENCES `marcas_materiales` (`id_marca_material`),
  ADD CONSTRAINT `materiales_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categorias_material` (`id_categoria`);

--
-- Filtros para la tabla `motos`
--
ALTER TABLE `motos`
  ADD CONSTRAINT `motos_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON UPDATE CASCADE,
  ADD CONSTRAINT `motos_ibfk_2` FOREIGN KEY (`id_marca_moto`) REFERENCES `marcas_motos` (`id_marca_moto`) ON UPDATE CASCADE,
  ADD CONSTRAINT `motos_ibfk_3` FOREIGN KEY (`id_modelo_moto`) REFERENCES `modelos_motos` (`id_modelo_moto`) ON UPDATE CASCADE,
  ADD CONSTRAINT `motos_ibfk_4` FOREIGN KEY (`id_transmision`) REFERENCES `transmisiones` (`id_transmision`) ON UPDATE CASCADE,
  ADD CONSTRAINT `motos_ibfk_5` FOREIGN KEY (`id_cilindraje`) REFERENCES `cilindrajes` (`id_cilindraje`) ON UPDATE CASCADE,
  ADD CONSTRAINT `motos_ibfk_6` FOREIGN KEY (`id_combustible`) REFERENCES `combustible` (`id_combustible`);

--
-- Filtros para la tabla `reparaciones`
--
ALTER TABLE `reparaciones`
  ADD CONSTRAINT `reparaciones_ibfk_1` FOREIGN KEY (`id_moto`) REFERENCES `motos` (`id_moto`),
  ADD CONSTRAINT `reparaciones_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`);

--
-- Filtros para la tabla `ventas_materiales`
--
ALTER TABLE `ventas_materiales`
  ADD CONSTRAINT `ventas_materiales_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_venta`),
  ADD CONSTRAINT `ventas_materiales_ibfk_2` FOREIGN KEY (`id_material`) REFERENCES `materiales` (`id_material`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
