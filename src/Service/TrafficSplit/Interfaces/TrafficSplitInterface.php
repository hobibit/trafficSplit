<?php

namespace App\Service\TrafficSplit\Interfaces;

interface TrafficSplitInterface
{
    public function __construct(array $gateways);

    public function handlePayment();
}
