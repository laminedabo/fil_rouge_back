<?php

namespace App\Entity;

use App\Repository\PromoBriefApprenantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PromoBriefApprenantRepository::class)
 */
class PromoBriefApprenant
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
    private $statut;

    /**
     * @ORM\ManyToOne(targetEntity=Apprenant::class, inversedBy="promoBriefApprenants")
     */
    private $apprenant;

    /**
     * @ORM\ManyToOne(targetEntity=PromoBrief::class, inversedBy="promoBriefApprenants")
     */
    private $promoBrief;

    public function __construct()
    {
        $this->apprenant = new ArrayCollection();
        $this->promoBrief = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * @return Collection|Apprenant[]
     */
    public function getApprenant(): Collection
    {
        return $this->apprenant;
    }

    public function addApprenant(Apprenant $apprenant): self
    {
        if (!$this->apprenant->contains($apprenant)) {
            $this->apprenant[] = $apprenant;
            $apprenant->setPromoBriefApprenant($this);
        }

        return $this;
    }

    public function removeApprenant(Apprenant $apprenant): self
    {
        if ($this->apprenant->contains($apprenant)) {
            $this->apprenant->removeElement($apprenant);
            // set the owning side to null (unless already changed)
            if ($apprenant->getPromoBriefApprenant() === $this) {
                $apprenant->setPromoBriefApprenant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PromoBrief[]
     */
    public function getPromoBrief(): Collection
    {
        return $this->promoBrief;
    }

    public function addPromoBrief(PromoBrief $promoBrief): self
    {
        if (!$this->promoBrief->contains($promoBrief)) {
            $this->promoBrief[] = $promoBrief;
            $promoBrief->setPromoBriefApprenant($this);
        }

        return $this;
    }

    public function removePromoBrief(PromoBrief $promoBrief): self
    {
        if ($this->promoBrief->contains($promoBrief)) {
            $this->promoBrief->removeElement($promoBrief);
            // set the owning side to null (unless already changed)
            if ($promoBrief->getPromoBriefApprenant() === $this) {
                $promoBrief->setPromoBriefApprenant(null);
            }
        }

        return $this;
    }
}
