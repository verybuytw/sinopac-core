<?php

namespace VeryBuy\Payment\SinoPac\BuilderTrait\Response;

use Carbon\Carbon;
use VeryBuy\Payment\SinoPac\SinoPacContract;

trait NormalTrait
{
	/**
	 * @return int
	 */
	public function getAmount(): int
	{
		return ($this->parsed->Amount / 100);
	}

	/**
	 * @return string
	 */
	public function getCompanyId(): string
	{
		return $this->parsed->ShopNO;
	}

	/**
	 * @return string
	 */
	public function getId(): string
	{
		return $this->parsed->TSNO;
	}

	/**
	 * @return string
	 */
	public function getOrderNumber(): string
	{
		return $this->parsed->OrderNO;
	}

    /**
     * @return string
     */
    public function getTradedAt(): string
    {
        return Carbon::parse($this->parsed->TSDate)->format('Y-m-d H:i:s');
    }

    /**
     * @return string
     */
    public function getPaidAt(): string
    {
        return Carbon::parse($this->parsed->PayDate)->format('Y-m-d H:i:s');
    }

    /**
     * @return string
     */
    protected function getPayType(): string
    {
        return $this->parsed->PayType;
    }

    /**
     * @return boolean
     */
    public function isRefund(): bool
    {
        return ($this->parsed->RefundFlag === SinoPacContract::RESPONSE_AUTOPUSH_REFUND);
    }

    /**
     * @return boolean
     */
    public function isATM(): bool
    {
        return ($this->getPayType() === SinoPacContract::PAYTYPE_ATM);
    }

    /**
     * @return boolean
     */
    public function isCreditCard(): bool
    {
        return ($this->getPayType() === SinoPacContract::PAYTYPE_CREDITCARD);
    }
}
