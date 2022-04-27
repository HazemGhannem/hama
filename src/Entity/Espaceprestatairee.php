<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Espaceprestatairee
 *
 * @ORM\Table(name="espaceprestatairee", indexes={@ORM\Index(name="fk_serv", columns={"idservice"})})
 * @ORM\Entity
 */
class Espaceprestatairee
{
    /**
     * @var int
     *
     * @ORM\Column(name="idprest", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idprest;

    /**
     * @var string
     *
     * @ORM\Column(name="nomSociete", type="string", length=20, nullable=false)
     */
    private $nomsociete;

    /**
     * @var string
     *
     * @ORM\Column(name="numSociete", type="string", length=20, nullable=false)
     */
    private $numsociete;

    /**
     * @var string
     *
     * @ORM\Column(name="FaxSociete", type="string", length=20, nullable=false)
     */
    private $faxsociete;

    /**
     * @var string
     *
     * @ORM\Column(name="catSociete", type="string", length=20, nullable=false)
     */
    private $catsociete;

    /**
     * @var string
     *
     * @ORM\Column(name="typeSociete", type="string", length=20, nullable=false)
     */
    private $typesociete;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=255, nullable=false)
     */
    private $logo;

    /**
     * @var string
     *
     * @ORM\Column(name="Url", type="string", length=255, nullable=false)
     */
    private $url;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idplan", type="integer", nullable=true)
     */
    private $idplan;

    /**
     * @var int
     *
     * @ORM\Column(name="idservice", type="integer", nullable=false)
     */
    private $idservice;

    /**
     * @var int|null
     *
     * @ORM\Column(name="iduser", type="integer", nullable=true)
     */
    private $iduser;

    public function getIdprest(): ?int
    {
        return $this->idprest;
    }

    public function getNomsociete(): ?string
    {
        return $this->nomsociete;
    }

    public function setNomsociete(string $nomsociete): self
    {
        $this->nomsociete = $nomsociete;

        return $this;
    }

    public function getNumsociete(): ?string
    {
        return $this->numsociete;
    }

    public function setNumsociete(string $numsociete): self
    {
        $this->numsociete = $numsociete;

        return $this;
    }

    public function getFaxsociete(): ?string
    {
        return $this->faxsociete;
    }

    public function setFaxsociete(string $faxsociete): self
    {
        $this->faxsociete = $faxsociete;

        return $this;
    }

    public function getCatsociete(): ?string
    {
        return $this->catsociete;
    }

    public function setCatsociete(string $catsociete): self
    {
        $this->catsociete = $catsociete;

        return $this;
    }

    public function getTypesociete(): ?string
    {
        return $this->typesociete;
    }

    public function setTypesociete(string $typesociete): self
    {
        $this->typesociete = $typesociete;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getIdplan(): ?int
    {
        return $this->idplan;
    }

    public function setIdplan(?int $idplan): self
    {
        $this->idplan = $idplan;

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

    public function getIduser(): ?int
    {
        return $this->iduser;
    }

    public function setIduser(?int $iduser): self
    {
        $this->iduser = $iduser;

        return $this;
    }


}
