<?php
/**
 * Shopware 5
 * Copyright (c) shopware AG
 *
 * According to our dual licensing model, this program can be used either
 * under the terms of the GNU Affero General Public License, version 3,
 * or under a proprietary license.
 *
 * The texts of the GNU Affero General Public License with an additional
 * permission and of our proprietary license can be found at and
 * in the LICENSE file you have received along with this program.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * "Shopware" is a registered trademark of shopware AG.
 * The licensing of the program under the AGPLv3 does not imply a
 * trademark license. Therefore any rights, title and interest in
 * our trademarks remain entirely with us.
 */

namespace Shopware\Models\Article;

use Doctrine\ORM\Mapping as ORM;
use Shopware\Components\Model\ModelEntity;

/**
 * @deprecated since 5.2 will be removed in 6.0, use \Shopware\Models\Attribute\Configuration instead
 *
 * @ORM\Table(name="s_core_engine_elements")
 * @ORM\Entity
 */
class Element extends ModelEntity
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", nullable=false)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(name="type", type="string", nullable=false)
     */
    private $type;

    /**
     * @var string
     * @ORM\Column(name="`default`", type="string", nullable=true)
     */
    private $default;

    /**
     * @var string
     * @ORM\Column(name="store", type="string", nullable=true)
     */
    private $store;

    /**
     * @var string
     * @ORM\Column(name="label", type="string", nullable=true)
     */
    private $label;

    /**
     * @var bool
     * @ORM\Column(name="required", type="boolean")
     */
    private $required = false;

    /**
     * @var string
     * @ORM\Column(name="help", type="string", nullable=true)
     */
    private $help;

    /**
     * @var bool
     * @ORM\Column(name="translatable", type="boolean")
     */
    private $translatable = false;

    /**
     * @var bool
     * @ORM\Column(name="variantable", type="boolean")
     */
    private $variantable = false;

    /**
     * @var string
     * @ORM\Column(name="position", type="integer", nullable=false)
     */
    private $position = 0;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * @param string $name
     *
     * @return Element
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }


    /**
     * @param string $type
     *
     * @return Element
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getDefault()
    {
        return $this->default;
    }


    /**
     * @param string $default
     *
     * @return Element
     */
    public function setDefault($default)
    {
        $this->default = $default;

        return $this;
    }

    /**
     * @return string
     */
    public function getStore()
    {
        return $this->store;
    }


    /**
     * @param string $store
     *
     * @return Element
     */
    public function setStore($store)
    {
        $this->store = $store;

        return $this;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }


    /**
     * @param string $label
     *
     * @return Element
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return bool
     */
    public function getRequired()
    {
        return $this->required;
    }


    /**
     * @param bool $required
     *
     * @return Element
     */
    public function setRequired($required)
    {
        $this->required = $required;

        return $this;
    }

    /**
     * @return string
     */
    public function getHelp()
    {
        return $this->help;
    }


    /**
     * @param string $help
     *
     * @return Element
     */
    public function setHelp($help)
    {
        $this->help = $help;

        return $this;
    }

    /**
     * @return bool
     */
    public function getTranslatable()
    {
        return $this->translatable;
    }


    /**
     * @param bool $translatable
     *
     * @return Element
     */
    public function setTranslatable($translatable)
    {
        $this->translatable = $translatable;

        return $this;
    }

    /**
     * @return bool
     */
    public function getVariantable()
    {
        return $this->variantable;
    }


    /**
     * @param bool $variantable
     *
     * @return Element
     */
    public function setVariantable($variantable)
    {
        $this->variantable = $variantable;

        return $this;
    }

    /**
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }


    /**
     * @param string $position
     *
     * @return Element
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }
}
