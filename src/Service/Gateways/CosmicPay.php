<?php

namespace App\Service\Gateways;

use App\Service\Gateways\Abstractions\AbstractGateway;

class CosmicPay extends AbstractGateway
{
    //This crafty gataway use comets

    public function execute(): string
    {
        $comets = [
            'Halleys Comet',
            'Comet Hale-Bopp',
            'Comet NEOWISE (C/2020 F3)',
            'Comet Hyakutake (C/1996 B2)',
            'Comet ISON (C/2012 S1)',
            'Comet Lovejoy (C/2011 W3)',
            'Comet PanSTARRS (C/2011 L4)',
            'Comet Encke (2P/Encke)',
            'Comet Wild 2 (81P/Wild)',
            'Comet Tempel-Tuttle (55P/Tempel-Tuttle)',
        ];

        return $comets[array_rand($comets)];
    }
}
