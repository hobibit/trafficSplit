<?php

declare(strict_types=1);

namespace App\Service\Gateways\Interfaces;

interface GatewayInterface
{
    public function addPayment(): string;

    public function getTrafficLoad(): int;
}
