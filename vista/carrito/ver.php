<?php if (isset($carrito) && count($carrito) >= 1) : ?>
    <h1>Detalle de la compra</h1>
    <table class="tabla">
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Herramientas</th>
        </tr>
        <?php foreach ($carrito as $indice => $elemento) :
            $producto = $elemento['producto_datos']; //NOTE: guardamos el objeto producto en un variable para mejor manejo    
        ?>
            <tr>
                <td>
                    <?php if ($producto->pros_imagen == null) : ?>
                        <!--NOTE: comprobamos que tenga cargada una imagen, en caso que no tenga le ponemos una imagen default-->
                        <img src="recursos/imagenes/camiseta.png" alt="imagen default" class="miniatura">
                    <?php else : ?>
                        <img src="<?= base_url ?>subidas/productos/<?= $producto->pros_imagen ?>" alt="imagen del producto" class="miniatura">
                    <?php endif; ?>
                </td>
                <td>
                    <a href="<?= base_url ?>producto/detalle&id=<?= $producto->id_producto ?>"><?= $producto->pros_nombre ?></a>
                </td>
                <td><?= $producto->pros_precio ?></td>
                <td>
                    <?= $elemento['cantidad'] ?>
                    <a href="<?= base_url ?>carrito/sumar&indice=<?=$indice?>" class="boton"><b>+</b></a>
                    <a href="<?= base_url ?>carrito/restar&indice=<?=$indice?>" class="boton"><b>-</b></a>
                </td>
                <td>
                <a href="<?= base_url ?>carrito/quitar&indice=<?=$indice?>" class="boton boton-rojo">Quitar del carrito</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <div class="carrito-total">
        <?php $estadisticas = Utilidades::estadisticasCarrito() ?>
        <h3>Precio Total: $<?= $estadisticas['total'] ?></h3>
        <br>
        <a href="<?= base_url ?>pedido/realizar" class="boton boton-azul">Realizar pedido</a>
        <a href="<?= base_url ?>carrito/eliminar" class="boton boton-rojo">Vaciar carrito</a>
    </div>
<?php else:?>
    <h1>No hay productos en tu carrito</h1>
<?php endif; ?>