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
        <?php foreach($pedidos as $pedido):?>
            <tr>
                <td>
                    <a href="<?= base_url ?>pedido/detallePedido&id=<?= $pedido['id_pedido'] ?>"><?= $pedido['id_pedido'] ?></a>
                </td>
                <td><?= $pedido['peos_costo'] ?></td>
                <td><?= $pedido['peos_fecha'] ?></td>
                <td><?= Utilidades::estadoPedido($pedido['peos_estado']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif;?>
