<?php

// En el archivo BaseController.php

class BaseController {
    protected $entityManager;

    public function __construct($entityManager) {
        $this->entityManager = $entityManager;
    }

    public function index() {
        // Aquí puedes definir la lógica para la acción index si es necesario
        echo "Index action";
    }

    protected function render($view, $data = []) {
        extract($data);
        require __DIR__ . '/../View/' . $view . '.php';
    }
}
