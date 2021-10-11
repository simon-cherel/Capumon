<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 */
class Reservation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $ReservationId;

    /**
     * @ORM\Column(type="text")
     */
    private $ReservationAdress;

    /**
     * @ORM\Column(type="integer")
     */
    private $NumberGuests;

    /**
     * @ORM\Column(type="datetime")
     */
    private $StartDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $EndDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $HostName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $GuestName;

    /**
     * @ORM\Column(type="integer")
     */
    private $NumberNights;

    /**
     * @ORM\Column(type="float")
     */
    private $PaymentTotal;

    /**
     * @ORM\ManyToOne(targetEntity=Room::class, inversedBy="reservations")
     */
    private $room;

    /**
     * @ORM\ManyToOne(targetEntity=UnavailablePeriod::class, inversedBy="reservations")
     */
    private $unavailablePeriod;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="reservation")
     */
    private $client;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReservationId(): ?int
    {
        return $this->ReservationId;
    }

    public function setReservationId(int $ReservationId): self
    {
        $this->ReservationId = $ReservationId;

        return $this;
    }

    public function getReservationAdress(): ?string
    {
        return $this->ReservationAdress;
    }

    public function setReservationAdress(string $ReservationAdress): self
    {
        $this->ReservationAdress = $ReservationAdress;

        return $this;
    }

    public function getNumberGuests(): ?int
    {
        return $this->NumberGuests;
    }

    public function setNumberGuests(int $NumberGuests): self
    {
        $this->NumberGuests = $NumberGuests;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->StartDate;
    }

    public function setStartDate(\DateTimeInterface $StartDate): self
    {
        $this->StartDate = $StartDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->EndDate;
    }

    public function setEndDate(\DateTimeInterface $EndDate): self
    {
        $this->EndDate = $EndDate;

        return $this;
    }

    public function getHostName(): ?string
    {
        return $this->HostName;
    }

    public function setHostName(string $HostName): self
    {
        $this->HostName = $HostName;

        return $this;
    }

    public function getGuestName(): ?string
    {
        return $this->GuestName;
    }

    public function setGuestName(string $GuestName): self
    {
        $this->GuestName = $GuestName;

        return $this;
    }

    public function getNumberNights(): ?int
    {
        return $this->NumberNights;
    }

    public function setNumberNights(int $NumberNights): self
    {
        $this->NumberNights = $NumberNights;

        return $this;
    }

    public function getPaymentTotal(): ?float
    {
        return $this->PaymentTotal;
    }

    public function setPaymentTotal(float $PaymentTotal): self
    {
        $this->PaymentTotal = $PaymentTotal;

        return $this;
    }

    public function getRoom(): ?Room
    {
        return $this->room;
    }

    public function setRoom(?Room $room): self
    {
        $this->room = $room;

        return $this;
    }

    public function getUnavailablePeriod(): ?UnavailablePeriod
    {
        return $this->unavailablePeriod;
    }

    public function setUnavailablePeriod(?UnavailablePeriod $unavailablePeriod): self
    {
        $this->unavailablePeriod = $unavailablePeriod;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }
}
