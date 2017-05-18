<?php

namespace VeryBuy\Payment\SinoPac;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Collection;
use VeryBuy\Payment\SinoPac\Exceptions\InvalidArgumentException;
use VeryBuy\Payment\SinoPac\Order;

class OrderCollection extends Collection implements Arrayable, Jsonable
{
    public function init(): self
    {
        return $this->map(function($item) {
            return new Order($item);
        });
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
