<?php

namespace App\Entity;

use App\Entity\User;
use App\Entity\Promo;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\FormateurRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=FormateurRepository::class)
 * @ApiResource(
 *     attributes={
 *          "security"="is_granted('ROLE_ADMIN')",
 *          "pagination_items_per_page"=10, 
 *          "normalization_context"={"groups"={"gprincipal_read"},"enable_max_depth"=true}
 *     },
 * 
 *     collectionOperations={
 *          "add_formateur"={
 *              "method"="POST",
 *              "path"="/admin/formateurs",
 *              "security"="is_granted('ROLE_ADMIN')",
 *              "security_message"="Vous n'avez pas access à cette Ressource"
 *          },
 *         "get"={
 *              "security"="is_granted('ROLE_FORMATEUR')", 
 *              "security_message"="Vous n'avez pas acces a cette ressource.",
 *              "path"="admin/formateurs",
 *          },
 *          "get_formateurs"={
 *              "method"="GET",
 *              "path"="/formateurs" ,
 *              "security"="is_granted('ROLE_ADMIN')", 
 *              "security_message"="Vous n'avez pas acces a cette ressource.",
 *              "route_name"="formateur_liste",
 *          }
 *     },
 *     
 *     itemOperations={
 *         "get"={
 *              "security"="is_granted('ROLE_ADMIN')", 
 *              "security_message"="Vous n'avez pas ces privileges.",
 *              "path"="admin/formateurs/{id}",
 *              "defaults"={"id"=null}
 *          }, 
 *          "get_formateur"={
 *              "method"="GET",
 *              "path"="/formateurs/{id}",
 *              "requirements"={"id"="\d+"},
 *              "security"="is_granted('ROLE_FORMATEUR')",
 *              "security_message"="Vous n'avez pas access à cette Ressource"
 *          }, 
 *         "delete"={
 *              "security"="is_granted('ROLE_ADMIN')",
 *              "security_message"="Vous n'avez pas ces privileges.",
 *              "path"="admin/formateurs/{id}",
 *          },
 *         "patch"={
 *              "security"="is_granted('ROLE_ADMIN')", 
 *              "security_message"="Vous n'avez pas ces privileges.",
 *              "path"="admin/formateurs/{id}",
 *          },
 *         "put"={
 *              "security_post_denormalize"="is_granted('ROLE_ADMIN')", 
 *              "security_message"="Vous n'avez pas ces privileges.",
 *              "path"="admin/formateurs/{id}",
 *          },
 *     },
 * )
 */
class Formateur extends User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    // protected $id;

    /**
     * @ORM\ManyToMany(targetEntity=Groupe::class, inversedBy="formateurs")
     */
    private $groupe;

    /**
     * @ORM\ManyToMany(targetEntity=Promo::class, inversedBy="formateurs")
     */
    private $promo;

    /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="formateur", orphanRemoval=true)
     */
    private $commentaires;

    /**
     * @ORM\OneToMany(targetEntity=Brief::class, mappedBy="formateur", orphanRemoval=true)
     * @Groups({"brief_read"})
     */
    private $briefs;

    public function __construct()
    {
        $this->groupe = new ArrayCollection();
        $this->promo = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
        $this->briefs = new ArrayCollection();
    }

    // public function getId(): ?int
    // {
    //     return $this->id;
    // }

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
     * @return Collection|Promo[]
     */
    public function getPromo(): Collection
    {
        if ($this->promo) {
            return $this->promo; //fonctions modifiées
        }
        return new ArrayCollection();
    }

    public function addPromo(Promo $promo): self
    {
        if ($promo) {
            $this->promo[] = $promo;
        }
        // if (!$this->promo->contains($promo)) {
        //     $this->promo[] = $promo;
        // }

        return $this;
    }

    public function removePromo(Promo $promo): self
    {
        if ($this->promo !== null) {
            $this->promo->removeElement($promo);
        }
        // if ($this->promo->contains($promo)) {
        //     $this->promo->removeElement($promo);
        // }

        return $this;
    }

    /**
     * @return Collection|Commentaire[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setFormateur($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->contains($commentaire)) {
            $this->commentaires->removeElement($commentaire);
            // set the owning side to null (unless already changed)
            if ($commentaire->getFormateur() === $this) {
                $commentaire->setFormateur(null);
            }
        }

        return $this;
    }

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
            $brief->setFormateur($this);
        }

        return $this;
    }

    public function removeBrief(Brief $brief): self
    {
        if ($this->briefs->contains($brief)) {
            $this->briefs->removeElement($brief);
            // set the owning side to null (unless already changed)
            if ($brief->getFormateur() === $this) {
                $brief->setFormateur(null);
            }
        }

        return $this;
    }
}
