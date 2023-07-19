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
            </tr>
                <tr>
                    <td>
                        <a href="<?= base_url ?>pedido/detallePedido&id=<?= $pedidos['id_pedido'] ?>"><?= $pedidos['id_pedido'] ?></a>
                    </td>
                    <td><?= $pedidos['peos_costo'] ?></td>
                    <td><?= $pedidos['peos_fecha'] ?></td>
                    <td><?= Utilidades::estadoPedido($pedidos['peos_estado']) ?></td>
                </tr>
        </table>
    <?php endif;?>
</section>

