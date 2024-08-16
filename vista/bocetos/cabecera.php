<!--TODO: Cabecera de la pagina web-->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Master</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;900&amp;display=swap">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?=base_url?>recursos/css/barraLateral.css">
    <link rel="stylesheet" href="<?=base_url?>recursos/css/cabecera.css">
    <link rel="stylesheet" href="<?=base_url?>recursos/css/formularios.css">
    <link rel="stylesheet" href="<?=base_url?>recursos/css/global.css">
    <link rel="stylesheet" href="<?=base_url?>recursos/css/menu.css">
    <link rel="stylesheet" href="<?=base_url?>recursos/css/piePagina.css">
    <link rel="stylesheet" href="<?=base_url?>recursos/css/productos.css">
    <link rel="stylesheet" href="<?=base_url?>recursos/css/usuarios.css">
    <link rel="stylesheet" href="<?=base_url?>recursos/css/categorias.css">
    <link rel="stylesheet" href="<?=base_url?>recursos/css/pedidos.css">
    <link rel="stylesheet" href="<?=base_url?>recursos/css/errores.css">
    <link rel="icon" href="Proyectos.png" type="image/png">
</head>

<body>
    <section id="web">
        <!------------------ CABECERA ------------------>
        <header id="cabecera">
            <div id="logo">
                <img src="<?=base_url?>recursos/imagenes/camiseta.png" alt="logo de camiseta">
                <a href="index.php">
                    Tienda de camisetas
                </a>
            </div>
        </header>


        <!------------------ MENU ------------------>
        <nav id="menu">
        <?php $categorias = Utilidades::mostrarCategorias(); //NOTE: usamos el helper para mostrar las categorias en el menu?>
            <ul>
                <li class="posicionR">
                    <?php ob_start(); $carrito = Utilidades::estadisticasCarrito();?>
                    <a href="<?= base_url ?>carrito/detalle" title="Ir al carrito">
                        <i class='bx bx-cart bx-sm'></i>
                        <?php if (isset($_SESSION['identidad'])) : ?>
                            <div class="redondo-rojo-carrito">
                                <?= $carrito['cantidad'] ?>
                            </div>
                        <?php endif;?>
                    </a>
                </li>
                <li>
                    <a href="<?=base_url?>">Inicio</a>
                </li>
                <?php foreach ($categorias as $categoria): //NOTE: hacemos un bucle para mostrar todas las categorias?>
                    <li>
                        <a href="<?= base_url ?>categoria/ver&id=<?=$categoria['id_categoria']?>"><?=$categoria['caia_nombre']?></a>
                    </li>
                <?php endforeach;?>
            </ul>
        </nav>

        <!------------------ BARRA LATERAL Y CONTENIDO PRINCIPAL ------------------>
        <section id="contenido">