<?php

namespace App\Entity;

use App\Repository\OfficeRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OfficeRepository::class)
 */
class Office
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
    private $title;

    /**
     * @ORM\Column(type="integer")
     */
    private $maxSub;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="time")
     */
    private $hour;



    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Lieu;

    /**
     * @ORM\OneToMany(targetEntity=Sub::class, mappedBy="idOffice", orphanRemoval=true, cascade="remove")
     */
    private $subs;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $paracha;

    public function __construct()
    {
        $this->subs = new ArrayCollection();
    }

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $comment;





    public function getId(): ?int
    {
        return $this->id;
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



    public function getMaxSub(): ?int
    {
        return $this->maxSub;
    }

    public function setMaxSub(int $maxSub): self
    {
        $this->maxSub = $maxSub;

        return $this;
    }


    public function getDate(): ?DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getHour(): ?DateTimeInterface
    {
        return $this->hour;
    }

    public function setHour(DateTimeInterface $hour): self
    {
        $this->hour = $hour;

        return $this;
    }

    /**
     * @return Collection|Sub[]
     */
    public function getSubs(): Collection
    {
        return $this->subs;
    }

    public function addSub(Sub $sub): self
    {
        if (!$this->subs->contains($sub)) {
            $this->subs[] = $sub;
            $sub->setIdOffice($this);
        }

        return $this;
    }

    public function removeSub(Sub $sub): self
    {
        if ($this->subs->removeElement($sub)) {
            // set the owning side to null (unless already changed)
            if ($sub->getIdOffice() === $this) {
                $sub->setIdOffice(null);
            }
        }

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->Lieu;
    }

    public function setLieu(string $Lieu): self
    {
        $this->Lieu = $Lieu;

        return $this;
    }

    public function __toString()
    {
        return (string) $this->getId();
    }

    public function getParacha(): ?string
    {
        return $this->paracha;
    }

    public function setParacha(string $paracha): self
    {
        $this->paracha = $paracha;

        return $this;
    }

    public function getComment(): ?bool
    {
        return $this->comment;
    }

    public function setComment(?bool $comment): self
    {
        $this->comment = $comment;

        return $this;
    }
}