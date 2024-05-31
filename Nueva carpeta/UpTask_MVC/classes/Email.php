<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {
    // Propiedades
    protected $email;
    protected $nombre;
    protected $token;
    // Constructor
    public function __construct($email, $nombre, $token) {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }
    // Metodo para enviar email de confirmacion
    public function enviarConfirmacion() {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'db0f9d6ffdad55';
        $mail->Password = '36c6f6041d5651';
        $mail->setFrom('cuentas@taskwave.com', 'TaskWave');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Confirma tu cuenta en TaskWave';
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $contenido = "<html>";
        $contenido .= "<p>Hola {$this->nombre},</p>";
        $contenido .= "<p>Has creado tu cuenta en TaskWave pero debes confirma tu cuenta haciendo click en el siguiente enlace:</p>";
        $contenido .= "<p><a href='http://localhost:3001/confirmar?token={$this->token}'>CONFIRMAR CUENTA</a></p>";
        $contenido .= "<p>Si no has creado una cuenta en TaskWave, por favor ignora este mensaje.</p>";
        $contenido .= "</html>";
        $mail->Body = $contenido;
        $mail->AltBody = 'Para ver el mensaje, por favor usa un cliente de correo compatible con HTML';
        $mail->send();
    }
    // Metodo para enviar email de recuperacion
    public function enviarRecuperacion() {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'db0f9d6ffdad55';
        $mail->Password = '36c6f6041d5651';
        $mail->setFrom('cuentas@taskwave.com', 'TaskWave');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Reestablece tu contraseña en TaskWave';
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $contenido = "<html>";
        $contenido .= "<p>Hola {$this->nombre},</p>";
        $contenido .= "<p>Parece que has olvidado tu password en TaskWave, Has click en el siguiente enlace para reestablecer tu cuenta:</p>";
        $contenido .= "<p><a href='http://localhost:3001/reestablecer?token={$this->token}'>REESTABLECER TU PASSWORD</a></p>";
        $contenido .= "<p>Si no has creado una cuenta en TaskWave, por favor ignora este mensaje.</p>";
        $contenido .= "</html>";
        $mail->Body = $contenido;
        $mail->AltBody = 'Para ver el mensaje, por favor usa un cliente de correo compatible con HTML';
        $mail->send();
    }
}