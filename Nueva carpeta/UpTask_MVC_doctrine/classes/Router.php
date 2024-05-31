<?php

namespace MVC;

use Controllers\LoginController;
use Doctrine\ORM\EntityManagerInterface;

class Router
{
    private $routes = [];

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function comprobarRutas(EntityManagerInterface $entityManager)
    {
        $uri = $_SERVER['REQUEST_URI'];
        foreach ($this->routes as $ruta => $metodo) {
            if ($uri === $ruta) {
                $partes = explode('@', $metodo);
                $controlador = "Controllers\\$partes[0]";
                $metodo = $partes[1];
                $loginController = new LoginController($entityManager);
                if (method_exists($controlador, $metodo)) {
                    // Llama al método del controlador y pasa los datos del usuario como un arreglo adicional
                    $usuarioData = [
                        'nombre' => 'John Doe'
                    ];
                    call_user_func([$loginController, $metodo], $this, $usuarioData);
                    return;
                }
            }
        }
        echo "Página No Encontrada";
    }

    public function render($view, $vars = [])
    {
        extract($vars);
        include "views/$view.php";
    }
}
