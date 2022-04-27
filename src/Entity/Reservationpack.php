<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservationpack
 *
 * @ORM\Table(name="reservationpack")
 * @ORM\Entity
 */
class Reservationpack
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
     * @var int
     *
     * @ORM\Column(name="iduser", type="integer", nullable=false)
     */
    private $iduser;

    /**
     * @var int
     *
     * @ORM\Column(name="idpack", type="integer", nullable=false)
     */
    private $idpack;

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
     * @var float
     *
     * @ORM\Column(name="prixrespack", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixrespack;

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

    public function setIduser(int $iduser): self
    {
        $this->iduser = $iduser;

        return $this;
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

    public function getPrixrespack(): ?float
    {
        return $this->prixrespack;
    }

    public function setPrixrespack(float $prixrespack): self
    {
        $this->prixrespack = $prixrespack;

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
