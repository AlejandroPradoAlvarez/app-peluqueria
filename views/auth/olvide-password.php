<h1 class="nombre_pagina">Olvide Password</h1>
<p class="descripcion-pagina">Restablece tu password escribiendo tu email a continuación</p>

<?php 
    include_once __DIR__. "/../templates/alertas.php";
?>

<form class="formulario" method="POST" action="/olvide">

    <div class="campo">
        <label form="email">E-mail</label>
        <input type="email" id="email" name="email" placeholder="Tu email">
    </div>


    <input type="submit" value="Enviar Instrucciones" class="boton">


</form>


<div class="acciones">
    <a href="/">¿Ya tienes cuenta? Inicia Sesión</a>
    <a href="/crear-cuenta">¿Aún no tienes una cuenta?Crear una</a>

</div>