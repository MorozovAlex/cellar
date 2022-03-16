<?php

namespace App\Entity;

use App\Repository\ShopCartRepository;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

#[Entity(repositoryClass: ShopCartRepository::class, readOnly: false)]
class ShopCart
{
    #[Id, Column(type: "integer"), GeneratedValue(strategy: "IDENTITY")]
    private int|null $id = null;

    #[Column(type: "string", length: 255)]
    private string $sessionId;

    #[ManyToOne(targetEntity: "ShopItem", cascade: ["all"], inversedBy: "shopCarts")]
    #[JoinColumn(nullable: false)]
    private ?ShopItem $shopItem;

    #[Column(type: "integer")]
    private int $count;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSessionId(): ?string
    {
        return $this->sessionId;
    }

    public function setSessionId(string $sessionId): self
    {
        $this->sessionId = $sessionId;

        return $this;
    }

    public function getShopItem(): ?ShopItem
    {
        return $this->shopItem;
    }

    public function setShopItem(?ShopItem $shopItem): self
    {
        $this->shopItem = $shopItem;

        return $this;
    }

    public function getCount(): ?int
    {
        return $this->count;
    }

    public function setCount(int $count): self
    {
        $this->count = $count;

        return $this;
    }
}