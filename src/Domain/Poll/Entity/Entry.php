<?php
declare(strict_types=1);


namespace App\Domain\Poll\Entity;


use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ApiResource(
 *          normalizationContext={"groups"={"entry_read"}},
 *          collectionOperations={
 *              "get",
 *              "post"
 *          },
 *          itemOperations={
 *              "get",
 *              "put"
 *          }
 * )
 */
class Entry
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
    public string $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Domain\Poll\Entity\User", inversedBy="entries")
     * @Groups({"entry_read"})
     */
    private User $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Domain\Poll\Entity\Poll", inversedBy="entries")
     */
    private Poll $poll;

    /**
     * @var Vote[]
     * @ORM\OneToMany(targetEntity="App\Domain\Poll\Entity\Vote", mappedBy="entry")
     */
    private array $votes;

    /**
     * @var Veto[]
     * @ORM\OneToMany(targetEntity="App\Domain\Poll\Entity\Veto", mappedBy="entry")
     */
    private array $vetos;

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

    public function getUser(): User
    {
        return $this->user;
    }
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function getPoll(): Poll
    {
        return $this->poll;
    }

    public function setPoll(Poll $poll): void
    {
        $this->poll = $poll;
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