<?php

namespace App\Entity;

use App\Repository\WishListRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WishListRepository::class)]
class WishList
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, WishListsCards>
     */
    #[ORM\OneToMany(targetEntity: WishListsCards::class, mappedBy: 'wishlist')]
    private Collection $wishlistscards;

    #[ORM\ManyToOne(inversedBy: 'wishLists')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function __construct()
    {
        $this->wishlistscards = new ArrayCollection();
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

    /**
     * @return Collection<int, WishListsCards>
     */
    public function getWishListsCards(): Collection
    {
        return $this->wishlistscards;
    }

    public function addCard(WishListsCards $wishlistscards): static
    {
        if (!$this->wishlistscards->contains($wishlistscards)) {
            $this->wishlistscards->add($wishlistscards);
            $wishlistscards->setWishlist($this);
        }

        return $this;
    }

    public function removeCard(WishListsCards $wishlistscards): static
    {
        if ($this->wishlistscards->removeElement($wishlistscards)) {
            // set the owning side to null (unless already changed)
            if ($wishlistscards->getWishlist() === $this) {
                $wishlistscards->setWishlist(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
