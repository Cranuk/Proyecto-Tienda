<section id="producto" class="listado">
    <h1>Listado de productos</h1>

    <a href="<?=base_url?>producto/crear" class="boton boton-chico">
        Crear producto
    </a>

    <?php if (isset($_SESSION['producto']) && $_SESSION['producto'] == 'guardado'):?>
        <strong class="alerta_verde">Producto GUARDADO</strong>
    <?php elseif (isset($_SESSION['producto']) && $_SESSION['producto'] != 'guardado'):?>
        <strong class="alerta_roja">ERROR al guardar el producto</strong>
    <?php endif;?>
    <?php Utilidades::borrarSesion('producto');?>
    <?php if (isset($_SESSION['borrado']) && $_SESSION['borrado'] == 'finalizado'):?>
        <strong class="alerta_verde">Producto ELIMINADO</strong>
    <?php elseif (isset($_SESSION['borrado']) && $_SESSION['borrado'] != 'finalizado'):?>
        <strong class="alerta_roja">ERROR al eliminar el producto</strong>
    <?php endif;?>
    <?php Utilidades::borrarSesion('borrado');?>
    <table class="tabla">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Imagen</th>
            <th>Herramientas</th>
        </tr>
        <?php foreach ($productos as $producto):?>
            <tr>
                <td><?=$producto['id_producto']?></td>
                <td><?=$producto['pros_nombre']?></td>
                <td><?=$producto['pros_precio']?></td>
                <td><?=$producto['pros_stock']?></td>
                <?php if (is_null($producto['pros_imagen'])) : ?>
                    <!--NOTE: comprobamos que tenga cargada una imagen, en caso que no tenga le ponemos una imagen default-->
                    <td>
                        <img src="<?= base_url ?>recursos/imagenes/camiseta.png" alt="imagen default">
                    </td>
                <?php else : ?>
                    <td>
                        <img src="<?= base_url ?>subidas/productos/<?= $producto['pros_imagen'] ?>" alt="imagen del producto">
                    </td>
                <?php endif; ?>
                <td>
                    <!--NOTE: los botones creados al estar en un bucle les debemos asignar el id para saber a que producto en especifico deseamos eliminar o editar mediante parametro GET-->
                    <a href="<?=base_url?>producto/eliminar&id=<?=$producto['id_producto']?>" class="boton boton-rojo boton-herramienta">Eliminar</a>
                    <a href="<?=base_url?>producto/editar&id=<?=$producto['id_producto']?>" class="boton boton-azul boton-herramienta">Editar</a>
                </td>
            </tr>
        <?php endforeach;?>
    </table>
</section>
