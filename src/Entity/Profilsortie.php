<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProfilsortieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 * denormalizationContext={"groups"={"profilSortie_write"}},
 * attributes={
 *          
 *      },
 * 
 *     collectionOperations={
 *         "post"={
 *              "security_post_denormalize"="is_granted('EDIT', object)", 
 *              "security_post_denormalize_message"="Vous n'avez pas ce privilege.",
 *              "path"="/admin/profilsorties",
 *          },
 *         "get"={
 *              "security"="is_granted('ROLE_APPRENANT')", 
 *              "security_message"="Vous n'avez pas acces a cette ressource.",
 *              "path"="/admin/profilsorties",
 *              "normalization_context"={"groups"={"profilsortie_libelle_read"}},
 *              },
 *          "profilsortie_promo"={
 *               "method"="GET",
 *              "security"="is_granted('ROLE_FORMATEUR')", 
 *              "security_message"="Vous n'avez pas acces a cette ressource.",
 *              "path"="/admin/promos/{id}/profilsorties",
 *              "normalization_context"={"groups"={"profilsortie_apprenants_read"}},
 *              },
 *         "profilsortie_item"={
 *              "method"="GET",
 *              "security"="is_granted('ROLE_FORMATEUR')", 
 *              "security_message"="Vous n'avez pas acces a cette ressource.",
 *              "path"="/admin/promos/{idp}/profilsorties/{id}",
 *              "normalization_context"={"groups"={"profilsortie_apprenants_read"}},
 *         },     
 *     },
 *     itemOperations={       
 *       "profilsortie_id"={
 *               "method"="GET",
 *              "security"="is_granted('ROLE_FORMATEUR')", 
 *              "security_message"="Vous n'avez pas acces a cette ressource.",
 *              "path"="/admin/profilsorties/{id}",
 *              "normalization_context"={"groups"={"profilsortie_apprenants_read"}},
 *              },     
 *         "patch"={
 *              "security"="is_granted('EDIT',object)", 
 *              "security_message"="Vous n'avez pas ce privilege.",
 *              "path"="/admin/profilsorties/{id}",
 *         },
 *         "put"={
 *              "security_post_denormalize"="is_granted('EDIT', object)", 
 *              "security_post_denormalize_message"="Vous n'avez pas ce privilege.",
 *              "path"="/admin/profilsorties/{id}",
 *         },
 *         "delete"={
 *              "security_post_denormalize"="is_granted('DELETE', object)", 
 *              "security_post_denormalize_message"="Vous n'avez pas ce privilege.",
 *              "path"="/admin/profilsorties/{id}",
 *         }
 *     },
 * )
 * @ORM\Entity(repositoryClass=ProfilsortieRepository::class)
 */
class Profilsortie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups ({"profilsortie_read","profilsortie_apprenants_read","profilsortie_libelle_read","profilSortie_write"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\notBlank(message = "valeur null")
     * @Groups ({"profilsortie_read","profilsortie_apprenants_read","profilsortie_libelle_read","profilSortie_write"})
     */
    private $libelle;

    /**
     * @Groups({"profilsortie_apprenants_read"})
     * @ORM\OneToMany(targetEntity=Apprenant::class, mappedBy="profilsortie")
     *@ApiSubresource()
     */

    private $apprenants;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("profilSortie_write")
     */
    private $statut;

    public function __construct()
    {
        $this->apprenants = new ArrayCollection();
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
     * @return Collection|Apprenant[]
     */
    public function getApprenants(): Collection
    {
        return $this->apprenants;
    }

    public function addApprenant(Apprenant $apprenant): self
    {
        if (!$this->apprenants->contains($apprenant)) {
            $this->apprenants[] = $apprenant;
            $apprenant->setProfilsortie($this);
        }

        return $this;
    }

    public function removeApprenant(Apprenant $apprenant): self
    {
        if ($this->apprenants->contains($apprenant)) {
            $this->apprenants->removeElement($apprenant);
            // set the owning side to null (unless already changed)
            if ($apprenant->getProfilsortie() === $this) {
                $apprenant->setProfilsortie(null);
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
}