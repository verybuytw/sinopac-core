<?php

namespace VeryBuy\Payment\SinoPac\Order;

use VeryBuy\Payment\SinoPac\Order\AbstractOrder;

class CreditCardOrder extends AbstractOrder
{
	/**
	 * @return array
	 */
	protected function getResponseCode(): array
	{
		return [
			'010' => '待付款',
			'020' => '授權成功 - 待請款',
			'025' => '請款處理中',
			'028' => '請款完成–待撥款',
			'030' => '待撥款',
			'040' => '已撥款',
			'110' => '逾期失效--',
			'115' => '付款失敗',
			'120' => '授權逾期未請款',
			'130' => '已拒絕–取消授權',
			'140' => '退款申請中',
			'150' => '退款申請完成 - 清算中',
			'160' => '退款申請完成 - 取消請款',
			'170' => '退款完成',
			'210' => '待撥款',
			'220' => '待扣款',
			'230' => '已撥款',
			'240' => '已扣款',
		];
	}
}
