<?php
require_once 'modelo/categoriaModelo.php';
require_once 'modelo/productoModelo.php';
class categoriaControlador{
    public function test(){ //NOTE: funcion de testeo para saber si me carga todo en orden
        echo 'controlador categoria, accion index';
    }

    public function ver(){ //NOTE: funcion que te muestra los productos que tenga esa categoria asignada
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            //ANCHOR: conseguir categoria
            $datos = new categoriaModelo();
            $datos->setId($id);
            $categoria = $datos->verCategoria();
            
            //ANCHOR: conseguir producto de esa categoria
            $datos2 = new productoModelo();
            $datos2->setCategoria_id($id);
            $productos = $datos2->mostrarProductoCategoria();
        }
        require_once 'vista/categorias/ver.php';
    }

    public function listado(){ //NOTE: funcion que te muestra todas las categorias creadas
        Utilidades::esAdmin();
        $datos = new CategoriaModelo();
        $categorias = $datos->mostrarCategorias();
        require_once 'vista/categorias/listado.php';
    }

    public function crear(){
        Utilidades::esAdmin();
        require_once 'vista/categorias/crear.php';
    }

    public function editar(){
        Utilidades::esAdmin();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $edicion = true; //TODO: esta variable se creo para poder utilizar el mismo archivo para diferente tarea
            $dato = new CategoriaModelo();
            $dato->setId($id);
            $categoria = $dato->verCategoria();

            require_once 'vista/categorias/crear.php';//NOTE: nos redirige a esta pagina
        }else{
            header('Location:'.base_url.'categoria/listado');
        }
    }

    public function guardar(){
        Utilidades::esAdmin();
        //NOTE: guardar categoria en la base de datos
        if (isset($_POST) && isset($_POST['nombre'])) {
            $categoria = new CategoriaModelo();
            $categoria->setNombre($_POST['nombre']);

            //NOTE: si se esta editando la categoria
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $categoria->setId($id);
                $guardado = $categoria->editar(); 
            }else{
                $guardado = $categoria->guardar();
            }

            if($guardado){
                $_SESSION['categoria'] = 'guardado';
            }else{
                $_SESSION['categoria'] = 'error';
            }
        }else{
            $_SESSION['categoria'] = 'error';
        }
        
        header('Location:'.base_url.'categoria/listado');
    }

    public function eliminar(){
        Utilidades::esAdmin();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $categoria = new CategoriaModelo();
            $categoria->setId($id);
            $borrado = $categoria->eliminar();

            if ($borrado) {
                $_SESSION['borrado'] = 'finalizado';
            }else{
                $_SESSION['borrado'] = 'error';
            }
        }else{
            $_SESSION['borrado'] = 'error';
        }
        header('Location:'.base_url.'categoria/listado');
    }
}