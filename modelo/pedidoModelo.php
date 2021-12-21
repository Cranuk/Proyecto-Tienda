<?php
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
    private $db; 

    public function __construct(){
        $this -> db = BaseDatos::conectar();
    }

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
        $this->provincia = $this->db->real_escape_string($provincia);

        return $this;
    }

    public function setLocalidad($localidad){
        $this->localidad = $this->db->real_escape_string($localidad);

        return $this;
    }

    public function setDireccion($direccion){
        $this->direccion = $this->db->real_escape_string($direccion);

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
        $pedidos = $this->db->query("SELECT * FROM pedidos ORDER BY id_pedido DESC");
        return $pedidos;
    }

    public function elegirPedido(){
        $pedido = $this->db->query("SELECT * FROM pedidos WHERE id_pedido = {$this->getId()}");
        return $pedido->fetch_object(); //NOTE: lo devolvemos como un objeto para utilizar sus datos
    }

    public function pedidoUsuario(){
        $consulta = "SELECT * FROM pedidos WHERE usuario_id = {$this->getUsuario_id()} ORDER BY id_pedido DESC LIMIT 1";
        $pedido = $this->db->query($consulta);
        return $pedido->fetch_object(); //NOTE: lo devolvemos como un objeto para utilizar sus datos
    }

    public function productoUsuario($id){
        $consulta = "SELECT pr.*, lp.* FROM productos pr ";
        $consulta .= "INNER JOIN lineaspedidos lp ON pr.id_producto = lp.producto_id ";
        $consulta .= "WHERE lp.pedido_id = {$id}";
        $producto = $this->db->query($consulta);
        return $producto;
    }

    public function datosUsuario($id){
        $consulta = "SELECT u.* FROM pedidos p ";
        $consulta .= "INNER JOIN usuarios u ON p.usuario_id = u.id_usuario ";
        $consulta .= "WHERE id_pedido = {$id}";
        $datoUsuario = $this->db->query($consulta);
        return $datoUsuario->fetch_object(); //NOTE: lo devolvemos como un objeto para utilizar sus datos
    }

    public function listaPedidoUsuario(){
        $consulta = "SELECT * FROM pedidos WHERE usuario_id = {$this->getUsuario_id()} ORDER BY id_pedido DESC";
        $pedido = $this->db->query($consulta);
        return $pedido;
    }

    public function guardar(){
        $sql = "INSERT INTO pedidos VALUES (NULL, {$this->getUsuario_id()}, '{$this->getDireccion()}', '{$this->getLocalidad()}', '{$this->getProvincia()}', {$this->getCosto()}, 'pendiente', CURDATE(), CURTIME())";
        $guardar = $this->db->query($sql);
        $resultado = false;
        if ($guardar) {
            $resultado = true;
        }
        return $resultado;
    }

    public function actualizarStock(){
        $sql = "SELECT LAST_INSERT_ID() as pedido";
        $consulta = $this->db->query($sql);
        $pedido_id = $consulta->fetch_object()->pedido;

        foreach ($_SESSION['carrito'] as $carrito){
            $producto = $carrito['producto_datos'];
            $actualizarStock = "UPDATE productos SET pros_stock = pros_stock - {$carrito['cantidad']} WHERE id_producto = {$producto->id_producto}";
            $guardar = $this->db->query($actualizarStock);
        }
        
        $resultado = false;
        if ($guardar) {
            $resultado = true;
        }
        return $resultado;
    }

    public function guardarLinea(){
        $sql = "SELECT LAST_INSERT_ID() as pedido";
        $consulta = $this->db->query($sql);
        $pedido_id = $consulta->fetch_object()->pedido;

        foreach ($_SESSION['carrito'] as $carrito){
            $producto = $carrito['producto_datos'];
            $insertar = "INSERT INTO lineaspedidos VALUES(NULL, {$pedido_id}, {$producto->id_producto}, {$carrito['cantidad']})";
            $guardar = $this->db->query($insertar);
        }
        
        $resultado = false;
        if ($guardar) {
            $resultado = true;
        }
        return $resultado;
        
    }

    public function cambiarEstado(){
        $sql = "UPDATE pedidos SET peos_estado = '{$this->getEstado()}' WHERE id_pedido = {$this->getId()}";
        $actualizar = $this->db->query($sql);

        $resultado = false;
        if ($actualizar) {
            $resultado = true;
        }
        return $resultado;
    }
}