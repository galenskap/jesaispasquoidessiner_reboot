<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Security\Core\User\UserInterface;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @Vich\Uploadable
 * @UniqueEntity(fields={"username"}, message="There is already an account with this username")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Submission", mappedBy="author", orphanRemoval=true)
     */
    private $submissions;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $email;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="avatar", fileNameProperty="avatar_name")
     *
     * @var File|null
     */
    private $avatar_file;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $avatar_name;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var string
     */
    protected $updatedAt;

    public function __construct()
    {
        $this->submissions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection|Submission[]
     */
    public function getSubmissions(): Collection
    {
        return $this->submissions;
    }

    public function addSubmission(Submission $submission): self
    {
        if (!$this->submissions->contains($submission)) {
            $this->submissions[] = $submission;
            $submission->setAuthor($this);
        }

        return $this;
    }

    public function removeSubmission(Submission $submission): self
    {
        if ($this->submissions->contains($submission)) {
            $this->submissions->removeElement($submission);
            // set the owning side to null (unless already changed)
            if ($submission->getAuthor() === $this) {
                $submission->setAuthor(null);
            }
        }

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
    * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $avatar_file
    */
   public function setAvatarFile(?File $avatar_file = null): void
   {
       $this->avatar_file = $avatar_file;

       if (null !== $avatar_file) {
           // It is required that at least one field changes if you are using doctrine
           // otherwise the event listeners won't be called and the file is lost
           $this->updatedAt = new \DateTimeImmutable();
       }
   }

   public function getAvatarFile(): ?File
   {
       return $this->avatar_file;
   }

   public function setAvatarName(?string $avatar_name): void
   {
       $this->avatar_name = $avatar_name;
   }

   public function getAvatarName(): ?string
   {
       return $this->avatar_name;
   }

   /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
        ) = unserialize($serialized);
    }

    
    /**
      * @return string
      */
     public function getUpdatedAt()
     {
         return $this->updatedAt;
     }

     /**
      * @param string $updatedAt
      */
     public function setUpdatedAt($updatedAt)
     {
         $this->updatedAt = $updatedAt;
     }
}
