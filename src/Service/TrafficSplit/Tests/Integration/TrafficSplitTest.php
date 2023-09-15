<?php

namespace App\Service\TrafficSplit\Tests\Integration;

use App\Service\Gateways\ChucklePay;
use App\Service\Gateways\CosmicPay;
use App\Service\Gateways\GiggleGuard;
use App\Service\Gateways\WitWallet;
use App\Service\TrafficSplit\Exceptions\GatewayWeightException;
use App\Service\TrafficSplit\Gateway;
use App\Service\TrafficSplit\TrafficSplit;
use PHPUnit\Framework\TestCase;

class TrafficSplitTest extends TestCase
{
    /**
     * @dataProvider provideGatewaysData
     */
    public function testThatHandlePaymentWillChoseGatewayWithLowerLoad(
        $gateway1weight, $gateway2weight, $gateway3weight, $gateway4weight,
        $gateway1trafic, $gateway2trafic, $gateway3trafic, $gateway4trafic,
    ): void
    {
        //given
        $gateway1 = new Gateway('ChucklePay', $gateway1weight);
        $gateway2 = new Gateway('CosmicPay', $gateway2weight);
        $gateway3 = new Gateway('GiggleGuard', $gateway3weight);
        $gateway4 = new Gateway('WitWallet', $gateway4weight);

        $traficSplit = new TrafficSplit([$gateway1, $gateway2, $gateway3, $gateway4]);

        //when
        for ($i = 1; $i <= 100; $i++) {
            $traficSplit->handlePayment();
        }

        //then
        $this->assertEquals($gateway1trafic, $gateway1->getTrafficLoad());
        $this->assertEquals($gateway2trafic, $gateway2->getTrafficLoad());
        $this->assertEquals($gateway3trafic, $gateway3->getTrafficLoad());
        $this->assertEquals($gateway4trafic, $gateway4->getTrafficLoad());
    }

    public function provideGatewaysData()
    {
        return [
            [
                25,
                25,
                25,
                25,
                25,
                25,
                25,
                25,
            ],
            [
                100,
                0,
                0,
                0,
                125,
                25,
                25,
                25,
            ],
            [
                0,
                50,
                50,
                0,
                125,
                75,
                75,
                25,
            ],

        ];
    }

    /**
     * @dataProvider provideGatewaysWeights
     */
    public function testThatSumOfWeightInGatewaysMustBe100($gateway1weight, $gateway2weight): void
    {
        //given
        $gateway1 = new Gateway('ChucklePay', $gateway1weight);
        $gateway2 = new Gateway('CosmicPay', $gateway2weight);

        //then
        $this->expectException(GatewayWeightException::class);

        //when
        new TrafficSplit([$gateway1, $gateway2]);
    }

    public function provideGatewaysWeights()
    {
        return [
            [
                25,
                25,
            ],
            [
                75,
                75,
            ],
        ];
    }
}
