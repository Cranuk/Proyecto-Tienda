<?php
//TODO: iniciar session para utilizarlo dentro del proyecto
session_start();
//TODO: desde el archivo index se recomienda solicitar todos los archivos necesarios para la correcta funcionalidad de tu programa
require_once 'autoload.php'; //NOTE: Solicitamos el archivo que no llama los controladores correpondientes
require_once "configuracion/db.php"; //NOTE: solicitamos el archivo para poder utilizar la base de datos
require_once 'configuracion/parametros.php'; //NOTE: Solicitamos el archivo donde se definieron variables constantes
require_once 'helpers/utilidades.php'; //NOTE: Solicitamos librerias que nos serviran para tareas especificas
require_once 'vista/bocetos/cabecera.php'; //NOTE: Solicitamos el archivo para mostrar la cabecera de la pagina web
require_once 'vista/bocetos/barraLateral.php'; //NOTE: Solicitamos el archivo para mostrar la barra lateral de la pagina web

function mostrar_error(){
	//NOTE: usamos el controlador error para mandar el mensaje de error
	$error = new errorControlador();
	$error -> mensaje();
}

if(isset($_GET['controlador'])){
	$nombre_controlador = $_GET['controlador'].'Controlador';
}elseif(!isset($_GET['controlador'])){ //NOTE: Al poner esta condicion ponemos un controlador default al no tener especificado una en la url
	$nombre_controlador = controlador_default.'Controlador';
}else{
	mostrar_error();
	exit();
}

if(class_exists($nombre_controlador)){	
	$controlador = new $nombre_controlador();
	
	if(isset($_GET['accion']) && method_exists($controlador, $_GET['accion'])){
		$accion = $_GET['accion'];
		$controlador->$accion();
	}elseif(!isset($_GET['accion'])){ //NOTE: AL poner esta condicion ponemos una accion default al no tener especificado una en la url
		$accion = accion_default;
		$controlador->$accion();
	}else{
		mostrar_error();
	}
}else{
	mostrar_error();
}

require_once 'vista/bocetos/piePagina.php'; //NOTE: Solicitamos el archivo para mostrar el pie de pagina de la pagina web