<?php declare(strict_types=1);
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

namespace Shopware\Core\Events\Basket;

use Enlight_Event_EventArgs;

class GetBasketAllowEmptyBasketEvent extends Enlight_Event_EventArgs
{
    public const EVENT_NAME = 'Shopware_Modules_Basket_sGetBasket_AllowEmptyBasket';

    public function getArticles(): array
    {
        return $this->get('articles');
    }

    public function getTotalAmount(): float
    {
        return $this->get('totalAmount');
    }

    public function getTotalAmountWithTax(): float
    {
        return $this->get('totalAmountWithTax');
    }

    public function getTotalCount(): int
    {
        return $this->get('totalCount');
    }

    public function getTotalAmountNet(): float
    {
        return $this->get('totalAmountNet');
    }
}
