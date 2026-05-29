<?php

namespace App\Http\Adapters;

use App\Http\Interfaces\DeliveryCarrierInterface;

class Carrier2Adapter implements DeliveryCarrierInterface
{
    private const PRICE_PER_KG = 100;

    public function calculateCost(float $weight): float
    {
        $this->validateWeight($weight);
        return $weight * self::PRICE_PER_KG;
    }

    public function getName(): string
    {
        return 'Перевозчик 2 (за кг)';
    }

    private function validateWeight(float $weight): void
    {
        if ($weight < 0) {
            throw new \InvalidArgumentException('Вес не может быть отрицательным');
        }
    }
}
