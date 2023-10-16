<!-- TODO: aqui estaria los errores que se muestran como el caso de que no haya contenido o que la pagina no exista-->
<section id="errorControl">
    <div class="contenidoError">
        <div class="errorInfo">
            <?php if($bandera):?>
                <i class='bx bx-error-circle bx-logoGrande boxi'></i>
                <div class="textoMensaje">
                    <?=$textoError?>
                </div>
            <?php else:?>
                <i class='bx bx-task-x bx-logoGrande boxi'></i>
                <div class="textoMensaje">
                    <?=$textoError?>
                </div>
            <?php endif;?>
        </div>
        <div class="errorBoton">
            <a href=<?=base_url?> class="boton boton-azul boton-herramienta">Ir al inicio</a>
        </div>
    </div>
</section>