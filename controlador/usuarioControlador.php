<?php
require_once 'modelo/usuarioModelo.php';
class usuarioControlador{
    public function test(){ //NOTE: funcion de testeo para saber si me carga todo en orden
        echo 'controlador usuario, accion index';
    }

    public function registrar(){
        require_once 'vista/usuarios/registro.php';
    }

    public function guardar(){
        if (isset($_POST)) {
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : false;
            $correo = isset($_POST['correo']) ? $_POST['correo'] : false;
            $clave = isset($_POST['clave']) ? $_POST['clave'] : false;

            if ($nombre && $apellido && $correo && $clave) {
                $usuario = new UsuarioModelo;
                $usuario->setNombre($nombre);
                $usuario->setApellido($apellido);
                $usuario->setCorreo($correo);
                $usuario->setClave(md5($clave));
                $guardado = $usuario->guardar();

                if ($guardado) {
                    $_SESSION['registro'] = "completado";
                }else{
                    $_SESSION['registro'] = "error";
                }
            }else{
                $_SESSION['registro'] = "error";
            }
        }else{
            $_SESSION['registro'] = "error";
        }
        header('Location:'.base_url.'usuario/registrar'); //NOTE: una vez terminado o no el registro nos rediriga a la misma pagina
    }

    public function logeo(){
        if(isset($_POST)){
            //ANCHOR: Identificar al usuario
            //ANCHOR: Consulta a la base
            $usuario = new UsuarioModelo();
            $usuario->setCorreo($_POST['correo']);
            $usuario->setClave(md5($_POST['clave']));
            $identidad = $usuario->logeo(); //NOTE: guardamos el objeto en una variable
            if ($identidad) {
                //ANCHOR: Crear una sesion
                $_SESSION['identidad'] = $identidad;
                if ($identidad->rol == 'admin') {
                    $_SESSION['admin'] = true;
                }
            }else{
                $_SESSION['error_login'] = 'Logeo fallido';
            }
        }
        header('Location:'.base_url);
    }

    public function cerrar(){
        //NOTE: cierra todas las sesiones activas al logearse con un usuario
        if (isset($_SESSION['identidad'])) {
            unset($_SESSION['identidad']);
        }
        if (isset($_SESSION['admin'])) {
            unset($_SESSION['admin']);
        }
        header('Location:'.base_url);
    }
}//FIN DE LA CLASE