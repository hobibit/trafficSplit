<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\Gateways\Exceptions\GatewayNotFoundException;
use App\Service\Gateways\Helpers\GatewayHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GatewayController extends AbstractController
{
    #[Route('/api/{gateway}/trafficload/')]
    public function getTraficLoad(string $gateway): JsonResponse
    {
        try {
            $gatewayClass = GatewayHelper::getGatewayByName($gateway);
        } catch (GatewayNotFoundException $e) {
            return new JsonResponse(
                ['error' => $e]
            );
        }

        $traficLoad = $gatewayClass->getTrafficLoad();

        return new JsonResponse(
            ['load' => $traficLoad]
        );
    }

    #[Route('/api/{gateway}/addpayment/')]
    public function addPayment(string $gateway): JsonResponse
    {
        $gatewayClass = GatewayHelper::getGatewayByName($gateway);
        $message = $gatewayClass->addPayment();

        return new JsonResponse($message);
    }
}
