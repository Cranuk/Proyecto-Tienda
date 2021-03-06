<!--TODO: Cabecera de la pagina web-->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Master</title>
    <link rel="stylesheet" href="<?=base_url?>recursos/css/estilos.css">
</head>

<body>
    <div id="contenedor">
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
                <li>
                    <a href="<?=base_url?>">Inicio</a>
                </li>
                <?php while ($categoria = $categorias->fetch_object()): //NOTE: hacemos un bucle para mostrar todas las categorias?>
                    <li>
                        <a href="<?= base_url ?>categoria/ver&id=<?=$categoria->id_categoria?>"><?=$categoria->caia_nombre?></a>
                    </li>
                <?php endwhile;?>
            </ul>
        </nav>

        <!------------------ BARRA LATERAL Y CONTENIDO PRINCIPAL ------------------>
        <div id="contenido">