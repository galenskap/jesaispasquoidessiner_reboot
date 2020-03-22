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
    private $female_plural_text;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatchingText(bool $is_subject_female, bool $is_subject_plural)
    {
      // default text
      $text = $this->getMaleSingularText();

      if ($is_subject_plural && $is_subject_female && !is_null($this->getFemalePluralText()))
        $text = $this->getFemalePluralText();
      else if ($is_subject_plural && !is_null($this->getMalePluralText()))
        $text = $this->getMalePluralText();
      else if (!$is_subject_plural && $is_subject_female && !is_null($this->getFemaleSingularText()))
        $text = $this->getFemaleSingularText();

      return $text;
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

    public function getFemalePluralText(): ?string
    {
        return $this->female_plural_text;
    }

    public function setFemalePluralText(?string $female_plural_text): self
    {
        $this->female_plural_text = $female_plural_text;

        return $this;
    }
}
