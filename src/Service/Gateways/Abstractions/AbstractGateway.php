<?php

declare(strict_types=1);

namespace App\Service\Gateways\Abstractions;

use App\Service\Gateways\Interfaces\GatewayInterface;

abstract class AbstractGateway implements GatewayInterface
{
    private int $trafficLoad = 0;
    private static array $instances = [];

    private function __construct()
    {
    }

    public static function getInstance()
    {
        $class = get_called_class();
        if (!isset(self::$instances[$class])) {
            self::$instances[$class] = new $class();
        }
        return self::$instances[$class];
    }

    public function addPayment(): string
    {
        $class = explode('\\', get_called_class());
        $this->trafficLoad++;
        return sprintf('%s [%d]: %s', end($class), $this->getTrafficLoad(), $this->execute());
    }

    public function getTrafficLoad(): int
    {
        return $this->trafficLoad;
    }

    abstract public function execute(): string;
}
