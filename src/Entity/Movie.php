<?php declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MovieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=MovieRepository::class)
 */
class Movie
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
    private $title;

    /**
     * @ORM\Column(type="integer")
     */
    private $duration;

    /**
     * @ORM\ManyToMany(targetEntity=Type::class, inversedBy="movies")
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity=MovieHasPeople::class, mappedBy="movieId", orphanRemoval=true)
     */
    private $people;

    /**
     * Movie constructor.
     */
    public function __construct()
    {
        $this->type = new ArrayCollection();
        $this->people = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return int
     */
    public function getDuration(): int
    {
        return $this->duration;
    }

    /**
     * @param int $duration
     * @return $this
     */
    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * @return Collection|Type[]
     */
    public function getType(): Collection
    {
        return $this->type;
    }

    /**
     * @param Type $type
     * @return $this
     */
    public function addType(Type $type): self
    {
        if (!$this->type->contains($type)) {
            $this->type[] = $type;
        }

        return $this;
    }

    /**
     * @param Type $type
     * @return $this
     */
    public function removeType(Type $type): self
    {
        $this->type->removeElement($type);

        return $this;
    }

    /**
     * @return Collection|MovieHasPeople[]
     */
    public function getPeople(): Collection
    {
        return $this->people;
    }

    /**
     * @param MovieHasPeople $person
     * @return $this
     */
    public function addPerson(MovieHasPeople $person): self
    {
        if (!$this->people->contains($person)) {
            $this->people[] = $person;
            $person->setMovieId($this);
        }

        return $this;
    }

    /**
     * @param MovieHasPeople $person
     * @return $this
     */
    public function removePerson(MovieHasPeople $person): self
    {
        if ($this->people->removeElement($person)) {
            // set the owning side to null (unless already changed)
            if ($person->getMovieId() === $this) {
                $person->setMovieId(null);
            }
        }

        return $this;
    }
}
