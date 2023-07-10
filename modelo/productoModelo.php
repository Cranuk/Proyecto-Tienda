<?php
require_once 'configuracion/conexion.php';
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
        $this->nombre = $nombre;
        return $this;
    }

    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
        return $this;
    }

    public function setPrecio($precio){
        $this->precio = $precio;
        return $this;
    }

    public function setStock($stock){
        $this->stock = $stock;
        return $this;
    }

    public function setOferta($oferta){
        $this->oferta = $oferta;
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
        $base = Conexion::conectar();
        $sql = "SELECT * FROM productos ORDER BY id_producto DESC";
        $consulta = $base->prepare($sql);
        $resultado = $consulta->execute();
        $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function mostrarDestacados($limite){
        $base = Conexion::conectar();
        $sql = "SELECT * FROM productos WHERE pros_stock > 0 ORDER BY RAND() LIMIT :limite";
        $consulta = $base->prepare($sql);
        $consulta -> bindValue(':limite', $limite, PDO::PARAM_INT);
        $consulta->execute();
        $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
    
        if ($resultado) {
            return $resultado;
        } else {
            return []; // NOTE: Devuelve un array vacío si no hay productos destacados
        }
    }

    public function mostrarProductoCategoria(){
        $base = Conexion::conectar();
        $categoria_id = $this->getCategoria_id();
        $sql = "SELECT * FROM productos WHERE categoria_id = :categoria_id ORDER BY id_producto DESC";
        $consulta = $base->prepare($sql);
        $consulta -> bindParam(':categoria_id', $categoria_id);
        $consulta -> execute();
        $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
    
        if ($resultado) {
            return $resultado;
        } else {
            return []; // NOTE: Devuelve un array vacío si no hay productos destacados
        }
    }

    public function elegirProducto(){
        $base = Conexion::conectar();
        $producto_id = $this->getId();
        $sql = "SELECT * FROM productos WHERE id_producto = :producto_id";
        $consulta = $base->prepare($sql);
        $consulta -> bindParam(':producto_id', $producto_id);
        $consulta -> execute();
        $resultado = $consulta -> fetch(PDO::FETCH_ASSOC);
        return $resultado; //NOTE: lo devolvemos como un objeto para utilizar sus datos
    }

    public function guardar(){
        $base = Conexion::conectar();
        $categoria_id = $this->getCategoria_id();
        $nombre = $this->getNombre();
        $descripcion = $this->getDescripcion();
        $precio = $this->getPrecio();
        $stock = $this->getStock();
        $imagen = $this->getImagen();
        $sql = "INSERT INTO productos VALUES (NULL, :categoria_id, :nombre, :descripcion, :precio, :stock, NULL, CURDATE(), :imagen)";
        $consulta = $base->prepare($sql);
        $consulta -> bindParam(':categoria_id', $categoria_id);
        $consulta -> bindParam(':nombre', $nombre);
        $consulta -> bindParam(':descripcion', $descripcion);
        $consulta -> bindParam('precio', $precio);
        $consulta -> bindParam('stock', $stock);
        $consulta -> bindParam('imagen', $imagen);
        $guardo = $consulta -> execute();
        $resultado = false;
        if ($guardo) {
            $resultado = true;
        }
        return $resultado;
    }

    public function editar(){
        $base = Conexion::conectar();
        $producto_id = $this -> getId();
        $categoria_id = $this -> getCategoria_id();
        $nombre = $this -> getNombre();
        $descripcion = $this -> getDescripcion();
        $precio = $this -> getPrecio();
        $stock = $this -> getStock();
        $imagen = $this -> getImagen();
        $sql = "UPDATE productos SET categoria_id = :categoria_id, pros_nombre = :nombre, pros_descripcion = :descripcion, pros_precio = :precio, pros_stock = :stock";
        if($imagen != null){ //NOTE: actualiza la imagen si cargo una nueva para actualizar la que esta en la base de datos
            $sql .= ", pros_imagen = :imagen";
        }
        $sql .= " WHERE id_producto = :producto_id";
        $consulta = $base -> prepare($sql);
        $consulta -> bindParam(':categoria_id', $categoria_id);
        $consulta -> bindParam(':nombre', $nombre);
        $consulta -> bindParam(':descripcion', $descripcion);
        $consulta -> bindParam(':precio', $precio);
        $consulta -> bindParam(':stock', $stock);
        $consulta -> bindParam(':producto_id', $producto_id);
        if($imagen != null){ //NOTE: actualiza la imagen si cargo una nueva para actualizar la que esta en la base de datos
            $consulta -> bindParam(':imagen', $imagen);
        }
        $guardo = $consulta -> execute();
        $resultado = false;
        if ($guardo) {
            $resultado = true;
        }
        return $resultado;
    }

    public function eliminar(){
        $base = Conexion::conectar();
        $producto_id = $this -> getId();
        $sql = "DELETE FROM productos WHERE id_producto = :producto_id";
        $consulta = $base -> prepare($sql);
        $consulta -> bindParam(':producto_id', $producto_id);
        $borro = $consulta -> execute();
        $resultado = false;
        if ($borro) {
            $resultado = true;
        }
        return $resultado;
    }
}