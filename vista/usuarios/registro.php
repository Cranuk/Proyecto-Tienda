<h1>Registrarse</h1>

<?php if (isset($_SESSION['registro']) && $_SESSION['registro'] == "completado"):?>
    <strong class="alerta_verde">Registro completado</strong>
<?php elseif(isset($_SESSION['registro']) && $_SESSION['registro'] == "nulo"):?>
    <strong class="alerta_roja">El registro no fue completado correctamente</strong>
<?php endif;?>
<?php 
    Utilidades::borrarSesion('registro');
?>

<form action="<?=base_url?>usuario/guardar" method="post">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" class="anchura">

    <label for="apellido">Apellido:</label>
    <input type="text" name="apellido" class="anchura">

    <label for="correo">Correo:</label>
    <input type="email" name="correo" class="anchura">

    <label for="clave">Clave:</label>
    <input type="password" name="clave" class="anchura" required>

    <input type="submit" value="Registrarse">
</form>