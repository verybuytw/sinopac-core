<?php

namespace VeryBuy\Payment\SinoPac\Order;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Collection;
use VeryBuy\Payment\SinoPac\Exceptions\InvalidArgumentException;
use VeryBuy\Payment\SinoPac\Order\AbstractOrder;
use VeryBuy\Payment\SinoPac\Order\AtmOrder;
use VeryBuy\Payment\SinoPac\Order\CreditCardOrder;
use VeryBuy\Payment\SinoPac\SinoPacContract;

class OrderCollection extends Collection implements Arrayable, Jsonable
{
    public function init(): self
    {
        return $this->map(function($item) {
            return $this->genClassFromType($item);
        });
    }

    /**
     * @param  object $item
     * @return AbstractOrder
     */
    protected function genClassFromType($item): AbstractOrder
    {
        $types = [
            SinoPacContract::PAYTYPE_ATM => AtmOrder::class,
            SinoPacContract::PAYTYPE_CREDITCARD => CreditCardOrder::class
        ];

        if (array_key_exists($item->getPayType(), $types)) {
            return new $types[$item->getPayType()]($item);
        }

        throw new InvalidArgumentException('Undefined Order type.');
    }

    /**
     * @param  Order
     * @return OrderCollection|InvalidArgumentException
     */
    public function push($value): self
    {
        if ($value instanceof Order) {
            return parent::push($value);
        }

        throw new InvalidArgumentException('Only can push Order instance.');
    }

    /**
     * @param  string
     * @param  Order
     * @return OrderCollection|InvalidArgumentException
     */
    public function put($key, $value): self
    {
        if ($value instanceof Order) {
            return parent::put($key, $value);
        }

        throw new InvalidArgumentException('Only can put Order instance.');
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->map(function($order) {
            return $order->toArray();
        })->all();
    }

    /**
     * @param  integer $options
     * @return string
     */
    public function toJson($options = 0): string
    {
        return json_encode($this->toArray(), $options);
    }
}
