<section id="producto" class="listado">
    <h1 class="sin-borde">Listado de productos</h1>

    <a href="<?=base_url?>producto/crear" class="boton boton-verde boton-herramienta boton-posicion" title="Crear producto">
        <i class='bx bx-list-plus bx-sm'></i>
    </a>
    
    <?php Utilidades::borrarSesion('borrado');?>
    <table>
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
                    <a href="<?=base_url?>producto/editar&id=<?=$producto['id_producto']?>" class="boton boton-azul boton-herramienta"><i class='bx bx-edit bx-sm'></i></a>
                    <a onclick="alerta_eliminar(<?=$producto['id_producto']?>, 2)" class="boton boton-rojo boton-herramienta"><i class='bx bx-trash bx-sm'></i></a>
                </td>
            </tr>
        <?php endforeach;?>
    </table>
</section>
