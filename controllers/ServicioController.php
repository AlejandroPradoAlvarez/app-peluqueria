<?php 

namespace Controllers;

use Model\Servicio;
use MVC\Router;

class ServicioController{

    public static function index(Router $router){
        if(isset($_SESSION['admin'])){
        iniciarSession();

        isAdmin();

        $servicios= Servicio::all();

        $router->render('servicios/index', [
            'nombre'=> $_SESSION['nombre'],
            'servicios'=> $servicios
        ]);
        }else{
            $servicios= Servicio::all();

            $router->render('servicios/index', [
            'nombre'=> '',
            'servicios'=> $servicios
        ]);
        }
    }


    public static function crear(Router $router){

        iniciarSession();

        isAdmin();

        $servicio=new Servicio;
        $alertas=[];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $servicio->sincronizar($_POST);//rellena el objeto en memoria con los datos de post evitandoc rear uno nuevo 
            
            $alertas=$servicio->validar();

            if(empty($alertas)){

                $servicio->guardar();
                header('Location: /servicios');
            }
        }

        $router->render('servicios/crear', [
            'nombre'=> $_SESSION['nombre'],

            'servicio'=>$servicio,
            'alertas'=>$alertas
        ]);
    }



    public static function actualizar(Router $router){

        iniciarSession();

        isAdmin();

        if(!is_numeric($_GET['id'])) return;//validacion

        $servicio=Servicio::find($_GET['id']);
        $alertas=[];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $servicio->sincronizar($_POST);

            $alertas=$servicio->validar();

            if(empty($alertas)){

                $servicio->guardar();
                header('Location: /servicios');
            }
        }

        $router->render('servicios/actualizar', [
            'nombre'=> $_SESSION['nombre'],
            'servicio'=>$servicio,
            'alertas'=>$alertas
        ]);

    }


    public static function eliminar(){

        iniciarSession();
        isAdmin();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id=$_POST['id'];
            $servicio=Servicio::find($id);
            $servicio->eliminar();
            header('Location: /servicios');

        }

       
    }
}