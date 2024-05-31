<?php

use Doctrine\ORM\EntityRepository;

class ProductRepository extends EntityRepository {
    // Métodos personalizados del repositorio de productos
    public function findByName($name) {
        return $this->findOneBy(['name' => $name]);
    }

    public function findByPrice($price) {
        return $this->findOneBy(['price' => $price]);
    }

}