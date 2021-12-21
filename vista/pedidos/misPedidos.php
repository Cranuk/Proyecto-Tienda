<?php if (isset($gestion)) : ?>
    <h1>Listado de pedidos</h1>
<?php else : ?>
    <h1>Mis pedidos</h1>
<?php endif; ?>
<table class="tabla">
    <tr>
        <th>Numero del pedido</th>
        <th>Coste</th>
        <th>Fecha</th>
        <th>Estado</th>
    </tr>
    <?php while ($pedido = $pedidos->fetch_object()) : ?>
        <tr>
            <td>
                <a href="<?= base_url ?>pedido/detallePedido&id=<?= $pedido->id_pedido ?>"><?= $pedido->id_pedido ?></a>
            </td>
            <td><?= $pedido->peos_costo ?></td>
            <td><?= $pedido->peos_fecha ?></td>
            <td><?= Utilidades::estadoPedido($pedido->peos_estado) ?></td>
        </tr>
    <?php endwhile; ?>
</table>