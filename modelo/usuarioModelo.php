<?php
class UsuarioModelo{
    private $id;
    private $nombre;
    private $apellido;
    private $correo;
    private $clave;
    private $imagen;
    private $rol;
    private $db;

    public function __construct(){
        $this -> db = BaseDatos::conectar();
    }

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
        return password_hash($this->db->real_escape_string($this->clave),PASSWORD_BCRYPT, ['cost' => 4]);// NOTE: la clave del usuario se codifica para mejor seguridad
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
        $this->nombre = $this->db->real_escape_string($nombre);
        return $this;
    }

    public function setApellido($apellido){
        $this->apellido = $this->db->real_escape_string($apellido);
        return $this;
    }

    public function setCorreo($correo){
        $this->correo = $this->db->real_escape_string($correo);
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
        $sql = "INSERT INTO usuarios VALUES (NULL, '{$this->getNombre()}', '{$this->getApellido()}', '{$this->getCorreo()}', '{$this->getClave()}', NULL, 'usuario')";
        $guardar = $this->db->query($sql);
        $resultado = false;
        if ($guardar) {
            $resultado = true;
        }
        return $resultado;
    }

    public function logeo(){
        $resultado = false; //NOTE: Esta variable es una bandera con la cual verifica si esta todo en orden
        $correo = $this->correo;
        $clave = $this->clave;

        // NOTE: comprobar si existe el usuario
        $sql = "SELECT * FROM usuarios WHERE usos_correo = '$correo'";
        $buscar = $this->db->query($sql);

        if ($buscar && $buscar->num_rows == 1) {
            $usuario = $buscar->fetch_object(); //NOTE: Nos da un objeto con los datos traidos con la query
            //NOTE: verificar la clave
            $verificado = password_verify($clave, $usuario->usos_clave); //NOTE: comprobamos la clave que ingresamos con la guardada en la base
            if ($verificado) { //NOTE: si esta todo en orden guadamos el objeto en una variable y retornamos los datos
                $resultado = $usuario;
            }
        }
        return $resultado;
    }
}