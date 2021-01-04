<?php
declare(strict_types=1);


namespace App\Domain\Poll\Entity;


use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ApiResource(
 *          normalizationContext={"groups"={"vote_read"}}
 * )
 */
class Vote
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     * @Groups({"vote_read", "entry_read", "poll_read"})
     */
    private string $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Domain\Poll\Entity\User", inversedBy="votes")
     * @Groups({"vote_read", "entry_read", "poll_read"})
     */
    private User $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Domain\Poll\Entity\Entry", inversedBy="votes")
     * @Groups({"vote_read"})
     */
    private Entry $entry;

    public function getId(): string
    {
        return $this->id;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function getEntry(): Entry
    {
        return $this->entry;
    }
    public function setEntry(Entry $entry): void
    {
        $this->entry = $entry;
    }
}