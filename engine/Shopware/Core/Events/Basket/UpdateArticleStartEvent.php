<?php declare(strict_types=1);

namespace Shopware\Core\Events\Basket;

use Enlight_Event_EventArgs;
use sBasket;
use Shopware\Components\Cart\Struct\CartItemStruct;

class UpdateArticleStartEvent extends Enlight_Event_EventArgs
{
    public const EVENT_NAME = 'Shopware_Modules_Basket_UpdateArticle_Start';


    public function getSubject(): sBasket
    {
        return $this->get('subject');
    }


    public function getId(): int
    {
        return $this->get('id');
    }


    public function getQuantity(): int
    {
        return $this->get('quantity');
    }


    public function getcartItem(): CartItemStruct
    {
        return $this->get('cartItem');
    }
}