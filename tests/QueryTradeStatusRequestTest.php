<?php

namespace Tests\Payment\SinoPac;

use Tests\Payment\SinoPac\AbstractTestCase;
use Tests\Payment\SinoPac\ConfigTrait;
use VeryBuy\Payment\SinoPac\Order\OrderCollection;
use VeryBuy\Payment\SinoPac\RequestBuilder;
use VeryBuy\Payment\SinoPac\Requests\QueryTradeStatusRequest;
use VeryBuy\Payment\SinoPac\SinoPacContract;

class QueryTradeStatusRequestTest extends AbstractTestCase
{
    use ConfigTrait;

    /**
     * @test
     */
    public function 測試虛擬帳號格式正確()
    {
        $response = (new RequestBuilder(
            $this->companyStub,
            $this->keyStub)
        )->make(new QueryTradeStatusRequest(
            [
                'PayType' => SinoPacContract::PAYTYPE_ATM,
                'PayFlag' => SinoPacContract::PAYFLAG_ATM_ALL,
            ],
            SinoPacContract::REQUEST_QUERY_TRADE_STATUS_TEST
        ));

        $this->assertInstanceOf(OrderCollection::class, $response->getOrderCollection());
    }

    /**
     * @test
     */
    public function 測試虛擬帳號時間區間查詢()
    {
        $response = (new RequestBuilder(
            $this->companyStub,
            $this->keyStub)
        )->make(new QueryTradeStatusRequest(
            [
                'PayType' => SinoPacContract::PAYTYPE_ATM,
                'OrderDateS' => '20170516',
                'OrderTimeS' => '0000',
                'OrderDateE' => '20170516',
                'OrderTimeE' => '0115',
                'PayFlag' => SinoPacContract::PAYFLAG_ATM_ALL,
            ],
            SinoPacContract::REQUEST_QUERY_TRADE_STATUS_TEST
        ));

        $this->assertInstanceOf(OrderCollection::class, $response->getOrderCollection());
    }
}
