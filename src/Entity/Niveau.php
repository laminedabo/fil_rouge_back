<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\NiveauRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *      collectionOperations={
 *          "get"={
 *              "path"="admin/niveaux",
 *              "normalization_context"={"groups"={"niveau_read","brief_read"}}
 *          }
 *      },
 *      attributes={
 *          "pagination_items_per_page"=10,
 *          "normalization_context"={"enable_max_depth"=true}
 *      },
 * )
 * @ORM\Entity(repositoryClass=NiveauRepository::class)
 */
class Niveau
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"referentiel_read","competence_detail_read","Grpcompetence_details_read","niveau_read","brief_read","brief_groupe_promo","all_brief_read","brief_promo","brief_apprenant_promo","promo_id_brief","brief_brouillon","brief_valide"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"competence_detail_read","niveau_read"})
     * \@Assert\NotBlank(message = "libelle vide")
     * @Groups({"referentiel_read","brief_read","Grpcompetence_details_read","brief_groupe_promo","all_brief_read","brief_promo","brief_apprenant_promo","promo_id_brief","brief_brouillon","brief_valide"})
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"referentiel_read","competence_detail_read","Grpcompetence_details_read","niveau_read"})
     * \@Assert\NotBlank(message = "critereEvaluation vide")
     */
    private $critereEvaluation;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"referentiel_read","competence_detail_read","niveau_read","Grpcompetence_details_read"})
     * \@Assert\NotBlank(message = "groupeAction vide")
     */
    private $groupeAction;

    /**
     * @ORM\ManyToOne(targetEntity=Competence::class, inversedBy="niveau")
     * @Groups({"brief_read","brief_groupe_promo","all_brief_read","brief_promo","brief_apprenant_promo","promo_id_brief","brief_brouillon","brief_valide"})
     */
    private $competence;

    /**
     * @ORM\ManyToOne(targetEntity=Brief::class, inversedBy="niveaux")
     */
    private $brief;

    /**
     * @ORM\ManyToMany(targetEntity=LivrablePartiel::class, mappedBy="niveaux")
     */
    private $livrablePartiels;

    public function __construct()
    {
        $this->livrablePartiels = new ArrayCollection();
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

    public function getCritereEvaluation(): ?string
    {
        return $this->critereEvaluation;
    }

    public function setCritereEvaluation(string $critereEvaluation): self
    {
        $this->critereEvaluation = $critereEvaluation;

        return $this;
    }

    public function getGroupeAction(): ?string
    {
        return $this->groupeAction;
    }

    public function setGroupeAction(string $groupeAction): self
    {
        $this->groupeAction = $groupeAction;

        return $this;
    }

    public function getCompetence(): ?Competence
    {
        return $this->competence;
    }

    public function setCompetence(?Competence $competence): self
    {
        $this->competence = $competence;

        return $this;
    }

    public function getBrief(): ?Brief
    {
        return $this->brief;
    }

    public function setBrief(?Brief $brief): self
    {
        $this->brief = $brief;

        return $this;
    }

    /**
     * @return Collection|LivrablePartiel[]
     */
    public function getLivrablePartiels(): Collection
    {
        return $this->livrablePartiels;
    }

    public function addLivrablePartiel(LivrablePartiel $livrablePartiel): self
    {
        if (!$this->livrablePartiels->contains($livrablePartiel)) {
            $this->livrablePartiels[] = $livrablePartiel;
            $livrablePartiel->addNiveau($this);
        }

        return $this;
    }

    public function removeLivrablePartiel(LivrablePartiel $livrablePartiel): self
    {
        if ($this->livrablePartiels->contains($livrablePartiel)) {
            $this->livrablePartiels->removeElement($livrablePartiel);
            $livrablePartiel->removeNiveau($this);
        }

        return $this;
    }
}
