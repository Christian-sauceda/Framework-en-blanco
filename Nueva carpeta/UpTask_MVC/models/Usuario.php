<?php
namespace Model;

class Usuario extends ActiveRecord {
    // Base de datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'email', 'password', 'token', 'confirmado'];
    // Definir propiedades
    public $id;
    public $nombre;
    public $email;
    public $password;
    public $token;
    public $confirmado;
    // Constructor
    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password2 = $args['password2'] ?? '';
        $this->token = $args['token'] ?? '';
        $this->confirmado = $args['confirmado'] ?? 0;
    }
    // Validacion
    public function validarNuevaCuenta() {
        if (!$this->nombre) {
            self::$alertas['error'][] = "Debes añadir un nombre";
        }
        if (!$this->email) {
            self::$alertas['error'][] = "Debes añadir un email";
        }
        if (!$this->password) {
            self::$alertas['error'][] = "Debes añadir un password";
        }
        if (strlen($this->password) < 6) {
            self::$alertas['error'][] = "El password debe tener al menos 6 caracteres";
        }
        if ($this->password !== $this->password2) {
            self::$alertas['error'][] = "Los passwords no son iguales";
        }
        return self::$alertas;
    }
    // Validar Login
    public function validarLogin() {
        if (!$this->email) {
            self::$alertas['error'][] = "El email es obligatorio";
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = "El email no es valido";
        } 
        if (!$this->password) {
            self::$alertas['error'][] = "El password es obligatorio";
        }
        return self::$alertas;
    }
    // validar Password
    public function validarPassword() {
        if (!$this->password) {
            self::$alertas['error'][] = "El password es obligatorio";
        }
        if (strlen($this->password) < 6) {
            self::$alertas['error'][] = "El password debe tener al menos 6 caracteres";
        }
        return self::$alertas;
    }
    //funcion para hashear el password
    public function hashPassword() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }
    //funcion generar token
    public function crearToken() {
        $this->token = md5(uniqid());
    }
    //validar Email
    public function validarEmail() {
        if (!$this->email) {
            self::$alertas['error'][] = "El email es obligatorio";
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = "El email no es valido";
        } 
        return self::$alertas;
    }
}