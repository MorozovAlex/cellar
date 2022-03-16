<?php

namespace App\Entity;

use App\Repository\ShopItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;
use JetBrains\PhpStorm\Pure;

#[Entity(repositoryClass: ShopItemRepository::class, readOnly: false)]
class ShopItem
{
    #[Id, Column(type: "integer"), GeneratedValue(strategy: "IDENTITY")]
    private int|null $id = null;

    #[Column(type: "string", length: 255)]
    private string $price;

    #[Column(type: "string", length: 255)]
    private string $title;

    #[Column(type: "text")]
    private string $description;

    #[OneToMany(
        mappedBy: "shopItem",
        targetEntity: "ShopCart",
        cascade: ["persist", "remove", "merge"],
        orphanRemoval: true)
    ]
    private Collection $shopCarts;

    #[Pure] public function __construct()
    {
        $this->shopCarts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getShopCarts(): Collection
    {
        return $this->shopCarts;
    }

    public function addShopCarts(ShopCart $shopCart): self
    {
        if (!$this->shopCarts->contains($shopCart)) {
            $this->shopCarts[] = $shopCart;
            $shopCart->setShopItem($this);
        }

        return $this;
    }

    public function removeShopCart(ShopCart $shopCart): self
    {
        if ($this->shopCarts->contains($shopCart)) {
            $this->shopCarts->removeElement($shopCart);

            if ($shopCart->getShopItem() === $this) {
                $shopCart->setShopItem(null);
            }
        }

        return $this;
    }
}