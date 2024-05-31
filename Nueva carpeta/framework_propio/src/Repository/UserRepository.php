<?php

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository {
    // Métodos personalizados del repositorio de usuarios
    public function findByName($name) {
        return $this->findOneBy(['name' => $name]);
    }

    public function findByEmail($email) {
        return $this->findOneBy(['email' => $email]);
    }

}

