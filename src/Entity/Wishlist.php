<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Wishlist
 *
 * @ORM\Table(name="wishlist")
 * @ORM\Entity
 */
class Wishlist
{
    /**
     * @var int
     *
     * @ORM\Column(name="iduser", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iduser;

    /**
     * @var int
     *
     * @ORM\Column(name="idpack", type="integer", nullable=false)
     */
    private $idpack;

    /**
     * @var int
     *
     * @ORM\Column(name="idservice", type="integer", nullable=false)
     */
    private $idservice;

    public function getIduser(): ?int
    {
        return $this->iduser;
    }

    public function getIdpack(): ?int
    {
        return $this->idpack;
    }

    public function setIdpack(int $idpack): self
    {
        $this->idpack = $idpack;

        return $this;
    }

    public function getIdservice(): ?int
    {
        return $this->idservice;
    }

    public function setIdservice(int $idservice): self
    {
        $this->idservice = $idservice;

        return $this;
    }


}
