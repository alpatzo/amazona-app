<?php

namespace App\Entity;

use App\Repository\JobRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JobRepository::class)
 */
class Job
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Category;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $SousCategory;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?string
    {
        return $this->Category;
    }

    public function setCategory(string $Category): self
    {
        $this->Category = $Category;

        return $this;
    }

    public function getSousCategory(): ?string
    {
        return $this->SousCategory;
    }

    public function setSousCategory(string $SousCategory): self
    {
        $this->SousCategory = $SousCategory;

        return $this;
    }
}
