<section id="producto" class="crear">
    <?php if(isset($edicion) && isset($producto)):?>
        <h1 class="sin-borde">Edicion del producto: <?=$producto['pros_nombre']?></h1>
        <?php $id = $producto['id_producto'];?>
    <?php else:?>
        <h1 class="sin-borde">Crear productos</h1>
        <?php $id = 0;?>
    <?php endif;?>

    <form onsubmit="alerta_producto(<?=$id?>)">
        <label for="categoria">Categoria:</label>
        <?php $categorias = Utilidades::mostrarCategorias(); ?>
        <select name="categoria" id="categoria">
            <?php foreach ($categorias as $categoria) : ?>
                <option value="<?= $categoria['id_categoria'] ?>" <?=isset($producto) && $categoria['id_categoria'] == $producto['categoria_id'] ? "selected" : "";?>>
                <?= $categoria['caia_nombre'] ?></option>
            <?php endforeach; ?>
        </select>

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="<?=isset($producto) ? $producto['pros_nombre'] : "";?>">

        <label for="descripcion">Descripcion:</label>
        <textarea name="descripcion" id="descripcion"><?=isset($producto) ? $producto['pros_descripcion'] : "";?></textarea>

        <label for="precio">Precio:</label>
        <input type="text" name="precio" id="precio" value="<?=isset($producto) ? $producto['pros_precio'] : "";?>">

        <label for="stock">Stock:</label>
        <input type="number" name="stock" id="stock" value="<?=isset($producto) ? $producto['pros_stock'] : "";?>">

        <label for="imagen">Imagen:</label>
        <?php if(isset($producto) && !empty($producto['pros_imagen'])):?>
            <img src="<?=base_url?>subidas/productos/<?=$producto['pros_imagen']?>" alt="imagen del producto" class="miniatura">
        <?php endif;?>
        <input type="file" name="imagen" id="imagen">

        <input type="submit" value="Guardar producto">
    </form>
</section>
