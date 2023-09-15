<?php

declare(strict_types=1);

namespace App\Service\TrafficSplit\Abstractions;

use App\Service\Gateways\Interfaces\GatewayInterface;
use App\Service\TrafficSplit\Exceptions\GatewayWeightException;
use App\Service\TrafficSplit\Gateway;
use App\Service\TrafficSplit\Interfaces\TrafficSplitInterface;
use Exception;

abstract class AbstractTrafficSplit implements TrafficSplitInterface
{
    protected array $gateways = [];

    public function __construct(array $gateways)
    {

        $totalWeight = 0;

        foreach ($gateways as $gateway) {
            if (!$gateway instanceof Gateway) {
                throw new Exception(sprintf('Gateway expected, %s given', get_class($gateway)));
            }
            if ($gateway->getWeight() <= 0) {
                continue;
            }
            $totalWeight += $gateway->getWeight();
            $this->gateways[] = $gateway;
        }

        if ($totalWeight <> 100) {
            throw new GatewayWeightException(sprintf('The sum of the gateway weights must be 100%%, now sum is: %d%%', $totalWeight));
        }
    }

    abstract public function handlePayment();
}
