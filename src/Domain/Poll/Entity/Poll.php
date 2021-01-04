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
 *     normalizationContext={"groups"={"poll_read"}},
 *     collectionOperations={
 *          "get",
 *          "post"
 *     },
 *     itemOperations={
 *          "get"
 *     }
 * )
 */
class Poll
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     * @Groups({"poll_read", "entry_read", "veto_read", "vote_read"})
     */
    private string $id;

    /**
     * @ORM\Column
     * @Groups({"poll_read", "entry_read", "veto_read", "vote_read"})
     */
    private string $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Domain\Poll\Entity\User", inversedBy="polls")
     * @Groups({"poll_read", "entry_read", "veto_read", "vote_read"})
     */
    private User $creator;

    /**
     * @ORM\OneToMany(targetEntity="App\Domain\Poll\Entity\Entry", mappedBy="poll")
     * @Groups({"poll_read"})
     * @var Entry[]
     */
    private Collection $entries;

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

    public function getCreator(): User
    {
        return $this->creator;
    }

    public function setCreator(User $creator): void
    {
        $this->creator = $creator;
    }

    /**
     * @return Entry[]
     */
    public function getEntries(): array
    {
        return $this->entries->toArray();
    }

    /**
     * @param Entry[] $entries
     */
    public function setEntries(array $entries): void
    {
        $this->entries = new ArrayCollection($entries);
    }
}