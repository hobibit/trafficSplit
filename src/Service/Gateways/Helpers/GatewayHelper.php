<?php

namespace App\Service\Gateways\Helpers;

use App\Service\Gateways\ChucklePay;
use App\Service\Gateways\CosmicPay;
use App\Service\Gateways\Exceptions\GatewayNotFoundException;
use App\Service\Gateways\GiggleGuard;
use App\Service\Gateways\Interfaces\GatewayInterface;
use App\Service\Gateways\WitWallet;

class GatewayHelper
{
    static function getGatewayByName(string $name): GatewayInterface
    {
        $name = strtolower($name);

        if ($name === 'chucklepay') {
            $gatewayClass = ChucklePay::getInstance();
        } else if ($name === 'cosmicpay') {
            $gatewayClass = CosmicPay::getInstance();
        } else if ($name === 'giggleguard') {
            $gatewayClass = GiggleGuard::getInstance();
        } else if ($name === 'witwallet') {
            $gatewayClass = WitWallet::getInstance();
        } else {
            throw new GatewayNotFoundException(sprintf('No gateway with name %s found.', $name));
        }

        return $gatewayClass;
    }
}
