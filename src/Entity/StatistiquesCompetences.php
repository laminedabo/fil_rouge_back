<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\StatistiquesCompetencesRepository;

/**
 * @ORM\Entity(repositoryClass=StatistiquesCompetencesRepository::class)
 * @ApiResource(
 *  collectionOperations={
 *     "GET"={
 *              "security"="is_granted('ROLE_FORMATEUR')",
 *              "security_message"="Vous n'avez pas accès à cette ressource",
 *              "path"="formateurs/promo/{id}/referentiel/{num}/competences",
 *              "normalization_context"={"groups"={"user_read"}}
 *           },
 *     
 *  
 *      "POST"={
 *              "security"="is_granted('ROLE_FORMATEUR')",
 *              "security_message"="Vous n'êtes pas autorisé à faire cette action",
 *              "path"="formateurs/promo/{id}/referentiel/{num}/competences"
 *          },
 * 
 *     "apprenant_brief"={
 *              "method"="GET",
 *              "security"="is_granted('ROLE_APPRENANT')",
 *              "security_message"="Vous n'avez pas accès à cette ressource",
 *              "path"="apprenant/{idAp}/promo/{idPr}/referentiel/{idRef}/statistiques/briefs",
 *              "normalization_context"={"groups"={"user_read"}}
 *           },
 * 
 *     "apprenant_compet"={
 *              "method"="GET",
 *              "security"="is_granted('ROLE_APPRENANT')",
 *              "security_message"="Vous n'avez pas accès à cette ressource",
 *              "path"="api/apprenant/{idAp}/promo/{idPr}/referentiel/{idRef}/competences",
 *              "normalization_context"={"groups"={"user_read"}}
 *           },
 * 
 *     "compet_stats"={
 *              "method"="GET",
 *              "security"="is_granted('ROLE_FORMATEUR')",
 *              "security_message"="Vous n'avez pas accès à cette ressource",
 *              "path"="formateurs/promo/{idPr}/referentiel/{idRef}/statistiques/competences",
 *              "normalization_context"={"groups"={"sc_read"}}
 *           },
 * 
 * 
 *   },
 *     itemOperations={
 *      
 *      "GET"={
 *              "security"="is_granted('ROLE_FORMATEUR')",
 *              "security_message"="Vous n'avez pas accès à cette ressource",
 *              "path"="formateurs/promo_referentiel/competences/{id}"
 *             },
 *     "PUT"={
 *              "security"="is_granted('ROLE_FORMATEUR')",
 *              "security_message"="Vous n'êtes pas autorisé à faire cette action",
 *              "path"="formateurs/promo/{var}/referentiel/{num}/competences/{id}"
 *             }
 *      }
 * )
 */
class StatistiquesCompetences
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Apprenant::class, inversedBy="statistiquesCompetences", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $apprenant;

    /**
     * @ORM\ManyToOne(targetEntity=Referentiel::class, inversedBy="statistiquesCompetences")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"user_read"})
     */
    private $referentiel;

    /**
     * @ORM\ManyToOne(targetEntity=Competence::class, inversedBy="statistiquesCompetences")
     * @Groups({"user_read"})
     */
    private $competence;

    /**
     * @ORM\ManyToOne(targetEntity=Promo::class, inversedBy="statistiquesCompetences")
     */
    private $promo;

    /**
     * @ORM\Column(type="boolean", options={"default":false})
     * @Groups({"user_read"})
     */
    private $niveau1;

    /**
     * @ORM\Column(type="boolean", options={"default":false})
     * @Groups({"user_read"})
     */
    private $niveau2;

    /**
     * @ORM\Column(type="boolean", options={"default":false})
     * @Groups({"user_read"})
     */
    private $niveau3;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getApprenant(): ?Apprenant
    {
        return $this->apprenant;
    }

    public function setApprenant(?Apprenant $apprenant): self
    {
        $this->apprenant = $apprenant;

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

    public function getCompetence(): ?Competence
    {
        return $this->competence;
    }

    public function setCompetence(?Competence $competence): self
    {
        $this->competence = $competence;

        return $this;
    }

    public function getPromo(): ?Promo
    {
        return $this->promo;
    }

    public function setPromo(?Promo $promo): self
    {
        $this->promo = $promo;

        return $this;
    }

    public function getNiveau1(): ?bool
    {
        return $this->niveau1;
    }

    public function setNiveau1(bool $niveau1): self
    {
        $this->niveau1 = $niveau1;

        return $this;
    }

    public function getNiveau2(): ?bool
    {
        return $this->niveau2;
    }

    public function setNiveau2(bool $niveau2): self
    {
        $this->niveau2 = $niveau2;

        return $this;
    }

    public function getNiveau3(): ?bool
    {
        return $this->niveau3;
    }

    public function setNiveau3(bool $niveau3): self
    {
        $this->niveau3 = $niveau3;

        return $this;
    }
}