<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\GroupetagRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 * attributes={
 *          "pagination_items_per_page"=10,
 *          "normalization_context"={"groups"={"Grptags_read","Grptags_tags_read"},"enable_max_depth"=true}
 *      },
 *      routePrefix="/admin",
 *     collectionOperations={
 *          "add_groupetags"={
 *              "method"="POST",
 *              "path"="/groupetags",
 *              "security_post_denormalize"="is_granted('EDIT', object)", 
 *              "security_post_denormalize_message"="Vous n'avez pas ce privilege.",
 *          },
 *         "get"={
 *              "security"="is_granted('ROLE_CM')", 
 *              "security_message"="Vous n'avez pas acces a cette ressource.",
 *              "path"="/groupetags",
 *               
 *         },
 *         "show_groupetags"={
 *              "method"="GET",
 *              "security"="is_granted('ROLE_CM')", 
 *              "security_message"="Vous n'avez pas acces a cette ressource.",
 *              "path"="/groupetags",
 *         },
 *         "show_groupetags_tags"={
 *              "method"="GET",
 *              "security"="is_granted('ROLE_FORMATEUR')", 
 *              "security_message"="Vous n'avez pas acces a cette ressource.",
 *              "path"="/groupetags/tags",
 *              "normalization_context"={"groups"={"Grptags_tags_read"},"enable_max_depth"=true}
 *              
 *         }
 *     },
 *     
 *     itemOperations={
 *         "get"={
 *              "security"="is_granted('ROLE_FORMATEUR')", 
 *              "security_message"="Vous n'avez pas ce privilege.",
 *              "path"="/groupetags/{id}",
 *         }, 
 *         "delete"={
 *              "security"="is_granted('DELETE',object)",
 *              "security_message"="Seul le proprietaite....",
 *              "path"="/groupetags/{id}",
 *         },
 *         "updateGroupeGroupetag"={
 *              "method"="PATCH",
 *              "security"="is_granted('EDIT',object)", 
 *              "security_message"="Vous n'avez pas ce privilege.",
 *              "path"="/groupetags/{id}",
 *         },
 *         "updateGroupeGroupetag"={
 *              "method"="PUT",
 *              "security_post_denormalize"="is_granted('EDIT', object)", 
 *              "security_post_denormalize_message"="Vous n'avez pas ce privilege.",
 *              "path"="/groupetags/{id}",
 *         },
 *     },
 * )
 * 
 * )
 * @ORM\Entity(repositoryClass=GroupetagRepository::class)
 */
class Groupetag
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"Grptags_read","Grptags_tags_read"})
     */
    private $id;

    /**
     * @Assert\NotBlank(message = "libelle nulle")
     * @ORM\Column(type="string", length=255)
     * @Groups({"Grptags_read","Grptags_tags_read"})
     */
    private $libelle;

    /**
     * @ORM\ManyToMany(targetEntity=Tag::class, inversedBy="groupetags",cascade={"persist"})
     * @Groups({"Grptags_read","Grptags_tags_read"})
     * 
     * @ApiSubresource()
     */
    private $tag;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $lastUpdate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $statut = "actif";

    public function __construct()
    {
        $this->tag = new ArrayCollection();
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
     * @return Collection|Tag[]
     */
    public function getTag(): Collection
    {
        return $this->tag;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tag->contains($tag)) {
            $this->tag[] = $tag;
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tag->contains($tag)) {
            $this->tag->removeElement($tag);
        }

        return $this;
    }

    public function removeMembers(){
        // foreach ($this->tag as  $tag) {
        //     $this->removeTag($tag);
        // }
    }

    public function getLastUpdate(): ?\DateTimeInterface
    {
        return $this->lastUpdate;
    }

    public function setLastUpdate(?\DateTimeInterface $lastUpdate): self
    {
        $this->lastUpdate = $lastUpdate;

        return $this;
    }

    /**
     * @ORM\PreUpdate()
     */
    public function preUpdate(){
        $this -> setLastUpdate(new \DateTime());
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
