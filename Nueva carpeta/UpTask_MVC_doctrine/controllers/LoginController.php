<?php

namespace Controllers;

use Entity\Usuario;
use Doctrine\ORM\EntityManagerInterface;

class LoginController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function login($router, $usuarioData)
    {
        // Crea una nueva instancia de Usuario y establece su nombre con los datos proporcionados
        $usuario = new Usuario();
        $usuario->setNombre($usuarioData['nombre']);

        // Persiste el objeto Usuario utilizando el EntityManager
        $this->entityManager->persist($usuario);
        $this->entityManager->flush();

        // Renderiza la vista de login
        $router->render('auth/login', [
            'usuario' => $usuario
        ]);
    }
}
