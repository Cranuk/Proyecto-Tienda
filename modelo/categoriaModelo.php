<?php
require_once 'configuracion/conexion.php';
class CategoriaModelo{
    private $id;
    private $nombre;

    //ANCHOR: getters
    public function getNombre(){
        return $this->nombre;
    }

    public function getId(){
        return $this->id;
    }

    //ANCHOR: setters
    public function setNombre($nombre){
        $this->nombre = $nombre;
        return $this;
    }

    public function setId($id){
        $this->id = $id;
        return $this;
    }

    //ANCHOR: metodos
    public function mostrarCategorias(){
        $base = Conexion::conectar();
        $sql = "SELECT * FROM categorias ORDER BY id_categoria DESC";
        $consulta = $base -> prepare($sql);
        $resultado = $consulta->execute();
        $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function verCategoria(){
        $base = Conexion::conectar();
        $categoria_id = $this->getId(); 
        $sql = "SELECT * FROM categorias WHERE id_categoria = :categoria_id";
        $consulta = $base -> prepare($sql);
        $consulta -> bindParam(':categoria_id', $categoria_id);
        $consulta -> execute();
        $resultado = $consulta -> fetch(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function guardar(){
        $base = Conexion::conectar();
        $nombre = $this -> getNombre();
        $sql = "INSERT INTO categorias VALUES (NULL, :nombre)";
        $consulta = $base -> prepare($sql);
        $consulta -> bindParam(':nombre', $nombre);
        $guardo = $consulta -> execute();
        $resultado = false;
        if ($guardo) {
            $resultado = true;
        }
        return $resultado;
    }

    public function eliminar(){
        $base = Conexion::conectar();
        $categoria_id = $this -> getId();
        $sql = "DELETE FROM categorias WHERE id_categoria = :categoria_id";
        $consulta = $base -> prepare($sql);
        $consulta -> bindParam(':categoria_id', $categoria_id);
        $borro = $consulta -> execute();
        $resultado = false;
        if ($borro) {
            $resultado = true;
        }
        return $resultado;
    }

    public function editar(){
        $base = Conexion::conectar();
        $categoria_id = $this -> getId();
        $nombre = $this -> getNombre();
        $sql = "UPDATE categorias SET caia_nombre = :nombre";
        $sql .= " WHERE id_categoria = :categoria_id";
        $consulta = $base -> prepare($sql);
        $consulta -> bindParam(':categoria_id', $categoria_id);
        $consulta -> bindParam(':nombre', $nombre);
        $guardo = $consulta -> execute();
        $resultado = false;
        if ($guardo) {
            $resultado = true;
        }
        return $resultado;
    }
}