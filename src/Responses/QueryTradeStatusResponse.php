<?php

namespace VeryBuy\Payment\SinoPac\Responses;

use VeryBuy\Payment\SinoPac\OrderCollection;
use VeryBuy\Payment\SinoPac\Responses\ResponseContract;

class QueryTradeStatusResponse extends ResponseContract
{
	/**
	 * @var OrderCollection
	 */
	protected $collection;

	/**
	 * @return OrderCollection
	 */
	public function getOrderCollection(): OrderCollection
	{
		$this->parsed->ECWebAPI = $this->parsed->ECWebAPI ?? [];

		return $this->collection = $this->collection ?? OrderCollection::make($this->parsed->ECWebAPI)->init();
	}
}
