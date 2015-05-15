CREATE VIEW `Seguimiento` AS 
select 
	`p`.`id` AS `Id Pedido`,
	`p`.`servicio_id` AS `Id Servicio`,
	`p`.`ciudad_id` AS `Id Ciudad`,
	`p`.`mensaje` AS `Mensaje`,
	`p`.`telefono` AS `Telefono User`,
	`r`.`mensaje` AS `Respuesta`,
	`r`.`proveedor_id` AS `Pro Id`,
	`pr`.`telefono` AS `Telefono Pro`,
	`pr`.`nombre` AS `Nombre Pro`,
	`pr`.`nombre_contacto` AS `Nombre`,
	`pr`.`apellido_contacto` AS `Apellido`,
	`pr`.`pago` AS `Status`,
	`p`.`fecha_hora` AS `fecha_pedido`,
	`r`.`fecha_hora` AS `fecha_respuesta` 
FROM ((`pedido` `p` join `respuesta` `r` on((`r`.`pedido_id` = `p`.`id`))) join `proveedor` `pr` on((`r`.`proveedor_id` = `pr`.`id`))) 
ORDER BY `p`.`fecha_hora` desc;

CREATE VIEW `Seguimiento_Pros` AS 
SELECT  `Pro Id`, `Status`, `Telefono Pro`, CONCAT(`Nombre Pro`,' (',`Nombre`,' ', `Apellido`, ') ') AS `Datos Pro` ,count(`Id Pedido`) as `Pedidos Recibidos`, count(`Respuesta`) as `Respuestas`
FROM `Seguimiento` as s
GROUP BY `Pro Id`
ORDER BY `Pedidos Recibidos` DESC


Para usar a futuro para separar por mes: EXTRACT(YEAR_MONTH FROM s.fecha_pedido)