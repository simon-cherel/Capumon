<?php

namespace App\Entity;

use App\Repository\OwnerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OwnerRepository::class)
 */
class Owner
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $familyName;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $country;

    /**
     * @ORM\OneToMany(targetEntity=Room::class, mappedBy="owner")
     */
    private $room;

    /**
     * @ORM\OneToMany(targetEntity=UnavailablePeriod::class, mappedBy="owner")
     */
    private $unavailablePeriod;

       /**
     * @return string
     */
    public function __toString()
    {
        $s = '';
        $s .= $this->getId() ." ";
        $s .= $this->getFirstname() . " ";
        $s .= $this->getFamilyName();
        return $s;
    }

    public function __construct()
    {
        $this->room = new ArrayCollection();
        $this->unavailablePeriod = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getFamilyName(): ?string
    {
        return $this->familyName;
    }

    public function setFamilyName(string $familyName): self
    {
        $this->familyName = $familyName;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Collection|Room[]
     */
    public function getRoom(): Collection
    {
        return $this->room;
    }

    public function addRoom(Room $room): self
    {
        if (!$this->room->contains($room)) {
            $this->room[] = $room;
            $room->setOwner($this);
        }

        return $this;
    }

    public function removeRoom(Room $room): self
    {
        if ($this->room->removeElement($room)) {
            // set the owning side to null (unless already changed)
            if ($room->getOwner() === $this) {
                $room->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UnavailablePeriod[]
     */
    public function getUnavailablePeriod(): Collection
    {
        return $this->unavailablePeriod;
    }

    public function addUnavailablePeriod(UnavailablePeriod $unavailablePeriod): self
    {
        if (!$this->unavailablePeriod->contains($unavailablePeriod)) {
            $this->unavailablePeriod[] = $unavailablePeriod;
            $unavailablePeriod->setOwner($this);
        }

        return $this;
    }

    public function removeUnavailablePeriod(UnavailablePeriod $unavailablePeriod): self
    {
        if ($this->unavailablePeriod->removeElement($unavailablePeriod)) {
            // set the owning side to null (unless already changed)
            if ($unavailablePeriod->getOwner() === $this) {
                $unavailablePeriod->setOwner(null);
            }
        }

        return $this;
    }
}
