<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservationservice
 *
 * @ORM\Table(name="reservationservice")
 * @ORM\Entity
 */
class Reservationservice
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
     * @ORM\Column(name="iduser", type="integer", nullable=true)
     */
    private $iduser;

    /**
     * @var int
     *
     * @ORM\Column(name="idservice", type="integer", nullable=false)
     */
    private $idservice;

    /**
     * @var string|null
     *
     * @ORM\Column(name="date", type="string", length=10, nullable=true)
     */
    private $date;

    /**
     * @var string|null
     *
     * @ORM\Column(name="heuredeb", type="string", length=10, nullable=true)
     */
    private $heuredeb;

    /**
     * @var string|null
     *
     * @ORM\Column(name="heurefin", type="string", length=10, nullable=true)
     */
    private $heurefin;

    /**
     * @var float|null
     *
     * @ORM\Column(name="prixresserv", type="float", precision=10, scale=0, nullable=true)
     */
    private $prixresserv;

    /**
     * @var bool
     *
     * @ORM\Column(name="etat", type="boolean", nullable=false)
     */
    private $etat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIduser(): ?int
    {
        return $this->iduser;
    }

    public function setIduser(?int $iduser): self
    {
        $this->iduser = $iduser;

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

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(?string $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getHeuredeb(): ?string
    {
        return $this->heuredeb;
    }

    public function setHeuredeb(?string $heuredeb): self
    {
        $this->heuredeb = $heuredeb;

        return $this;
    }

    public function getHeurefin(): ?string
    {
        return $this->heurefin;
    }

    public function setHeurefin(?string $heurefin): self
    {
        $this->heurefin = $heurefin;

        return $this;
    }

    public function getPrixresserv(): ?float
    {
        return $this->prixresserv;
    }

    public function setPrixresserv(?float $prixresserv): self
    {
        $this->prixresserv = $prixresserv;

        return $this;
    }

    public function getEtat(): ?bool
    {
        return $this->etat;
    }

    public function setEtat(bool $etat): self
    {
        $this->etat = $etat;

        return $this;
    }


}
