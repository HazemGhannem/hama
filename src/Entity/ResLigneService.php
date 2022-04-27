<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ResLigneService
 *
 * @ORM\Table(name="res_ligne_service")
 * @ORM\Entity
 */
class ResLigneService
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idservice", type="integer", nullable=true)
     */
    private $idservice;

    /**
     * @var string|null
     *
     * @ORM\Column(name="etat", type="string", length=10, nullable=true)
     */
    private $etat;

    /**
     * @var string|null
     *
     * @ORM\Column(name="numligneservice", type="string", length=50, nullable=true)
     */
    private $numligneservice;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdservice(): ?int
    {
        return $this->idservice;
    }

    public function setIdservice(?int $idservice): self
    {
        $this->idservice = $idservice;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(?string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getNumligneservice(): ?string
    {
        return $this->numligneservice;
    }

    public function setNumligneservice(?string $numligneservice): self
    {
        $this->numligneservice = $numligneservice;

        return $this;
    }


}
