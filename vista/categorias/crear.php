<section id="categoria" class="crear">
    <?php if(isset($edicion) && isset($categoria)):?>
        <h1 class="sin-borde">Edicion de la categoria: <?=$categoria['caia_nombre']?></h1>
        <?php $url_accion = base_url.'categoria/guardar&id='.$categoria['id_categoria'];?>
    <?php else:?>
        <h1 class="sin-borde">Crear categoria</h1>
        <?php $url_accion = base_url.'categoria/guardar';?>
    <?php endif;?>
    <form action="<?=$url_accion?>" method="POST">
        <label for="nombre">
            Nombre:
        </label>
        <input type="text" name="nombre" value="<?=isset($categoria) ? $categoria['caia_nombre'] : "";?>" required>
        <input type="submit" value="Guardar categoria">
    </form>
</section>
