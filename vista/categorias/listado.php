<section id="categoria" class="listado">
    <h1 class="sin-borde">Listado de categorias</h1>

    <a href="<?=base_url?>categoria/crear" class="boton boton-verde boton-herramienta boton-posicion" title="Agregar categoria">
        <i class='bx bx-add-to-queue bx-sm'></i>
    </a>
    <?php Utilidades::borrarSesion('borrado');?>

    <table class="tabla">
        <tr>
            <th>Id</th>
            <th>Categoria</th>
            <th>Herramientas</th>
        </tr>
        <?php foreach($categorias as $categoria):?>
            <tr>
                <td><?=$categoria['id_categoria']?></td>
                <td><?=$categoria['caia_nombre']?></td>
                <td>
                    <!--NOTE: los botones creados al estar en un bucle les debemos asignar el id para saber a que producto en especifico deseamos eliminar o editar mediante parametro GET-->
                    <a href="<?=base_url?>categoria/editar&id=<?=$categoria['id_categoria']?>" class="boton boton-azul boton-herramienta" title="Editar Categoria"><i class='bx bx-edit bx-sm'></i></a>
                    <a onclick="alerta_eliminar(<?=$categoria['id_categoria']?>, 1)" class="boton boton-rojo boton-herramienta" title="Eliminar Categoria"><i class='bx bx-trash bx-sm'></i></a>
                </td>
            </tr>
        <?php endforeach;?>
    </table>
</section>
