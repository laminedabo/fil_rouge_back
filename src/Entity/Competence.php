<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CompetenceRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @UniqueEntity("libelle")
 * @ApiResource(
 *      mercure=true,
 *      attributes={
 *          "pagination_items_per_page"=10,
 *      },
 *      routePrefix="/admin",
 *     collectionOperations={
 *          "add_competence"={
 *              "method"="POST",
 *              "path"="/competences",
 *              "security_post_denormalize"="is_granted('EDIT', object)", 
 *              "security_post_denormalize_message"="Vous n'avez pas ce privilege.",
 *          },
 *         "show_competence"={
 *              "method"="GET",
 *              "security"="is_granted('ROLE_CM')", 
 *              "security_message"="Vous n'avez pas acces a cette ressource.",
 *              "path"="/competences",
 *              "normalization_context"={"groups"={"competence_read"},"enable_max_depth"=true}
 *         },
 *     },
 *     
 *     itemOperations={
 *         "get"={
 *              "security"="is_granted('VIEW',object)", 
 *              "security_message"="Vous n'avez pas ce privilege.",
 *              "path"="/competences/{id}",
 *              "normalization_context"={"groups"={"competence_detail_read"}}
 *         }, 
 *         "delete"={
 *              "security"="is_granted('DELETE',object)",
 *              "security_message"="Seul le proprietaite....",
 *              "path"="/competences/{id}",
 *         },
 *         "update_competence"={
 *              "method"="PATCH",
 *              "security"="is_granted('EDIT',object)", 
 *              "security_message"="Vous n'avez pas ce privilege.",
 *              "path"="/competences/{id}",
 *         },
 *         "update_competence"={
 *              "method"="PUT",
 *              "security_post_denormalize"="is_granted('EDIT', object)", 
 *              "security_post_denormalize_message"="Vous n'avez pas ce privilege.",
 *              "path"="/competences/{id}",
 *         },
 *     },
 * )
 * @ORM\Entity(repositoryClass=CompetenceRepository::class)
 */
class Competence
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"referentiel_read","competence_read","competence_detail_read","Grpcompetence_details_read","Grpcompetence_competence_read","referentiel_groupecompetence_read","promo_referentiel","brief_read","brief_groupe_promo","all_brief_read",
     * "brief_promo","brief_apprenant_promo","promo_id_brief","brief_brouillon","brief_valide"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="valeur vide")
     * @Groups({"Grpcompetence_details_read","competence_detail_read","competence_read","Grpcompetence_competence_read","promo_referentiel","referentiel_groupecompetence_read"})
     * @Groups({"referentiel_read","brief_read","brief_groupe_promo","all_brief_read","brief_promo","brief_apprenant_promo","promo_id_brief","brief_brouillon","brief_valide"})
     */
    private $libelle;

    /**
     * @ORM\ManyToMany(targetEntity=Groupecompetence::class, mappedBy="competence", cascade={"persist"})
     * @Groups({"competence_detail_read"})
     * @ApiSubresource()
     */
    private $groupecompetences;

    /**
     * @ORM\OneToMany(targetEntity=Niveau::class, mappedBy="competence", cascade={"persist"})
     * @Groups({"referentiel_read","competence_detail_read","Grpcompetence_details_read"})
     * @ApiSubresource()
     */
    private $niveau;

    /**
     * @ORM\OneToMany(targetEntity=StatistiquesCompetences::class, mappedBy="competence")
     */
    private $statistiquesCompetences;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $statut = "actif";

    /**
     * @ORM\ManyToMany(targetEntity=Referentiel::class, mappedBy="competences")
     */
    private $referentiels;

    public function __construct()
    {
        $this->groupecompetences = new ArrayCollection();
        $this->niveau = new ArrayCollection();
        $this->statistiquesCompetences = new ArrayCollection();
        $this->referentiels = new ArrayCollection();
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
     * @return Collection|Groupecompetence[]
     */
    public function getGroupecompetences(): Collection
    {
        return $this->groupecompetences;
    }

    public function addGroupecompetence(Groupecompetence $groupecompetence): self
    {
        if (!$this->groupecompetences->contains($groupecompetence)) {
            $this->groupecompetences[] = $groupecompetence;
            $groupecompetence->addCompetence($this);
        }

        return $this;
    }

    public function removeGroupecompetence(Groupecompetence $groupecompetence): self
    {
        if ($this->groupecompetences->contains($groupecompetence)) {
            $this->groupecompetences->removeElement($groupecompetence);
            $groupecompetence->removeCompetence($this);
        }

        return $this;
    }

    public function removeMembers(){
        foreach ($this->groupecompetences as  $grpcmp) {
            $this -> removeGroupecompetence($grpcmp);
        }
        foreach ($this ->statistiquesCompetences as  $ststqcmp) {
            $this -> removeStatistiquesCompetence($ststqcmp);
        }
    }

    /**
     * @return Collection|Niveau[]
     */
    public function getNiveau(): Collection
    {
        return $this->niveau;
    }

    public function addNiveau(Niveau $niveau): self
    {
        if (!$this->niveau->contains($niveau)) {
            $this->niveau[] = $niveau;
            $niveau->setCompetence($this);
        }

        return $this;
    }

    public function removeNiveau(Niveau $niveau): self
    {
        if ($this->niveau->contains($niveau)) {
            $this->niveau->removeElement($niveau);
            // set the owning side to null (unless already changed)
            if ($niveau->getCompetence() === $this) {
                $niveau->setCompetence(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection|StatistiquesCompetences[]
     */
    public function getStatistiquesCompetences(): Collection
    {
        return $this->statistiquesCompetences;
    }

    public function addStatistiquesCompetence(StatistiquesCompetences $statistiquesCompetence): self
    {
        if (!$this->statistiquesCompetences->contains($statistiquesCompetence)) {
            $this->statistiquesCompetences[] = $statistiquesCompetence;
            $statistiquesCompetence->setCompetence($this);
        }

        return $this;
    }

    public function removeStatistiquesCompetence(StatistiquesCompetences $statistiquesCompetence): self
    {
        if ($this->statistiquesCompetences->contains($statistiquesCompetence)) {
            $this->statistiquesCompetences->removeElement($statistiquesCompetence);
            // set the owning side to null (unless already changed)
            if ($statistiquesCompetence->getCompetence() === $this) {
                $statistiquesCompetence->setCompetence(null);
            }
        }

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(?string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * @return Collection|Referentiel[]
     */
    public function getReferentiels(): Collection
    {
        return $this->referentiels;
    }

    public function addReferentiel(Referentiel $referentiel): self
    {
        if (!$this->referentiels->contains($referentiel)) {
            $this->referentiels[] = $referentiel;
            $referentiel->addCompetence($this);
        }

        return $this;
    }

    public function removeReferentiel(Referentiel $referentiel): self
    {
        if ($this->referentiels->contains($referentiel)) {
            $this->referentiels->removeElement($referentiel);
            $referentiel->removeCompetence($this);
        }

        return $this;
    }
}
