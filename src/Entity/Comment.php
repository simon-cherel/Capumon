<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentRepository::class)
 */
class Comment
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
    private $CommentId;

    /**
     * @ORM\Column(type="text")
     */
    private $Content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $author;

    /**
     * @ORM\Column(type="integer")
     */
    private $ReservationIdComment;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="comments")
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity=Room::class, inversedBy="comments")
     */
    private $room;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommentId(): ?int
    {
        return $this->CommentId;
    }

    public function setCommentId(int $CommentId): self
    {
        $this->CommentId = $CommentId;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->Content;
    }

    public function setContent(string $Content): self
    {
        $this->Content = $Content;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getReservationIdComment(): ?int
    {
        return $this->ReservationIdComment;
    }

    public function setReservationIdComment(int $ReservationIdComment): self
    {
        $this->ReservationIdComment = $ReservationIdComment;

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

    public function getRoom(): ?Room
    {
        return $this->room;
    }

    public function setRoom(?Room $room): self
    {
        $this->room = $room;

        return $this;
    }
}
