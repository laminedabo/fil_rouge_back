<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ApprenantRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ApprenantRepository::class)
 * @ApiResource(
 *     attributes={
 *          "security"="is_granted('ROLE_ADMIN')",
 *          "pagination_items_per_page"=10, 
 *          "normalization_context"={"groups"={"gprincipal_read"},"enable_max_depth"=true}
 *     },
 * 
 *     collectionOperations={
 *          "add_apprenant"={
 *              "method"="POST",
 *              "path"="/admin/apprenants",
 *              "security"="is_granted('ROLE_ADMIN') or is_granted('ROLE_CM')",
 *              "security_message"="Vous n'avez pas access à cette Ressource"
 *          },
 *         "get"={
 *              "security"="is_granted('ROLE_ADMIN')", 
 *              "security_message"="Vous n'avez pas acces a cette ressource.",
 *              "path"="/admin/apprenants",
 *          },
 *          "get_apprenants"={
 *              "method"="GET",
 *              "path"="/apprenants" ,
 *              "security"="(is_granted('ROLE_ADMIN'))", 
 *              "security_message"="Vous n'avez pas acces a cette ressource.",
 *              "route_name"="formateur_liste",
 *          }
 *      },
 *     
 *     itemOperations={
 *         "get"={
 *              "security"="is_granted('ROLE_FORMATEUR')", 
 *              "security_message"="Vous n'avez pas ces privileges.",
 *              "path"="admin/apprenants/{id}",
 *              "normalization_context"={"groups"={"apprenant_read"}},
 *              "defaults"={"id"=null}
 *          }, 
 *          "get_apprenant"={
 *              "method"="GET",
 *              "path"="/apprenants/{id}",
 *              "requirements"={"id"="\d+"},
 *              "security"="(is_granted('ROLE_FORMATEUR'))",
 *              "security_message"="Vous n'avez pas access à cette Ressource"
 *          }, 
 *         "delete"={
 *              "security"="is_granted('ROLE_ADMIN')",
 *              "security_message"="Vous n'avez pas ces privileges.",
 *              "path"="admin/apprenants/{id}",
 *          },
 *         "patch"={
 *              "security"="is_granted('ROLE_ADMIN')", 
 *              "security_message"="Vous n'avez pas ces privileges.",
 *              "path"="admin/apprenants/{id}",
 *          },
 *         "put"={
 *              "security_post_denormalize"="is_granted('ROLE_ADMIN')", 
 *              "security_message"="Vous n'avez pas ces privileges.",
 *              "path"="admin/apprenants/{id}",
 *          },
 *     },
 * )
 */
class Apprenant extends User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    // protected $id;

    /**
     * @ORM\ManyToOne(targetEntity=Profilsortie::class, inversedBy="apprenants")
     */
    private $profilsortie;

    /**
     * @ORM\ManyToMany(targetEntity=Groupe::class, inversedBy="apprenants",cascade={"persist"})
     * @Groups({"apprenant_read"})
     */
    private $groupe;

    /**
     * @ORM\OneToMany(targetEntity=Livrable::class, mappedBy="apprenant", orphanRemoval=true)
     * @Groups({"brief_promo","apprenant_promo_brief"})
     */
    private $livrables;

    /**
     * @ORM\OneToMany(targetEntity=LivrableRendu::class, mappedBy="apprenant", orphanRemoval=true)
     * @Groups({"brief_promo","apprenant_promo_brief"})
     */
    private $livrableRendus;

    /**
     * @ORM\OneToMany(targetEntity=PromoBriefApprenant::class, mappedBy="apprenant")
     */
    private $promoBriefApprenant;

    /**
     * @ORM\OneToMany(targetEntity=StatistiquesCompetences::class, mappedBy="apprenant", orphanRemoval=true)
     * @Groups({"apprenant_read"})
     */
    private $statistiquesCompetences;

    public function __construct()
    {
        $this->groupe = new ArrayCollection();
        $this->livrables = new ArrayCollection();
        $this->livrableRendus = new ArrayCollection();
        $this->statistiquesCompetences = new ArrayCollection();
    }

    // public function getId(): ?int
    // {
    //     return $this->id;
    // }

    public function getProfilsortie(): ?Profilsortie
    {
        return $this->profilsortie;
    }

    public function setProfilsortie(?Profilsortie $profilsortie): self
    {
        $this->profilsortie = $profilsortie;

        return $this;
    }

    /**
     * @return Collection|Groupe[]
     */
    public function getGroupe(): Collection
    {
        return $this->groupe;
    }

    public function addGroupe(Groupe $groupe): self
    {
        if (!$this->groupe->contains($groupe)) {
            $this->groupe[] = $groupe;
        }

        return $this;
    }

    public function removeGroupe(Groupe $groupe): self
    {
        if ($this->groupe->contains($groupe)) {
            $this->groupe->removeElement($groupe);
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
            $livrable->setApprenant($this);
        }

        return $this;
    }

    public function removeLivrable(Livrable $livrable): self
    {
        if ($this->livrables->contains($livrable)) {
            $this->livrables->removeElement($livrable);
            // set the owning side to null (unless already changed)
            if ($livrable->getApprenant() === $this) {
                $livrable->setApprenant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|LivrableRendu[]
     */
    public function getLivrableRendus(): Collection
    {
        return $this->livrableRendus;
    }

    public function addLivrableRendu(LivrableRendu $livrableRendu): self
    {
        if (!$this->livrableRendus->contains($livrableRendu)) {
            $this->livrableRendus[] = $livrableRendu;
            $livrableRendu->setApprenant($this);
        }

        return $this;
    }

    public function removeLivrableRendu(LivrableRendu $livrableRendu): self
    {
        if ($this->livrableRendus->contains($livrableRendu)) {
            $this->livrableRendus->removeElement($livrableRendu);
            // set the owning side to null (unless already changed)
            if ($livrableRendu->getApprenant() === $this) {
                $livrableRendu->setApprenant(null);
            }
        }

        return $this;
    }

    public function getPromoBriefApprenant(): ?PromoBriefApprenant
    {
        return $this->promoBriefApprenant;
    }

    public function setPromoBriefApprenant(?PromoBriefApprenant $promoBriefApprenant): self
    {
        $this->promoBriefApprenant = $promoBriefApprenant;

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
            $statistiquesCompetence->setApprenant($this);
        }

        return $this;
    }

    public function removeStatistiquesCompetence(StatistiquesCompetences $statistiquesCompetence): self
    {
        if ($this->statistiquesCompetences->contains($statistiquesCompetence)) {
            $this->statistiquesCompetences->removeElement($statistiquesCompetence);
            // set the owning side to null (unless already changed)
            if ($statistiquesCompetence->getApprenant() === $this) {
                $statistiquesCompetence->setApprenant(null);
            }
        }

        return $this;
    }
}
