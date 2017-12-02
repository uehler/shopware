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

namespace Shopware\Models\Emotion;

use Doctrine\ORM\Mapping as ORM;
use Shopware\Components\Model\ModelEntity;

/**
 * The Shopware Emotion Model enables you to adapt the view of a category individually according to a grid system.
 * Every emotion is assigned to a certain grid which consists of several rows and columns.
 * The width and height of the cells resulting from the columns and rows can be configured individually.
 * Again, a grid which is assigned to an emotion is assigned to multiple other grid components.
 * A grid element may extend over several cells. The grid elements can be filled with components
 * from the component library, such as banners, items or text elements.
 *
 * @category   Shopware
 *
 * @copyright  Copyright (c) shopware AG (http://www.shopware.de)
 *
 * @ORM\Entity(repositoryClass="Repository")
 * @ORM\Table(name="s_emotion")
 * @ORM\HasLifecycleCallbacks
 */
class Emotion extends ModelEntity
{
    /**
     * Contains the assigned \Shopware\Models\Category\Category
     * which can be configured in the backend emotion module.
     * The assigned grid will be displayed in front of the categories.
     *
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\ManyToMany(targetEntity="Shopware\Models\Category\Category", inversedBy="emotions")
     * @ORM\JoinTable(name="s_emotion_categories",
     *      joinColumns={
     *          @ORM\JoinColumn(name="emotion_id", referencedColumnName="id")
     *      },
     *      inverseJoinColumns={
     *          @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     *      }
     * )
     */
    protected $categories;

    /**
     * OWNING SIDE
     * Contains the assigned \Shopware\Models\User\User which created this emotion.
     *
     * @var \Shopware\Models\User\User
     * @ORM\ManyToOne(targetEntity="Shopware\Models\User\User")
     * @ORM\JoinColumn(name="userID", referencedColumnName="id")
     */
    protected $user;

    /**
     * INVERSE SIDE
     * Contains all the assigned \Shopware\Models\Emotion\Element models.
     * The element model contains the configuration about the size and position of the element
     * and the assigned \Shopware\Models\Emotion\Library\Component which contains the data configuration.
     *
     * @ORM\OneToMany(targetEntity="Shopware\Models\Emotion\Element", mappedBy="emotion", orphanRemoval=true, cascade={"persist"})
     *
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $elements;

    /**
     * INVERSE SIDE
     *
     * @ORM\OneToOne(targetEntity="Shopware\Models\Attribute\Emotion", mappedBy="emotion", orphanRemoval=true, cascade={"persist"})
     *
     * @var \Shopware\Models\Attribute\Emotion
     */
    protected $attribute;

    /**
     * @var bool
     * @ORM\Column(name="show_listing", type="boolean", nullable=false)
     */
    protected $showListing;

    /**
     * @var
     * @ORM\Column(name="template_id", type="integer", nullable=true)
     */
    protected $templateId = null;

    /**
     * @var Template
     * @ORM\ManyToOne(targetEntity="Shopware\Models\Emotion\Template", inversedBy="emotions")
     * @ORM\JoinColumn(name="template_id", referencedColumnName="id")
     */
    protected $template;
    /**
     * Unique identifier field for the shopware emotion.
     *
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="parent_id", type="integer", nullable=true)
     */
    private $parentId = null;

    /**
     * Is this emotion active
     *
     * @var int
     *
     * @ORM\Column(name="active", type="integer", nullable=false)
     */
    private $active;

    /**
     * Contains the name of the emotion.
     *
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * Id of the associated \Shopware\Models\User\User which
     * created this emotion.
     *
     * @var int
     *
     * @ORM\Column(name="userID", type="integer", nullable=false)
     */
    private $userId;

    /**
     * @var int
     *
     * @ORM\Column(name="position", type="integer", nullable=false)
     */
    private $position = 1;

    /**
     * @var int
     *
     * @ORM\Column(name="device", type="string", length=255, nullable=true)
     */
    private $device;

    /**
     * @var int
     *
     * @ORM\Column(name="fullscreen", type="integer", nullable=false)
     */
    private $fullscreen;

    /**
     * With the $validFrom and $validTo property you can define
     * a date range in which the emotion will be displayed.
     *
     * @var \DateTime
     *
     * @ORM\Column(name="valid_from", type="datetime", nullable=true)
     */
    private $validFrom;

    /**
     * @var int
     *
     * @ORM\Column(name="is_landingpage", type="integer", nullable=false)
     */
    private $isLandingPage;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_title", type="string",length=255, nullable=false)
     */
    private $seoTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_keywords", type="string",length=255, nullable=false)
     */
    private $seoKeywords;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_description", type="string",length=255, nullable=false)
     */
    private $seoDescription;

    /**
     * With the $validFrom and $validTo property you can define
     * a date range in which the emotion will be displayed.
     *
     * @var \DateTime
     *
     * @ORM\Column(name="valid_to", type="datetime", nullable=true)
     */
    private $validTo;

    /**
     * Create date of the emotion.
     *
     * @var \DateTime
     *
     * @ORM\Column(name="create_date", type="datetime", nullable=false)
     */
    private $createDate;

    /**
     * Date of the last edit.
     *
     * @var \DateTime
     *
     * @ORM\Column(name="modified", type="datetime", nullable=false)
     */
    private $modified;

    /**
     * @var int
     * @ORM\Column(name="`rows`", type="integer", nullable=false)
     */
    private $rows;

    /**
     * @var int
     * @ORM\Column(name="cols", type="integer", nullable=false)
     */
    private $cols;

    /**
     * @var int
     * @ORM\Column(name="cell_spacing", type="integer", nullable=false)
     */
    private $cellSpacing;

    /**
     * @var int
     * @ORM\Column(name="cell_height", type="integer", nullable=false)
     */
    private $cellHeight;

    /**
     * @var int
     * @ORM\Column(name="article_height", type="integer", nullable=false)
     */
    private $articleHeight;

    /**
     * Contains the assigned Shopware\Models\Shop\Shop.
     * Used for shop limitation of single emotion landingpages.
     *
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\ManyToMany(targetEntity="Shopware\Models\Shop\Shop")
     * @ORM\JoinTable(name="s_emotion_shops",
     *      joinColumns={
     *          @ORM\JoinColumn(name="emotion_id", referencedColumnName="id"
     *      )},
     *      inverseJoinColumns={
     *          @ORM\JoinColumn(name="shop_id", referencedColumnName="id")
     *      }
     * )
     */
    private $shops;

    /**
     * Contains the responsive mode of the emotion.
     *
     * @var string
     *
     * @ORM\Column(name="mode", type="string", length=255, nullable=false)
     */
    private $mode;

    /**
     * @var int
     *
     * @ORM\Column(name="preview_id", type="integer", nullable=true)
     */
    private $previewId;

    /**
     * @var string
     *
     * @ORM\Column(name="preview_secret", type="string", nullable=true)
     */
    private $previewSecret;

    /**
     * @var string
     * @ORM\Column(name="customer_stream_ids", type="string", nullable=true)
     */
    private $customerStreamIds;

    /**
     * @var string|null
     * @ORM\Column(name="replacement", type="string", nullable=true)
     */
    private $replacement;

    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->shops = new \Doctrine\Common\Collections\ArrayCollection();
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
        $this->elements = new \Doctrine\Common\Collections\ArrayCollection();

        $this->setRows(20);
        $this->setCols(4);
        $this->setCellSpacing(10);
        $this->setCellHeight(185);
        $this->setArticleHeight(2);
    }

    public function __clone()
    {
        $this->id = null;

        $categories = [];
        foreach ($this->getCategories() as $category) {
            $categories[] = $category;
        }

        $elements = [];
        /** @var $element Element */
        foreach ($this->getElements() as $element) {
            $newElement = clone $element;
            $newElement->setEmotion($this);

            if ($newElement->getData()) {
                /** @var $data Data */
                foreach ($newElement->getData() as $data) {
                    $data->setEmotion($this);
                }
            }

            $elements[] = $newElement;
        }

        if ($attribute = $this->getAttribute()) {
            /** @var Shopware\Models\Attribute\Emotion $newAttribute */
            $newAttribute = clone $attribute;
            $newAttribute->setEmotion($this);
            $this->attribute = $newAttribute;
        }

        $this->elements = $elements;
        $this->categories = $categories;
    }

    /**
     * Unique identifier field for the shopware emotion.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Contains the name of the emotion.
     *
     * @param string $name
     *
     * @return Emotion
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Contains the name of the emotion.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * Create date of the emotion.
     *
     * @param \DateTime|string $createDate
     *
     * @return Emotion
     */
    public function setCreateDate($createDate = 'now')
    {
        if ($createDate !== null && !($createDate instanceof \DateTime)) {
            $this->createDate = new \DateTime($createDate);
        } else {
            $this->createDate = $createDate;
        }

        return $this;
    }

    /**
     * Create date of the emotion.
     *
     * @return \DateTime
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }


    /**
     * With the $validFrom and $validTo property you can define
     * a date range in which the emotion will be displayed.
     *
     * @param \DateTime|string $validFrom
     *
     * @return Emotion
     */
    public function setValidFrom($validFrom)
    {
        if ($validFrom !== null && !($validFrom instanceof \DateTime)) {
            $this->validFrom = new \DateTime($validFrom);
        } else {
            $this->validFrom = $validFrom;
        }

        return $this;
    }

    /**
     * With the $validFrom and $validTo property you can define
     * a date range in which the emotion will be displayed.
     *
     * @return \DateTime
     */
    public function getValidFrom()
    {
        return $this->validFrom;
    }


    /**
     * With the $validFrom and $validTo property you can define
     * a date range in which the emotion will be displayed.
     *
     * @param \DateTime|string $validTo
     *
     * @return Emotion
     */
    public function setValidTo($validTo)
    {
        if ($validTo !== null && !($validTo instanceof \DateTime)) {
            $this->validTo = new \DateTime($validTo);
        } else {
            $this->validTo = $validTo;
        }

        return $this;
    }

    /**
     * With the $validFrom and $validTo property you can define
     * a date range in which the emotion will be displayed.
     *
     * @return \DateTime
     */
    public function getValidTo()
    {
        return $this->validTo;
    }

    /**
     * Contains the assigned \Shopware\Models\User\User which
     * created this emotion.
     *
     * @param \Shopware\Models\User\User $user
     *
     * @return \Shopware\Models\Emotion\Emotion
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Contains the assigned \Shopware\Models\User\User which
     * created this emotion.
     *
     * @return \Shopware\Models\User\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return \DateTime
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * @param \DateTime|string $modified
     */
    public function setModified($modified)
    {
        if ($modified !== null && !($modified instanceof \DateTime)) {
            $this->modified = new \DateTime($modified);
        } else {
            $this->modified = $modified;
        }
    }

    /**
     * @return \Shopware\Models\Attribute\Emotion
     */
    public function getAttribute()
    {
        return $this->attribute;
    }

    /**
     * @param \Shopware\Models\Attribute\Emotion|array|null $attribute
     *
     * @return \Shopware\Models\Attribute\Emotion
     */
    public function setAttribute($attribute)
    {
        return $this->setOneToOne($attribute, '\Shopware\Models\Attribute\Emotion', 'attribute', 'emotion');
    }

    /**
     * Contains all the assigned \Shopware\Models\Emotion\Element models.
     * The element model contains the configuration about the size and position of the element
     * and the assigned \Shopware\Models\Emotion\Library\Component which contains the data configuration.
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getElements()
    {
        return $this->elements;
    }

    /**
     * INVERSE SIDE
     * Contains all the assigned \Shopware\Models\Emotion\Element models.
     * The element model contains the configuration about the size and position of the element
     * and the assigned \Shopware\Models\Emotion\Library\Component which contains the data configuration.
     *
     * @param \Doctrine\Common\Collections\ArrayCollection|array|null $elements
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function setElements($elements)
    {
        return $this->setOneToMany($elements, '\Shopware\Models\Emotion\Element', 'elements', 'emotion');
    }


    /**
     * @param int $isLandingPage
     *
     * @return Emotion
     */
    public function setIsLandingPage($isLandingPage)
    {
        $this->isLandingPage = $isLandingPage;

        return $this;
    }

    /**
     * @return int
     */
    public function getIsLandingPage()
    {
        return $this->isLandingPage;
    }


    /**
     * @param string $seoDescription
     *
     * @return Emotion
     */
    public function setSeoDescription($seoDescription)
    {
        $this->seoDescription = $seoDescription;

        return $this;
    }

    /**
     * @return string
     */
    public function getSeoDescription()
    {
        return $this->seoDescription;
    }


    /**
     * @param string $seoTitle
     *
     * @return Emotion
     */
    public function setSeoTitle($seoTitle)
    {
        $this->seoTitle = $seoTitle;

        return $this;
    }

    /**
     * @return string
     */
    public function getSeoTitle()
    {
        return $this->seoTitle;
    }


    /**
     * @param string $seoKeywords
     *
     * @return Emotion
     */
    public function setSeoKeywords($seoKeywords)
    {
        $this->seoKeywords = $seoKeywords;

        return $this;
    }

    /**
     * @return string
     */
    public function getSeoKeywords()
    {
        return $this->seoKeywords;
    }


    /**
     * @param int $active
     *
     * @return Emotion
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return int
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getCategories()
    {
        return $this->categories;
    }


    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $categories
     *
     * @return Emotion
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getShops()
    {
        return $this->shops;
    }


    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $shops
     *
     * @return Emotion
     */
    public function setShops($shops)
    {
        $this->shops = $shops;

        return $this;
    }

    /**
     * @return bool
     */
    public function getShowListing()
    {
        return $this->showListing;
    }


    /**
     * @param bool $showListing
     *
     * @return Emotion
     */
    public function setShowListing($showListing)
    {
        $this->showListing = $showListing;

        return $this;
    }

    /**
     * @return Template
     */
    public function getTemplate()
    {
        return $this->template;
    }


    /**
     * @param Template $template
     *
     * @return Emotion
     */
    public function setTemplate(Template $template = null)
    {
        $this->template = $template;

        return $this;
    }


    /**
     * @param int $device
     *
     * @return Emotion
     */
    public function setDevice($device)
    {
        $this->device = $device;

        return $this;
    }

    /**
     * @return int
     */
    public function getDevice()
    {
        return $this->device;
    }


    /**
     * @param int $fullscreen
     *
     * @return Emotion
     */
    public function setFullscreen($fullscreen)
    {
        $this->fullscreen = $fullscreen;

        return $this;
    }

    /**
     * @return int
     */
    public function getFullscreen()
    {
        return $this->fullscreen;
    }


    /**
     * @param $rows
     *
     * @return Emotion
     */
    public function setRows($rows)
    {
        $this->rows = $rows;

        return $this;
    }

    /**
     * @return int
     */
    public function getRows()
    {
        return $this->rows;
    }

    /**
     * @return int
     */
    public function getCols()
    {
        return $this->cols;
    }


    /**
     * @param int $cols
     *
     * @return Emotion
     */
    public function setCols($cols)
    {
        $this->cols = $cols;

        return $this;
    }

    /**
     * @return int
     */
    public function getCellSpacing()
    {
        return $this->cellSpacing;
    }


    /**
     * @param int $cellSpacing
     *
     * @return Emotion
     */
    public function setCellSpacing($cellSpacing)
    {
        $this->cellSpacing = $cellSpacing;

        return $this;
    }

    /**
     * @return int
     */
    public function getCellHeight()
    {
        return $this->cellHeight;
    }


    /**
     * @param int $cellHeight
     *
     * @return Emotion
     */
    public function setCellHeight($cellHeight)
    {
        $this->cellHeight = $cellHeight;

        return $this;
    }

    /**
     * @return int
     */
    public function getArticleHeight()
    {
        return $this->articleHeight;
    }


    /**
     * @param int $articleHeight
     *
     * @return Emotion
     */
    public function setArticleHeight($articleHeight)
    {
        $this->articleHeight = $articleHeight;

        return $this;
    }


    /**
     * @param $mode
     *
     * @return Emotion
     */
    public function setMode($mode)
    {
        $this->mode = $mode;

        return $this;
    }

    /*
     * @return string
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }


    /**
     * @param int $position
     *
     * @return Emotion
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * @return int
     */
    public function getParentId()
    {
        return $this->parentId;
    }


    /**
     * @param int $parentId
     *
     * @return Emotion
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;

        return $this;
    }

    /**
     * @return int
     */
    public function getPreviewId()
    {
        return $this->previewId;
    }


    /**
     * @param int $previewId
     *
     * @return Emotion
     */
    public function setPreviewId($previewId)
    {
        $this->previewId = $previewId;

        return $this;
    }

    /**
     * @return string
     */
    public function getPreviewSecret()
    {
        return $this->previewSecret;
    }


    /**
     * @param string $previewSecret
     *
     * @return Emotion
     */
    public function setPreviewSecret($previewSecret)
    {
        $this->previewSecret = $previewSecret;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getReplacement()
    {
        return $this->replacement;
    }


    /**
     * @param string|null $replacement
     *
     * @return Emotion
     */
    public function setReplacement($replacement)
    {
        $this->replacement = $replacement;

        return $this;
    }

    public function getCustomerStreamIds()
    {
        return $this->customerStreamIds;
    }


    /**
     * @param $customerStreamIds
     *
     * @return Emotion
     */
    public function setCustomerStreamIds($customerStreamIds)
    {
        $this->customerStreamIds = $customerStreamIds;

        return $this;
    }
}
