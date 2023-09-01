<?php

namespace Mp\Module\MpConfigManager\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * @ORM\Entity
 * @ORM\Table("ps_configuration")
 */
class Config
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id_configuration")
     */
    private $id;

    /**
     * @var int|null
     * @ORM\Column(name="id_shop_group", nullable=true)
     */
    private $idShopGroup;

    /**
     * @var int|null
     * @ORM\Column(name="id_shop", nullable=true)
     */
    private $idShop;

    /**
     * @var string
     * @ORM\Column(name="name", length=255)
     */
    private $name;

    /**
     * @var string|null
     * @ORM\Column(name="value", nullable=true, length=255)
     */
    private $value;

    /**
     * @var DateTime
     * @ORM\Column(name="date_add", type="datetime")
     */
    private $createdAt;

    /**
     * @var DateTime
     * @ORM\Column(name="date_upd", type="datetime")
     */
    private $updatedAt;

    public function __construct()
    {
        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getIdShopGroup(): ?int
    {
        return $this->idShopGroup;
    }

    /**
     * @param int|null $idShopGroup
     * @return Config
     */
    public function setIdShopGroup(?int $idShopGroup): Config
    {
        $this->idShopGroup = $idShopGroup;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getIdShop(): ?int
    {
        return $this->idShop;
    }

    /**
     * @param int|null $idShop
     * @return Config
     */
    public function setIdShop(?int $idShop): Config
    {
        $this->idShop = $idShop;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Config
     */
    public function setName(string $name): Config
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @param string|null $value
     * @return Config
     */
    public function setValue(?string $value): Config
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     * @return Config
     */
    public function setCreatedAt(DateTime $createdAt): Config
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime $updatedAt
     * @return Config
     */
    public function setUpdatedAt(DateTime $updatedAt): Config
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}
