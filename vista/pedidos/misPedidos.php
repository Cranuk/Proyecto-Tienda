<section id="pedido" class="listado">
    <h1>Mis pedidos</h1>
    <?php if (empty($pedidos)):?>
        <h2>No hay pedidos</h2>
    <?php else:?>
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
                        <a href="<?= base_url ?>pedido/detallePedido&id=<?= $pedidos['id_pedido'] ?>" class="boton boton-naranja boton-herramienta"><i class='bx bx-link-external'></i></a>
                    </td>
                </tr>
        </table>
    <?php endif;?>
</section>

