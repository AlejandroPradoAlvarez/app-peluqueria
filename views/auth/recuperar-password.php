<h1 class="nombre_pagina">Recuperar Password</h1>
<p class="descripcion-pagina">Escribe tu nuevo password a continuación.</p>

<?php 
    include_once __DIR__. "/../templates/alertas.php";
?>

<?php if($error) return ; ?>
<form class="formulario" method="POST" >

    <div class="campo">
        <label form="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Nuevo password">
    </div>


    <input type="submit" value="Guardar Nuevo Password" class="boton">


</form>


<div class="acciones">
    <a href="/">¿Ya tienes cuenta? Inicia Sesión</a>
    <a href="/crear-cuenta">¿Aún no tienes una cuenta?Crear una</a>

</div>