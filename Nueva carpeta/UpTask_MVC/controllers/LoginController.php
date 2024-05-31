<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController
{
    // Metodo para mostrar el formulario de login
    public static function login(Router $router) {
        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarLogin();
            if(empty($alertas)) {
                //verificar el usuario exista
                $usuario = Usuario::where('email', $usuario->email);
                if(!$usuario  || !$usuario->confirmado) {
                    Usuario::setAlerta('error', 'El usuario no existe o no esta confirmado');
                } else {
                    //verificar password
                    if(password_verify($_POST['password'], $usuario->password)){
                        //iniciar sesion
                        session_start();
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;
                        //redireccionar
                        header('Location: /dashboard');
                    } else {
                        Usuario::setAlerta('error', 'El Usuario o Password incorrectos');
                    }
                }
            }
        }
        $alertas = Usuario::getAlertas();
        //render a la vista
        $router->render('auth/login', [
            'titulo' => 'Iniciar Sesión',
            'alertas' => $alertas
        ]);
    }
    // Metodo para cerrar sesion
    public static function logout()
    {
        echo "Desde Logout";
    }
    // Metodo para crear una cuenta
    public static function crear(Router $router) {
        $usuario = new Usuario;
        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();
            if (empty($alertas)) {
                $existeUsuario = Usuario::where('email', $usuario->email);
                if ($existeUsuario) {
                    Usuario::setAlerta('error', 'El usuario ya esta registrado');
                    $alertas = Usuario::getAlertas();
                } else {
                    //hashear password 
                    $usuario->hashPassword();
                    //eliminar password2
                    unset($usuario->password2);
                    //generar token
                    $usuario->crearToken();
                    //guardar en la base de datos
                    $resultado = $usuario->guardar();
                    //enviar email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion();
                    //redireccionar
                    if ($resultado) {
                        header('Location: /mensaje');
                    }
                }
            } 
        }
        $router->render('auth/crear', [
            'titulo' => 'Crear Cuenta',
            'usuario' => $usuario,
            'alertas' => $alertas

        ]);
    }
    // Metodo para mostrar el formulario de recuperar contraseña
    public static function olvide(Router $router) {
        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarEmail();   
            if (empty($alertas)) {
                $usuario = Usuario::where('email', $usuario->email);
                if ($usuario && $usuario->confirmado){
                    //generar token
                    $usuario->crearToken();
                    unset($usuario->password2);
                    //actualizar en la base de datos
                    $usuario->guardar();
                    //enviar email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarRecuperacion();
                    //imprimir alerta de exito
                    Usuario::setAlerta('exito', 'Revisa tu email para cambiar tu contraseña');
                } else {
                    Usuario::setAlerta('error', 'El email no existe o no esta confirmado');
                }
            }
        }
        $alertas = Usuario::getAlertas();
        $router->render('auth/olvide', [
            'titulo' => 'Olvide mi Password',
            'alertas' => $alertas
        ]);
    }
    // Metodo para mostrar el formulario de cambiar contraseña
    public static function reestablecer(Router $router) {
        //obtener token
        $token = $_GET['token'];
        $mostrar = true;
        if (!$token) header('Location: /');
        //identificar el usuario
        $usuario = Usuario::where('token', $token);
        if(empty($usuario)) {
            Usuario::setAlerta('error', 'Token no valido');
            $mostrar = false;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //asignar el nuevo password
            $usuario->sincronizar($_POST);
            //validar password
            $alertas = $usuario->validarPassword();
            if (empty($alertas)) {
                //hashear password
                $usuario->hashPassword();
                //eliminar token y password2
                $usuario->token = null;
                unset($usuario->password2);
                //guardar en la base de datos
                $resultado = $usuario->guardar();
                //redireccionar
                if($resultado) {
                    header('Location: /');
                }
            }
        }
        $alertas = Usuario::getAlertas();
        $router->render('auth/reestablecer', [
            'titulo' => 'Reestablecer Password',
            'alertas' => $alertas,
            'mostrar' => $mostrar
        ]);
    }
    // Metodo para mostrar un mensaje
    public static function mensaje(Router $router) {
        $router->render('auth/mensaje', [
            'titulo' => 'Cuenta Creada Exitosamente'
        ]);
    }
    // Metodo para confirmar la cuenta
    public static function confirmar(Router $router) {
        $token = $_GET['token'] ?? null;
        if (!$token) header('Location: /');
        $usuario = Usuario::where('token', $token);
        if(empty($usuario)){
            //Usuario no existe
            Usuario::setAlerta('error', 'Token no valido');
        } else{
            //confirmar usuario
            $usuario->confirmado = 1;
            $usuario->token = null;
            unset($usuario->password2);
            $usuario->guardar();
            Usuario::setAlerta('exito', 'Cuenta confirmada exitosamente');
        }
        $alertas = Usuario::getAlertas();
        $router->render('auth/confirmar', [
            'titulo' => 'Confirma tu Cuenta',
            'usuario' => $usuario,
            'alertas' => $alertas
        
        ]);
    }
}
