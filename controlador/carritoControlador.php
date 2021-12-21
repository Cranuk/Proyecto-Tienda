<?php
require_once 'modelo/productoModelo.php';
class carritoControlador
{
    public function test(){
        echo 'funcion de prueba para saber si funciona la logica';
    }

    public function detalle(){
        if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1){
            $carrito = $_SESSION['carrito'];
        }else{
            $carrito = array();
        }
        require_once 'vista/carrito/ver.php';
    }

    public function agregar(){ //NOTE: agrega el producto al carrito de compras
        if (isset($_GET['id'])) {
            $id_producto = $_GET['id'];
        } else {
            header('Location:'.base_url);
        }

        if (isset($_SESSION['carrito'])) { //NOTE: preguntamos si existe la session carrito, en caso de que no la creamos
            $contador = 0; //NOTE: bandera
            foreach ($_SESSION['carrito'] as $indice => $elemento) {
                if ($elemento['id_producto'] == $id_producto) { //NOTE: si el producto agregado ya estaba en el carrito solo se aumenta la cantidad
                    $_SESSION['carrito'][$indice]['cantidad']++;
                    $contador++;
                }
            }
        }

        if (!isset($contador) || $contador == 0) { //NOTE: agrega nuevo producto solo si no fueron agregados anteriormente
            //NOTE: conseguir producto
            $dato = new ProductoModelo();
            $dato->setId($id_producto);
            $producto = $dato->elegirProducto(); //NOTE: guardamos los datos de un producto en una variable

            //NOTE: agregar al carrito
            if (is_object($producto)) {
                $_SESSION['carrito'][] = array(
                    'id_producto' => $producto->id_producto,
                    'precio' => $producto->pros_precio,
                    'cantidad' => 1,
                    'producto_datos' => $producto
                );
            }
        }

        header('Location:'.base_url.'carrito/detalle');
    }

    public function quitar(){
        if (isset($_GET['indice'])) {
            $indice = $_GET['indice'];
            unset($_SESSION['carrito'][$indice]); // NOTE: estamos quitando del array carrito uno de sus elementos
        }
        header('Location:'.base_url.'carrito/detalle');
    }

    public function eliminar(){
        unset($_SESSION['carrito']);
        header('Location:'.base_url.'carrito/detalle');
    }

    public function sumar(){
        if (isset($_GET['indice'])) {
            $indice = $_GET['indice'];
            $_SESSION['carrito'][$indice]['cantidad']++; // NOTE: accedemos al indice del array para aumentar sus unidades
        }
        header('Location:'.base_url.'carrito/detalle');
    }

    public function restar(){
        if (isset($_GET['indice'])) {
            $indice = $_GET['indice'];
            $_SESSION['carrito'][$indice]['cantidad']--; // NOTE: accedemos al indice del array para disminuir sus unidades
        }
        if ($_SESSION['carrito'][$indice]['cantidad'] == 0) {
            unset($_SESSION['carrito'][$indice]);
        }
        header('Location:'.base_url.'carrito/detalle');
    }
}
