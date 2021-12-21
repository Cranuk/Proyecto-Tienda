<h1>Listado de categorias</h1>

<a href="<?=base_url?>categoria/crear" class="boton boton-chico">
    Crear categoria
</a>

<table class="tabla">
    <tr>
        <th>
            Id
        </th>
        <th>
            Categoria
        </th>
    </tr>
    <?php while ($categoria = $categorias->fetch_object()):?>
        <tr>
            <td>
                <?=$categoria->id_categoria?>
            </td>
            <td>
                <?=$categoria->caia_nombre?>
            </td>
        </tr>
    <?php endwhile;?>
</table>