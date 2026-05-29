<?php

namespace App\Http\Interfaces;

interface DeliveryCarrierInterface
{
    public function calculateCost(float $weight): float;
    public function getName(): string;
}