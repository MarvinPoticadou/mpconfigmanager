<?php
namespace Mp\Module\MpConfigManager\Form\Model;

use Mp\Module\MpConfigManager\Entity\Config;
use Symfony\Component\Validator\Constraints as Assert;

class ConfigData
{
    /**
     * @var int
     * @Assert\Type("int")
     */
    public $idShopGroup;

    /**
     * @var int
     * @Assert\Type("int")
     */
    public $idShop;

    /**
     * @var string
     * @Assert\Type("string")
     */
    public $name;

    /**
     * @var string
     * @Assert\Type("string")
     */
    public $value;

    public function __construct(Config $config = null)
    {
        if (!is_null($config)) {
            $this->idShopGroup = $config->getIdShopGroup();
            $this->idShop = $config->getIdShop();
            $this->name = $config->getName();
            $this->value = $config->getValue();
        }
    }
}
