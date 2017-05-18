<?php

namespace VeryBuy\Payment\SinoPac\Order;

use VeryBuy\Payment\SinoPac\Order\AbstractOrder;

class AtmOrder extends AbstractOrder
{
	/**
	 * @return array
	 */
	protected function getResponseCode(): array
	{
		return [
			'010' => '待付款',
			'020' => '買家已付款',
			'030' => '待撥款',
			'040' => '已撥款',
			'110' => '帳號逾期未轉帳，訂單失效',
			'210' => '待撥款',
			'230' => '已撥款',
		];
	}
}
