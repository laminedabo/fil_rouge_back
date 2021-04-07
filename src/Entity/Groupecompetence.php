<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\GroupecompetenceRepository;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @UniqueEntity("libelle")
 * @ApiResource(
 *     attributes={
 *          "pagination_items_per_page"=10,
 *          "normalization_context"={"groups"={"Grpcompetence_read"},"enable_max_depth"=true}
 *      },
 *      routePrefix="/admin",
 *     collectionOperations={
 *          "add_groupecompetence"={
 *              "method"="POST",
 *              "path"="/groupecompetences",
 *              "security_post_denormalize"="is_granted('EDIT', object)", 
 *              "security_post_denormalize_message"="Vous n'avez pas ce privilege.",
 *          },
 *         "get"={
 *              "security"="is_granted('ROLE_CM')", 
 *              "security_message"="Vous n'avez pas acces a cette ressource.",
 *              "path"="/groupecompetences"
 *              },
 *          "show_groupecompetence_competence"={
 *              "method"="GET",
 *              "security"="is_granted('ROLE_CM')", 
 *              "security_message"="Vous n'avez pas acces a cette ressource.",
 *              "path"="/groupecompetences/competences",
 *              "normalization_context"={"groups"={"Grpcompetence_competence_read"},"enable_max_depth"=true}
 *              },
 *     },
 *     
 *     itemOperations={
 *         "get"={
 *              "security"="is_granted('VIEW',object)", 
 *              "security_message"="Vous n'avez pas ce privilege.",
 *              "path"="/groupecompetences/{id}",
 *         }, 
 *         "delete"={
 *              "security"="is_granted('DELETE',object)",
 *              "security_message"="Seul le proprietaite....",
 *              "path"="/groupecompetences/{id}",
 *         },
 *         "update_groupecompetence"={
 *              "method"="PATCH",
 *              "security"="is_granted('EDIT',object)", 
 *              "security_message"="Vous n'avez pas ce privilege.",
 *              "path"="/groupecompetences/{id}",
 *         },
 *         "update_groupecompetence"={
 *              "method"="PUT",
 *              "security_post_denormalize"="is_granted('EDIT', object)", 
 *              "security_post_denormalize_message"="Vous n'avez pas ce privilege.",
 *              "path"="/groupecompetences/{id}",
 *         },
 *     },
 * )
 * @ORM\Entity(repositoryClass=GroupecompetenceRepository::class)
 */
class Groupecompetence
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"Grpcompetence_read","referentiel_groupecompetence_read","promo_referentiel","competence_detail_read","referentiel_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\notBlank(message="valeur vide")
     * @Groups({"Grpcompetence_read","referentiel_groupecompetence_read","promo_referentiel","competence_detail_read","referentiel_read"})
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\notBlank(message="valeur vide")
     * @Groups({"Grpcompetence_read","referentiel_groupecompetence_read","promo_referentiel"})
     */
    private $descriptif;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="groupecompetence")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"Grpcompetence_read"})
     * @ApiSubresource()
     */
    private $user;

    /**
     * deleted
     */
    private $referentiels;

    /**
     * @ORM\ManyToMany(targetEntity=Competence::class, inversedBy="groupecompetences", cascade={"persist"})
     * @Groups({"referentiel_read","Grpcompetence_read","Grpcompetence_competence_read","referentiel_groupecompetence_read","promo_referentiel"})
     * @ApiSubresource()
     */
    private $competence;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $statut = "actif";

    public function __construct()
    {
        $this->referentiels = new ArrayCollection();
        $this->competence = new ArrayCollection();
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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

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
            $referentiel->addGroupecompetence($this);
        }

        return $this;
    }

    public function removeReferentiel(Referentiel $referentiel): self
    {
        if ($this->referentiels->contains($referentiel)) {
            $this->referentiels->removeElement($referentiel);
            $referentiel->removeGroupecompetence($this);
        }

        return $this;
    }

    /**
     * @return Collection|Competence[]
     */
    public function getCompetence(): Collection
    {
        return $this->competence;
    }

    public function addCompetence(Competence $competence): self
    {
        if (!$this->competence->contains($competence)) {
            $this->competence[] = $competence;
        }

        return $this;
    }

    public function removeCompetence(Competence $competence): self
    {
        if ($this->competence->contains($competence)) {
            $this->competence->removeElement($competence);
        }

        return $this;
    }

    public function removeMembers(){
        foreach ($this->competence as $cmptce) {
            $this -> removeCompetence($cmptce);
        }
        foreach ($this->referentiels as $ref) {
            $this->removeReferentiel($ref);
        }
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
