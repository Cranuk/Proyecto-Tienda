<?php

class CategoriaModelo{
    private $id;
    private $nombre;
    private $db;

    public function __construct(){
        $this -> db = BaseDatos::conectar();
    }

    //ANCHOR: getters
    public function getNombre(){
        return $this->nombre;
    }

    public function getId(){
        return $this->id;
    }

    //ANCHOR: setters
    public function setNombre($nombre){
        $this->nombre = $this->db->real_escape_string($nombre);
        return $this;
    }

    public function setId($id){
        $this->id = $id;
        return $this;
    }

    //ANCHOR: otras funciones
    public function mostrarCategorias(){
        $categorias = $this->db->query("SELECT * FROM categorias ORDER BY id_categoria DESC");
        return $categorias;
    }

    public function verCategoria(){
        $categoria = $this->db->query("SELECT * FROM categorias WHERE id_categoria = '{$this->getId()}'");
        return $categoria->fetch_object();
    }

    public function guardar(){
        $sql = "INSERT INTO categorias VALUES (NULL, '{$this->getNombre()}')";
        $guardar = $this->db->query($sql);
        $resultado = false;
        if ($guardar) {
            $resultado = true;
        }
        return $resultado;
    }
}