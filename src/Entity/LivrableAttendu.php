<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\LivrableAttenduRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *      attributes={
 *          "normalization_context"={"enable_max_depth"=true}
 *      },
 * )
 * @ORM\Entity(repositoryClass=LivrableAttenduRepository::class)
 */
class LivrableAttendu
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"brief_read","brief_groupe_promo","all_brief_read","brief_promo","brief_apprenant_promo","promo_id_brief","brief_brouillon","brief_valide"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"brief_read","brief_groupe_promo","all_brief_read","brief_promo","brief_apprenant_promo","promo_id_brief","brief_brouillon","brief_valide"})
     */
    private $libelle;

    // a enlever
    private $briefs;

    /**
     * @ORM\OneToMany(targetEntity=BriefLivrableAttendu::class, mappedBy="LivrableAttendu", orphanRemoval=true)
     */
    private $briefLivrableAttendus;


    /**
     * @ORM\OneToMany(targetEntity=Livrable::class, mappedBy="livrableAttendu", orphanRemoval=true)
     */
    private $livrables;


    public function __construct()
    {
        $this->briefs = new ArrayCollection();
        $this->livrables = new ArrayCollection();
        $this->briefLivrableAttendus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|BriefLivrableAttendu[]
     */
    public function getBriefLivrableAttendus(): Collection
    {
        return $this->briefLivrableAttendus;
    }

    public function addBriefLivrableAttendu(BriefLivrableAttendu $briefLivrableAttendu): self
    {
        if (!$this->briefLivrableAttendus->contains($briefLivrableAttendu)) {
            $this->briefLivrableAttendus[] = $briefLivrableAttendu;
            $briefLivrableAttendu->setLivrableAttendu($this);
        }

        return $this;
    }


    public function removeBriefLivrableAttendu(BriefLivrableAttendu $briefLivrableAttendu): self
    {
        if ($this->briefLivrableAttendus->contains($briefLivrableAttendu)) {
            $this->briefLivrableAttendus->removeElement($briefLivrableAttendu);
            // set the owning side to null (unless already changed)
            if ($briefLivrableAttendu->getLivrableAttendu() === $this) {
                $briefLivrableAttendu->setLivrableAttendu(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Livrable[]
     */
    public function getLivrables(): Collection
    {
        return $this->livrables;
    }

    public function addLivrable(Livrable $livrable): self
    {
        if (!$this->livrables->contains($livrable)) {
            $this->livrables[] = $livrable;
            $livrable->setLivrableattendu($this);
        }

        return $this;
    }

    public function removeLivrable(Livrable $livrable): self
    {
        if ($this->livrables->contains($livrable)) {
            $this->livrables->removeElement($livrable);
            // set the owning side to null (unless already changed)
            if ($livrable->getLivrableattendu() === $this) {
                $livrable->setLivrableattendu(null);
            }
        }

        return $this;
    }
}
