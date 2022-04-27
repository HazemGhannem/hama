<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ResLignePack
 *
 * @ORM\Table(name="res_ligne_pack")
 * @ORM\Entity
 */
class ResLignePack
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
     * @ORM\Column(name="idrespack", type="integer", nullable=true)
     */
    private $idrespack;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idpack", type="integer", nullable=true)
     */
    private $idpack;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=10, nullable=false)
     */
    private $etat;

    /**
     * @var string
     *
     * @ORM\Column(name="numlignepack", type="string", length=50, nullable=false)
     */
    private $numlignepack;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdrespack(): ?int
    {
        return $this->idrespack;
    }

    public function setIdrespack(?int $idrespack): self
    {
        $this->idrespack = $idrespack;

        return $this;
    }

    public function getIdpack(): ?int
    {
        return $this->idpack;
    }

    public function setIdpack(?int $idpack): self
    {
        $this->idpack = $idpack;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getNumlignepack(): ?string
    {
        return $this->numlignepack;
    }

    public function setNumlignepack(string $numlignepack): self
    {
        $this->numlignepack = $numlignepack;

        return $this;
    }


}
