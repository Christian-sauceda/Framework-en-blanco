<h1 class="nombre-pagina">Servicios</h1>
<p class="descripcion-pagina">Administracion de servicios</p>

<?php
include_once __DIR__ . '/../templates/alertas.php';
?>

<ul class="lista-servicios">
    <?php foreach($servicios as $servicio) { ?>
        <li>
            <p>Nombre: <span><?php echo $servicio->nombre; ?></span></p>
            <p>Precio: <span>$<?php echo $servicio->precio; ?></span></p>
            <div class="acciones">
                <a href="/servicios/actualizar?id=<?php echo $servicio->id; ?>" class="boton-amarillo">Actualizar</a>
                <form action="/servicios/eliminar" method="POST">
                    <input type="hidden" name="id" value="<?php echo $servicio->id; ?>">
                    <button type="submit" class="boton-eliminar">Eliminar</button>
                </form>
            </div>
        </li>
    <?php }?>
</ul>
