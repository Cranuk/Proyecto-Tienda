<section id="producto" class="verProducto">
    <?php if (isset($producto)) : ?>
        <h1><?= $producto['pros_nombre'] ?></h1>
    <?php else : ?>
        <h1>El producto no existe</h1>
    <?php endif; ?>
    <div class="producto-detalle">
        <?php if (is_null($producto['pros_imagen'])) : ?>
            <!--NOTE: comprobamos que tenga cargada una imagen, en caso que no tenga le ponemos una imagen default-->
            <img src="<?= base_url ?>recursos/imagenes/camiseta.png" alt="imagen default">
        <?php else : ?>
            <img src="<?= base_url ?>subidas/productos/<?= $producto['pros_imagen'] ?>" alt="imagen del producto">
        <?php endif; ?>
        <div class="datos">
            <p><?= $producto['pros_nombre'] ?></p>
            <p><?= $producto['pros_descripcion'] ?></p>
            <p>$<?= $producto['pros_precio'] ?></p>
            <a href="<?=base_url?>carrito/agregar&id=<?=$producto['id_producto']?>" class="boton">Comprar</a>
        </div>
    </div>
</section>
