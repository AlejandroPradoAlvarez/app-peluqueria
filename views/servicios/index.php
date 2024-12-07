<h1 class="nombre-pagina">Servicios</h1>

<p class="descripcion-pagina">Adminsitracion de Servicios</p>


<?php 

@include_once __DIR__ . '../templates/barra.php';

?>

<ul class="servicios">
    <?php foreach($servicios as $servicio){ ?>

        <li>
            <p>Nombre: <span><?php echo $servicio->nombre; ?></span></p>
            <p>Precio: <span><?php echo $servicio->precio; ?>€</span></p>


            <div class="acciones">

                <?php if (isset($_SESSION['nombre']) && $_SESSION['admin'] === 1): ?>

                    <a class="boton" href="/servicios/actualizar?id=<?php echo $servicio->id; ?>">Actualizar</a>

                <form action="/servicios/eliminar" method="POST">

            <input type="hidden" name="id" value="<?php echo $servicio->id ;?>">

            <input type="submit" value="Borrar" class="boton-eliminar">

                </form>
                 <?php endif; ?>
            </div>

           

        </li>
    <?php }?>
</ul>