<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\TagRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 * 
 * attributes={
 *              "pagination_items_per_page"=10,
 *              "normalization_context"={"groups"={"tags_read","brief_read","tags_details_read"}}
 *      },
 * 
 *      collectionOperations={
 *          "add_groupetags"={
 *              "method"="POST",
 *              "path"="admin/tags",
 *              "security_post_denormalize"="is_granted('EDIT', object)", 
 *              "security_post_denormalize_message"="Vous n'avez pas ce privilege.",
 *          },
 *         "show_tags"={
 *              "method"="GET",
 *              "security"="is_granted('ROLE_FORMATEUR')", 
 *              "security_message"="Vous n'avez pas acces a cette ressource.",
 *              "path"="admin/tags"
 *              },
 * 
 *     },
 *     
 *     itemOperations={
 *         "get"={
 *              "security"="is_granted('VIEW',object)", 
 *              "security_message"="Vous n'avez pas ce privilege.",
 *              "path"="admin/tags/{id}",
 *         }, 
 *         "delete"={
 *              "security"="is_granted('DELETE',object)",
 *              "security_message"="Seul le proprietaite....",
 *              "path"="admin/tags/{id}",
 *         },
 *         "patch"={
 *              "security"="is_granted('EDIT',object)", 
 *              "security_message"="Vous n'avez pas ce privilege.",
 *              "path"="admin/tags/{id}",
 *         },
 *         "put"={
 *              "security_post_denormalize"="is_granted('EDIT', object)", 
 *              "security_post_denormalize_message"="Vous n'avez pas ce privilege.",
 *              "path"="admin/tags/{id}",
 *         },
 *     },
 * 
 * )
 * @ORM\Entity(repositoryClass=TagRepository::class)
 */
class Tag
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"Grptags_read","Grptags_tags_read","brief_read","brief_groupe_promo","all_brief_read","brief_promo","brief_apprenant_promo","promo_id_brief","brief_brouillon","brief_valide"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Notblank(message = "libelle null")
     * @Groups({"tags_read","Grptags_read","Grptags_tags_read","brief_read","brief_groupe_promo","all_brief_read","brief_promo","brief_apprenant_promo","promo_id_brief","brief_brouillon","brief_valide"})
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"tags_read","Grptags_read","Grptags_tags_read"})
     */
    private $descriptif;

    /**
     * @ORM\ManyToMany(targetEntity=Groupetag::class, mappedBy="tag")
     */
    private $groupetags;

    /**
     * @ORM\ManyToMany(targetEntity=Brief::class, mappedBy="tags")
     */
    private $briefs;

    public function __construct()
    {
        $this->groupetags = new ArrayCollection();
        $this->briefs = new ArrayCollection();
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

    public function getDescriptif(): ?string
    {
        return $this->descriptif;
    }

    public function setDescriptif(string $descriptif): self
    {
        $this->descriptif = $descriptif;

        return $this;
    }

    /**
     * @return Collection|Groupetag[]
     */
    public function getGroupetags(): Collection
    {
        return $this->groupetags;
    }

    public function addGroupetag(Groupetag $groupetag): self
    {
        if (!$this->groupetags->contains($groupetag)) {
            $this->groupetags[] = $groupetag;
            $groupetag->addTag($this);
        }

        return $this;
    }

    public function removeGroupetag(Groupetag $groupetag): self
    {
        if ($this->groupetags->contains($groupetag)) {
            $this->groupetags->removeElement($groupetag);
            $groupetag->removeTag($this);
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
            $brief->addTag($this);
        }

        return $this;
    }

    public function removeBrief(Brief $brief): self
    {
        if ($this->briefs->contains($brief)) {
            $this->briefs->removeElement($brief);
            $brief->removeTag($this);
        }

        return $this;
    }
}
