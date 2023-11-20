<section id="categoria" class="crear">
    <?php if(isset($edicion) && isset($categoria)):?>
        <h1 class="sin-borde">Edicion de la categoria: <?=$categoria['caia_nombre']?></h1>
        <?php $id = $categoria['id_categoria'];?>
    <?php else:?>
        <h1 class="sin-borde">Crear categoria</h1>
        <?php $id = 0;?>
    <?php endif;?>
    <form>
        <label for="nombre">
            Nombre:
        </label>
        <input type="text" name="nombre" id="nombreCategoria" value="<?=isset($categoria) ? $categoria['caia_nombre'] : "";?>" required>

        <div>
            <button onclick="volverAtras()" class="boton-atras">Volver</button>
            <button onclick="alerta_categoria(<?=$id?>)">Guardar</button>
        </div>
        
    </form>
</section>