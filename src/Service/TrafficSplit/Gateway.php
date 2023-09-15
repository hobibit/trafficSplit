<?php

namespace App\Service\TrafficSplit;

use App\Controller\GatewayController;

class Gateway
{
    public function __construct(private string $name, private int $weight)
    {
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }

    public function addPayment(): string
    {
        $gatewayController = new GatewayController();
        $response = $gatewayController->addPayment($this->name);
        return json_decode($response->getContent(), true);
    }

    public function getTrafficLoad(): int
    {
        $gatewayController = new GatewayController();
        $response = $gatewayController->getTraficLoad($this->name);
        $content = json_decode($response->getContent(), true);

        if (isset($content['error'])) {
            throw new \Exception($content['error']);
        }

        if (!isset($content['load'])) {
            throw new \Exception('No traffic load');
        }

        if (!is_numeric($content['load'])) {
            throw new \Exception('Not a number');
        }

        return $content['load'];
    }
}
