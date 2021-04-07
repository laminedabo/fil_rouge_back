<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\BriefRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * @ApiResource(
 *     attributes={
 *          "normalization_context"={"groups"={"brief_read"},"enable_max_depth"=true}
 *      },
 *     collectionOperations={
 *          "get"={
 *              "security"="is_granted('ROLE_CM')",
 *              "security_message"="Vous n'avez pas acces a cette ressource.",
 *              "path"="formateur/briefs",
 *              "normalization_context"={"groups"={"all_brief_read"},"enable_max_depth"=true}
 *          },
 *          "brief_groupe_promo"={
 *              "method"="GET",
 *              "security"="is_granted('ROLE_CM')",
 *              "security_message"="Vous n'avez pas acces a cette ressource.",
 *              "path"="formateur/promos/{idp}/groupes/{idg}/briefs",
 *              "requirements"={"idp"="\d+"},
 *              "requirements"={"idg"="\d+"},
 *              "normalization_context"={"groups"={"brief_groupe_promo"},"enable_max_depth"=true}
 *          },
 *          "brief_promo"={
 *              "method"="GET",
 *              "path"="formateurs/promos/{idp}/briefs/{id}",
 *              "requirements"={"idp"="\d+"},
 *              "requirements"={"id"="\d+"},
 *              "normalization_context"={"groups"={"brief_promo"},"enable_max_depth"=true}
 *          },
 *          "apprenant_promo_brief"={
 *              "method"="GET",
 *              "path"="apprenants/promos/{idp}/briefs/{idb}",
 *              "requirements"={"idp"="\d+"},
 *              "requirements"={"idb"="\d+"},
 *              "normalization_context"={"groups"={"apprenant_promo_brief"},"enable_max_depth"=true}
 *          },
 *          "promo_apprenant_brief"={
 *              "method"="GET",
 *              "security"="is_granted('ROLE_APPRENANT')",
 *              "security_message"="Vous n'avez pas acces a cette ressource.",
 *              "path"="apprenants/promos/{id}/briefs",
 *              "requirements"={"id"="\d+"},
 *              "normalization_context"={"groups"={"brief_apprenant_promo"},"enable_max_depth"=true}
 *          },
 *          "promo_id_brief"={
 *              "method"="GET",
 *              "security"="is_granted('ROLE_CM')",
 *              "security_message"="Vous n'avez pas acces a cette ressource.",
 *              "path"="formateurs/promos/{idp}/briefs",
 *              "requirements"={"idp"="\d+"},
 *              "normalization_context"={"groups"={"promo_id_brief"},"enable_max_depth"=true}
 *          },
 *          "briefs_brouillon"={
 *              "method"="GET",
 *              "security"="is_granted('ROLE_FORMATEUR')",
 *              "security_message"="Vous n'avez pas acces a cette ressource.",
 *              "path"="formateur/briefs/brouillons",
 *              "normalization_context"={"groups"={"brief_brouillon"},"enable_max_depth"=true}
 *          },
 *          "briefs_valide"={
 *              "method"="GET",
 *              "security"="is_granted('ROLE_FORMATEUR')",
 *              "security_message"="Vous n'avez pas acces a cette ressource.",
 *              "path"="formateur/briefs/valides",
 *              "normalization_context"={"groups"={"brief_valide"},"enable_max_depth"=true}
 *          },
 *          "add_briefs"={
 *              "method"="POST",
 *              "path"="formateur/briefs",
 *              "security_post_denormalize"="is_granted('EDIT', object)", 
 *              "security_post_denormalize_message"="Vous n'avez pas ce privilege.",
 *          },
 *           "duplique_briefs"={
 *              "method"="POST",
 *              "security_post_denormalize"="is_granted('EDIT', object)", 
 *              "security_post_denormalize_message"="Vous n'avez pas ce privilege.",
 *              "path"="formateur/briefs/{id}",
 *              "defaults"={"id"=null}   
 *            }
 *     },
 *      itemOperations={
 *          "get"={
 *              "security"="is_granted('ROLE_FORMATEUR')", 
 *              "security_message"="Vous n'avez pas ce privilege.",
 *              "path"="formateur/briefs/{id}",
 *         }, 
 * 
 *          "assignation_briefs"={
 *              "method"="PUT",
 *              "security_post_denormalize"="is_granted('ROLE_FORMATEUR')", 
 *              "security_post_denormalize_message"="Vous n'avez pas ce privilege.",
 *              "path"="formateurs/promo/{idpromo}/brief/{idbrief}/assignation",
 *          
 *          },
 * 
 *          "update_briefs"={
 *              "method"="PUT",
 *               "security_post_denormalize"="is_granted('EDIT', object)", 
 *              "security_post_denormalize_message"="Vous n'avez pas ce privilege.",
 *              "path"="formateur/promo/{idpromo}/brief/{idbrief}",
 *              "defaults"={"id"=null}
  *         }
 *      }
 * )
 * 
 * 
 * @ORM\Entity(repositoryClass=BriefRepository::class)
 */
class Brief
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"brief_read","apprenant_promo_brief","brief_groupe_promo","all_brief_read","brief_promo","brief_apprenant_promo","promo_id_brief","brief_brouillon","brief_valide"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"brief_read","apprenant_promo_brief","brief_promo"})
     */
    private $langue;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"brief_read","apprenant_promo_brief","brief_groupe_promo","all_brief_read","brief_promo","brief_apprenant_promo","promo_id_brief","brief_brouillon","brief_valide"})
     */
    private $titre;

    /**
     * @ORM\Column(type="text")
     * @Groups({"brief_read","apprenant_promo_brief","brief_groupe_promo","all_brief_read","brief_promo","brief_apprenant_promo","promo_id_brief","brief_brouillon","brief_valide"})
     */
    private $description;

    /**
     * @ORM\Column(type="text")
     * @Groups({"brief_read","apprenant_promo_brief","brief_promo"})
     */
    private $contexte;

    /**
     * @ORM\Column(type="text")
     * @Groups({"brief_read","apprenant_promo_brief","brief_groupe_promo","brief_promo","brief_apprenant_promo","promo_id_brief","brief_brouillon","brief_valide"})
     */
    private $livrablesAttendus;

    /**
     * @ORM\Column(type="text")
     * @Groups({"brief_read","apprenant_promo_brief","brief_promo"})
     */
    private $modalitesPedagogiques;

    /**
     * @ORM\Column(type="text")
     * @Groups({"brief_read","apprenant_promo_brief","brief_promo"})
     */
    private $criteresDePerformance;

    /**
     * @ORM\Column(type="text")
     * @Groups({"brief_read","apprenant_promo_brief","brief_promo"})
     */
    private $modalitesEvaluation;

    /**
     * @ORM\Column(type="blob", nullable=true)
     * @Groups({"all_brief_read"})
     */
    private $avatar;

    /**
     * @ORM\Column(type="date")
     * @Groups({"brief_read","apprenant_promo_brief","brief_groupe_promo","all_brief_read","brief_promo","brief_apprenant_promo","promo_id_brief","brief_brouillon","brief_valide"})
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"brief_read","apprenant_promo_brief","brief_groupe_promo","all_brief_read","brief_promo","brief_apprenant_promo","promo_id_brief","brief_brouillon","brief_valide"})
     */
    private $statut;

    // a enlever
    private $livrableAttendus;

     /**
     * @ORM\OneToMany(targetEntity=BriefLivrableAttendu::class, mappedBy="Brief", orphanRemoval=true,cascade={"persist"})
     * @Groups({"brief_read","apprenant_promo_brief","brief_groupe_promo","brief_promo","brief_apprenant_promo","promo_id_brief","brief_brouillon","brief_valide"})
     */
    private $briefLivrableAttendus;
    

    /**
     * @ORM\OneToMany(targetEntity=Ressource::class, mappedBy="brief", orphanRemoval=true,cascade={"persist"})
     * @Groups({"brief_read","apprenant_promo_brief"})
     */
    private $ressources;

    /**
     * @Groups({"brief_read","apprenant_promo_brief","brief_groupe_promo","brief_promo","promo_id_brief"})
     * @ORM\OneToMany(targetEntity=PromoBrief::class, mappedBy="brief", orphanRemoval=true,cascade={"persist"})
     */
    private $promoBriefs;

    /**
     * @ORM\ManyToOne(targetEntity=Referentiel::class, inversedBy="briefs",cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"brief_read","apprenant_promo_brief","brief_groupe_promo","all_brief_read","brief_promo","brief_apprenant_promo"})
     */
    private $referentiel;

    /**
     * @ORM\OneToMany(targetEntity=Niveau::class, mappedBy="brief",cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"brief_read","apprenant_promo_brief","brief_groupe_promo","brief_promo","brief_apprenant_promo","promo_id_brief","brief_brouillon","brief_valide"})
     */
    private $niveaux;

    /**
     * @ORM\ManyToMany(targetEntity=Tag::class, inversedBy="briefs",cascade={"persist"})
     * @Groups({"brief_read","apprenant_promo_brief","brief_groupe_promo","brief_promo","brief_apprenant_promo","promo_id_brief","brief_brouillon","brief_valide"})
     */
    private $tags;

    /**
     * @ORM\ManyToOne(targetEntity=Formateur::class, inversedBy="briefs")
     * @ORM\JoinColumn(nullable=false)
     * @MaxDepth(2)
     * @Groups({"brief_read","apprenant_promo_brief","brief_groupe_promo","all_brief_read","brief_promo","brief_apprenant_promo","promo_id_brief"})
     */
    private $formateur;

    /**
     * @ORM\ManyToMany(targetEntity=Groupe::class, inversedBy="briefs")
     * @Groups({"brief_read","apprenant_promo_brief","brief_groupe_promo","brief_promo","brief_apprenant_promo","promo_id_brief"})
     */
    private $groupes;

    public function __construct()
    {
        $this->livrableAttendus = new ArrayCollection();
        $this->ressources = new ArrayCollection();
        $this->promoBriefs = new ArrayCollection();
        $this->niveaux = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->groupes = new ArrayCollection();
        $this->briefLivrableAttendus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId( $id): self 
    {
         $this->id=$id;
         return $this;
    }
    public function getLangue(): ?string
    {
        return $this->langue;
    }

    public function setLangue(string $langue): self
    {
        $this->langue = $langue;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getContexte(): ?string
    {
        return $this->contexte;
    }

    public function setContexte(string $contexte): self
    {
        $this->contexte = $contexte;

        return $this;
    }

    public function getLivrablesAttendus(): ?string
    {
        return $this->livrablesAttendus;
    }

    public function setLivrablesAttendus(string $livrablesAttendus): self
    {
        $this->livrablesAttendus = $livrablesAttendus;

        return $this;
    }

    public function getModalitesPedagogiques(): ?string
    {
        return $this->modalitesPedagogiques;
    }

    public function setModalitesPedagogiques(string $modalitesPedagogiques): self
    {
        $this->modalitesPedagogiques = $modalitesPedagogiques;

        return $this;
    }

    public function getCriteresDePerformance(): ?string
    {
        return $this->criteresDePerformance;
    }

    public function setCriteresDePerformance(string $criteresDePerformance): self
    {
        $this->criteresDePerformance = $criteresDePerformance;

        return $this;
    }

    public function getModalitesEvaluation(): ?string
    {
        return $this->modalitesEvaluation;
    }

    public function setModalitesEvaluation(string $modalitesEvaluation): self
    {
        $this->modalitesEvaluation = $modalitesEvaluation;
        return $this;
    }

    public function getAvatar()
    {
        if ($this->avatar!==null) {
            $content = @\stream_get_contents($this->avatar);
            @fclose($this->avatar);

            return base64_encode($content);
        }
        return null;
    }

    public function setAvatar($avatar): self
    {
        $this->avatar = $avatar;
        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;
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
     * @return Collection|LivrableAttendu[]
     */
    public function getLivrableAttendus(): Collection
    {
        return $this->livrableAttendus;
    }

    public function addLivrableAttendu(LivrableAttendu $livrableAttendu): self
    {
        if (!$this->livrableAttendus->contains($livrableAttendu)) {
            $this->livrableAttendus[] = $livrableAttendu;
            $livrableAttendu->addBrief($this);
        }

        return $this;
    }

    public function removeLivrableAttendu(LivrableAttendu $livrableAttendu): self
    {
        if ($this->livrableAttendus->contains($livrableAttendu)) {
            $this->livrableAttendus->removeElement($livrableAttendu);
            $livrableAttendu->removeBrief($this);
        }

        return $this;
    }

    /**
     * @return Collection|Ressource[]
     */
    public function getRessources(): Collection
    {
        return $this->ressources;
    }

    public function addRessource(Ressource $ressource): self
    {
        if (!$this->ressources->contains($ressource)) {
            $this->ressources[] = $ressource;
            $ressource->setBrief($this);
        }

        return $this;
    }

    public function removeRessource(Ressource $ressource): self
    {
        if ($this->ressources->contains($ressource)) {
            $this->ressources->removeElement($ressource);
            // set the owning side to null (unless already changed)
            if ($ressource->getBrief() === $this) {
                $ressource->setBrief(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PromoBrief[]
     */
    public function getPromoBriefs(): Collection
    {
        return $this->promoBriefs;
    }

    public function addPromoBrief(PromoBrief $promoBrief): self
    {
        if (!$this->promoBriefs->contains($promoBrief)) {
            $this->promoBriefs[] = $promoBrief;
            $promoBrief->setBrief($this);
        }

        return $this;
    }

    public function removePromoBrief(PromoBrief $promoBrief): self
    {
        if ($this->promoBriefs->contains($promoBrief)) {
            $this->promoBriefs->removeElement($promoBrief);
            // set the owning side to null (unless already changed)
            if ($promoBrief->getBrief() === $this) {
                $promoBrief->setBrief(null);
            }
        }

        return $this;
    }

    public function getReferentiel(): ?Referentiel
    {
        return $this->referentiel;
    }

    public function setReferentiel(?Referentiel $referentiel): self
    {
        $this->referentiel = $referentiel;

        return $this;
    }

    /**
     * @return Collection|Niveau[]
     */
    public function getNiveaux(): Collection
    {
        return $this->niveaux;
    }

    public function addNiveau(Niveau $niveau): self
    {
        if (!$this->niveaux->contains($niveau)) {
            $this->niveaux[] = $niveau;
            $niveau->setBrief($this);
        }

        return $this;
    }

    public function removeNiveau(Niveau $niveau): self
    {
        if ($this->niveaux->contains($niveau)) {
            $this->niveaux->removeElement($niveau);
            // set the owning side to null (unless already changed)
            if ($niveau->getBrief() === $this) {
                $niveau->setBrief(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->contains($tag)) {
            $this->tags->removeElement($tag);
        }

        return $this;
    }

    public function getFormateur(): ?Formateur
    {
        return $this->formateur;
    }

    public function setFormateur(?Formateur $formateur): self
    {
        $this->formateur = $formateur;

        return $this;
    }

    /**
     * @return Collection|Groupe[]
     */
    public function getGroupes(): Collection
    {
        return $this->groupes;
    }

    public function addGroupe(Groupe $groupe): self
    {
        if (!$this->groupes->contains($groupe)) {
            $this->groupes[] = $groupe;
        }

        return $this;
    }

    public function removeGroupe(Groupe $groupe): self
    {
        if ($this->groupes->contains($groupe)) {
            $this->groupes->removeElement($groupe);
        }

        return $this;
    }
    // Suppression de la collection de PromoBriefs
    public function setPromoBrief($promoBrief)
    {
        $this->promoBriefs=$promoBrief;
    }
    // Suppression de la collection de groupes
    public function setGroupe($groupe)
    {
        $this->groupes=$groupe;
    }

    // Suppression de la collection de niveaux
    public function setNiveaux($niveaux)
    {
        $this->niveaux=$niveaux;
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
        if (!$this->briefLivrableAttendus->contains($briefLivrableAttendu)) 
        {
            $this->briefLivrableAttendus[] = $briefLivrableAttendu;
            $briefLivrableAttendu->setBrief($this);
        }

        return $this;
    }

    public function removeBriefLivrableAttendu(BriefLivrableAttendu $briefLivrableAttendu): self
    {
        if ($this->briefLivrableAttendus->contains($briefLivrableAttendu)) {
            $this->briefLivrableAttendus->removeElement($briefLivrableAttendu);
            // set the owning side to null (unless already changed)
            if ($briefLivrableAttendu->getBrief() === $this) {
                $briefLivrableAttendu->setBrief(null);
            }
        }

        return $this;
    }

    public function setBriefLivrableAttendu($briefLivrableAttendu)
    {
         $this->briefLivrableAttendus=$briefLivrableAttendu;
    } 
}
