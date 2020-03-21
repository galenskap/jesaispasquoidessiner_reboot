<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SubjectRepository")
 */
class Subject
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $text;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_female;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_plural;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getIsFemale(): ?bool
    {
        return $this->is_female;
    }

    public function setIsFemale(bool $is_female): self
    {
        $this->is_female = $is_female;

        return $this;
    }

    public function getIsPlural(): ?bool
    {
        return $this->is_plural;
    }

    public function setIsPlural(bool $is_plural): self
    {
        $this->is_plural = $is_plural;

        return $this;
    }
}
