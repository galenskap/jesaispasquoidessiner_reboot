<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SituationRepository")
 */
class Situation
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
    private $male_singular_text;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $female_singular_text;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $male_plural_text;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $female_plural_form;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMaleSingularText(): ?string
    {
        return $this->male_singular_text;
    }

    public function setMaleSingularText(string $male_singular_text): self
    {
        $this->male_singular_text = $male_singular_text;

        return $this;
    }

    public function getFemaleSingularText(): ?string
    {
        return $this->female_singular_text;
    }

    public function setFemaleSingularText(?string $female_singular_text): self
    {
        $this->female_singular_text = $female_singular_text;

        return $this;
    }

    public function getMalePluralText(): ?string
    {
        return $this->male_plural_text;
    }

    public function setMalePluralText(?string $male_plural_text): self
    {
        $this->male_plural_text = $male_plural_text;

        return $this;
    }

    public function getFemalePluralForm(): ?string
    {
        return $this->female_plural_form;
    }

    public function setFemalePluralForm(?string $female_plural_form): self
    {
        $this->female_plural_form = $female_plural_form;

        return $this;
    }
}
