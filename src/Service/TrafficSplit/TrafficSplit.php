<?php

declare(strict_types=1);

namespace App\Service\TrafficSplit;

use App\Service\TrafficSplit\Abstractions\AbstractTrafficSplit;
use App\Service\TrafficSplit\Exceptions\GatewayNotFoundException;

class TrafficSplit extends AbstractTrafficSplit
{

    public function handlePayment(): string
    {
        $gatewayWithTheLeastLoad = null;
        $gatewayLowestLoad = null;

        foreach ($this->gateways as $gateway) {
            if ($gatewayWithTheLeastLoad === null) {
                $gatewayWithTheLeastLoad = $gateway;
                $gatewayLowestLoad = $this->calculateLoad($gateway);
                continue;
            }

            $gatewayLoad = $this->calculateLoad($gateway);
            if ($gatewayLoad < $gatewayLowestLoad) {
                $gatewayWithTheLeastLoad = $gateway;
                $gatewayLowestLoad = $gatewayLoad;
            }
        }

        if ($gatewayWithTheLeastLoad === null) {
            throw new GatewayNotFoundException('No proper gateway found');
        }

        return $gatewayWithTheLeastLoad->addPayment();
    }

    public function calculateLoad(Gateway $gateway): float
    {
        return round(100 / $gateway->getWeight() * $gateway->getTrafficLoad(), 2);
    }
}
