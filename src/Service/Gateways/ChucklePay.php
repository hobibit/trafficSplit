<?php

declare(strict_types=1);

namespace App\Service\Gateways;

use App\Service\Gateways\Abstractions\AbstractGateway;

class ChucklePay extends AbstractGateway
{
    //Your payments make the gateway giggle.
    //Jokes generated by chatGPT

    public function execute(): string
    {
        $jokes = [
            'Why did the credit card apply for a job? It wanted to get a little more "interest" in life!,',
            'How do you organize a space party? You "planet" with PayPal!',
            'Why was the computer cold when making a payment? Because it left its Windows open!',
            'What did the credit card say to the ATM? "You complete me!"',
            'Why did the tomato turn red at the checkout counter? Because it saw the salad dressing!',
            'Why did the scarecrow become a successful banker? Because he was outstanding in his field!',
            'How do you know when a payment is going to be a disaster? When its a "check-mate" situation!',
            'Why did the coin go to therapy? It had too many "cents" of self-doubt!',
            'What do you call a group of musical bills? A "cash choir"!',
            'Why was the math book sad when it made a payment? Because it had too many problems!',
        ];

        return $jokes[array_rand($jokes)];
    }
}