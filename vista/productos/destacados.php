<section id="producto" class="destacados vidriera">
    <h1>Nuestros Productos</h1>
    <?php if (empty($destacados)) : ?>
        <h2>Destacados sin productos</h2>
    <?php else:?>
        <?php foreach ($destacados as $destacado) : ?>
            <div class="producto">
                <a href="<?=base_url?>producto/detalle&id=<?=$destacado['id_producto']?>">
                    <?php if ($destacado['pros_imagen'] == null) : ?>
                        <!--NOTE: comprobamos que tenga cargada una imagen, en caso que no tenga le ponemos una imagen default-->
                        <img src="<?= base_url ?>recursos/imagenes/camiseta.png" alt="imagen default">
                    <?php else : ?>
                        <img src="<?= base_url ?>subidas/productos/<?= $destacado['pros_imagen'] ?>" alt="imagen del producto">
                    <?php endif; ?>
                    <h2><?= $destacado['pros_nombre'] ?></h2>
                </a>
                <p>$<?= $destacado['pros_precio'] ?></p>
            </div>
        <?php endforeach; ?>
    <?php endif;?>
</section>