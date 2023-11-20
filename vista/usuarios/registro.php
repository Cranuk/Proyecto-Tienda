<section id="usuario">
    <h1>Registrarse</h1>

    <form onsubmit="alerta_usuario()">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombreUsuario" class="anchura">

        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" id="apellidoUsuario" class="anchura">

        <label for="correo">Correo:</label>
        <input type="email" name="correo" id="correoUsuario" class="anchura">

        <label for="clave">Clave:</label>
        <input type="password" name="clave" id="claveUsuario" class="anchura" required>

        <input type="submit" value="Registrarse">
    </form>
</section>
