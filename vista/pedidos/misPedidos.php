<?php if (empty($pedidos)):?>
    <?php 
        $error = new errorControlador();
        $error -> errorMensaje('pedidos'); 
    ?>
<?php else:?>
    <section id="pedido" class="listado">
        <h1 class="sin-borde">Mis pedidos</h1>
        <table class="tabla">
            <tr>
                <th>Numero del pedido</th>
                <th>Coste</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Herramientas</th>
            </tr>
                <tr>
                    <td><?= $pedidos['id_pedido'] ?></td>
                    <td><?= $pedidos['peos_costo'] ?></td>
                    <td><?= $pedidos['peos_fecha'] ?></td>
                    <td><?= Utilidades::estadoPedido($pedidos['peos_estado']) ?></td>
                    <td>
                        <a href="<?= base_url ?>pedido/detallePedido&id=<?= $pedidos['id_pedido'] ?>" class="boton boton-naranja boton-herramienta" title="Ir a detalles"><i class='bx bx-link-external bx-sm'></i></a>
                    </td>
                </tr>
        </table>
    </section>
<?php endif;?>


