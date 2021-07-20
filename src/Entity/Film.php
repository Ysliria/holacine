<?php

namespace App\Entity;

use App\Repository\FilmRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FilmRepository::class)
 */
class Film
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="integer")
     */
    private $annee;

    /**
     * @ORM\ManyToOne(targetEntity=Classification::class, inversedBy="films")
     * @ORM\JoinColumn(nullable=false)
     */
    private $classification;

    /**
     * @ORM\ManyToOne(targetEntity=Style::class, inversedBy="films")
     * @ORM\JoinColumn(nullable=false)
     */
    private $style;

    /**
     * @ORM\ManyToOne(targetEntity=Artiste::class, inversedBy="films")
     * @ORM\JoinColumn(nullable=false)
     */
    private $realisateur;

    /**
     * @ORM\ManyToOne(targetEntity=Artiste::class, inversedBy="films")
     * @ORM\JoinColumn(nullable=false)
     */
    private $producteur;

    /**
     * @ORM\ManyToMany(targetEntity=Artiste::class, inversedBy="films")
     */
    private $acteur;

    /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="film", orphanRemoval=true)
     */
    private $commentaires;

    public function __construct()
    {
        $this->acteur = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(int $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getClassification(): ?Classification
    {
        return $this->classification;
    }

    public function setClassification(?Classification $classification): self
    {
        $this->classification = $classification;

        return $this;
    }

    public function getStyle(): ?Style
    {
        return $this->style;
    }

    public function setStyle(?Style $style): self
    {
        $this->style = $style;

        return $this;
    }

    public function getRealisateur(): ?Artiste
    {
        return $this->realisateur;
    }

    public function setRealisateur(?Artiste $realisateur): self
    {
        $this->realisateur = $realisateur;

        return $this;
    }

    public function getProducteur(): ?Artiste
    {
        return $this->producteur;
    }

    public function setProducteur(?Artiste $producteur): self
    {
        $this->producteur = $producteur;

        return $this;
    }

    /**
     * @return Collection|Artiste[]
     */
    public function getActeur(): Collection
    {
        return $this->acteur;
    }

    public function addActeur(Artiste $acteur): self
    {
        if (!$this->acteur->contains($acteur)) {
            $this->acteur[] = $acteur;
        }

        return $this;
    }

    public function removeActeur(Artiste $acteur): self
    {
        $this->acteur->removeElement($acteur);

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
            $commentaire->setFilm($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getFilm() === $this) {
                $commentaire->setFilm(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getTitre();
    }
}
