<?php 
    // TODO: creamos la clase conexion con la funcion publica conectar para luego llamar dicha funcion para realizar consultas SQL
    class Conexion{
        public static function conectar(){
            try {
                $conexion = new PDO(conexion, usuario, clave);      
                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $conexion;
            }

            catch(PDOException $e){
                echo "La conexión ha fallado: " . $e->getMessage();
                die();
            }
        }
    }
?>