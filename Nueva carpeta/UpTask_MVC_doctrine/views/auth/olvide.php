<div class="contenedor olvide">
    <?php include_once __DIR__ . '/../template/nombre-sitio.php' ?>
    <div class="contenedor-sm">
        <p style="text-align: center;">Recupera tu Acceso a TaskWave para eso ingresa tu email para enviarte instrucciones</p>
        <?php include_once __DIR__ . '/../template/alertas.php' ?>
        <form class="formulario" method="POST" action="/olvide">
            <div class="campo">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Tu Email" name="email">
            </div>
            <input type="submit" class="boton" value="Enviar Instrucciones">
        </form>
        <div class="acciones">
            <a href="/">¿Ya tienes una cuenta? Iniciar Sesión</a>
            <a href="/crear">¿No tienes una cuenta? Crear Cuenta</a>
        </div>
    </div> <!--.contenedor-sm-->
</div> <!--.contenedor-->