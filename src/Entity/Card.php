<?php

namespace App\Entity;

use App\Repository\CardRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: CardRepository::class)]
#[ApiResource]
class Card
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $rarity = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(length: 255)]
    private ?string $shortcut_name = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(nullable: true)]
    private ?array $particularity = null;

    /**
     * @var Collection<int, UserCollection>
     */
    #[ORM\OneToMany(targetEntity: UserCollection::class, mappedBy: 'card')]
    private Collection $users;

    #[ORM\ManyToOne(inversedBy: 'cards')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Extension $extension = null;

    /**
     * @var Collection<int, WishListsCards>
     */
    #[ORM\OneToMany(targetEntity: WishListsCards::class, mappedBy: 'card')]
    private Collection $wishListsCards;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->wishListsCards = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getRarity(): ?string
    {
        return $this->rarity;
    }

    public function setRarity(string $rarity): static
    {
        $this->rarity = $rarity;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getShortcutName(): ?string
    {
        return $this->shortcut_name;
    }

    public function setShortcutName(string $shortcut_name): static
    {
        $this->shortcut_name = $shortcut_name;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getParticularity(): ?array
    {
        return $this->particularity;
    }

    public function setParticularity(?array $particularity): static
    {
        $this->particularity = $particularity;

        return $this;
    }

    /**
     * @return Collection<int, UserCollection>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(UserCollection $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setCard($this);
        }

        return $this;
    }

    public function removeUser(UserCollection $user): static
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getCard() === $this) {
                $user->setCard(null);
            }
        }

        return $this;
    }

    public function getExtension(): ?Extension
    {
        return $this->extension;
    }

    public function setExtension(?Extension $extension): static
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * @return Collection<int, WishListsCards>
     */
    public function getWishListsCards(): Collection
    {
        return $this->wishListsCards;
    }

    public function addWishListsCard(WishListsCards $wishListsCard): static
    {
        if (!$this->wishListsCards->contains($wishListsCard)) {
            $this->wishListsCards->add($wishListsCard);
            $wishListsCard->setCard($this);
        }

        return $this;
    }

    public function removeWishListsCard(WishListsCards $wishListsCard): static
    {
        if ($this->wishListsCards->removeElement($wishListsCard)) {
            // set the owning side to null (unless already changed)
            if ($wishListsCard->getCard() === $this) {
                $wishListsCard->setCard(null);
            }
        }

        return $this;
    }

}
