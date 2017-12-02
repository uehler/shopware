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

namespace Shopware\Models\Customer;

use Doctrine\ORM\Mapping as ORM;
use Shopware\Components\Model\ModelEntity;

/**
 * Shopware payment model represents a payment method information.
 * <br>
 * The Shopware Payment Data model represents a row of the s_core_payment_data.
 * It's used to store payment data
 * For now it will only be used for SEPA payments, but it's meant to be
 * extendable so that it can accommodate future scenarios
 *
 * @ORM\Entity(repositoryClass="PaymentDataRepository")
 * @ORM\Table(name="s_core_payment_data")
 * @ORM\HasLifecycleCallbacks
 */
class PaymentData extends ModelEntity
{
    /**
     * @ORM\ManyToOne(targetEntity="Shopware\Models\Payment\Payment", inversedBy="paymentData")
     * @ORM\JoinColumn(name="payment_mean_id", referencedColumnName="id")
     */
    protected $paymentMean;

    /**
     * @var int
     *
     * @ORM\Column(name="payment_mean_id", type="integer")
     */
    protected $paymentMeanId;

    /**
     * @ORM\ManyToOne(targetEntity="\Shopware\Models\Customer\Customer", inversedBy="paymentData")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $customer;

    /**
     * @var bool
     *
     * @ORM\Column(name="use_billing_data", type="boolean", nullable=true)
     */
    protected $useBillingData;

    /**
     * @var string
     *
     * @ORM\Column(name="bankname", type="string", length=255, nullable=true)
     */
    protected $bankName;

    /**
     * @var string
     *
     * @ORM\Column(name="bic", type="string", length=50, nullable=true)
     */
    protected $bic;

    /**
     * @var string
     *
     * @ORM\Column(name="iban", type="string", length=50, nullable=true)
     */
    protected $iban;

    /**
     * @var string
     *
     * @ORM\Column(name="account_number", type="string", length=50, nullable=true)
     */
    protected $accountNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="bank_code", type="string", length=50, nullable=true)
     */
    protected $bankCode;

    /**
     * @var string
     *
     * @ORM\Column(name="account_holder", type="string", length=50, nullable=true)
     */
    protected $accountHolder;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="date", nullable=false)
     */
    protected $createdAt;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * Gets the id of the payment
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @param string $bankName
     *
     * @return PaymentData
     */
    public function setBankName($bankName)
    {
        $this->bankName = $bankName;

        return $this;
    }

    /**
     * @return string
     */
    public function getBankName()
    {
        return $this->bankName;
    }


    /**
     * @param string $bic
     *
     * @return PaymentData
     */
    public function setBic($bic)
    {
        $this->bic = $bic;

        return $this;
    }

    /**
     * @return string
     */
    public function getBic()
    {
        return $this->bic;
    }


    /**
     * @param \DateTime $createdAt
     *
     * @return PaymentData
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }


    /**
     * @param mixed $customer
     *
     * @return PaymentData
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCustomer()
    {
        return $this->customer;
    }


    /**
     * @param string $iban
     *
     * @return PaymentData
     */
    public function setIban($iban)
    {
        $this->iban = $iban;

        return $this;
    }

    /**
     * @return string
     */
    public function getIban()
    {
        return $this->iban;
    }


    /**
     * @param mixed $paymentMean
     *
     * @return PaymentData
     */
    public function setPaymentMean($paymentMean)
    {
        $this->paymentMean = $paymentMean;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPaymentMean()
    {
        return $this->paymentMean;
    }


    /**
     * @param bool $useBillingData
     *
     * @return PaymentData
     */
    public function setUseBillingData($useBillingData)
    {
        $this->useBillingData = $useBillingData;

        return $this;
    }

    /**
     * @return bool
     */
    public function getUseBillingData()
    {
        return $this->useBillingData;
    }


    /**
     * @param string $accountHolder
     *
     * @return PaymentData
     */
    public function setAccountHolder($accountHolder)
    {
        $this->accountHolder = $accountHolder;

        return $this;
    }

    /**
     * @return string
     */
    public function getAccountHolder()
    {
        return $this->accountHolder;
    }


    /**
     * @param string $accountNumber
     *
     * @return PaymentData
     */
    public function setAccountNumber($accountNumber)
    {
        $this->accountNumber = $accountNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getAccountNumber()
    {
        return $this->accountNumber;
    }


    /**
     * @param string $bankCode
     *
     * @return PaymentData
     */
    public function setBankCode($bankCode)
    {
        $this->bankCode = $bankCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getBankCode()
    {
        return $this->bankCode;
    }

    /**
     * @return int
     */
    public function getPaymentMeanId()
    {
        return $this->paymentMeanId;
    }
}
