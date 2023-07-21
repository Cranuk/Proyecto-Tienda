<aside id="barraLateral">
    <div id="carrito" class="bloqueLateral">
        <h3>Carrito de compras</h3>
        <ul class="paddingLR-10">
            <?php ob_start(); $carrito = Utilidades::estadisticasCarrito();?>
            <li>
                <a href="<?= base_url ?>carrito/detalle" onclick="function; return false;">Cantidad(<?= $carrito['cantidad'] ?>)</a>
            </li>
            <li>
                <a href="<?= base_url ?>carrito/detalle" onclick="function; return false;">Total a pagar: $ <?= $carrito['total'] ?></a>
            </li>
            <li>
                <a href="<?= base_url ?>carrito/detalle">Ver mi carrito</a>
            </li>
        </ul>
    </div>
    <div id="logeo" class="bloqueLateral">
        <?php if (!isset($_SESSION['identidad'])) : ?>
            <h3>Entrar a la web</h3>
            <form action="<?= base_url ?>usuario/logeo" method="post" class="paddingLR-10">
                <label for="correo">Email</label>
                <input type="email" name="correo">
                <label for="clave">Contraseña</label>
                <input type="password" name="clave">
                <input type="submit" value="Enviar">
            </form>
        <?php else : ?>
            <h3>Bienvenido, <b><?= $_SESSION['identidad']['usos_nombres'] ?></b></h3>
        <?php endif; ?>
        <ul class="paddingLR-10">
            <?php if (isset($_SESSION['admin'])) : ?>
                <!--ANCHOR: enlaces de administrador-->
                <li>
                    <a href="<?= base_url ?>categoria/listado">Gestionar Categorias</a>
                </li>
                <li>
                    <a href="<?= base_url ?>producto/listado">Gestionar Productos</a>
                </li>
                <li>
                    <a href="<?= base_url ?>pedido/listado">Gestionar Pedidos</a>
                </li>
            <?php endif; ?>
            <?php if (isset($_SESSION['identidad'])) : ?>
                <!--ANCHOR: enlaces de usuario-->
                <li>
                    <a href="<?= base_url ?>pedido/misPedidos">Mis pedidos</a>
                </li>
                <li>
                    <a href="<?= base_url ?>usuario/cerrar">Cerrar sesion</a>
                </li>
            <?php else : ?>
                <li>
                    <a href="<?= base_url ?>usuario/registrar">Registrate</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</aside>