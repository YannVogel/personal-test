<?php declare(strict_types=1);

namespace App\Entity;

use App\Repository\MovieHasPeopleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MovieHasPeopleRepository::class)
 */
class MovieHasPeople
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Movie::class, inversedBy="people")
     * @ORM\JoinColumn(nullable=false)
     */
    private $movie;

    /**
     * @ORM\ManyToOne(targetEntity=People::class, inversedBy="movies")
     * @ORM\JoinColumn(nullable=false)
     */
    private $people;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $role;

    /**
     * @ORM\Column(type="string", length=10, nullable=true, columnDefinition="enum('principal', 'secondaire')")
     */
    private $significance;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Movie|null
     */
    public function getMovieId(): ?Movie
    {
        return $this->movie;
    }

    /**
     * @param Movie|null $movie
     * @return $this
     */
    public function setMovieId(?Movie $movie): self
    {
        $this->movie = $movie;

        return $this;
    }

    /**
     * @return People|null
     */
    public function getPeopleId(): ?People
    {
        return $this->people;
    }

    /**
     * @param People|null $people
     * @return $this
     */
    public function setPeopleId(?People $people): self
    {
        $this->people = $people;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRole(): ?string
    {
        return $this->role;
    }

    /**
     * @param string $role
     * @return $this
     */
    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSignificance(): ?string
    {
        return $this->significance;
    }

    /**
     * @param string|null $significance
     * @return $this
     */
    public function setSignificance(?string $significance): self
    {
        $this->significance = $significance;

        return $this;
    }
}
