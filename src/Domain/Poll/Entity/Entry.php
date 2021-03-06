<?php
declare(strict_types=1);


namespace App\Domain\Poll\Entity;


use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ApiResource(
 *          normalizationContext={"groups"={"entry_read"}},
 *          denormalizationContext={"groups"={"entry_write"}},
 *          collectionOperations={
 *              "get",
 *              "post"
 *          },
 *          itemOperations={
 *              "get",
 *              "delete"
 *          }
 * )
 */
class Entry
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     * @Groups({"entry_read", "poll_read", "veto_read", "vote_read", "user_read"})
     */
    private string $id;

    /**
     * @ORM\Column
     * @Groups({"entry_read", "poll_read", "veto_read", "vote_read", "user_read", "poll_write", "entry_write"})
     */
    public string $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Domain\Poll\Entity\User", inversedBy="entries")
     * @Groups({"entry_read", "poll_read", "veto_read", "vote_read", "poll_write", "entry_write"})
     */
    private User $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Domain\Poll\Entity\Poll", inversedBy="entries")
     * @Groups({"entry_read", "veto_read", "entry_write"})
     */
    private Poll $poll;

    /**
     * @var Vote[]
     * @ORM\OneToMany(targetEntity="App\Domain\Poll\Entity\Vote", mappedBy="entry")
     * @Groups({"entry_read", "poll_read"})
     */
    private Collection $votes;

    /**
     * @var Veto[]
     * @ORM\OneToMany(targetEntity="App\Domain\Poll\Entity\Veto", mappedBy="entry")
     * @Groups({"entry_read", "poll_read"})
     */
    private Collection $vetos;

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
        return $this->votes->toArray();
    }

    /**
     * @param Vote[] $votes
     */
    public function setVotes(array $votes): void
    {
        $this->votes = new ArrayCollection($votes);
    }

    /**
     * @return Veto[]
     */
    public function getVetos(): array
    {
        return $this->vetos->toArray();
    }

    /**
     * @param Veto[] $vetos
     */
    public function setVetos(array $vetos): void
    {
        $this->vetos = new ArrayCollection($vetos);
    }
}