<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity({"username","email"})
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"user" = "User", "apprenant" = "Apprenant", "formateur" = "Formateur", "cm" = "CM"})
 * 
 * @ApiResource(
 *     attributes={
 *          "security"="is_granted('ROLE_ADMIN')",
 *          "pagination_items_per_page"=10, 
*           "normalization_context"={"groups"={"user_read","user_details_read","gprincipal_read"}}
 *     },
 *      routePrefix="/admin",
 *     collectionOperations={
 *          "add_user"={
 *              "method"="POST",
 *              "path"="/users",
 *              "security"="is_granted('ROLE_ADMIN')",
 *              "security_message"="Vous n'avez pas le privilege"
 *          },
 *         "get"={
 *              "security"="is_granted('ROLE_ADMIN')", 
 *              "security_message"="Vous n'avez pas acces a cette ressource.",
 *              "path"="/users",
 *          },
 *          "get_admins"={
 *              "method"="GET",
 *              "path"="s",
 *              "security"="(is_granted('ROLE_ADMIN'))", 
 *              "security_message"="Vous n'avez pas acces a cette ressource.",
 *              "route_name"="admin_liste",
 *              "normalization_context"={"groups"={"admin_read"}}
 *          }
 *     },
 *     
 *     itemOperations={
 *          "update_user"={
 *              "method"="PUT",
 *              "path"="/users/{id}",
 *              "security"="is_granted('ROLE_ADMIN')",
 *              "security_message"="action non autorisée",
 *              "requirements"={"id"="\d+"},
 *          },
 *         "get"={
 *              "security"="is_granted('ROLE_ADMIN')", 
 *              "security_message"="Vous n'avez pas ces privileges.",
 *              "normalization_context"={"groups"={"user_read","user_details_read"}},
 *              "path"="/users/{id}",
 *              "requirements"={"id"="\d+"},
 *          },
 *          "get_admin"={
 *              "method"="GET",
 *              "path"="s/{id}",
 *              "requirements"={"id"="\d+"},
 *              "security"="(is_granted('ROLE_FORMATEUR'))",
 *              "security_message"="Vous n'avez pas access à cette Ressource"
 *          }, 
 *         "delete"={
 *              "security"="is_granted('ROLE_ADMIN')",
 *              "security_message"="Vous n'avez pas ces privileges.",
 *              "path"="/users/{id}",
 *              "requirements"={"id"="\d+"},
 *          },
 *         "patch"={
 *              "security"="is_granted('ROLE_ADMIN')", 
 *              "security_message"="Vous n'avez pas ces privileges.",
 *              "path"="/users/{id}",
 *              "requirements"={"id"="\d+"},
 *          }
 *     },
 * )
 * @ApiFilter(SearchFilter::class, properties={"id": "exact", "profil.libelle":"exact", "profil.id":"exact", "lastLogin":"exact", "statut":"exact"})
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"profilsortie_apprenants_read","user_read","apprenant_read","profil_read","promo_read","gprincipal_read","gproupe_read","gproupe_apprenant_read","promo_groupe_apprenants","promo_groupe_formateurs","brief_promo","apprenant_promo_brief","brief_groupe_promo","all_brief_read","brief_promo","brief_apprenant_promo","promo_id_brief"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\NotBlank(message = "valeur null")
     * @Groups({"user_read","apprenant_read","profil_read","profilsortie_apprenants_read","promo_read","gprincipal_read","gproupe_read","gproupe_apprenant_read","promo_groupe_apprenants","promo_groupe_formateurs","brief_promo","apprenant_promo_brief","brief_groupe_promo","all_brief_read","brief_promo","brief_apprenant_promo","promo_id_brief"})
     */
    private $username;

    /**
     * @Groups({"user_details_read"})
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message = "mot de passe null")
     */
    private $password;

    /**
     * @ORM\Column(type="blob", nullable=true)
     * @Groups({"user_read","promo_read",})
     */
    private $avatar;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user_read","apprenant_read","profil_read","promo_read","gprincipal_read","gproupe_read","gproupe_apprenant_read","promo_groupe_apprenants","promo_groupe_formateurs","brief_promo","apprenant_promo_brief","apprenant_promo_brief","brief_groupe_promo","all_brief_read","brief_promo","brief_apprenant_promo","promo_id_brief","profilsortie_apprenants_read"})
     */
    private $prenom;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user_read","apprenant_read","profil_read","promo_read","gprincipal_read","gproupe_read","gproupe_apprenant_read","promo_groupe_apprenants","promo_groupe_formateurs","brief_promo","apprenant_promo_brief","brief_groupe_promo","all_brief_read","brief_promo","brief_apprenant_promo","promo_id_brief","profilsortie_apprenants_read"})
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(message = "email invalide.")
     * @Assert\NotBlank(message = "email vide")
     * @Groups({"user_read","apprenant_read","profil_read","promo_read","gprincipal_read","gproupe_read","gproupe_apprenant_read","promo_groupe_apprenants","promo_groupe_formateurs","brief_promo","apprenant_promo_brief","profilsortie_apprenants_read"})
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, options={"default":"actif"})
     * @Groups({"user_read"})
     */
    private $statut = "actif";

    /**
     * @ORM\ManyToOne(targetEntity=Profil::class, inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"user_read","promo_read",})
     */
    private $profil;

    /**
     * @ORM\OneToMany(targetEntity=Promo::class, mappedBy="user", orphanRemoval=true)
     * @Groups({"user_details_read"})
     */
    private $promo;

    /**
     * @ORM\OneToMany(targetEntity=Groupecompetence::class, mappedBy="user", orphanRemoval=true)
     * @Groups({"user_details_read"})
     */
    private $groupecompetence;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"user_read","apprenant_read","promo_read",})
     */
    private $lastLogin;

    /**
     * @ORM\OneToMany(targetEntity=CommentaireGeneral::class, mappedBy="user", orphanRemoval=true)
     */
    private $commentaireGenerals;

    /**
     * @Groups({"user_read","promo_read",})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse;

    public function __construct()
    {
        $this->promo = new ArrayCollection();
        $this->groupecompetence = new ArrayCollection();
        $this->commentaireGenerals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_'.$this->profil->getLibelle();

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getPhoto()
    {
        return $this->avatar;
    }

    public function setAvatar($avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }
    

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getProfil(): ?Profil
    {
        return $this->profil;
    }

    public function setProfil(?Profil $profil): self
    {
        $this->profil = $profil;

        return $this;
    }

    /**
     * @return Collection|Promo[]
     */
    public function getPromo(): Collection
    {
        return $this->promo;
    }

    public function addPromo(Promo $promo): self
    {
        if (!$this->promo->contains($promo)) {
            $this->promo[] = $promo;
            $promo->setUser($this);
        }

        return $this;
    }

    public function removePromo(Promo $promo): self
    {
        if ($this->promo->contains($promo)) {
            $this->promo->removeElement($promo);
            // set the owning side to null (unless already changed)
            if ($promo->getUser() === $this) {
                $promo->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Groupecompetence[]
     */
    public function getGroupecompetence(): Collection
    {
        return $this->groupecompetence;
    }

    public function addGroupecompetence(Groupecompetence $groupecompetence): self
    {
        if (!$this->groupecompetence->contains($groupecompetence)) {
            $this->groupecompetence[] = $groupecompetence;
            $groupecompetence->setUser($this);
        }

        return $this;
    }

    public function removeGroupecompetence(Groupecompetence $groupecompetence): self
    {
        if ($this->groupecompetence->contains($groupecompetence)) {
            $this->groupecompetence->removeElement($groupecompetence);
            // set the owning side to null (unless already changed)
            if ($groupecompetence->getUser() === $this) {
                $groupecompetence->setUser(null);
            }
        }

        return $this;
    }

    public function getLastLogin(): ?\DateTimeInterface
    {
        return $this->lastLogin;
    }

    public function setLastLogin(?\DateTimeInterface $lastLogin): self
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    /**
     * @return Collection|CommentaireGeneral[]
     */
    public function getCommentaireGenerals(): Collection
    {
        return $this->commentaireGenerals;
    }

    public function addCommentaireGeneral(CommentaireGeneral $commentaireGeneral): self
    {
        if (!$this->commentaireGenerals->contains($commentaireGeneral)) {
            $this->commentaireGenerals[] = $commentaireGeneral;
            $commentaireGeneral->setUser($this);
        }

        return $this;
    }

    public function removeCommentaireGeneral(CommentaireGeneral $commentaireGeneral): self
    {
        if ($this->commentaireGenerals->contains($commentaireGeneral)) {
            $this->commentaireGenerals->removeElement($commentaireGeneral);
            // set the owning side to null (unless already changed)
            if ($commentaireGeneral->getUser() === $this) {
                $commentaireGeneral->setUser(null);
            }
        }

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }
}
