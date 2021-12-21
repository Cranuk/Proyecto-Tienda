<div id="contenidoPrincipal">
    <?php if (isset($categoria)) : ?>
        <h1>Productos con la categoria <?= $categoria->caia_nombre ?></h1>
    <?php else : ?>
        <h1>La categoria no existe</h1>
    <?php endif; ?>
    <?php if ($productos->num_rows == 0) : ?>
        <h2>Categoria sin productos</h2>
    <?php endif; ?>
    <?php while ($producto = $productos->fetch_object()) : ?>
        <div class="productos">
            <a href="<?= base_url ?>producto/detalle&id=<?= $producto->id_producto ?>">
                <?php if ($producto->pros_imagen == null) : ?>
                    <!--NOTE: comprobamos que tenga cargada una imagen, en caso que no tenga le ponemos una imagen default-->
                    <img src="recursos/imagenes/camiseta.png" alt="imagen default">
                <?php else : ?>
                    <img src="<?= base_url ?>subidas/productos/<?= $producto->pros_imagen ?>" alt="imagen del producto">
                <?php endif; ?>
                <h2><?= $producto->pros_nombre ?></h2>
                <p>$<?= $producto->pros_precio ?></p>
            </a>
        </div>
    <?php endwhile; ?>
</div>