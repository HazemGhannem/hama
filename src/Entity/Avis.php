<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Avis
 * @ORM\Table(name="avis")
 * @ORM\Entity(repositoryClass="App\Repository\AvisRepository")
 */
class Avis
{

    /**
     * @var int
     *
     * @ORM\Column(name="idAvis", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idavis;

    /**
     * @var int
     * @Assert\Positive(message ="le numéro doit etre positive")
     * @Assert\NotBlank(message="champ vide")
     
     * @ORM\Column(name="rating", type="integer", nullable=false)
     */
    private $rating;

    /**
     * @var Utilisateur
     *  
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="idUser", referencedColumnName="id")
     * })
     * @Assert\NotBlank(message="champ vide")
     */
    private $idUser;

    /**
     * @var string
     *      @Assert\NotBlank(message="champ vide")
     * @ORM\Column(name="descriptionAvis", type="string", length=255, nullable=false)
     */
    private $descriptionavis;

    public function getIdavis(): ?int
    {
        return $this->idavis;
    }
    public function getRating(): ?int
    {
        return $this->rating;
    }
    public function setRating(int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getidUser()
    {
        return $this->idUser;
    }
    public function setidUser(Utilisateur $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getDescriptionavis(): ?string
    {
        return $this->descriptionavis;
    }

    public function setDescriptionavis(string $descriptionavis): self
    {
        $this->descriptionavis = $descriptionavis;

        return $this;
    }
}
