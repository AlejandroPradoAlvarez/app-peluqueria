<?php 

namespace Controllers;
use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController{

    public static function login(Router $router){
       
        $alertas=[];

        $auth=New Usuario;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //var_dump($_SERVER);
            $auth= New Usuario($_POST);

            $alertas=$auth->validarLogin();

            if(empty($alertas)){
                //Comprobar que exista el usuario
                $usuario=Usuario::where('email',$auth->email);
                if($usuario){
                    //Verificar el password
                    if($usuario->comprobarPasswordAndVerificado($auth->password)){
                        //Autenticar al usuario
                        session_start();
                        $_SESSION['id']=$usuario->id;
                        $_SESSION['nombre']= $usuario->nombre . " " . $usuario->apellido;
                        $_SESSION['email']= $usuario->email;
                        $_SESSION['login']= true;
                        
                        //Redireccionamiento segun sea admin/cliente/ añadir trabajador para si quieres 3 usuarios
                        if($usuario->admin ==="1"){

                            $_SESSION['admin']=$usuario->admin ?? null;
                            header('Location: /admin'); 
                        }else{
                           header('Location: /cita'); 
                        }

                    }
                }else{
                    Usuario::setAlerta('error','Usuario no encontrado');
                }
            }
        }

        $alertas=Usuario::getAlertas();


        $router->render('auth/login', [
            'alertas'=>$alertas,
            'auth'=>$auth
        ]);
    }

    public static function logout(){
        
        iniciarSession();

        $_SESSION=[];
       
        header('Location: /');
    }

    public static function olvide(Router $router){

        $alertas=[];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $auth= new Usuario($_POST);
            $alertas=$auth->validarEmail();

            if(empty($alertas)){
                $usuario=Usuario::where('email',$auth->email);
                

                if($usuario && $usuario->confirmado === "1"){
                   
                    //Generar un token de un solo uso 
                    $usuario->creartoken();
                    $usuario->guardar();
                    
                    // enviar email
                    // $email= new Email($usuario->email,$usuario->nombre,$usuario->token);
                    // $email->enviarInstrucciones();

                    //alerta de exito
                    Usuario::setAlerta('exito','Revisa tu email');
                    

                }else{

                    Usuario::setAlerta("error","El usuario no existe o no esta confirmado");
                    
                }
            }
        }

        $alertas=Usuario::getAlertas();

        $router->render('auth/olvide-password', ['alertas'=>$alertas]);

    }

    public static function recuperar(Router $router){

        $alertas=[];
        $error=false;

        $token= s($_GET['token']);
        
        //Buscar usuario por su token
        $usuario=Usuario::where('token',$token);

        if(empty($usuario)){
            Usuario::setAlerta('error','Token no válido');
            $error=true;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            //Leer el neuvo password y guardarlo
            $password= new Usuario($_POST);
            $alertas=$password->validarPassword();

            if(empty($alertas)){
                $usuario->password=null;

                $usuario->password=$password->password;
                $usuario->hashPassword();
                $usuario->token=null;

                $resultado=$usuario->guardar();
                if($resultado){
                    header('Location: /');
                }
               
            }
        };
        $alertas=Usuario::getAlertas();
        
        $router->render('auth/recuperar-password',[
            'alertas'=>$alertas,
            'error'=>$error
        ]);
    }

    public static function crear(Router $router): void{

        $usuario=new Usuario($_POST);
        
        $alertas=[];
            if($_SERVER['REQUEST_METHOD']=== 'POST'){

                $usuario->sincronizar($_POST);
                $alertas=$usuario->validarNuevaCuenta();
               
                //debuguear($alertas);
                //debuguear($usuario);

                //REVISAR QUE ALERTAS ESTE VACIO

                if(empty($alertas)){

                    //VERIFICAR QUE EL USUARIO NO ESTE REGISTRADO mediante su email
                    $resultado=$usuario->existeUsuario();

                    if($resultado->num_rows){

                        $alertas=Usuario::getAlertas();
                    }else{
                        //Hashear el password
                        $usuario->hashPassword();
                        
                        //Generara un token unico para evitar boots
                        $usuario->crearToken();
                        
                        //Envia email para confirmar
                        // $email=new email ($usuario->email,$usuario->nombre,$usuario->token);
                        // $email->enviarConfirmacion();


                        //CREAR EL USUARIO
                        $resultado=$usuario->guardar();

                        //debuguear($usuario);

                        if($resultado){
                            header('Location: /mensaje');
                        }
                    }
                }
            }
        $router->render('auth/crear-cuenta', [

            'usuario'=>$usuario,
            'alertas'=>$alertas
        ]);
    }

    public static function mensaje(Router $router): void{

        $router->render('auth/mensaje');
    }


    public static function confirmar(Router $router): void{

        $alertas=[];

        $token=s($_GET['token']);

        $usuario=Usuario::where('token',$token);

        if (empty($usuario) || $usuario->token ==='null'){

            //mostrar mensaje de error
            Usuario::setAlerta('error','Token no válido');
        }else{

            //modificar a usuario confirmado y eliminamos el token para evitar que terceros lo usen 
            $usuario->confirmado="1";
            $usuario->token=null;
            
            $usuario->guardar();
            Usuario::setAlerta('exito','Cuenta comprobada correctamente');
        }
        
        //Obtener alertas
        $alertas=Usuario::getAlertas();

        //Renderizar la vista
        $router->render('auth/confirmar-cuenta',[

            'alertas'=>$alertas

        ]);
    }
}