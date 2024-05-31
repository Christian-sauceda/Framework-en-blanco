<?php

require_once 'BaseController.php';

class ProductController extends BaseController {
    private $productRepository;

    public function __construct($entityManager) {
        parent::__construct($entityManager);
        $this->productRepository = $entityManager->getRepository(Product::class);
    }

    public function productList() {
        // Obtener los productos desde la base de datos
        $products = $this->productRepository->findAll();

        // Pasar los productos a la vista
        $this->render('product_list', ['products' => $products]);
    }
}
