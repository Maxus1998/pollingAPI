<?php
declare(strict_types=1);


namespace App\Domain\Poll\Entity;


use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ApiResource(
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
     */
    private string $id;

    /**
     * @ORM\Column
     */
    private string $name;

    /**
     * @ORM\Column
     */
    private User $creator;

    /**
     * @ORM\OneToMany(targetEntity="App\Domain\Poll\Entity\Entry", mappedBy="poll")
     * @var Entry[]
     */
    private array $entries;

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
        return $this->entries;
    }

    /**
     * @param Entry[] $entries
     */
    public function setEntries(array $entries): void
    {
        $this->entries = $entries;
    }
}