<?php 

namespace Controllers;

use MVC\Router;

class CitaController{
    public static function index(Router $router){

       iniciarSession();//llama a una funcion que inicia session si no esta ya iniciada en el archivo funciones.php


       isAuth();
        

        $router->render('cita/index',[
            'nombre'=>$_SESSION['nombre'],
            'id'=>$_SESSION['id']

        ]);
    }
}