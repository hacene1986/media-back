<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MediaRepository")
 */
class Media
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
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $author;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Loaning", mappedBy="media")
     */
    private $loanings;

    public function __construct()
    {
        $this->loanings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    /**
     * @return Collection|Loaning[]
     */
    public function getLoanings(): Collection
    {
        return $this->loanings;
    }

    public function addLoaning(Loaning $loaning): self
    {
        if (!$this->loanings->contains($loaning)) {
            $this->loanings[] = $loaning;
            $loaning->setMedia($this);
        }

        return $this;
    }

    public function removeLoaning(Loaning $loaning): self
    {
        if ($this->loanings->contains($loaning)) {
            $this->loanings->removeElement($loaning);
            // set the owning side to null (unless already changed)
            if ($loaning->getMedia() === $this) {
                $loaning->setMedia(null);
            }
        }

        return $this;
    }
}
