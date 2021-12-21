<?php
require_once 'modelo/productoModelo.php';
class productoControlador{
    public function test(){ //NOTE: funcion de testeo para saber si me carga todo en orden
        echo 'controlador producto, accion index';
    }

    public function destacado(){
        $limite = 6; //NOTE: limite de productos que se mostrara en la vista de productos destacados
        $datos = new ProductoModelo();
        $destacados = $datos->mostrarDestacados($limite);
        require_once 'vista/productos/destacados.php';//NOTE: nos redirige a esta pagina
    }

    public function listado(){
        Utilidades::esAdmin();
        $datos = new ProductoModelo();
        $productos = $datos->mostrarProductos();
        require_once 'vista/productos/listado.php';//NOTE: nos redirige a esta pagina
    }

    public function crear(){
        Utilidades::esAdmin();
        require_once 'vista/productos/crear.php';//NOTE: nos redirige a esta pagina
    }

    public function guardar(){ //NOTE: esta funcion tiene realiza la misma accion solo para distintas situaciones (editar y guardar)
        Utilidades::esAdmin();
        if (isset($_POST)) {

            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
            $stock = isset($_POST['stock']) ? $_POST['stock'] : false;

            if ($categoria && $nombre && $descripcion && $precio && $stock) {
                $producto = new ProductoModelo();
                $producto->setCategoria_id($categoria);
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setStock($stock);

                //NOTE: guardar la imagen
                if(isset($_FILES['imagen'])){
                    $archivo = $_FILES['imagen'];
                    $nombreArchivo = $archivo['name'];
                    $tipoArchivo = $archivo['type'];

                    if ($tipoArchivo == 'image/png' || $tipoArchivo == 'image/jpeg' || $tipoArchivo == 'image/jpg') {//NOTE: verificamos que sea un formato de imagen deseada
                        if (!is_dir('subidas/productos')) {//NOTE: pregunta si existe una carpeta en esa ubicacion caso que no*
                            mkdir('subidas/productos',0777, true); //NOTE: *creamos la carpeta y el permiso
                        }
                        $producto->setImagen($nombreArchivo);
                        move_uploaded_file($archivo['tmp_name'],'subidas/productos/'.$nombreArchivo);//NOTE: guardamos el archivo en la carpeta creada anteriormente con su nombre
                    }
                }

                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $producto->setId($id);
                    $guardado = $producto->editar(); 
                }else{
                    $guardado = $producto->guardar();
                }

                if ($guardado) {
                    $_SESSION['producto'] = 'guardado';
                }else{
                    $_SESSION['producto'] = 'error';
                }
            }else{
                $_SESSION['producto'] = 'error';
            }
        }else{
            $_SESSION['producto'] = 'error';
        }
        header('Location:'.base_url.'producto/listado');
    }

    public function eliminar(){
        Utilidades::esAdmin();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $producto = new ProductoModelo();
            $producto->setId($id);
            $borrado = $producto->eliminar();

            if ($borrado) {
                $_SESSION['borrado'] = 'finalizado';
            }else{
                $_SESSION['borrado'] = 'error';
            }
        }else{
            $_SESSION['borrado'] = 'error';
        }
        header('Location:'.base_url.'producto/listado');

    }

    public function editar(){
        Utilidades::esAdmin();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $edicion = true; //TODO: esta variable se creo para poder utilizar el mismo archivo para diferente tarea
            $dato = new ProductoModelo();
            $dato->setId($id);
            $producto = $dato->elegirProducto();

            require_once 'vista/productos/crear.php';//NOTE: nos redirige a esta pagina
        }else{
            header('Location:'.base_url.'producto/listado');
        }
    }

    public function detalle(){
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $edicion = true; //TODO: esta variable se creo para poder utilizar el mismo archivo para diferente tarea
            $dato = new ProductoModelo();
            $dato->setId($id);
            $producto = $dato->elegirProducto();
        }
        require_once 'vista/productos/ver.php';//NOTE: nos redirige a esta pagina
    }
}