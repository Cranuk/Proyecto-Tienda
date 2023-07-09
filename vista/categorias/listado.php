<h1>Listado de categorias</h1>

<a href="<?=base_url?>categoria/crear" class="boton boton-chico">
    Crear categoria
</a>

<table class="tabla">
    <tr>
        <th>Id</th>
        <th>Categoria</th>
    </tr>
    <?php foreach($categorias as $categoria):?>
        <tr>
            <td><?=$categoria['id_categoria']?></td>
            <td><?=$categoria['caia_nombre']?></td>
        </tr>
    <?php endforeach;?>
</table>