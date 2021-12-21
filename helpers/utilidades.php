<?php
class Utilidades{
    public static function borrarSesion($nombre){
        if (isset($_SESSION[$nombre])) {
            $_SESSION[$nombre] = null;
        unset($_SESSION[$nombre]);
        }
        return $nombre;
    }

    public static function esAdmin(){ //NOTE: comprobamos si el usuario logeado tiene el rol de admin activado
        if (!isset($_SESSION['admin'])){
            header('Location:'.base_url);
        }else{
            return true;
        }
    }

    public static function logeado(){ //NOTE: comprobamos si el usuario logeado
        if (!isset($_SESSION['identidad'])){
            header('Location:'.base_url);
        }else{
            return true;
        }
    }

    public static function mostrarCategorias(){ //NOTE: mostramos en la pagina principal las categorias que estan creadas en la base de datos
        require_once 'modelo/categoriaModelo.php';
        $dato = new CategoriaModelo();
        $categorias = $dato->mostrarCategorias();
        return $categorias;
    }

    public static function estadisticasCarrito(){ //NOTE: funcion que tiene un array con datos sobre la compra de productos alias carrito
        $estadisticas = array(
            'cantidad' => 0,
            'total' => 0
        );
        if (isset($_SESSION['carrito'])) {
            $estadisticas['cantidad'] = count($_SESSION['carrito']);
            foreach($_SESSION['carrito'] as $producto){
                $estadisticas['total'] += $producto['precio'] * $producto['cantidad'];
            }
        }

        return $estadisticas;
    }

    public static function estadoPedido($estado){
        $valor = 'Pendiente';
        if ($estado == 'pendiente') {
            $valor = 'Pendiente';
        } elseif($estado == 'preparacion') {
            $valor = 'En preparacion';
        }elseif($estado == 'despacho') {
            $valor = 'Preparado para enviar';
        }elseif($estado == 'enviado') {
            $valor = 'En camino al destino';
        }

        return $valor;
    }
}