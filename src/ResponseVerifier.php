<?php

namespace VeryBuy\Payment\SinoPac;

use Carbon\Carbon;
use VeryBuy\Payment\SinoPac\BuilderTrait\Response\NormalTrait as Normal;
use VeryBuy\Payment\SinoPac\Responses\ResponseContract;
use VeryBuy\Payment\SinoPac\TransformToXmlTrait as TransformToXml;

class ResponseVerifier extends ResponseContract
{
    use Normal, TransformToXml;

    /**
     * @return string
     */
    public function getOrderNumber(): string
    {
        return $this->parsed->OrderID;
    }
}
