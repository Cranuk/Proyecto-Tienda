<?php
require_once 'configuracion/conexion.php';
class PedidoModelo{
    private $id;
    private $usuario_id;
    private $direccion;
    private $localidad;
    private $provincia;
    private $costo;
    private $estado;
    private $fecha;
    private $hora;

    //ANCHOR: getters
    public function getId(){
        return $this->id;
    }

    public function getUsuario_id(){
        return $this->usuario_id;
    }

    public function getDireccion(){
        return $this->direccion;
    }

    public function getLocalidad(){
        return $this->localidad;
    }

    public function getProvincia(){
        return $this->provincia;
    }

    public function getCosto(){
        return $this->costo;
    }

    public function getEstado(){
        return $this->estado;
    }

    public function getFecha(){
        return $this->fecha;
    }

    public function getHora(){
        return $this->hora;
    }

    //ANCHOR: setters
    public function setHora($hora){
        $this->hora = $hora;
        return $this;
    }

    public function setFecha($fecha){
        $this->fecha = $fecha;
        return $this;
    }

    public function setEstado($estado){
        $this->estado = $estado;
        return $this;
    }

    public function setCosto($costo){
        $this->costo = $costo;
        return $this;
    }

    public function setProvincia($provincia){
        $this->provincia = $provincia;
        return $this;
    }

    public function setLocalidad($localidad){
        $this->localidad = $localidad;
        return $this;
    }

    public function setDireccion($direccion){
        $this->direccion = $direccion;
        return $this;
    }

    public function setUsuario_id($usuario_id){
        $this->usuario_id = $usuario_id;
        return $this;
    }

    public function setId($id){
        $this->id = $id;
        return $this;
    }

    //ANCHOR: otras funciones
    public function mostrarPedidos(){
        $base = Conexion::conectar();
        $sql = "SELECT * FROM pedidos ORDER BY id_pedido DESC";
        $consulta = $base -> prepare($sql);
        $consulta->execute();
        $resultado = $consulta -> fetch(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function elegirPedido(){
        $base = Conexion::conectar();
        $pedido_id = $this->getId();
        $sql = "SELECT * FROM pedidos WHERE id_pedido = :pedido_id";
        $consulta = $base -> prepare($sql);
        $consulta -> bindParam(':pedido_id', $pedido_id);
        $consulta -> execute();
        $resultado = $consulta -> fetch(PDO::FETCH_ASSOC);
        return $resultado; //NOTE: lo devolvemos como un objeto para utilizar sus datos
    }

    public function pedidoUsuario(){
        $base = Conexion::conectar();
        $usuario_id = $this->getUsuario_id();
        $sql = "SELECT * FROM pedidos WHERE usuario_id = :usuario_id ORDER BY id_pedido DESC LIMIT 1";
        $consulta = $base -> prepare($sql);
        $consulta -> bindParam(':usuario_id', $usuario_id);
        $consulta -> execute();
        $resultado =  $consulta -> fetch(PDO::FETCH_ASSOC);
        return $resultado; //NOTE: lo devolvemos como un objeto para utilizar sus datos
    }

    public function productoUsuario($id){
        $base = Conexion::conectar();
        $sql = "SELECT pr.*, lp.* FROM productos pr ";
        $sql .= "INNER JOIN lineaspedidos lp ON pr.id_producto = lp.producto_id ";
        $sql .= "WHERE lp.pedido_id = :id";
        $consulta = $base -> prepare($sql);
        $consulta -> bindParam(':id', $id);
        $consulta -> execute();
        $resultado = $consulta -> fetch(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function datosUsuario($id){
        $base = Conexion::conectar();
        $sql = "SELECT u.* FROM pedidos p ";
        $sql .= "INNER JOIN usuarios u ON p.usuario_id = u.id_usuario ";
        $sql .= "WHERE id_pedido = :id";
        $consulta = $base -> prepare($sql);
        $consulta -> bindParam(':id', $id);
        $consulta -> execute();
        $resultado = $consulta -> fetch(PDO::FETCH_ASSOC);
        return $resultado; //NOTE: lo devolvemos como un objeto para utilizar sus datos
    }

    public function listaPedidoUsuario(){
        $base = Conexion::conectar();
        $usuario_id = $this -> getUsuario_id();
        $sql = "SELECT * FROM pedidos WHERE usuario_id = :usuario_id ORDER BY id_pedido DESC";
        $consulta = $base -> prepare($sql);
        $consulta -> bindParam(':usuario_id', $usuario_id);
        $consulta -> execute();
        $resultado = $consulta -> fetch(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function guardar(){
        $base = Conexion::conectar();
        $usuario_id = $this -> getUsuario_id();
        $direccion = $this -> getDireccion();
        $localidad = $this -> getLocalidad();
        $provincia = $this -> getProvincia();
        $costo = $this -> getCosto();
        $sql = "INSERT INTO pedidos VALUES (NULL, :usuario_id, :direccion, :localidad, :provincia, :costo, 'pendiente', CURDATE(), CURTIME())";
        $consulta = $base -> prepare($sql);
        $consulta -> bindParam(':usuario_id', $usuario_id);
        $consulta -> bindParam(':direccion', $direccion);
        $consulta -> bindParam(':localidad', $localidad);
        $consulta -> bindParam(':provincia', $provincia);
        $consulta -> bindParam(':costo', $costo);
        $guardo = $consulta -> execute();
        $resultado = false;
        if ($guardo) {
            $resultado = true;
        }
        return $resultado;
    }

    public function actualizarStock(){
        $base = Conexion::conectar();
        $sql = "SELECT LAST_INSERT_ID() as pedido";
        $consulta = $base -> prepare($sql);
        $consulta -> execute();
        $row = $consulta->fetch(PDO::FETCH_OBJ);
        $pedido = $row->pedido;

        foreach ($_SESSION['carrito'] as $carrito){
            $producto = $carrito['producto_datos'];
            $sql2 = "UPDATE productos SET pros_stock = pros_stock - :cantidad WHERE id_producto = :id_producto";
            $consulta2 = $base -> prepare($sql2);
            $consulta2 -> bindParam(':cantidad', $carrito['cantidad']);
            $consulta -> bindParam(':producto_id', $producto->id_producto);
            $guardo = $consulta -> execute();
        }
        
        $resultado = false;
        if ($guardo) {
            $resultado = true;
        }
        return $resultado;
    }

    public function guardarLinea(){
        $base = Conexion::conectar();
        $sql = "SELECT LAST_INSERT_ID() as pedido";
        $consulta = $base -> prepare($sql);
        $consulta -> execute();
        $row = $consulta->fetch(PDO::FETCH_OBJ);
        $pedido = $row->pedido;

        foreach ($_SESSION['carrito'] as $carrito){
            $producto = $carrito['producto_datos'];
            $sql2 = "INSERT INTO lineaspedidos VALUES(NULL, :pedido, :id_producto, :cantidad)";
            $consulta = $base -> prepare($sql2);
            $consulta -> bindParam(':pedido', $pedido);
            $consulta -> bindParam(':id_producto', $producto->id_producto);
            $consulta -> bindParam(':cantidad', $carrito['cantidad']);
            $guardo = $consulta -> execute();
        }
        
        $resultado = false;
        if ($guardo) {
            $resultado = true;
        }
        return $resultado;
        
    }

    public function cambiarEstado(){
        $base = Conexion::conectar();
        $estado = $this -> getEstado();
        $pedido_id = $this -> getId();
        $sql = "UPDATE pedidos SET peos_estado = :estado WHERE id_pedido = :pedido_id";
        $consulta = $base -> prepare($sql);
        $consulta -> bindParam(':estado', $estado);
        $consulta -> bindParam(':pedido_id', $pedido_id);
        $actualizo = $consulta -> execute();
        
        $resultado = false;
        if ($actualizo) {
            $resultado = true;
        }
        return $resultado;
    }
}