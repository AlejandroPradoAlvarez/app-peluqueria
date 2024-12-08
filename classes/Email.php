<?php 

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email{

    public $email;
    public $nombre;
    public $token;

    public function __construct($email,$nombre,$token){

        $this->email=$email;
        $this->nombre=$nombre;
        $this->token=$token;

    }

    public function enviarConfirmacion(){

        //Crear el objeto de email

      // hay que sacar nuevas credenciales en  MAILTRAP. Para correos reales Brevo https://www.brevo.com       
        // Looking to send emails in production? Check out our Email API/SMTP product!
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['MAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['MAIL_PORT'];
        $mail->Username = $_ENV['MAIL_USER'];
        $mail->Password = $_ENV['MAIL_PASSWORD'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;


        $mail->setFrom('apppelumvc@gmail.com','Peluqueria');

        $mail->addAddress($this->email,$this->nombre);

        $mail->Subject='Confirma tu cuenta';

        //SET HTML

        $mail->isHTML(TRUE);

        $mail->CharSet= 'UTF-8';


        $contenido="<html>";
        $contenido.="<p><strong>HOLA ".$this->nombre. "</strong> Has creado tu cuenta en la peluqueria, 
        solo debes confirmarla presionando el siguiente enlace</p>";
        $contenido .="<p>Presiona aqui: <a href='" . $_ENV['SERVER_HOST'] . "/confirmar-cuenta?token=" . $this->token . "'>
         Confirmar cuenta</a></p>";
        $contenido.="<p>Si no solicitasteste esta cuenta, puedes ignorar el mensaje</p>";
        $contenido.="</html>";

        $mail->Body=$contenido;

        //ENVIAR EL EMAIL
        $mail->send();

    }

    public function enviarInstrucciones(){

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['MAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['MAIL_PORT'];
        $mail->Username = $_ENV['MAIL_USER'];
        $mail->Password = $_ENV['MAIL_PASSWORD'];



        $mail->setFrom('apppelumvc@gmail.com','Peluqueria.com');

        $mail->addAddress($this->email,$this->nombre);

        $mail->Subject='Restablece tu password';

        $mail->isHTML(TRUE);

        $mail->CharSet= 'UTF-8';


        $contenido="<html>";
        $contenido.="<p><strong>HOLA ".$this->nombre. "</strong> Has solicitado  reestablecer tu password, 
        sigue el siguiente enlace para hacerlo.</p>";
        $contenido .="<p>Presiona aqui: <a href='" . $_ENV['SERVER_HOST'] . "/recuperar?token=" . $this->token . 
        "'>Reestablecer password.</a></p>";
        $contenido.="<p>Si no solicitasteste esta cuenta, puedes ignorar el mensaje</p>";
        $contenido.="</html>";

        $mail->Body=$contenido;

        echo 'hola';
        exit;

        //ENVIAR EL EMAIL
        $mail->send();

    }

    public function enviarCita($resultado) {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['MAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['MAIL_PORT'];
        $mail->Username = $_ENV['MAIL_USER'];
        $mail->Password = $_ENV['MAIL_PASSWORD'];

    
        $mail->setFrom('apppelumvc@gmail.com', 'Peluqueria.com');
        $mail->addAddress($this->email,$this->nombre);
    
        $mail->Subject = 'Recordatorio cita';
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
    
        // Contenido del correo
        $contenido = "<html>";
        $contenido .= "<p><strong>Hola {$this->nombre}</strong>. Has reservado una cita.</p>";
        $contenido .= "<p>Fecha: {$resultado->fecha}</p>";
        $contenido .= "<p>Hora: {$resultado->hora}</p>";
        
        // Contar el número de servicios
        $numServicios = count($resultado->servicios);
        $contenido .= "<p>Número de servicios: {$numServicios}</p>";
        
        // Calcular el precio total
        $precioTotal = array_reduce($resultado->servicios, function($carry, $servicio) {
            return $carry + $servicio->precio;
        }, 0);
        $contenido .= "<p>Precio total: " . number_format($precioTotal, 2) . " €</p>";
        
        // Listar los servicios reservados
        $contenido .= "<p>Servicios reservados:</p><ul>";
        foreach ($resultado->servicios as $servicio) {
            $contenido .= "<li>{$servicio->nombre}, {$servicio->precio} €</li>";
        }
        $contenido .= "</ul>";
        
        $contenido .= "</html>";
        
        $mail->Body = $contenido;
    
        // Generar el archivo .ics
        $icalContent = $this->crearCalendario($resultado);

        // Adjuntar el archivo .ics
        $mail->addStringAttachment($icalContent, 'cita.ics', 'base64', 'text/calendar');

        
        //ENVIAR EL EMAIL
         $mail->send();
    }
    
    public function crearCalendario($resultado) {
        $summary = "Reunión de prueba"; // Título del evento
        $location = "Sala de reuniones, Oficina"; // Ubicación
        $description = "Cita para discutir el progreso del proyecto."; // Descripción
        $startDate = "2024-12-10 10:00:00"; // Fecha y hora de inicio (Formato Y-m-d H:i:s)
        $endDate = "2024-12-10 11:00:00"; // Fecha y hora de fin (Formato Y-m-d H:i:s)
    
        // Convertir las fechas al formato adecuado para iCalendar
        $startDateFormatted = date('Ymd\THis\Z', strtotime($startDate));
        $endDateFormatted = date('Ymd\THis\Z', strtotime($endDate));
    
        // Crear el contenido del archivo .ics
        $icalContent = "BEGIN:VCALENDAR\r\n";
        $icalContent .= "VERSION:2.0\r\n";
        $icalContent .= "PRODID:-//hacksw/handcal//NONSGML v1.0//EN\r\n";
        $icalContent .= "BEGIN:VEVENT\r\n";
        $icalContent .= "SUMMARY:{$summary}\r\n";
        $icalContent .= "LOCATION:{$location}\r\n";
        $icalContent .= "DESCRIPTION:{$description}\r\n";
        $icalContent .= "DTSTART:{$startDateFormatted}\r\n";
        $icalContent .= "DTEND:{$endDateFormatted}\r\n";
        $icalContent .= "END:VEVENT\r\n";
        $icalContent .= "END:VCALENDAR\r\n";
    
        return $icalContent;
    }
    

    
}