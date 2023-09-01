-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.21 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.4.0.6659
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Volcando estructura para tabla hpskserlisadb.tbl_accesos
CREATE TABLE IF NOT EXISTS `tbl_accesos` (
  `perfil_id` int DEFAULT NULL,
  `menu_id` int DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla hpskserlisadb.tbl_accesos: 14 rows
/*!40000 ALTER TABLE `tbl_accesos` DISABLE KEYS */;
INSERT INTO `tbl_accesos` (`perfil_id`, `menu_id`) VALUES
	(2, 1),
	(2, 2),
	(2, 3),
	(3, 2),
	(3, 1),
	(3, 3),
	(4, 1),
	(4, 2),
	(4, 3),
	(2, 4),
	(4, 4),
	(2, 13),
	(3, 13),
	(4, 14);
/*!40000 ALTER TABLE `tbl_accesos` ENABLE KEYS */;

-- Volcando estructura para tabla hpskserlisadb.tbl_areas
CREATE TABLE IF NOT EXISTS `tbl_areas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) DEFAULT NULL,
  `inactiva` int NOT NULL DEFAULT '0',
  `creado` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla hpskserlisadb.tbl_areas: 11 rows
/*!40000 ALTER TABLE `tbl_areas` DISABLE KEYS */;
INSERT INTO `tbl_areas` (`id`, `descripcion`, `inactiva`, `creado`) VALUES
	(1, 'COMPRAS', 0, '2023-02-04 04:28:03'),
	(2, 'RRHH', 0, NULL),
	(3, 'CONTABILIDAD', 0, NULL),
	(4, 'CONTROL DE CALIDAD', 0, '2023-02-04 04:28:36'),
	(5, 'BODEGA', 0, '2023-02-04 04:29:06'),
	(6, 'GERENCIA', 0, NULL),
	(7, 'MERCADEO', 0, '2023-02-04 04:27:22'),
	(8, 'IT', 0, NULL),
	(9, 'OPERACIONES', 0, NULL),
	(10, 'SERVICIOS GENERALES', 0, NULL),
	(11, 'TALENTO HUMANO', 0, NULL);
/*!40000 ALTER TABLE `tbl_areas` ENABLE KEYS */;

-- Volcando estructura para tabla hpskserlisadb.tbl_categoria_incidente
CREATE TABLE IF NOT EXISTS `tbl_categoria_incidente` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) DEFAULT NULL,
  `id_tipo_caso` int DEFAULT NULL,
  `inactiva` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla hpskserlisadb.tbl_categoria_incidente: 11 rows
/*!40000 ALTER TABLE `tbl_categoria_incidente` DISABLE KEYS */;
INSERT INTO `tbl_categoria_incidente` (`id`, `descripcion`, `id_tipo_caso`, `inactiva`) VALUES
	(1, 'FALLA TECNICA', 1, 0),
	(2, 'SOLICITUD RRHH', 2, 0),
	(3, 'GARANTIAS', 2, 0),
	(4, 'IT', 2, 0),
	(5, 'SOLICITUD CONTABILIDAD', 2, 0),
	(6, 'SOLICITUD OPERACIONES', 2, 0),
	(7, 'SOLICITUD TALENTO HUMANO', 2, 0),
	(8, 'SOLICITUD BODEGA', 2, 0),
	(9, 'SOLICITUD COMPRAS', 2, 0),
	(10, 'SOLICITUD SERVICIOS GENERALES', 2, 0),
	(11, 'SOLICITUD GERENCIA', 2, 0);
/*!40000 ALTER TABLE `tbl_categoria_incidente` ENABLE KEYS */;

-- Volcando estructura para tabla hpskserlisadb.tbl_configuracion
CREATE TABLE IF NOT EXISTS `tbl_configuracion` (
  `id` int NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `valor` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla hpskserlisadb.tbl_configuracion: 4 rows
/*!40000 ALTER TABLE `tbl_configuracion` DISABLE KEYS */;
INSERT INTO `tbl_configuracion` (`id`, `descripcion`, `valor`) VALUES
	(1, 'master_pass', 'ad5507917c7c73b1d3f0cadfaf705d46'),
	(2, 'title_app', 'CIFNIC -  Helpdesk'),
	(3, 'email_app', 'sistemas@cifnic-company.com'),
	(0, 'pass_temp', 'Cifnic20201010');
/*!40000 ALTER TABLE `tbl_configuracion` ENABLE KEYS */;

-- Volcando estructura para tabla hpskserlisadb.tbl_dashboard_tiles
CREATE TABLE IF NOT EXISTS `tbl_dashboard_tiles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `perfil_id` int DEFAULT NULL,
  `estado_id` int DEFAULT NULL,
  `titulo` varchar(150) DEFAULT NULL,
  `color` varchar(150) DEFAULT NULL,
  `icono` varchar(50) DEFAULT NULL,
  `tamano` varchar(150) DEFAULT NULL,
  `orden` int DEFAULT NULL,
  `filtro` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla hpskserlisadb.tbl_dashboard_tiles: 16 rows
/*!40000 ALTER TABLE `tbl_dashboard_tiles` DISABLE KEYS */;
INSERT INTO `tbl_dashboard_tiles` (`id`, `perfil_id`, `estado_id`, `titulo`, `color`, `icono`, `tamano`, `orden`, `filtro`) VALUES
	(1, 1, 1, 'Casos pendientes', 'panel-primary', 'fa fa-clock-o', 'col-lg-3 col-md-6', 1, NULL),
	(2, 1, 2, 'En proceso', 'panel-yellow', 'fa fa-gears', 'col-lg-3 col-md-6', 2, NULL),
	(3, 1, 3, 'Notificado', 'panel-red', 'fa fa-bullhorn', 'col-lg-3 col-md-6', 3, NULL),
	(4, 1, 4, 'Resuelto', 'panel-green', 'fa fa-check', 'col-lg-3 col-md-6', 4, NULL),
	(9, 2, 1, 'Casos pendientes', 'panel-primary', 'fa fa-clock-o', 'col-lg-3 col-md-6', 1, NULL),
	(5, 2, 2, 'En proceso', 'panel-yellow', 'fa fa-gears', 'col-lg-3 col-md-6', 2, NULL),
	(6, 2, 3, 'Notificado', 'panel-red', 'fa fa-bullhorn', 'col-lg-3 col-md-6', 4, NULL),
	(7, 2, 4, 'Resuelto', 'panel-green', 'fa fa-check', 'col-lg-3 col-md-6', 3, NULL),
	(17, 3, 5, 'En revision', 'panel-primary', 'fa fa-clock-o', 'col-lg-3 col-md-6', 4, NULL),
	(10, 3, 2, 'En proceso', 'panel-yellow', 'fa fa-gears', 'col-lg-3 col-md-6', 1, NULL),
	(11, 3, 3, 'Notificado', 'panel-red', 'fa fa-bullhorn', 'col-lg-3 col-md-6', 2, NULL),
	(12, 3, 4, 'Resuelto', 'panel-green', 'fa fa-check', 'col-lg-3 col-md-6', 3, NULL),
	(13, 4, 1, 'Casos pendientes', 'panel-primary', 'fa fa-clock-o', 'col-lg-3 col-md-6', 1, NULL),
	(14, 4, 2, 'En proceso', 'panel-yellow', 'fa fa-gears', 'col-lg-3 col-md-6', 2, NULL),
	(15, 4, 3, 'Notificado', 'panel-red', 'fa fa-bullhorn', 'col-lg-3 col-md-6', 3, NULL),
	(16, 4, 4, 'Resuelto', 'panel-green', 'fa fa-check', 'col-lg-3 col-md-6', 4, NULL);
/*!40000 ALTER TABLE `tbl_dashboard_tiles` ENABLE KEYS */;

-- Volcando estructura para tabla hpskserlisadb.tbl_estados
CREATE TABLE IF NOT EXISTS `tbl_estados` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla hpskserlisadb.tbl_estados: 5 rows
/*!40000 ALTER TABLE `tbl_estados` DISABLE KEYS */;
INSERT INTO `tbl_estados` (`id`, `descripcion`) VALUES
	(1, 'Solicitado'),
	(2, 'En proceso'),
	(3, 'Notificado'),
	(4, 'Resuelto'),
	(5, 'En revision');
/*!40000 ALTER TABLE `tbl_estados` ENABLE KEYS */;

-- Volcando estructura para tabla hpskserlisadb.tbl_flujos_estado
CREATE TABLE IF NOT EXISTS `tbl_flujos_estado` (
  `id` int NOT NULL AUTO_INCREMENT,
  `perfil_id` int DEFAULT NULL,
  `estado_actual` int DEFAULT NULL,
  `estados_disponibles` int DEFAULT NULL,
  `orden` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla hpskserlisadb.tbl_flujos_estado: 11 rows
/*!40000 ALTER TABLE `tbl_flujos_estado` DISABLE KEYS */;
INSERT INTO `tbl_flujos_estado` (`id`, `perfil_id`, `estado_actual`, `estados_disponibles`, `orden`) VALUES
	(1, 2, 2, 3, 1),
	(2, 2, 2, 4, 2),
	(3, 3, 2, 3, 1),
	(4, 3, 2, 4, 2),
	(5, 4, 3, 5, 2),
	(6, 2, 2, 2, NULL),
	(7, 3, 2, 2, NULL),
	(8, 4, 3, 3, 1),
	(9, 3, 5, 5, 1),
	(10, 3, 5, 3, 2),
	(11, 3, 5, 4, 3);
/*!40000 ALTER TABLE `tbl_flujos_estado` ENABLE KEYS */;

-- Volcando estructura para tabla hpskserlisadb.tbl_incidentes
CREATE TABLE IF NOT EXISTS `tbl_incidentes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fecha_creacion` datetime DEFAULT NULL,
  `asunto` varchar(150) DEFAULT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `estado_id` int DEFAULT NULL,
  `creado_por` int DEFAULT NULL,
  `tipo_incidente_id` int DEFAULT NULL,
  `asignado` int DEFAULT NULL,
  `area_id` int DEFAULT NULL,
  `sub_categoria_id` int DEFAULT NULL,
  `eliminado` int NOT NULL DEFAULT '0',
  `cerrado` int NOT NULL DEFAULT '0',
  `observacion_cierre` varchar(300) DEFAULT NULL,
  `fecha_cierre` datetime DEFAULT NULL,
  `cerrado_por` int DEFAULT NULL,
  `prioridad_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla hpskserlisadb.tbl_incidentes: 2 rows
/*!40000 ALTER TABLE `tbl_incidentes` DISABLE KEYS */;
INSERT INTO `tbl_incidentes` (`id`, `fecha_creacion`, `asunto`, `descripcion`, `estado_id`, `creado_por`, `tipo_incidente_id`, `asignado`, `area_id`, `sub_categoria_id`, `eliminado`, `cerrado`, `observacion_cierre`, `fecha_cierre`, `cerrado_por`, `prioridad_id`) VALUES
	(1, '2023-05-02 00:12:54', 'incidente de ejecutivo a IT', 'prueba de ejecutivo a analists', 1, 12, 2, NULL, 8, 63, 0, 0, NULL, NULL, NULL, 1),
	(2, '2023-05-03 00:33:33', 'Prueba dos', 'prueba dos de veronica a julio', 1, 24, 2, 37, 8, 63, 0, 0, NULL, NULL, NULL, 1);
/*!40000 ALTER TABLE `tbl_incidentes` ENABLE KEYS */;

-- Volcando estructura para tabla hpskserlisadb.tbl_incidentes_detalles
CREATE TABLE IF NOT EXISTS `tbl_incidentes_detalles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `incidente_id` int DEFAULT NULL,
  `comentario` varchar(500) DEFAULT NULL,
  `adjunto` varchar(150) DEFAULT NULL,
  `modificado_por` int DEFAULT NULL,
  `modificado` datetime DEFAULT NULL,
  `estado_id` int DEFAULT NULL,
  `asignado` int DEFAULT NULL,
  `prioridad_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla hpskserlisadb.tbl_incidentes_detalles: 2 rows
/*!40000 ALTER TABLE `tbl_incidentes_detalles` DISABLE KEYS */;
INSERT INTO `tbl_incidentes_detalles` (`id`, `incidente_id`, `comentario`, `adjunto`, `modificado_por`, `modificado`, `estado_id`, `asignado`, `prioridad_id`) VALUES
	(1, 1, 'prueba de ejecutivo a analists', '009a_705.jpg', 12, '2023-05-02 00:12:54', 1, NULL, 1),
	(2, 2, 'prueba dos de veronica a julio', NULL, 24, '2023-05-03 00:33:33', 1, 37, 1);
/*!40000 ALTER TABLE `tbl_incidentes_detalles` ENABLE KEYS */;

-- Volcando estructura para tabla hpskserlisadb.tbl_menu
CREATE TABLE IF NOT EXISTS `tbl_menu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(25) DEFAULT NULL,
  `controlador` varchar(25) DEFAULT NULL,
  `accion` varchar(25) DEFAULT NULL,
  `icono_estilo` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `estado` int DEFAULT NULL,
  `id_padre` int DEFAULT NULL,
  `es_padre` int DEFAULT NULL,
  `orden` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla hpskserlisadb.tbl_menu: 13 rows
/*!40000 ALTER TABLE `tbl_menu` DISABLE KEYS */;
INSERT INTO `tbl_menu` (`id`, `descripcion`, `controlador`, `accion`, `icono_estilo`, `estado`, `id_padre`, `es_padre`, `orden`) VALUES
	(1, 'Inicio', 'home', 'index', 'fa fa-home fa-fw', 1, 0, 0, 1),
	(2, 'Casos reportados', 'incidentes', 'index', 'fa fa-arrow-circle-right fa-fw', 1, 0, 0, 2),
	(3, 'Casos cerrados', 'incidentes', 'cerrados', 'fa fa-folder fa-fw', 1, 0, 0, 4),
	(4, 'Reportes', 'reportes', 'index', 'fa fa-bar-chart-o fa-fw', 1, 0, 0, 8),
	(5, 'Usuarios', 'users', 'index', 'fa fa-users fa-fw', 1, 0, 0, 6),
	(6, 'Perfiles', 'profiles', 'index', 'fa fa-flag fa-fw', 1, 0, 0, 7),
	(7, 'Catalogos', NULL, NULL, 'fa fa-book fa-fw', 1, 0, 1, 5),
	(8, 'Areas', 'areas', 'index', 'fa fa-flag fa-fw', 1, 7, 0, 1),
	(9, 'Categorias', 'categorias', 'index', 'fa fa-flag fa-fw', 1, 7, 0, 3),
	(10, 'Subcategorias', 'subcategorias', 'index', 'fa fa-flag fa-fw', 1, 7, 0, 4),
	(11, 'Tipos de incidentes', 'tipo_incidentes', 'index', 'fa fa-flag fa-fw', 1, 7, 0, 2),
	(12, 'Estados', 'estados', 'index', 'fa fa-flag fa-fw', 1, 7, 9, 5),
	(13, 'Casos asignados', 'incidentes', 'asignados', 'fa fa-arrow-circle-down fa-fw', 1, 0, 0, 3);
/*!40000 ALTER TABLE `tbl_menu` ENABLE KEYS */;

-- Volcando estructura para tabla hpskserlisadb.tbl_perfiles
CREATE TABLE IF NOT EXISTS `tbl_perfiles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla hpskserlisadb.tbl_perfiles: 4 rows
/*!40000 ALTER TABLE `tbl_perfiles` DISABLE KEYS */;
INSERT INTO `tbl_perfiles` (`id`, `descripcion`) VALUES
	(1, 'Administrador'),
	(2, 'Coordinador'),
	(3, 'Analista'),
	(4, 'Ejecutivo');
/*!40000 ALTER TABLE `tbl_perfiles` ENABLE KEYS */;

-- Volcando estructura para tabla hpskserlisadb.tbl_prioridad_incidente
CREATE TABLE IF NOT EXISTS `tbl_prioridad_incidente` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla hpskserlisadb.tbl_prioridad_incidente: 4 rows
/*!40000 ALTER TABLE `tbl_prioridad_incidente` DISABLE KEYS */;
INSERT INTO `tbl_prioridad_incidente` (`id`, `descripcion`) VALUES
	(1, 'Baja'),
	(2, 'Media'),
	(3, 'Alta'),
	(4, 'Urgente');
/*!40000 ALTER TABLE `tbl_prioridad_incidente` ENABLE KEYS */;

-- Volcando estructura para tabla hpskserlisadb.tbl_subcategoria_incidente
CREATE TABLE IF NOT EXISTS `tbl_subcategoria_incidente` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) DEFAULT NULL,
  `categoria_id` int DEFAULT NULL,
  `inactiva` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=138 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla hpskserlisadb.tbl_subcategoria_incidente: 137 rows
/*!40000 ALTER TABLE `tbl_subcategoria_incidente` DISABLE KEYS */;
INSERT INTO `tbl_subcategoria_incidente` (`id`, `descripcion`, `categoria_id`, `inactiva`) VALUES
	(1, '3CX NO CONECTA', 1, 0),
	(2, '3CX ERROR EN CONFIGURACION DE CUENTA', 1, 0),
	(3, 'SIN AUDIO', 1, 0),
	(4, 'ERROR EN OUTLOOK', 1, 0),
	(5, 'FALLO EN EL TECLADO', 1, 0),
	(6, 'FALLO EN EL MOUSE', 1, 0),
	(7, 'FALLO EN LA BATERIA', 1, 0),
	(8, 'SIN ACCESO A UCP', 1, 0),
	(9, 'ERROR AL DESCARGAR GRABACION', 1, 0),
	(10, 'ERROR AL DESCARGAR CDR', 1, 0),
	(11, 'ERROR EN MENSAJE DE ACTIVACION DE WINDOWS', 1, 0),
	(12, 'BATERIA DE LAPTOP NO CARGA', 1, 0),
	(13, 'LLAMADAS NO CONECTAN', 1, 0),
	(14, 'LLAMADAS NO MUESTRAN CALLERID', 1, 0),
	(15, 'LLAMADAS ENTRECORTADAS', 1, 0),
	(16, 'SIN CONEXION A INTERNET', 1, 0),
	(17, 'PC NO ENCIENDE', 1, 0),
	(18, 'CABLE DE AURICULAR DANADO', 1, 0),
	(19, 'HEADSET EN MAL ESTADO', 1, 0),
	(20, 'IMPRESORA NO ENCIENDE', 1, 0),
	(21, 'PAPEL ATASCADO', 1, 0),
	(22, 'TONER AGOTADO', 1, 0),
	(23, 'MONITOR NO ENCIENDE', 1, 0),
	(24, 'MONITOR DANADO', 1, 0),
	(25, 'FUENTE DE PODER EN MAL ESTADO', 1, 0),
	(26, 'CABLE DE ALIMENTACION EN MAL ESTADO', 1, 0),
	(27, 'CABLE VGA EN MAL ESTADO', 1, 0),
	(28, 'INTERNET LENTO', 1, 0),
	(29, 'WIFI NO RESPONDE', 1, 0),
	(30, 'CARTA SALARIAL', 2, 0),
	(31, 'RENUNCIA', 2, 0),
	(32, 'DIAS ACOMULADOS VACACIONES', 2, 0),
	(33, 'DIAS ACOMULADOS ANTIGUEDAD', 2, 0),
	(34, 'LLAMADOS DE ATENCION CCE', 2, 0),
	(35, 'PAPELERIA', 2, 0),
	(36, 'SUBSIDIO', 2, 0),
	(37, 'LIQUIDACION', 2, 0),
	(38, 'ANTICIPOS', 2, 0),
	(39, 'BAJA DE EMPLEADO', 2, 0),
	(40, 'BONOS', 2, 0),
	(41, 'AUMENTO DE SALARIO', 2, 0),
	(42, 'PROMOCIONES', 2, 0),
	(43, 'SOLICITUD DE EMPLEO', 2, 0),
	(44, 'HEADSET', 3, 0),
	(45, 'LAPTOP', 3, 0),
	(46, 'MONITOR', 3, 0),
	(47, 'CPU', 3, 0),
	(48, 'BATERIA', 3, 0),
	(49, 'SERVIDOR TORRE', 3, 0),
	(50, 'UPS RACK', 3, 0),
	(51, 'SERVIDOR BLADE', 3, 0),
	(52, 'SWITCH', 3, 0),
	(53, 'ACCESS POINT', 3, 0),
	(54, 'IMPRESORA', 3, 0),
	(55, 'ESCANER', 3, 0),
	(56, 'PARLANTES', 3, 0),
	(57, 'DATA SHOW', 3, 0),
	(58, 'TELEFONO IP', 3, 0),
	(59, 'CREACION DE CUENTA DE CORREO', 4, 0),
	(60, 'CREACION DE EXTENSION TELEFONICA', 4, 0),
	(61, 'ACCESO A SISTEMA', 4, 0),
	(62, 'ACCESO VPN', 4, 0),
	(63, 'SOLICITUD DE PC', 4, 0),
	(64, 'SOLICITUD DE LAPTOP', 4, 0),
	(65, 'SOLCIITUD DE HEADSET', 4, 0),
	(66, 'SOLICITUD DE MONITOR', 4, 0),
	(67, 'SOLICITUD DE TECLADO', 4, 0),
	(68, 'SOLICITUD DE MOUSE', 4, 0),
	(69, 'SOLICITUD DE UPS', 4, 0),
	(70, 'SOLICITUD DE DID', 4, 0),
	(71, 'SOLICITUD DE RECARGA', 4, 0),
	(72, 'SOLICITUD DE SWITCH', 4, 0),
	(73, 'SOLICITUD DE ACCESSPOINT', 4, 0),
	(74, 'SOLICITUD DE SERVIDOR', 4, 0),
	(75, 'BAJA DE USUARIO DE SISTEMA', 4, 0),
	(76, 'INSTALACION DE APLICACIONES', 4, 0),
	(77, 'ACCESO A INTERNET', 4, 0),
	(78, 'SOLICITUD DE GRABACION', 4, 0),
	(79, 'SOLICITUD DE GRABACION DE IVR', 4, 0),
	(80, 'SOLICITUD DE GRABACION DE ANUNCIO', 4, 0),
	(81, 'SOLICITUD PARA REASIGNAR LLAMADAS A NUM ESPECIALES', 4, 0),
	(82, 'SOLICITUD DE ACCESO FTP', 4, 0),
	(83, 'SOLICITUD A GRUPOS DE DETINATARIOS DE CORREO', 4, 0),
	(84, 'MANTENIMIENTO PREVENTIVO', 4, 0),
	(85, 'ACTUALIZACION DE SISTEMA', 4, 0),
	(86, 'MANTENIMIENTO CORRECTIVO', 4, 0),
	(87, 'LAPTOP NO ENCIENDE', 1, 0),
	(88, 'SOLICITUD DE FORMATO', 2, 0),
	(89, 'ASIGNACION DE UNIFORMES', 2, 0),
	(90, 'SOLICITUD DE CK', 5, 0),
	(91, 'DESCRIPCIÓN DE UNIFORME EMPLEADOS', 6, 0),
	(92, 'DETALLE DE EMPLEADO POLIGRAFO', 7, 0),
	(93, 'SOLICITUD DE INSUMOS', 8, 0),
	(94, 'SOLICITUD COMPRA DE UNIFORMES', 9, 0),
	(95, 'SOLICITUD DE TRANSPORTE', 10, 0),
	(96, 'SOLICITUD DE FIRMA', 11, 0),
	(97, 'SOLICITUD HISTORIAL EMPLEADO', 2, 0),
	(98, 'SOLICITUD HISTORIAL EMPLEADO', 6, 0),
	(99, 'SOLICITUD PERFIL DE PUESTO', 2, 0),
	(100, 'AUTORIZACIÓN DE INGRESO DE CANDIDATO', 2, 0),
	(101, 'SOLICITUD DE PAPELERIA', 9, 0),
	(102, 'COLILLA INSS', 2, 0),
	(103, 'CONSTANCIA DE CAPACITACIÓN DEL PERSONAL', 2, 0),
	(104, 'CERTIFICADO DE CAPACITACIÓN DEL PERSONAL', 2, 0),
	(105, 'CONSTANCIA EXÁMENES MÉDICOS', 2, 0),
	(106, 'SOLICITUD DE ACOMPAÑAMIENTO', 6, 0),
	(107, 'FORMATO EJECUCIÓN DE SERVICIO', 6, 0),
	(108, 'REVISIÓN DE PRESUPUESTO', 6, 0),
	(109, 'SOLICITUD LIQUIDACIÓN DE TRABAJO', 6, 0),
	(110, 'FORMATO DE LEVANTAMIENTO', 6, 0),
	(111, 'ACTA CONFORMIDAD DE TRABAJO', 6, 0),
	(112, 'FORMATO FACTURACIÓN DE SERVICIO', 5, 0),
	(113, 'SOLICITUD DE SOLVENCIA FISCAL', 5, 0),
	(114, 'SOLVENCIA PROVEEDOR DEL ESTADO', 5, 0),
	(115, 'SOLVENCIA MATRICULA DE ALCALDÍA', 5, 0),
	(116, 'SOLICITUD RUC EMPRESA', 5, 0),
	(117, 'SOLICITUD DE SOLVENCIA MUNICIPAL', 5, 0),
	(118, 'CERTIFICADO DE DECLARACIÓN DE BENEFICIARIO FINAL', 5, 0),
	(119, 'CONSTANCIA DE RESPONSABLE DIRECTO', 5, 0),
	(120, 'CONSTANCIA DE RETENCION', 5, 0),
	(121, 'INFORME DE VENTAS', 5, 0),
	(122, 'SOLICITUD DE CONTRATO', 11, 0),
	(123, 'COMPROBANTES DE POLIZA', 11, 0),
	(124, 'CONSTANCIA DE CLIENTES', 11, 0),
	(125, 'PODER DE REPRESENTACIÓN', 11, 0),
	(126, 'JUNTA DIRECTIVA CERTIFICADA', 11, 0),
	(127, 'ACTA CONSTITUTIVA', 11, 0),
	(128, 'LICENCIA DE HIGIENE Y SEGURIDAD AMBIENTAL', 11, 0),
	(129, 'SOLVENCIA FISCAL', 11, 0),
	(130, 'APROBACIÓN DE PRESUPUESTO', 11, 0),
	(131, 'PRECIO DE VENTA', 11, 0),
	(132, 'SOLICITUD DE CRÉDITO ', 11, 0),
	(133, 'PRECIO DE PRODUCTOS', 9, 0),
	(134, 'PRECIO RENTA DE EQUIPOS', 9, 0),
	(135, 'SEGUIMIENTO DE PRODUCTOS', 10, 0),
	(136, 'CITAS', 7, 0),
	(137, 'EXISTENCIA DE PRODUCTO', 8, 0);
/*!40000 ALTER TABLE `tbl_subcategoria_incidente` ENABLE KEYS */;

-- Volcando estructura para tabla hpskserlisadb.tbl_tipo_incidente
CREATE TABLE IF NOT EXISTS `tbl_tipo_incidente` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla hpskserlisadb.tbl_tipo_incidente: 2 rows
/*!40000 ALTER TABLE `tbl_tipo_incidente` DISABLE KEYS */;
INSERT INTO `tbl_tipo_incidente` (`id`, `descripcion`) VALUES
	(1, 'REPORTE'),
	(2, 'SOLICITUD');
/*!40000 ALTER TABLE `tbl_tipo_incidente` ENABLE KEYS */;

-- Volcando estructura para tabla hpskserlisadb.tbl_usuarios
CREATE TABLE IF NOT EXISTS `tbl_usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(150) DEFAULT NULL,
  `correo` varchar(150) DEFAULT NULL,
  `nombre_acceso` varchar(50) DEFAULT NULL,
  `clave_acceso` varchar(100) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `telefono` varchar(25) DEFAULT NULL,
  `cargo` varchar(250) DEFAULT NULL,
  `perfil_id` int DEFAULT NULL,
  `area_id` int DEFAULT NULL,
  `userid` int DEFAULT NULL,
  `eliminado` smallint NOT NULL DEFAULT '0',
  `fecha_eliminacion` datetime DEFAULT NULL,
  `observacion_eliminacion` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre_acceso` (`nombre_acceso`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla hpskserlisadb.tbl_usuarios: 37 rows
/*!40000 ALTER TABLE `tbl_usuarios` DISABLE KEYS */;
INSERT INTO `tbl_usuarios` (`id`, `nombre_usuario`, `correo`, `nombre_acceso`, `clave_acceso`, `fecha_creacion`, `telefono`, `cargo`, `perfil_id`, `area_id`, `userid`, `eliminado`, `fecha_eliminacion`, `observacion_eliminacion`) VALUES
	(1, 'Administrador', 'jasen.artola@cifnic-company.com', 'admin', '81dc9bdb52d04dc20036dbd8313ed055', '2022-10-06 04:23:25', '', 'Admin', 1, NULL, NULL, 0, NULL, NULL),
	(2, 'Martha Jeannette Duque-Estrada Gurdian', 'jduqueestrada@gruposerlisa.com.ni', 'jduqueestrada', '81dc9bdb52d04dc20036dbd8313ed055', '2023-02-02 14:02:18', '', '', 4, NULL, NULL, 0, NULL, NULL),
	(3, 'Ruth Walkiria Useda Selva', 'ruseda@gruposerlisa.com.ni', 'ruseda', '81dc9bdb52d04dc20036dbd8313ed055', '2023-02-02 14:03:36', '', '', 3, 6, NULL, 0, NULL, NULL),
	(4, 'Carlos Antonio Cifuentes Perezalonzo', 'cc@gruposerlisa.com.ni', 'cecifuentes', '81dc9bdb52d04dc20036dbd8313ed055', '2023-02-02 14:05:27', '', '', 4, NULL, NULL, 0, NULL, NULL),
	(5, 'Nairoby Ramón Matamoros Suárez', 'compras@gruposerlisa.com.ni', 'compras', '81dc9bdb52d04dc20036dbd8313ed055', '2023-02-02 14:18:07', '', '', 3, 1, NULL, 0, NULL, NULL),
	(6, 'Isabel del Rosario Almanza Somarriba', 'contadorgeneral@gruposerlisa.com.ni', 'contadorgeneral', '81dc9bdb52d04dc20036dbd8313ed055', '2023-02-02 14:20:23', '', '', 3, 3, NULL, 0, NULL, NULL),
	(7, 'Hazel Stefany Cano Maltez', 'cxc@gruposerlisa.com.ni', 'facturacion_del', '81dc9bdb52d04dc20036dbd8313ed055', '2023-02-02 14:24:10', '', '', 4, NULL, NULL, 1, NULL, NULL),
	(8, 'Ana Maria Vega Parrales', 'calidad@gruposerlisa.com.ni', 'calidad', '81dc9bdb52d04dc20036dbd8313ed055', '2023-02-02 14:27:52', '', '', 3, 4, NULL, 0, NULL, NULL),
	(9, 'Ana Guadalupe Mora Torres', 'bodegaydespacho@gruposerlisa.com.ni', 'bodegaydespacho', '81dc9bdb52d04dc20036dbd8313ed055', '2023-02-02 14:29:04', '', '', 3, 5, NULL, 0, NULL, NULL),
	(10, 'Gisela de los Angeles Sandoval Hernández', 'recepcion@gruposerlisa.com.ni', 'recepcion', '81dc9bdb52d04dc20036dbd8313ed055', '2023-02-02 14:31:39', '', '', 4, NULL, NULL, 0, NULL, NULL),
	(11, 'Ariel Antonio Cortez Araica', 'acortez@gruposerlisa.com.ni', 'acortez', '81dc9bdb52d04dc20036dbd8313ed055', '2023-02-02 14:33:21', '', '', 3, 9, NULL, 0, NULL, NULL),
	(12, 'Diana de los Ángeles López Rivera', 'dlopez@gruposerlisa.com.ni', 'dlopez', '81dc9bdb52d04dc20036dbd8313ed055', '2023-02-02 14:34:40', '', '', 4, NULL, NULL, 0, NULL, NULL),
	(13, 'Ninoska Marbeli Garibo Madrigal', 'ngaribo@gruposerlisa.com.ni', 'ngaribo', '81dc9bdb52d04dc20036dbd8313ed055', '2023-02-02 14:35:48', '', '', 4, NULL, NULL, 0, NULL, NULL),
	(14, 'Ligia Margarita Boedeker Herrera', 'lboedecker@gruposerlisa.com.ni', 'lboedecker', '81dc9bdb52d04dc20036dbd8313ed055', '2023-02-02 14:37:29', '', '', 4, NULL, NULL, 0, NULL, NULL),
	(15, 'Maria Lourdes Torres Escobar', 'ltorres@gruposerlisa.com.ni', 'ltorres', '81dc9bdb52d04dc20036dbd8313ed055', '2023-02-02 14:39:03', '', '', 4, NULL, NULL, 0, NULL, NULL),
	(16, 'Augusto César González Siles', 'cgonzalez@gruposerlisa.com.ni', 'cgonzalez', '81dc9bdb52d04dc20036dbd8313ed055', '2023-02-02 14:40:05', '', '', 3, 7, NULL, 0, NULL, NULL),
	(17, 'Arnaldo Félix Reyes Pichardo', 'areyes@gruposerlisa.com.ni', 'areyes', '81dc9bdb52d04dc20036dbd8313ed055', '2023-02-02 14:40:57', '', '', 4, NULL, NULL, 0, NULL, NULL),
	(18, 'José René Obando', 'reneobando@gruposerlisa.com.ni', 'reneobando', '81dc9bdb52d04dc20036dbd8313ed055', '2023-02-02 14:41:56', '', '', 4, NULL, NULL, 0, NULL, NULL),
	(19, 'Byron Antonio Guevara Aguirre', 'monitoreo@gruposerlisa.com.ni', 'monitoreo', '81dc9bdb52d04dc20036dbd8313ed055', '2023-02-02 14:43:02', '', '', 4, NULL, NULL, 0, NULL, NULL),
	(20, 'David Morales', 'coordinadorservicios@gruposerlisa.com.ni', 'coordinadorservicios', '81dc9bdb52d04dc20036dbd8313ed055', '2023-02-02 14:44:05', '', '', 3, 10, NULL, 0, NULL, NULL),
	(21, 'Heyddy Yaoska Rivas Jiménez', 'cxp@gruposerlisa.com.ni', 'cxp', '81dc9bdb52d04dc20036dbd8313ed055', '2023-02-02 14:56:50', '', '', 3, 3, NULL, 0, NULL, NULL),
	(22, 'Bianca Cristina D´Arbelles Orozco', 'nomina@gruposerlisa.com.ni', 'nomina', '81dc9bdb52d04dc20036dbd8313ed055', '2023-02-02 15:01:27', '', '', 4, NULL, NULL, 0, NULL, NULL),
	(23, 'Aracely de los Angeles González Reyes', 'rrhh@gruposerlisa.com.ni', 'rrhh', '81dc9bdb52d04dc20036dbd8313ed055', '2023-02-02 15:02:17', '', '', 4, NULL, NULL, 0, NULL, NULL),
	(24, 'Verónica Sebastiana Blandino Jiménez', 'vblandino@gruposerlisa.com.ni', 'vblandino', '81dc9bdb52d04dc20036dbd8313ed055', '2023-02-02 15:03:06', '', '', 3, 2, NULL, 0, NULL, NULL),
	(25, 'Suleyma Sarai Urbina Morales', 'auxiliaroperaciones1@gruposerlisa.com.ni', 'auxiliaroperaciones1', '81dc9bdb52d04dc20036dbd8313ed055', '2023-02-02 15:04:14', '', '', 4, NULL, NULL, 0, NULL, NULL),
	(26, 'Fatima Montenegro', 'logistica@gruposerlisa.com.ni', 'logistica', '81dc9bdb52d04dc20036dbd8313ed055', '2023-02-02 15:05:11', '', '', 4, NULL, NULL, 0, NULL, NULL),
	(27, 'Jasen Jose Artola Orozco', 'ti@gruposerlisa.com.ni', 'ti', '81dc9bdb52d04dc20036dbd8313ed055', '2023-02-02 22:12:47', '', '', 2, 8, NULL, 0, NULL, NULL),
	(28, 'Coordinador RRHH', 'corrhh@test.com', 'corrhh', '81dc9bdb52d04dc20036dbd8313ed055', '2023-02-04 16:51:59', '', '', 2, 2, NULL, 0, NULL, NULL),
	(29, 'Coordinador contabilidad', 'contadorgeneral@gruposerlisa.com.ni', 'cordcontabilidad', '81dc9bdb52d04dc20036dbd8313ed055', '2023-02-04 17:15:16', '', '', 2, 3, NULL, 0, NULL, NULL),
	(30, 'Coordinador compras', 'cordcompras@test.com', 'cordcompras', '81dc9bdb52d04dc20036dbd8313ed055', '2023-02-04 17:21:06', '', '', 2, 1, NULL, 0, NULL, NULL),
	(31, 'Coordinador operaciones', 'cordoperaciones@test.com', 'cordoperaciones', '81dc9bdb52d04dc20036dbd8313ed055', '2023-02-04 17:25:18', '', '', 2, 9, NULL, 0, NULL, NULL),
	(32, 'Carlos Esteban Cifuentes Duque-Estrada', 'cecifuentes@gruposerlisa.com.ni', 'ceciuentes', '81dc9bdb52d04dc20036dbd8313ed055', '2023-02-04 17:57:52', '', '', 3, 6, NULL, 0, NULL, NULL),
	(33, 'Josselin Prisila Pérez Lezama', 'facuracion@gruposerlisa.com.ni', 'facturacion', '81dc9bdb52d04dc20036dbd8313ed055', '2023-02-04 18:23:40', '', '', 3, 3, NULL, 0, NULL, NULL),
	(34, 'Hazel Stefany Cano Maltez', 'cxc@gruposerlisa.com.ni', 'cxc', '81dc9bdb52d04dc20036dbd8313ed055', '2023-02-04 18:29:49', '', '', 3, 3, NULL, 0, NULL, NULL),
	(35, 'Marlene Maria Martinez Manzanares', 'asistentegerencia@gruposerlisa.com.ni', 'asistentegerencia', '81dc9bdb52d04dc20036dbd8313ed055', '2023-02-07 14:55:16', '', '', 4, NULL, NULL, 0, NULL, NULL),
	(36, 'Betsi Sayra Ugarte Ayala', 'reclutamiento@gruposerlisa.com.ni', 'reclutamiento', '81dc9bdb52d04dc20036dbd8313ed055', '2023-02-07 16:29:48', '', '', 4, NULL, NULL, 0, NULL, NULL),
	(37, 'Julio Cesar Sandino', 'jsandino02@gmail.com', 'jsandino', '0107dc2b12585743a43803ca3736d200', '2023-04-20 00:24:04', '', 'Analista de desarrollo', 3, 8, NULL, 0, NULL, NULL);
/*!40000 ALTER TABLE `tbl_usuarios` ENABLE KEYS */;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
