<?php

namespace App\Entity;

use App\Repository\UnavailablePeriodRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UnavailablePeriodRepository::class)
 */
class UnavailablePeriod
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Start;

    /**
     * @ORM\Column(type="datetime")
     */
    private $ending;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->Start;
    }

    public function setStart(\DateTimeInterface $Start): self
    {
        $this->Start = $Start;

        return $this;
    }

    public function getEnding(): ?\DateTimeInterface
    {
        return $this->ending;
    }

    public function setEnding(\DateTimeInterface $ending): self
    {
        $this->ending = $ending;

        return $this;
    }
}
