<div class="banner">
    <a href="/servicios">Catálogo de servicios</a>
</div>

<h1 class="nombre-pagina">LOGIN</h1>
<p class="descripcion-pagina">Inicia sesion con tus datos</p>
<?php 
    include_once __DIR__. "/../templates/alertas.php";
?>

<form class="formulario" method="post" action="/">

    <div class="campo">
     <label for="email">Email</label>
        <input type="email" id="email" placeholder="Tu email" name="email" value="<?php echo s($auth->email);?>">
    </div>


    <div class="campo">
        <label for="password">Password</label>
        <input type="password" id="password" placeholder="Tu password" name="password">
    </div>

    <div class="contenedor-boton">
        <input type="submit" class="boton" value="Iniciar Sesión">
    </div>
    
</form>

<div class="acciones">
    <a href="/crear-cuenta">¿Aún no tienes una cuenta? Crear una.</a>
    <a href="/olvide">¿Olvidaste tu Password?</a>
</div>