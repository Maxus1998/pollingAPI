<?php
declare(strict_types=1);


namespace App\Domain\Poll\Entity;


use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ApiResource
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     * @Groups({"entry_read"})
     */
    private string $id;

    /**
     * @ORM\Column
     * @Groups({"entry_read"})
     */
    private string $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Domain\Poll\Entity\Poll", mappedBy="creator")
     */
    private array $polls;

    /**
     * @ORM\OneToMany(targetEntity="App\Domain\Poll\Entity\Entry", mappedBy="user")
     */
    private array $entries;

    /**
     * @ORM\OneToMany(targetEntity="App\Domain\Poll\Entity\Vote", mappedBy="")
     */
    private array $votes;

    /**
     * @ORM\OneToMany(targetEntity="App\Domain\Poll\Entity\Veto", mappedBy="")
     */
    private array $vetos;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return Poll[]
     */
    public function getPolls(): array
    {
        return $this->polls;
    }

    /**
     * @param Poll[] $polls
     */
    public function setPolls(array $polls): void
    {
        $this->polls = $polls;
    }

    /**
     * @return Entry[]
     */
    public function getEntries(): array
    {
        return $this->entries;
    }

    /**
     * @param Entry[] $entries
     */
    public function setEntries(array $entries): void
    {
        $this->entries = $entries;
    }

    /**
     * @return Vote[]
     */
    public function getVotes(): array
    {
        return $this->votes;
    }

    /**
     * @param Vote[] $votes
     */
    public function setVotes(array $votes): void
    {
        $this->votes = $votes;
    }

    /**
     * @return Veto[]
     */
    public function getVetos(): array
    {
        return $this->vetos;
    }

    /**
     * @param Veto[] $vetos
     */
    public function setVetos(array $vetos): void
    {
        $this->vetos = $vetos;
    }
}