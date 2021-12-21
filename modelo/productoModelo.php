<?php
class ProductoModelo{
    private $id;
    private $categoria_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $oferta;
    private $fecha;
    private $imagen;
    private $db;

    public function __construct(){
        $this -> db = BaseDatos::conectar();
    }

    //ANCHOR: getters
    public function getId(){
        return $this->id;
    }

    public function getCategoria_id(){
        return $this->categoria_id;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function getPrecio(){
        return $this->precio;
    }

    public function getStock(){
        return $this->stock;
    }

    public function getOferta(){
        return $this->oferta;
    }

    public function getFecha(){
        return $this->fecha;
    }

    public function getImagen(){
        return $this->imagen;
    }

    //ANCHOR: setters
    public function setId($id){
        $this->id = $id;

        return $this;
    }

    public function setCategoria_id($categoria_id){
        $this->categoria_id = $categoria_id;

        return $this;
    }

    public function setNombre($nombre){
        $this->nombre = $this->db->real_escape_string($nombre);

        return $this;
    }

    public function setDescripcion($descripcion){
        $this->descripcion = $this->db->real_escape_string($descripcion);

        return $this;
    }

    public function setPrecio($precio){
        $this->precio = $this->db->real_escape_string($precio);

        return $this;
    }

    public function setStock($stock){
        $this->stock = $this->db->real_escape_string($stock);

        return $this;
    }

    public function setOferta($oferta){
        $this->oferta = $this->db->real_escape_string($oferta);

        return $this;
    }

    public function setFecha($fecha){
        $this->fecha = $fecha;

        return $this;
    }

    public function setImagen($imagen){
        $this->imagen = $imagen;

        return $this;
    }

    //ANCHOR: otras funciones
    public function mostrarProductos(){
        $productos = $this->db->query("SELECT * FROM productos ORDER BY id_producto DESC");
        return $productos;
    }

    public function mostrarDestacados($limite){
        $productos = $this->db->query("SELECT * FROM productos WHERE pros_stock > 0 ORDER BY RAND() LIMIT {$limite}");
        return $productos;
    }

    public function mostrarProductoCategoria(){
        $productos = $this->db->query("SELECT * FROM productos WHERE categoria_id = '{$this->getCategoria_id()}' ORDER BY id_producto DESC");
        return $productos;
    }

    public function elegirProducto(){
        $producto = $this->db->query("SELECT * FROM productos WHERE id_producto = {$this->getId()}");
        return $producto->fetch_object(); //NOTE: lo devolvemos como un objeto para utilizar sus datos
    }

    public function guardar(){
        $sql = "INSERT INTO productos VALUES (NULL, {$this->getCategoria_id()}, '{$this->getNombre()}', '{$this->getDescripcion()}', {$this->getPrecio()}, {$this->getStock()}, NULL, CURDATE(), '{$this->getImagen()}')";
        $guardar = $this->db->query($sql);
        $resultado = false;
        if ($guardar) {
            $resultado = true;
        }
        return $resultado;
    }

    public function editar(){
        $sql = "UPDATE productos SET categoria_id={$this->getCategoria_id()}, pros_nombre='{$this->getNombre()}', pros_descripcion='{$this->getDescripcion()}', pros_precio={$this->getPrecio()}, pros_stock={$this->getStock()}";
        if($this->getImagen() != null){//NOTE: actualiza la imagen si cargo una nueva para actualizar la que esta en la base de datos
            $sql .= ", pros_imagen='{$this->getImagen()}'";
        }
        $sql .= " WHERE id_producto = {$this->getId()};";
        $actualizar = $this->db->query($sql);

        $resultado = false;
        if ($actualizar) {
            $resultado = true;
        }
        return $resultado;
    }

    public function eliminar(){
        $sql = "DELETE FROM productos WHERE id_producto = {$this->getId()}";
        $borrar = $this->db->query($sql);
        $resultado = false;
        if ($borrar) {
            $resultado = true;
        }
        return $resultado;
    }
}