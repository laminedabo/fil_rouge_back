<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ReferentielRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @UniqueEntity("libelle")
 * @ApiResource(
 *     attributes={
 *          "security"="is_granted('ROLE_ADMIN')",
 *          "normalization_context"={"enable_max_depth"=true}
 *     },
 *     routePrefix="/admin/referentiels",
 *     collectionOperations={
 *          "add_referentiel"={
 *              "method"="POST",
 *              "path"="",
 *              "security"="is_granted('ROLE_ADMIN')",
 *              "security_message"="Vous n'avez pas le privilege",
 *          },
 *         "get"={
 *              "security"="is_granted('ROLE_ADMIN')", 
 *              "security_message"="Vous n'avez pas acces a cette ressource.",
 *              "path"="",
 *              "normalization_context"={"groups"={"referentiel_read"}}
 *   
 *          },              
 *           "show_referentiel_groupecompetence"={
 *              "method"="GET",
 *              "security"="is_granted('ROLE_CM')", 
 *              "security_message"="Vous n'avez pas acces a cette ressource.",
 *              "path"="/groupecompetences",
 *              "normalization_context"={"groups"={"referentiel_groupecompetence_read"}}
 *          }
 *     },
 *     
 *     itemOperations={
 *         "get"={
 *              "security"="is_granted('VIEW',object)", 
 *              "security_message"="Vous n'avez pas ce privilege.",
 *              "path"="/{id}",
 *              "normalization_context"={"groups"={"referentiel_read"}}
 *          },
 *           "show_referentiel_groupecompetence"={
 *              "method"="GET",
 *              "security"="is_granted('ROLE_CM')", 
 *              "security_message"="Vous n'avez pas acces a cette ressource.",
 *              "path"="/{id}/competences",
 *              "normalization_context"={"groups"={"referentiel_competence_read"}}
 *          },
 *         "delete"={
 *              "security"="is_granted('DELETE',object)",
 *              "security_message"="Vous n'avez pas ces privileges.",
 *              "path"="/{id}",
 *          },
 *         "update_referentiel"={
 *              "method"="PATCH",
 *              "security"="is_granted('ROLE_ADMIN')", 
 *              "security_message"="Vous n'avez pas ces privileges.",
 *              "path"="/{id}",
 *          },
 *         "update_referentiel"={
 *              "method"="PUT",
 *              "security_post_denormalize"="is_granted('ROLE_ADMIN')", 
 *              "security_message"="Vous n'avez pas ces privileges.",
 *              "path"="/{id}",
 *          },
 *     }
 * )
 * @ORM\Entity(repositoryClass=ReferentielRepository::class)
 */
class Referentiel
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"referentiel_read","promo_read","promo_referentiel","Grpcompetence_read","brief_read","brief_groupe_promo","all_brief_read","brief_promo","brief_apprenant_promo"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\notBlank(message = "libelle null")
     * @Groups({"referentiel_read","promo_read","promo_referentiel","promo_groupe_apprenants","promo_groupe_formateurs","brief_read","brief_groupe_promo","all_brief_read","brief_promo","brief_apprenant_promo"})
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\notBlank(message = "referentiel null")
     *  @Groups({"referentiel_read","promo_read","promo_referentiel","promo_groupe_apprenants","promo_groupe_formateurs"})
     */
    private $presentation;

    /**
     * @ORM\Column(type="blob", nullable=true)
     * @Groups({"referentiel_read","promo_referentiel"})
     */
    private $programme;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"referentiel_read","promo_referentiel"})
     */
    private $critereAdmission;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"referentiel_read","promo_referentiel"})
     */
    private $critereEvaluation;

    /**
     * @ORM\OneToMany(targetEntity=Promo::class, mappedBy="referentiel")
     * @Groups({"referentiel_read"})
     */
    private $promos;

    /**
     * deleted
     */
    private $groupecompetence;

    /**
     * @ORM\OneToMany(targetEntity=Brief::class, mappedBy="referentiel", orphanRemoval=true)
     */
    private $briefs;

    /**
     * @ORM\OneToMany(targetEntity=StatistiquesCompetences::class, mappedBy="referentiel", orphanRemoval=true)
     */
    private $statistiquesCompetences;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $statut = "actif";

    /**
     * @ORM\ManyToMany(targetEntity=Competence::class, inversedBy="referentiels")
     * @ApiSubresource(maxDepth=2)
     * @MaxDepth(2)
     * @Groups({"referentiel_read","referentiel_competence_read","promo_referentiel"})
     */
    private $competences;

    public function __construct()
    {
        $this->promos = new ArrayCollection();
        $this->groupecompetence = new ArrayCollection();
        $this->briefs = new ArrayCollection();
        $this->statistiquesCompetences = new ArrayCollection();
        $this->competences = new ArrayCollection();
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

    public function getPresentation(): ?string
    {
        return $this->presentation;
    }

    public function setPresentation(string $presentation): self
    {
        $this->presentation = $presentation;

        return $this;
    }

     public function getProgramme()
    {
        if ($this->programme) {
            $content = \stream_get_contents($this->programme);
            fclose($this->programme);

            return base64_encode($content);
        }
        return null;
    }

    public function setProgramme($programme): self
    {
        $this->programme = $programme;

        return $this;
    }

    public function getCritereAdmission(): ?string
    {
        return $this->critereAdmission;
    }

    public function setCritereAdmission(string $critereAdmission): self
    {
        $this->critereAdmission = $critereAdmission;

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

    /**
     * @return Collection|Promo[]
     */
    public function getPromos(): Collection
    {
        return $this->promos;
    }

    public function addPromo(Promo $promo): self
    {
        if (!$this->promos->contains($promo)) {
            $this->promos[] = $promo;
            $promo->setReferentiel($this);
        }

        return $this;
    }

    public function removePromo(Promo $promo): self
    {
        if ($this->promos->contains($promo)) {
            $this->promos->removeElement($promo);
            // set the owning side to null (unless already changed)
            if ($promo->getReferentiel() === $this) {
                $promo->setReferentiel(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Groupecompetence[]
     */
    /*public function getGroupecompetence(): Collection
    {
        return $this->groupecompetence;
    }

    public function addGroupecompetence(Groupecompetence $groupecompetence): self
    {
        if (!$this->groupecompetence->contains($groupecompetence)) {
            $this->groupecompetence[] = $groupecompetence;
        }

        return $this;
    }

    public function removeGroupecompetence(Groupecompetence $groupecompetence): self
    {
        if ($this->groupecompetence->contains($groupecompetence)) {
            $this->groupecompetence->removeElement($groupecompetence);
        }

        return $this;
    }*/

    /**
     * @return Collection|Brief[]
     */
    public function getBriefs(): Collection
    {
        return $this->briefs;
    }

    public function addBrief(Brief $brief): self
    {
        if (!$this->briefs->contains($brief)) {
            $this->briefs[] = $brief;
            $brief->setReferentiel($this);
        }

        return $this;
    }

    public function removeBrief(Brief $brief): self
    {
        if ($this->briefs->contains($brief)) {
            $this->briefs->removeElement($brief);
            // set the owning side to null (unless already changed)
            if ($brief->getReferentiel() === $this) {
                $brief->setReferentiel(null);
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
            $statistiquesCompetence->setReferentiel($this);
        }

        return $this;
    }

    public function removeStatistiquesCompetence(StatistiquesCompetences $statistiquesCompetence): self
    {
        if ($this->statistiquesCompetences->contains($statistiquesCompetence)) {
            $this->statistiquesCompetences->removeElement($statistiquesCompetence);
            // set the owning side to null (unless already changed)
            if ($statistiquesCompetence->getReferentiel() === $this) {
                $statistiquesCompetence->setReferentiel(null);
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

    public function removeMembers(){
        
    }

    /**
     * @return Collection|Competence[]
     */
    public function getCompetences(): Collection
    {
        return $this->competences;
    }

    public function addCompetence(Competence $competence): self
    {
        if (!$this->competences->contains($competence)) {
            $this->competences[] = $competence;
        }

        return $this;
    }

    public function removeCompetence(Competence $competence): self
    {
        if ($this->competences->contains($competence)) {
            $this->competences->removeElement($competence);
        }

        return $this;
    }
}
