<section id="pedido" class="confirmado">
    <?php if (isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'finalizado') : ?>
        <h1 class="sin-borde">Pedido Confirmado</h1>
        <p>
            Su pedido se ha confirmado correctamente, una vez realizado el pago se pondra en proceso de envio.
        </p>
        <br>
        <h3>Datos del pedido:</h3>
        <?php if (isset($pedidoUsuario)) : ?>
            Numero del pedido: <?= $pedidoUsuario['id_pedido'] ?> <br>
            Precio: $<?= $pedidoUsuario['peos_costo'] ?> <br>
            Productos:
            <table class="tabla">
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                </tr>
                <tr>
                    <td>
                        <?php if (is_null($productoUsuario['pros_imagen'])) : ?>
                            <!--NOTE: comprobamos que tenga cargada una imagen, en caso que no tenga le ponemos una imagen default-->
                            <img src="<?= base_url ?>recursos/imagenes/camiseta.png" alt="imagen default">
                        <?php else : ?>
                            <img src="<?= base_url ?>subidas/productos/<?= $productoUsuario['pros_imagen'] ?>" alt="imagen del producto">
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?= base_url ?>producto/detalle&id=<?= $productoUsuario['id_producto'] ?>"><?= $productoUsuario['pros_nombre'] ?></a>
                    </td>
                    <td><?= $productoUsuario['pros_precio'] ?></td>
                    <td><?= $productoUsuario['lios_cantidad'] ?></td>
                </tr>
            </table>
        <?php endif; ?>
    <?php else : ?>
        <h1>Su pedido no se pudo confirmar</h1>
        <p>
            Por favor solicite soporte a la tienda para resolver el problema
        </p>
    <?php endif; ?>
</section>
