<?php

class errorControlador{
    public function errorMensaje($contenido=''){
        if(!empty($contenido)){
            $bandera = true;
            $textoError = 'No hay '.$contenido.' registrados';
            require_once 'vista/bocetos/error.php';
        }else{
            $bandera = false;
            $textoError = 'La pagina que buscas no existe';
            require_once 'vista/bocetos/error.php';
        }
    }
}