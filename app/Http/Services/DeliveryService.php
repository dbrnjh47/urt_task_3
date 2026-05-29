<?php

namespace App\Http\Services;

use App\Http\Interfaces\DeliveryCarrierInterface;

class DeliveryService
{
    public array $carriers = [];
    
    public function addCarrier(DeliveryCarrierInterface $carrier): self
    {
        $this->carriers[$carrier->getName()] = $carrier;
        return $this;
    }
    
    public function getCostsForWeight(float $weight): array
    {
        $result = [];
        
        foreach ($this->carriers as $carrier) {
            try {
                $result[$carrier->getName()] = $carrier->calculateCost($weight);
            } catch (\InvalidArgumentException $e) {
                $result[$carrier->getName()] = null;
            }
        }
        
        return $result;
    }
}