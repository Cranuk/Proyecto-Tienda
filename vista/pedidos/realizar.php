<section id="pedido" class="realizar">
    <?php if (isset($_SESSION['identidad'])) : ?>
        <h1>Confirmar el pedido</h1>
        <p class="ver-carrito">
            <a href="<?= base_url ?>carrito/detalle">Ver carrito</a>
        </p>
        

        <h3>Direccion donde se enviara el pedido</h3>
        <form action="<?= base_url ?>pedido/confirmar" method="POST" class="contenedor-form">
            <label for="direccion">Direccion:</label>
            <input type="text" name="direccion">

            <label for="localidad">Localidad:</label>
            <input type="text" name="localidad">

            <label for="provincia">Provincia:</label>
            <input type="text" name="provincia">

            <input type="submit" value="Realizar Pedido">

        </form>
    <?php else: ?>
        <h1>Requiere estar logueado para confirmar su pedido</h1>
    <?php endif; ?>
</section>
