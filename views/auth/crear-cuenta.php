<h1 class="nombre_pagina">Crear Cuenta</h1>
<p class="descripcion-pagina">Llena el siguiente formulario para crear una cuenta</p>
<?php 
    include_once __DIR__. "/../templates/alertas.php";
?>

<form class="formulario" method="POST" action="/crear-cuenta">

    <div class="campo">
        <label form="nombre">Nombre</label>
        <input 
        type="texto" 
        id="nombre" 
        name="nombre" 
        placeholder="Tu nombre"
        value="<?php echo s($usuario->nombre);?>">
    </div>


    <div class="campo">
        <label form="apellido">Apellido</label>
        <input 
        type="texto" 
        id="apellido" 
        name="apellido" 
        placeholder="Tu apellido"
        value="<?php echo s($usuario->apellido);?>">
        >
    </div>
        

    <div class="campo">
        <label form="telefono">Teléfono</label>
        <input 
        type="tel"
         id="telefono" 
         name="telefono" 
         placeholder="Tu telefono"
         value="<?php echo s($usuario->telefono);?>">
         >
    </div>


    <div class="campo">
        <label form="email">E-mail</label>
        <input 
        type="email" 
        id="email" 
        name="email" 
        placeholder="Tu E-mail"
        value="<?php echo s($usuario->email);?>">
        >
    </div>

    <div class="campo">
        <label form="password">Password</label>
        <input 
        type="password" 
        id="password" 
        name="password" 
        placeholder="Tu password">
        >
    </div>

    <input type="submit" value="Crear Cuenta" class="boton">


</form>


<div class="acciones">
    <a href="/">¿Ya tienes cuenta? Inicia Sesión</a>
    <a href="/olvide">¿Olvidaste tu Password?</a>

</div>