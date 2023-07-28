<section id="categoria" class="crear">
    <?php if(isset($edicion) && isset($categoria)):?>
        <h1 class="sin-borde">Edicion de la categoria: <?=$categoria['caia_nombre']?></h1>
        <?php $id = $categoria['id_categoria'];?>
    <?php else:?>
        <h1 class="sin-borde">Crear categoria</h1>
        <?php $id = 0;?>
    <?php endif;?>
    <form onsubmit="alerta_categoria(<?=$id?>)">
        <label for="nombre">
            Nombre:
        </label>
        <input type="text" name="nombre" id="nombre" value="<?=isset($categoria) ? $categoria['caia_nombre'] : "";?>" required>
        <input type="submit" value="Guardar categoria">
    </form>
</section>