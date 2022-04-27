<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur")
 * @ORM\Entity
 * @UniqueEntity(
 *  fields={"email"},
 *  message= "L'email que vous avez tapez est déjà utilisé!"
 * )
 * @ORM\Entity(repositoryClass="App\Repository\utilisateurRepository")
 */
class Utilisateur implements UserInterface
{
    // const ROLE_ADMIN='ROLE_ADMIN';

    // public function __construct() {
    // //$this->roles[]= 'ROLE_USER';
    // $this->typeuser="client";
    // $this->typeuser="PRESTATIRE";

    // }

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom", type="string", length=50, nullable=true)
     * @Assert\NotBlank(message="Veuillez Remplir ce champ")
     *  @Assert\Regex(
     *     pattern     = "/^[a-z]+$/i",
     *     htmlPattern = "[a-zA-Z]+"
     * )
     */
    private $nom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="prenom", type="string", length=50, nullable=true)
     * @Assert\NotBlank(message="Veuillez Remplir ce champ")
     *  @Assert\Regex(
     *     pattern     = "/^[a-z]+$/i",
     *     htmlPattern = "[a-zA-Z]+"
     * )
     */
    private $prenom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=true)
     * @Assert\NotBlank(message="Veuillez Remplir ce champ")
     * @Assert\Email(message = "The email '{{ value }}' is not a valid email.")
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="password", type="string", length=50, nullable=true)
     * @Assert\NotBlank(message="Veuillez Remplir ce champ")
     */
    private $password;


    /**
     * @Assert\EqualTo(propertyPath="password", message="Vous n'avez pas taper le meme mot de passe")
     */
    public $repeatpassword;




    /**
     * @var int|null
     *
     * @ORM\Column(name="tel", type="integer", nullable=true)
     * @Assert\NotBlank(message="Veuillez Remplir ce champ")
     * @Assert\Length(min=8)
     * @Assert\Regex(
     *     pattern     = "/^[0-9]+$/i",
     *     htmlPattern = "[0-9]+"
     * )
     */
    private $tel;

    /**
     * @var string|null
     *
     * @ORM\Column(name="role", type="string", length=20, nullable=true)
     * @Assert\NotBlank(message="Veuillez Remplir ce champ")
     */
    private $role;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=false)
     */
    private $image;


    /**
     * @var int
     *
     * @ORM\Column(name="Bloquer", type="integer", nullable=false)
     */
    private $bloquer = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="remember", type="integer", nullable=false)
     */
    private $remember = '0';

    // /**
    //  * @ORM\Column(type="boolean",type="boolean", nullable=false)
    //  */
    // private $isVerified = false;

    /**
     * @ORM\OneToMany(targetEntity=Messages::class, mappedBy="sender", orphanRemoval=true)
     */
    private $sent;

    /**
     * @ORM\OneToMany(targetEntity=Messages::class, mappedBy="recipient", orphanRemoval=true)
     */
    private $received;

    public function __construct()
    {
        $this->sent = new ArrayCollection();
        $this->received = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRepeatpassword(): ?string
    {
        return $this->repeatpassword;
    }
    public function setRepeatpassword(string $repeatpassword): self
    {
        $this->repeatpassword = $repeatpassword;
        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getTel(): ?int
    {
        return $this->tel;
    }

    public function setTel(?int $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(?string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }


    public function getSalt()
    {
    }
    public function eraseCredentials()
    {
    }

    public function __toString(): string
    {
        return $this->getNom();
    }



    public function getRoles(): array
    {
        $role = $this->role;
        $role[] = 'ROLE_USER';
        return array_unique($role);
    }
    public function setRoles(array $role)
    {
        $this->roles = $role;
        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }
    public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
    }





    public function getBloquer(): ?int
    {
        return $this->bloquer;
    }

    public function setBloquer(int $bloquer): self
    {
        $this->bloquer = $bloquer;

        return $this;
    }

    public function getRemember(): ?int
    {
        return $this->remember;
    }

    public function setRemember(int $remember): self
    {
        $this->remember = $remember;

        return $this;
    }

    /**
     * @return Collection<int, Messages>
     */
    public function getReceived(): Collection
    {
        return $this->received;
    }

    public function addReceived(Messages $received): self
    {
        if (!$this->received->contains($received)) {
            $this->received[] = $received;
            $received->setRecipient($this);
        }

        return $this;
    }

    public function removeReceived(Messages $received): self
    {
        if ($this->received->removeElement($received)) {
            // set the owning side to null (unless already changed)
            if ($received->getRecipient() === $this) {
                $received->setRecipient(null);
            }
        }
        return $this;
    }


    // public function isVerified(): bool
    // {
    //     return $this->isVerified;
    // }

    // public function setIsVerified(bool $isVerified): self
    // {
    //     $this->isVerified = $isVerified;

    //     return $this;
    // }

    /**
     * @return Collection<int, Messages>
     */
    public function getSent(): Collection
    {
        return $this->sent;
    }

    public function addSent(Messages $sent): self
    {
        if (!$this->sent->contains($sent)) {
            $this->sent[] = $sent;
            $sent->setSender($this);
        }

        return $this;
    }

    public function removeSent(Messages $sent): self
    {
        if ($this->sent->removeElement($sent)) {
            // set the owning side to null (unless already changed)
            if ($sent->getSender() === $this) {
                $sent->setSender(null);
            }
        }

        return $this;
    }



}
