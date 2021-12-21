<h1>Detalle del pedido</h1>

<?php if (isset($pedido)) : ?>
    <?php if (isset($_SESSION['admin'])) : ?>
        <!--NOTE: si tiene el rol de administrador podra cambiar el estado del pedido-->
        <h3>Cambio de estado del pedido:</h3>
        <form action="<?= base_url ?>pedido/cambiarEstado" class="producto-estado" method="post">
            <input type="hidden" value="<?= $pedido->id_pedido ?>" name="pedido_id">
            <select name="estado">
                <option value="pendiente" <?= $pedido->peos_estado == "pendiente" ? "selected" : "" ?>>Pendiente</option>
                <option value="preparacion" <?= $pedido->peos_estado == "preparacion" ? "selected" : "" ?>>En preparacion</option>
                <option value="despacho" <?= $pedido->peos_estado == "despacho" ? "selected" : "" ?>>Preparado para enviar</option>
                <option value="enviado" <?= $pedido->peos_estado == "enviado" ? "selected" : "" ?>>En camino al destino</option>
            </select>
            <input type="submit" value="Cambiar estado">
        </form>
    <?php endif; ?>
    <h3>Datos del usuario</h3>
    Nombre: <?=$usuario->usos_nombres?><br>
    Apellido: <?=$usuario->usos_apellidos?><br>
    Correo: <?=$usuario->usos_correo?><br>
    <br><br>
    <h3>Datos del pedido</h3>
    Numero del pedido: <?= $pedido->id_pedido ?> <br>
    Precio: $<?= $pedido->peos_costo ?> <br><br>
    <h3>Direccion del pedido:</h3>
    Direccion: <?= $pedido->peos_direccion ?> <br>
    Localidad: <?= $pedido->peos_localidad ?> <br>
    Provincia: <?= $pedido->peos_provincia ?> <br>
    Estado del pedido: <?= Utilidades::estadoPedido($pedido->peos_estado) ?> <br><br>
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