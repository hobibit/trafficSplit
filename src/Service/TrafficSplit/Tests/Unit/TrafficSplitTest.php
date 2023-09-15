<?php

declare(strict_types=1);

namespace App\Service\TrafficSplit\Tests\Unit;

use App\Service\Gateways\Interfaces\GatewayInterface;
use App\Service\TrafficSplit\Gateway;
use App\Service\TrafficSplit\TrafficSplit;
use PHPUnit\Framework\TestCase;

class TrafficSplitTest extends TestCase
{
    public function testCalculatingLoad(): void
    {
        //given
        $gateway1 = $this->createMock(Gateway::class);
        $gateway1->expects($this->any())->method('getWeight')->willReturn(50);
        $gateway1->expects($this->once())->method('getTrafficLoad')->willReturn(100);

        $gateway2 = $this->createMock(Gateway::class);
        $gateway2->expects($this->any())->method('getWeight')->willReturn(50);

        $traficSplit = new TrafficSplit([$gateway1, $gateway2]);

        $expectedCalculatedLoad = 200;

        //when
        $returnedCalculatedLoad = $traficSplit->calculateLoad($gateway1);

        //then
        $this->assertEquals($returnedCalculatedLoad, $expectedCalculatedLoad);
    }

    public function provideGatewaysData()
    {
        return [
            [
                25,
                100,
                75,
                100,
                2,
            ],
            [
                75,
                100,
                25,
                100,
                1,
            ],
            [
                50,
                10,
                50,
                1000,
                1,
            ],
        ];
    }

    /**
     * @dataProvider provideGatewaysData
     */
    public function testThatHandlePaymentWillChoseGatewayWithLowerLoad($gateway1weight, $gateway1trafic, $gateway2weight, $gateway2trafic, $correctGateway): void
    {
        //given
        $gateway1 = $this->createMock(Gateway::class);
        $gateway1->expects($this->any())->method('getWeight')->willReturn($gateway1weight);
        $gateway1->expects($this->any())->method('getTrafficLoad')->willReturn($gateway1trafic);

        $gateway2 = $this->createMock(Gateway::class);
        $gateway2->expects($this->any())->method('getWeight')->willReturn($gateway2weight);
        $gateway2->expects($this->any())->method('getTrafficLoad')->willReturn($gateway2trafic);

        $traficSplit = new TrafficSplit([$gateway1, $gateway2]);

        //then
        if ($correctGateway === 1) {
            $gateway1->expects($this->once())->method('addPayment');
        } else {
            $gateway2->expects($this->once())->method('addPayment');
        }

        //when
        $traficSplit->handlePayment();
    }
}
