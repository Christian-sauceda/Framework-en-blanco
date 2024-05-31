<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="usuarios")
 */
class Usuario
{
    /** 
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /** 
     * @ORM\Column(type="string")
     */
    private $nombre;

    public function getId()
    {
        return $id;
    }

    public function getNombre()
    {
        return $nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
}
