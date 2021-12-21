<?php if (isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'finalizado') : ?>
    <h1>Pedido Confirmado</h1>
    <p>
        Su pedido se ha confirmado correctamente, una vez realizado el pago se pondra en proceso de envio.
    </p>
    <br>
    <h3>Datos del pedido:</h3>
    <?php if (isset($pedido)) : ?>
        Numero del pedido: <?= $pedido->id_pedido ?> <br>
        Precio: $<?= $pedido->peos_costo ?> <br>
        Productos:
        <table class="tabla">
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
            </tr>
            <?php while ($producto = $productos->fetch_object()) : ?>
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
                    <td><?= $producto->lios_cantidad ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php endif; ?>
<?php else : ?>
    <h1>Su pedido no se pudo confirmar</h1>
    <p>
        Por favor solicite soporte a la tienda para resolver el problema
    </p>
<?php endif; ?>