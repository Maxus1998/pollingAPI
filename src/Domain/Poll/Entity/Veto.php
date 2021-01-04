<?php
declare(strict_types=1);


namespace App\Domain\Poll\Entity;


use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ApiResource(
 *          normalizationContext={"groups"={"veto_read"}},
 *          denormalizationContext={"groups"={"veto_write"}},
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
class Veto
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     * @Groups({"veto_read", "entry_read", "poll_read", "user_read"})
     */
    private string $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Domain\Poll\Entity\User", inversedBy="vetos")
     * @Groups({"veto_read", "entry_read", "poll_read", "veto_write"})
     */
    private User $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Domain\Poll\Entity\Entry", inversedBy="vetos")
     * @Groups({"veto_read", "user_read", "veto_write"})
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