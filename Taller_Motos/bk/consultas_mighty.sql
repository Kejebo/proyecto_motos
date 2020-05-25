use db_tallerMotos;
delimiter //
	create procedure get_inventario()
	begin
        select  m.precio_venta as venta, m.precio_compra as compra,m.id_material as id, m.nombre as nombre, me.nombre_medida as medida,m.cantidad_inicial as cantidad,m.cantidad_inicial*m.presentacion as total 
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
	end //
delimiter ;

delimiter //
	create procedure get_detalle_venta(id int)
		begin
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

		end //
delimiter ;
delimiter //
	create procedure get_detalle_compra(id int)
		begin
		select c.id_compra as id,factura as factura, c_m.precio as precio, c_m.cantidad as cantidad, 
        concat(m.nombre,' ',mm.nombre_marca,' ',if(m.presentacion>0,m.presentacion,''),' ',me.nombre_medida) as nombre_material, m.id_material as material from compras_materiales c_m
            inner join compras c on c.id_compra=c_m.id_compra
            inner join materiales m on m.id_material = c_m.id_material
            inner join marcas_materiales mm on mm.id_marca_material=m.id_marca_material
            inner join categorias_material cm on cm.id_categoria=m.id_categoria
			inner join medidas me on me.id_medida=cm.id_medida where c.id_compra=id
			order by m.id_material
            desc;

		end //
delimiter ;



	delimiter // 
    create procedure get_detalle_reparacion(id int)
    begin
	select m.nombre as nombre, me.nombre_medida as medida,m.cantidad_inicial as cantidad,m.cantidad_inicial*m.presentacion as total 
		,COALESCE(m.presentacion,0) as monto, mm.nombre_marca as marca, d.cantidad as cant, m.id_material as material from detalle_reparacion d 
    inner join materiales m on m.id_material=d.id_material
     inner join marcas_materiales mm on mm.id_marca_material=m.id_marca_material
		inner join categorias_material cm on cm.id_categoria=m.id_categoria
		inner join medidas me on me.id_medida=cm.id_medida
    where d.id_reparacion=id
    order by m.id_material desc;
	end //
    delimiter ;
    

    	delimiter // 
    create procedure get_detalle_trabajo(id int)
    begin
	select t.nombre_trabajo as trabajo, t.id_trabajo as id from detalle_trabajo d 
	inner join trabajos t on t.id_trabajo=d.id_trabajo
    where d.id_reparacion=id
    order by t.id_trabajo desc;
	end //
    delimiter ;
    delimiter //
    create procedure get_reparacion(id int)
    begin
	select *, clientes.nombre_cliente as cliente, clientes.id_cliente as id_cliente,concat(ma.nombre_marca,' ',mm.nombre_modelo,' ',mm.ano) as moto ,
    m.numero_placa as placa from  reparaciones r 
    inner join motos m on r.id_moto=m.id_moto
    inner join clientes on clientes.id_cliente = m.id_cliente
    inner join marcas_motos ma on ma.id_marca_moto = m.id_marca_moto inner join
    modelos_motos mm on mm.id_modelo_moto = m.id_modelo_moto where r.id_reparacion=id;  
	end //
    delimiter ; 
    
delimiter //
create procedure get_reparaciones()
begin
	select r.id_reparacion as id, fecha_entrada as fecha,clientes.nombre_cliente as cliente, concat(ma.nombre_marca,' ',mm.nombre_modelo,' ',mm.ano) as moto ,
    m.numero_placa as placa, r.precio as monto from  reparaciones r 
    inner join motos m on r.id_moto=m.id_moto
    inner join clientes on clientes.id_cliente = m.id_cliente
    inner join marcas_motos ma on ma.id_marca_moto = m.id_marca_moto inner join
    modelos_motos mm on mm.id_modelo_moto = m.id_modelo_moto
    order by r.id_reparacion asc;
    end //
delimiter ;

delimiter //
create procedure get_motos_cliente(id int)
begin
	select clientes.nombre_cliente as cliente, concat(motos.numero_placa,' ',ma.nombre_marca,' ',mm.nombre_modelo,' ',mm.ano) as moto ,
    combus.tipo_combustible as gasolina, motos.numero_placa as placa, motos.id_moto as id,
    motos.kilometraje as kilometraje, transmisiones.nombre_transmision as transmision from  motos 
    inner join clientes on clientes.id_cliente = motos.id_cliente
    inner join marcas_motos ma on ma.id_marca_moto = motos.id_marca_moto inner join
    modelos_motos mm on mm.id_modelo_moto = motos.id_modelo_moto inner join
    transmisiones on transmisiones.id_transmision = motos.id_transmision inner join
    cilindrajes on cilindrajes.id_cilindraje = motos.id_cilindraje inner join
    combustible combus on combus.id_combustible = motos.id_combustible where estado_moto = true and motos.id_cliente=id
    order by motos.id_moto asc;
    end //
delimiter ;
delimiter // 
 create procedure delete_detalle_reparacion(id int)
	begin
		delete from detalle_reparacion where id_reparacion =id;
	end //
delimiter ;
delimiter //
	create procedure insert_detalle_reparacion(id_reparacion int,id_material int,cantidad int)
	begin 
		insert into detalle_reparacion(id_reparacion,id_material,cantidad) values(id_reparacion,id_material,cantidad);
	end //
delimiter ;

delimiter //
	create procedure get_motos_activas()
    begin
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
    end //
delimiter ;

delimiter //
	create procedure get_moto(id int)
    begin
	select * from  motos 
    inner join clientes on clientes.id_cliente = motos.id_cliente
    inner join marcas_motos ma on ma.id_marca_moto = motos.id_marca_moto inner join
    modelos_motos mm on mm.id_modelo_moto = motos.id_modelo_moto inner join
    transmisiones on transmisiones.id_transmision = motos.id_transmision inner join
    cilindrajes on cilindrajes.id_cilindraje = motos.id_cilindraje inner join
    combustible combus on combus.id_combustible = motos.id_combustible where motos.id_moto=id; 
    end //
delimiter ;

	delimiter //
    create PROCEDURE insert_venta(cliente varchar(50),id_usuario int,fecha date)
	begin
		insert into ventas(cliente,id_usuario,fecha) values(cliente,id_usuario, fecha);
    end //
    delimiter ;
	delimiter //
    create procedure update_compra(id int, proveedor int,factura int,fecha date)
	begin
		update compras c set c.id_proveedor=proveedor, c.factura=factura, c.fecha=fecha where c.id_compra=id;
	end //
	delimiter ;
    
    select * from materiales m 
		inner join marcas_materiales mm 
		inner join medidas me 
		inner join categorias_material cm where
		mm.id_marca_material= m.id_marca_material and cm.id_medida=me.id_medida and m.id_categoria=cm.id_categoria and m.id_material=5;
/************************************************ Inventario************************************************/
delimiter //

	create procedure update_material(id int, nombre varchar(20), id_marca int, id_categoria int, cantidad int, minima int,venta int, compra int)
		begin
        update materiales m set m.nombre=nombre, m.id_marca_material=id_marca, m.id_categoria=id_categoria,m.cantidad_minima=minima,
        m.precio_compra=compra,m.precio_venta=venta,m.cantidad_inicial=cantidad where m.id_material=id;
        end //
	delimiter ;
    
delimiter //
	create procedure get_marcas()
    begin
		select * from marcas_materiales;
	end //
delimiter ;
	delimiter //
    create procedure get_inventario()
    begin
		select  m.precio_venta as venta, m.precio_compra as compra,m.id_material as id, m.nombre as nombre, me.nombre_medida as medida,m.cantidad_inicial as cantidad,m.cantidad_inicial*m.presentacion as total 
		,COALESCE(m.presentacion,0) as monto, mm.nombre_marca as marca 
        from materiales m 
		inner join marcas_materiales mm 
		inner join medidas me 
		inner join categorias_material cm where
		mm.id_marca_material= m.id_marca_material and cm.id_medida=me.id_medida and m.id_categoria=cm.id_categoria and m.estado=1;
	 end //
     delimiter ;
	
    delimiter //
    create procedure get_material(id int)
    begin
		select * from materiales m 
		inner join marcas_materiales mm 
		inner join medidas me 
		inner join categorias_material cm where
		mm.id_marca_material= m.id_marca_material and cm.id_medida=me.id_medida and m.id_categoria=cm.id_categoria and m.id_material=id;
	 end //
     delimiter ;
     
	delimiter // 
    create procedure get_detalle_reparacion(id int)
    begin
	select m.nombre as nombre, me.nombre_medida as medida,m.cantidad_inicial as cantidad,m.cantidad_inicial*m.presentacion as total 
		,COALESCE(m.presentacion,0) as monto, mm.nombre_marca as marca, d.cantidad as cant from detalle_reparacion d 
    inner join materiales m on m.id_material=d.id_material
     inner join marcas_materiales mm on mm.id_marca_material=m.id_marca_material
		inner join categorias_material cm on cm.id_categoria=m.id_categoria
		inner join medidas me on me.id_medida=cm.id_medida
    where d.id_reparacion=id
    order by m.id_material desc;
	end //
    delimiter ;
    
    	delimiter // 
    create procedure get_detalle_trabajo(id int)
    begin
	select * from detalle_trabajo d 
	inner join trabajos t on t.id_trabajo=d.id_trabajo
    where d.id_reparacion=24
    order by t.id_trabajo desc;
	end //
    delimiter ;

delimiter //
	create procedure get_saldo(id int)
	begin
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
		where m.id_material=6;
	end //
delimiter ;
delimiter //
	create procedure get_material(id int)
	begin
        select *,m.cantidad+coalesce(compra,0)-coalesce(venta,0)-coalesce(reparacion,0) as saldo 

		from materiales m inner join marcas_materiales ma
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
		where m.id_marca_material =ma.id_marca_material and m.id_material=id;
	end //
delimiter ;


/************************************************ Usuarios************************************************/
delimiter //
	create procedure get_usuarios()
    begin 
		select * from usuarios;
	end //
delimiter ;

delimiter //
	create procedure get_usuario(id int)
    begin 
		select * from usuarios u where u.id_usuario=id;
	end //
delimiter ;

delimiter //
	create procedure get_login(nombre varchar(50), clave varchar(25))
    begin
		select * from usuarios u where u.nombre_completo=nombre and u.clave=clave;
	end //
delimiter ;

/************************************************ Proveedores************************************************/
delimiter //
	create procedure get_proveedores()
    begin 
		select * from proveedores;
	end //
delimiter ;

delimiter //
	create procedure get_proveedor(id int)
    begin 
		select * from proveedores u where u.id_proveedor=id;
	end //
delimiter ;

/************************************************ Ventas************************************************/
delimiter //
	create procedure get_ventas()
		begin
		select v.id_venta as id, v.fecha as fecha,c.nombre_cliente as cliente,sum(m.precio_venta*v_m.cantidad) as saldo from ventas v
            inner join ventas_materiales v_m on v_m.id_venta=v.id_venta
            inner join materiales m on m.id_material = v_m.id_material
            inner join clientes c on c.id_cliente=v.id_cliente
			group by v.id_venta
			order by v.id_venta
            desc;

		end //
delimiter ;

delimiter //
	create procedure get_venta(id int)
		begin
		select  v.id_venta as id, c.nombre_cliente as cliente, v.fecha as fecha,v_m.precio*v_m.cantidad as saldo 
        , v_m.precio as precio, v_m.cantidad as cantidad, 
        concat(m.nombre,' ',mm.nombre_marca,' ',if(m.presentacion>0,m.presentacion,''),' ',me.nombre_medida) as nombre_material, m.id_material as material  
        from ventas_materiales v_m
            inner join ventas v on v_m.id_venta=v.id_venta
			inner join materiales m on m.id_material = v_m.id_material
            inner join marcas_materiales mm on mm.id_marca_material=m.id_marca_material
            inner join categorias_material cm on cm.id_categoria=m.id_categoria
			inner join medidas me on me.id_medida=cm.id_medida
            inner join clientes c on c.id_cliente=v.id_cliente
            where v.id_venta=id
			order by m.id_material
            desc;

		end //
delimiter ;

delimiter //
	create procedure get_ventas_diario(fecha date)
		begin
		select v.fecha as fecha,v.cliente as cliente,sum(m.precio_venta*v_m.cantidad) as saldo from ventas v
            inner join ventas_materiales v_m on v_m.id_venta=v.id_venta
            inner join materiales m on m.id_material = v_m.id_material
            where v.fecha=fecha
			group by v.id_venta
			order by v.id_venta
            desc;

		end //
delimiter ;

delimiter //
	create procedure get_ventas_mensual(fecha date)
		begin
		select v.fecha as fecha,v.cliente as cliente,sum(m.precio_venta*v_m.cantidad) as saldo from ventas v
            inner join ventas_materiales v_m on v_m.id_venta=v.id_venta
            inner join materiales m on m.id_material = v_m.id_material
            where month(v.fecha)=month(fecha) and year(v.fecha) = year(fecha)
			group by v.id_venta
			order by v.id_venta
            desc;

		end //
delimiter ;

/************************************************ Compras************************************************/
delimiter //
	create procedure get_compras()
		begin
		select c.id_compra as id,factura as factura, p.nombre as proveedor, c.fecha as fecha,sum(c_m.precio*c_m.cantidad) as saldo from compras c
            inner join compras_materiales c_m on c_m.id_compra=c.id_compra
            inner join materiales m on m.id_material = c_m.id_material
            inner join proveedores p on p.id_proveedor=c.id_proveedor
			group by c.id_compra
			order by c.id_compra
            desc;

		end //
delimiter ;
	

delimiter //
	create procedure get_compra(id int)
		begin
		select c.id_compra as id,factura as factura, p.nombre as proveedor, c.fecha as fecha,c_m.precio*c_m.cantidad as saldo 
        , c_m.precio as precio, c_m.cantidad as cantidad, 
        concat(m.nombre,' ',mm.nombre_marca,' ',if(m.presentacion>0,m.presentacion,''),' ',me.nombre_medida) as nombre_material, m.id_material as material from compras_materiales c_m
            inner join compras c on c.id_compra=c_m.id_compra
            inner join materiales m on m.id_material = c_m.id_material
            inner join marcas_materiales mm on mm.id_marca_material=m.id_marca_material
            inner join categorias_material cm on cm.id_categoria=m.id_categoria
			inner join medidas me on me.id_medida=cm.id_medida
            inner join proveedores p on p.id_proveedor=c.id_proveedor where c_m.id_compra=id
			order by m.id_material
            desc;

		end //
delimiter ;



delimiter //
	create procedure get_compras_diario(fecha date)
		begin
		select c.fecha as fecha,sum(c_m.precio*c_m.cantidad) as saldo from compras c
            inner join compras_materiales c_m on c_m.id_compra=c.id_compra
            inner join materiales m on m.id_material = c_m.id_material
            where c.fecha=fecha
			group by c.id_compra
			order by c.id_compra
            desc;

		end //
delimiter ;

delimiter //
	create procedure get_compras_mensual(fecha date)
		begin
		select c.fecha as fecha,sum(c_m.precio*c_m.cantidad) as saldo from compras c
            inner join compras_materiales c_m on c_m.id_compra=c.id_compra
            inner join materiales m on m.id_material = c_m.id_material
            where month(c.fecha)=month(fecha) and year(c.fecha)=year(fecha)
			group by c.id_compra
			order by c.id_compra
            desc;

		end //
delimiter ;

/************************************************ Reparaciones************************************************/
delimiter //
	create procedure get_detalle_reparacion(id int)
		begin
		select m.nombre as material, r.fecha_entrada as fecha,c.nombre as cliente,r.precio as saldo 
        from reparaciones r
            inner join detalle_reparaciones d_r on d_r.id_reparacion=r.id_reparacion
            inner join motos m on m.id_moto = d_r.id_moto 
            inner join clientes c on c.id_cliente = r.id_cliente
            inner join materiales ma on ma.id_material = d_r.id_material
			group by r.id_reparacion
			order by v.id_reparacion
            desc;

		end //
delimiter ;


delimiter //
	create procedure get_reparacion()
		begin
		select * from reparaciones r
            inner join clientes c on c.id_cliente = r.id_cliente
        	order by r.id_reparacion
            desc;

		end //
delimiter ;

delimiter //
	create procedure get_reparacion_cliente(id int)
		begin
		select * from reparaciones r
            inner join clientes c on c.id_cliente = r.id_cliente
            where r.id_cliente=id
        	order by r.id_reparacion
            desc;

		end //
delimiter ;

delimiter //
	create procedure get_entrada_diario(fecha date)
		begin
		select * from reparaciones r
            inner join clientes c on c.id_cliente = r.id_cliente
            where	r.fecha_entrada = fecha
        	order by r.id_reparacion
            desc;

		end //
delimiter ;

delimiter //
	create procedure get_entrada_mensual(fecha date)
		begin
		select * from reparaciones r
            inner join clientes c on c.id_cliente = r.id_cliente
            where month(r.fecha_entrada) = month(fecha) and year(r.fecha_entrada)=year(fecha)
        	order by r.id_reparacion
            desc;

		end //
delimiter ;
delimiter //
	create procedure get_salida_diario(fecha date)
		begin
		select * from reparaciones r
            inner join clientes c on c.id_cliente = r.id_cliente
            where	r.fecha_salida = fecha
        	order by r.id_reparacion
            desc;

		end //
delimiter ;

delimiter //
	create procedure get_salida_mensual(fecha date)
		begin
		select * from reparaciones r
            inner join clientes c on c.id_cliente = r.id_cliente
            where month(r.fecha_salida) = month(fecha) and year(r.fecha_salida)=year(fecha)
        	order by r.id_reparacion
            desc;

		end //
delimiter ;

