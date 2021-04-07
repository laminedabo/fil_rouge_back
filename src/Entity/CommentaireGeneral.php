<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CommentaireGeneralRepository;

/**
 * @ApiResource(
 *      collectionOperations={
 *          "add_commentaire"={
 *              "method"="POST",
 *              "path"="users/promo/{idp}/apprenant/{ida}/chats",
 *              "security"="is_granted('ROLE_APPRENANT')", 
 *              "security_message"="non autorisé.",
 *          },
 *          "get_commentaire"={
 *              "method"="GET",
 *              "path"="users/promo/{idp}/apprenant/{ida}/chats",
 *              "security"="is_granted('ROLE_APPRENANT')", 
 *              "security_message"="non autorisé.",
 *          }
 *      }
 * )
 * @ORM\Entity(repositoryClass=CommentaireGeneralRepository::class)
 */
class CommentaireGeneral
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $libelle;

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $pj;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="commentaireGenerals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=FilDeDiscussion::class, inversedBy="commentaireGenerals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $filDeDiscussion;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(?string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getPj()
    {
        return $this->pj;
    }

    public function setPj($pj): self
    {
        $this->pj = $pj;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

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

    public function getFilDeDiscussion(): ?FilDeDiscussion
    {
        return $this->filDeDiscussion;
    }

    public function setFilDeDiscussion(?FilDeDiscussion $filDeDiscussion): self
    {
        $this->filDeDiscussion = $filDeDiscussion;

        return $this;
    }
}
