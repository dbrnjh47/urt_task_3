<?php

namespace App\Http\Adapters;

use App\Http\Interfaces\DeliveryCarrierInterface;

class Carrier1Adapter implements DeliveryCarrierInterface
{
    private const PRICE_UP_TO_10KG = 100;
    private const PRICE_OVER_10KG = 1000;
    private const WEIGHT_THRESHOLD = 10;
    
    public function calculateCost(float $weight): float
    {
        $this->validateWeight($weight);
        
        if ($weight <= self::WEIGHT_THRESHOLD) {
            return self::PRICE_UP_TO_10KG;
        }
        
        return self::PRICE_OVER_10KG;
    }
    
    public function getName(): string
    {
        return 'Перевозчик 1 (пороговая система)';
    }
    
    private function validateWeight(float $weight): void
    {
        if ($weight < 0) {
            throw new \InvalidArgumentException('Вес не может быть отрицательным');
        }
    }
}