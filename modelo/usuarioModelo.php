<?php
require_once 'configuracion/conexion.php';
class UsuarioModelo{
    private $id;
    private $nombre;
    private $apellido;
    private $correo;
    private $clave;
    private $imagen;
    private $rol;

    //ANCHOR: getters
    public function getId(){
        return $this->id;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getApellido(){
        return $this->apellido;
    }

    public function getCorreo(){
        return $this->correo;
    }

    public function getClave(){
        return $this->clave;
    }

    public function getImagen(){
        return $this->imagen;
    }

    public function getRol(){
        return $this->rol;
    }

    //ANCHOR: setters;
    public function setId($id){
        $this->clave = $id;
        return $this;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
        return $this;
    }

    public function setApellido($apellido){
        $this->apellido = $apellido;
        return $this;
    }

    public function setCorreo($correo){
        $this->correo = $correo;
        return $this;
    }

    public function setClave($clave){
        $this->clave = $clave;
        return $this;
    }

    public function setImagen($imagen){
        $this->imagen = $imagen;
        return $this;
    }

    public function setRol($rol){
        $this->rol = $rol;
        return $this;
    }

    //ANCHOR: metodos de clase
    public function guardar(){
        $base = Conexion::conectar();
        $nombre = $this -> getNombre();
        $apellido = $this -> getApellido();
        $correo = $this -> getCorreo();
        $clave = $this -> getClave();
        $sql = "INSERT INTO usuarios VALUES (NULL, :nombre, :apellido, :correo, :clave, NULL, 'usuario')";
        $consulta = $base -> prepare($sql);
        $consulta -> bindParam(':nombre', $nombre);
        $consulta -> bindParam(':apellido', $apellido);
        $consulta -> bindParam(':correo', $correo);
        $consulta -> bindParam(':clave', $clave);
        $guardo = $consulta -> execute();
        $resultado = false;
        if ($guardo) {
            $resultado = true;
        }
        return $resultado;
    }

    public function logeo(){
        $base = Conexion::conectar();
        $correo = $this->getCorreo();
        $clave = $this->getClave();
        $sql = "SELECT * FROM usuarios WHERE usos_correo = :correo"; // NOTE: comprobar si existe el usuario
        $consulta = $base -> prepare($sql);
        $consulta -> bindParam(':correo', $correo);
        $existe = $consulta -> execute();
        $duplicado = $consulta -> rowCount(); // NOTE: comprobamos que solo exista solo su perfil

        if ($existe && $duplicado == 1) {
            $usuario = $consulta->fetch(PDO::FETCH_ASSOC);
            if ($clave === $usuario['usos_clave']) { //NOTE: si esta todo en orden guardamos el objeto en una variable y retornamos los datos
                $resultado = $usuario;
            }else{
                $resultado = null;
            }
        }
        return $resultado;
    }
}