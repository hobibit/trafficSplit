<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\TrafficSplitEntity;
use App\Service\Gateways\ChucklePay;
use App\Service\Gateways\CosmicPay;
use App\Service\TrafficSplit\Gateway;
use App\Service\TrafficSplit\TrafficSplit;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\Request;

class TrafficSplitController extends AbstractController
{
    #[Route('/')]
    public function homepage(Request $request): Response
    {
        $trafficSplit = new TrafficSplitEntity();
        $form = $this->createForm(\App\Form\TrafficSplitForm::class, $trafficSplit);

        $messages = [];

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /**
             * @var TrafficSplitEntity
             */
            $trafficSplit = $form->getData();

            $gateway1 = new Gateway('ChucklePay', $trafficSplit->getChucklePayWeight());
            $gateway2 = new Gateway('CosmicPay', $trafficSplit->getCosmicPayWeight());
            $gateway3 = new Gateway('GiggleGuard', $trafficSplit->getGiggleGuardWeight());
            $gateway4 = new Gateway('WitWallet', $trafficSplit->getWitWalletWeight());

            $traficSplit = new TrafficSplit([$gateway1, $gateway2, $gateway3, $gateway4]);
            for ($i = 1; $i <= 100; $i++) {
                $messages[] = $traficSplit->handlePayment();
            }
        }

        return $this->render('homepage.html.twig', [
            'form' => $form,
            'messages' => $messages,
        ]);
    }
}
