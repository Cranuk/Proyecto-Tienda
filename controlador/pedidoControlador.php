<?php
require_once 'modelo/pedidoModelo.php';

class pedidoControlador
{
    public function test(){ //NOTE: funcion de testeo para saber si me carga todo en orden
        echo 'controlador pedido, accion index';
    }

    public function realizar(){
        require_once 'vista/pedidos/realizar.php';
    }

    public function confirmar(){ //NOTE: se confirma el pedido si esta registrado en la pagina
        if (isset($_SESSION['identidad'])) {
            $usuario_id = $_SESSION['identidad']['id_usuario']; //NOTE: tomamos el id del usuario logeado
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
            $localidad = isset($_POST['localidad']) ? $_POST['localidad'] : false;
            $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false;
            $datoCarrito = Utilidades::estadisticasCarrito(); //NOTE: usamos el helpers para obtener datos del carrito
            $costo = $datoCarrito['total'];

            if ($direccion && $localidad && $provincia) {
                //ANCHOR: guardar en la base el pedido
                $dato = new PedidoModelo();
                $dato->setUsuario_id($usuario_id);
                $dato->setDireccion($direccion);
                $dato->setLocalidad($localidad);
                $dato->setProvincia($provincia);
                $dato->setCosto($costo);

                $pedidoConfirmar = $dato->guardar();
                $actualizarStock = $dato->actualizarStock();
                //NOTE: guardar linea de pedido con datos de la compra
                $lineaConfirmar = $dato->guardarLinea();

                if ($pedidoConfirmar && $lineaConfirmar && $actualizarStock) {
                    $_SESSION['pedido'] = 'finalizado';
                } else {
                    $_SESSION['pedido'] = 'error';
                }
            } else {
                $_SESSION['pedido'] = 'error';
            }
            header('Location:' . base_url . 'pedido/pedidoConfirmado');
        } else {
            header('Location:' . base_url);
        }
    }

    public function pedidoConfirmado(){
        if (isset($_SESSION['identidad'])) {
            $usuario_id = $_SESSION['identidad']['id_usuario']; //NOTE: tomamos el id del usuario logeado
            $dato = new PedidoModelo();
            $dato->setUsuario_id($usuario_id);
            $pedidoUsuario = $dato->pedidoUsuario();
            $dato2 = new PedidoModelo();
            $productoUsuario = $dato2->pedidoProducto($pedidoUsuario['id_pedido']);
        }
        require_once 'vista/pedidos/confirmado.php';
    }

    public function misPedidos(){ //NOTE: nos dara los pedidos que tenga el usuario logeado
        Utilidades::logeado(); // NOTE: usamos el helper para comprobar si esta logeado
        $usuario_id = $_SESSION['identidad']['id_usuario']; //NOTE: tomamos el id del usuario logeado
        $dato = new PedidoModelo();

        //NOTE: sacamos los pedidos del usuario
        $dato->setUsuario_id($usuario_id);
        $pedidos = $dato->listaPedidoUsuario();

        require_once 'vista/pedidos/misPedidos.php';
    }

    public function detallePedido(){
        Utilidades::logeado(); // NOTE: usamos el helper para comprobar si esta logeado

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // NOTE: Sacar el pedido
            $dato = new PedidoModelo();
            $dato->setId($id);
            $pedido = $dato->elegirPedido();

            // NOTE: Sacar los productos
            $dato2 = new PedidoModelo();
            $productos = $dato2->pedidoProducto($id);

            // NOTE: Sacamos los datos del usuario
            $dato3 = new PedidoModelo();
            $usuario = $dato3->datosUsuario($id);

            require_once 'vista/pedidos/detalles.php';
        } else {
            header('Location:' . base_url . 'pedido/misPedidos');
        }
    }

    public function cambiarEstado(){
        Utilidades::esAdmin();
        if (isset($_POST['pedido_id']) && isset($_POST['estado'])) {
            //NOTE: obtenemos los datos traidos por post
            $id = $_POST['pedido_id'];
            $estado = $_POST['estado'];

            //NOTE: actualizamos el estado del pedido
            $pedido = new PedidoModelo();
            $pedido->setId($id);
            $pedido->setEstado($estado);
            $pedido->cambiarEstado();
            header('Location:' . base_url . 'pedido/detallePedido&id=' . $id);
        } else {
            header('Location:' . base_url);
        }
    }

    public function listado(){
        Utilidades::esAdmin(); // NOTE: usamos el helper para comprobar si el usuario tiene categoria administrador
        $dato = new PedidoModelo();
        $pedidos = $dato->mostrarPedidos();
        require_once 'vista/pedidos/misPedidos.php';
    }
}
