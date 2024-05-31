<?php

class ProductService {
    private $entityManager;

    public function __construct($entityManager) {
        $this->entityManager = $entityManager;
    }

    public function getAllProducts() {
        $productRepository = $this->entityManager->getRepository('Product');
        return $productRepository->findAll();
    }

    // Otros métodos para la lógica relacionada con los productos
    public function getProductById($id) {
        $productRepository = $this->entityManager->getRepository('Product');
        return $productRepository->find($id);
    }

}
