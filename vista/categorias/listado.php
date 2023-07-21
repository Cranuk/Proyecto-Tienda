<section id="categoria" class="listado">
    <h1>Listado de categorias</h1>

    <a href="<?=base_url?>categoria/crear" class="boton" title="Agregar categoria">
        Crear categoria
    </a>

    <?php if (isset($_SESSION['categoria']) && $_SESSION['categoria'] == 'guardado'):?>
        <strong class="alerta_verde">categoria GUARDADA</strong>
    <?php elseif (isset($_SESSION['categoria']) && $_SESSION['categoria'] != 'guardado'):?>
        <strong class="alerta_roja">ERROR al guardar la categoria</strong>
    <?php endif;?>
    <?php Utilidades::borrarSesion('categoria');?>
    <?php if (isset($_SESSION['borrado']) && $_SESSION['borrado'] == 'finalizado'):?>
        <strong class="alerta_verde">Categoria ELIMINADA</strong>
    <?php elseif (isset($_SESSION['borrado']) && $_SESSION['borrado'] != 'finalizado'):?>
        <strong class="alerta_roja">ERROR al eliminar la categoria</strong>
    <?php endif;?>
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
                    <a href="<?=base_url?>categoria/eliminar&id=<?=$categoria['id_categoria']?>" class="boton boton-rojo boton-herramienta" title="Eliminar Categoria"><i class='bx bx-trash bx-sm'></i></a>
                </td>
            </tr>
        <?php endforeach;?>
    </table>
</section>
