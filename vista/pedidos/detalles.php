<section id="pedido" class="detalle">
    <h1>Detalle del pedido</h1>

    <?php if (isset($pedido)) : ?>
        <?php if (isset($_SESSION['admin'])) : ?>
            <!--NOTE: si tiene el rol de administrador podra cambiar el estado del pedido-->
            <h3>Cambio de estado del pedido:</h3>
            <form action="<?= base_url ?>pedido/cambiarEstado" class="producto-estado" method="post">
                <input type="hidden" value="<?= $pedido['id_pedido'] ?>" name="pedido_id">
                <select name="estado">
                    <option value="pendiente" <?= $pedido['peos_estado'] == "pendiente" ? "selected" : "" ?>>Pendiente</option>
                    <option value="preparacion" <?= $pedido['peos_estado'] == "preparacion" ? "selected" : "" ?>>En preparacion</option>
                    <option value="despacho" <?= $pedido['peos_estado'] == "despacho" ? "selected" : "" ?>>Preparado para enviar</option>
                    <option value="enviado" <?= $pedido['peos_estado'] == "enviado" ? "selected" : "" ?>>En camino al destino</option>
                </select>
                <input type="submit" value="Cambiar estado">
            </form>
        <?php endif; ?>
        <section id="pedido" class="infoDetalle">
            <div class= columnaDetalle1>
                <h3>Datos del usuario</h3>
                Nombre: <?=$usuario['usos_nombres']?><br>
                Apellido: <?=$usuario['usos_apellidos']?><br>
                Correo: <?=$usuario['usos_correo']?><br>
            </div>

            <div class="columnaDetalle2">
                <h3>Datos del pedido</h3>
                Numero del pedido: <?= $pedido['id_pedido'] ?> <br>
                Precio: $<?= $pedido['peos_costo'] ?> <br>
            </div>

            <div class="columnaDetalle3">
                <h3>Datos del envio</h3>
                Direccion: <?= $pedido['peos_direccion'] ?> <br>
                Localidad: <?= $pedido['peos_localidad'] ?> <br>
                Provincia: <?= $pedido['peos_provincia'] ?> <br>
                Estado del pedido: <?= Utilidades::estadoPedido($pedido['peos_estado']) ?>
            </div>
        </section>

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
                        <?php if (is_null($productos['pros_imagen'])) : ?>
                            <!--NOTE: comprobamos que tenga cargada una imagen, en caso que no tenga le ponemos una imagen default-->
                            <img src="<?= base_url ?>recursos/imagenes/camiseta.png" alt="imagen default" class="miniatura">
                        <?php else : ?>
                            <img src="<?= base_url ?>subidas/productos/<?= $productos['pros_imagen'] ?>" alt="imagen del producto" class="miniatura">
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?= base_url ?>producto/detalle&id=<?= $productos['id_producto'] ?>"><?= $productos['pros_nombre'] ?></a>
                    </td>
                    <td><?= $productos['pros_precio'] ?></td>
                    <td><?= $productos['lios_cantidad'] ?></td>
                </tr>
        </table>
    <?php endif; ?>
</section>
