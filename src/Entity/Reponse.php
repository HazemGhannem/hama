<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Reponse
 *
 * @ORM\Table(name="reponse")
 * @ORM\Entity
 */
class Reponse
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
     * @var string
     *@Assert\NotBlank()
     * @ORM\Column(name="message", type="string", length=255, nullable=false)
     */
    private $message;

    /**
     * @var \DateTime
     *@Assert\NotBlank()
     * @ORM\Column(name="createdAt", type="datetime", nullable=false)
     */
    private $createdat;

    /**
     * @var Reclamation 
     *@ORM\OneToOne(targetEntity=Reclamation::class, inversedBy="reponse", cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="reclamation", referencedColumnName="id")
     * })
     */
    private $reclamation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getCreatedat(): ?\DateTimeInterface
    {
        return $this->createdat;
    }

    public function setCreatedat(\DateTimeInterface $createdat): self
    {
        $this->createdat = $createdat;

        return $this;
    }

    public function getReclamation()
    {
        return $this->reclamation;
    }

    public function setReclamation(Reclamation  $reclamation): self
    {
        $this->reclamation = $reclamation;

        return $this;
    }



}
