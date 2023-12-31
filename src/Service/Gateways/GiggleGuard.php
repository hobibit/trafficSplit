<?php

declare(strict_types=1);

namespace App\Service\Gateways;

use App\Service\Gateways\Abstractions\AbstractGateway;


class GiggleGuard extends AbstractGateway
{
    //Protecting your payments with humor.
    //Jokes generated by chatGPT

    public function execute(): string
    {
        $jokes = [
            'Why dont programmers like nature? It has too many bugs!',
            'Why do programmers always mix up Christmas and Halloween? Because Oct 31 == Dec 25.',
            'Why was the programmer cold? Because they left their Windows open.',
            'Why do programmers prefer iOS development over Android development? Because on iOS, you dont have to deal with "Java."',
            'Why did the programmer go broke? Because he used up all his cache.',
            'Why do programmers hate nature? It has too many branches.',
            'What do you call a programmer from Finland? Nerdic.',
            'Why did the programmer quit his job? He didnt get arrays.',
            'How many programmers does it take to screw in a light bulb? None, its a hardware problem.',
            'Why do programmers wear glasses? Because they dont C#.',
            'Whats a programmers favorite game? Hide and seek. They like finding bugs.',
            'Why dont programmers like to go outside? The sun has a tendency to burn their skin.',
            'Why was the JavaScript developer sad? Because he didnt "null" his feelings.',
            'How do you comfort a JavaScript bug? You console it.',
            'Why did the programmer break up with his keyboard? It had too many issues.',
            'Why did the programmer bring a ladder to the bar? Because he heard the drinks were on the house.',
            'What do you call a programmer with a social life? An anomaly.',
        ];

        return $jokes[array_rand($jokes)];
    }
}
