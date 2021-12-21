<div id="contenidoPrincipal">
    <h1>Nuestros Productos</h1>
    <?php while ($destacado = $destacados->fetch_object()) : ?>
        <div class="productos">
            <a href="<?=base_url?>producto/detalle&id=<?=$destacado->id_producto?>">
                <?php if ($destacado->pros_imagen == null) : ?>
                    <!--NOTE: comprobamos que tenga cargada una imagen, en caso que no tenga le ponemos una imagen default-->
                    <img src="recursos/imagenes/camiseta.png" alt="imagen default">
                <?php else : ?>
                    <img src="<?= base_url ?>subidas/productos/<?= $destacado->pros_imagen ?>" alt="imagen del producto">
                <?php endif; ?>
                <h2><?= $destacado->pros_nombre ?></h2>
            </a>
            <p>$<?= $destacado->pros_precio ?></p>
        </div>
    <?php endwhile; ?>
</div>