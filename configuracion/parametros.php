<?php
//TODO: configuracion de parametros para el sistema para uso local
//ANCHOR: aqui vamos declarar variables constantes para la conexion a la base de datos
define('conexion','mysql:host=localhost;dbname=base_tienda');
define('usuario','root');
define('clave','');

//ANCHOR: aqui vamos a declarar variables constantes para uso interno del programa
define('base_url', 'http://mis-proyectos/MisProgramas/WebStore/');
define('controlador_default', 'producto');
define('accion_default','destacado');

?>