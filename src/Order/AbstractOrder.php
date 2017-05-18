<?php

namespace VeryBuy\Payment\SinoPac\Order;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use VeryBuy\Payment\SinoPac\BuilderTrait\Response\NormalTrait;

abstract class AbstractOrder implements Arrayable, Jsonable
{
	use NormalTrait;

	/**
	 * @var array
	 */
	protected $parsed;

	/**
	 * @param array $order
	 */
	public function __construct($order)
	{
		$this->parsed = json_decode(json_encode($order));
	}

	/**
	 * @return array
	 */
	public function toArray(): array
	{
		return json_decode(json_encode($this->parsed), JSON_OBJECT_AS_ARRAY);
	}

	/**
	 * @param  integer $options
	 * @return string
	 */
	public function toJson($options = 0): string
	{
		return json_encode($this->toArray());
	}

	/**
	 * @return string|LogicException
	 */
	public function getPayStatusMessage()
	{
		if (array_key_exists($this->getPayType(), $response = $this->getResponseCode())) {
			return $response[$this->getPayType()];
		}

		throw new \LogicException('SinoPac undefined error message at version 6.1.5');
	}

	/**
	 * @return array
	 */
	abstract protected function getResponseCode(): array;
}
