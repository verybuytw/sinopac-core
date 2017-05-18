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
	 * @return array
	 */
	abstract protected function getResponseCode(): array;
}
