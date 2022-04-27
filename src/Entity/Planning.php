<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Planning
 *
 * @ORM\Table(name="planning", indexes={@ORM\Index(name="fk_ser", columns={"idservice"})})
 * @ORM\Entity
 */
class Planning
{
    /**
     * @var int
     *
     * @ORM\Column(name="idPlan", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idplan;

    /**
     * @var string
     *
     * @ORM\Column(name="dateplan", type="string", length=20, nullable=false)
     */
    private $dateplan;

    /**
     * @var string
     *
     * @ORM\Column(name="etatplan", type="string", length=11, nullable=false)
     */
    private $etatplan;

    /**
     * @var int
     *
     * @ORM\Column(name="idservice", type="integer", nullable=false)
     */
    private $idservice;

    public function getIdplan(): ?int
    {
        return $this->idplan;
    }

    public function getDateplan(): ?string
    {
        return $this->dateplan;
    }

    public function setDateplan(string $dateplan): self
    {
        $this->dateplan = $dateplan;

        return $this;
    }

    public function getEtatplan(): ?string
    {
        return $this->etatplan;
    }

    public function setEtatplan(string $etatplan): self
    {
        $this->etatplan = $etatplan;

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
