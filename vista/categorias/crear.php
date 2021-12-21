<h1>Crear categoria</h1>

<div class="contenedor-form">
    <form action="<?= base_url ?>categoria/guardar" method="POST">
        <label for="nombre">
            Nombre:
        </label>
        <input type="text" name="nombre" required>
        <input type="submit" value="Guardar">
    </form>
</div>