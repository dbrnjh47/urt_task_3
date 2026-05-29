<?php

namespace App\Http\Controllers;

use App\Http\Adapters\Carrier1Adapter;
use App\Http\Adapters\Carrier2Adapter;
use App\Http\Services\DeliveryService;

class DeliveryController extends Controller
{
    private $weight = 10.1;
    private DeliveryService $deliveryService;

    public function __construct()
    {
        $this->deliveryService = new DeliveryService();
        $this->deliveryService
            ->addCarrier(new Carrier1Adapter())
            ->addCarrier(new Carrier2Adapter());
    }

    public function show(): void
    {
        if (!is_numeric($this->weight) || $this->weight <= 0) {
            http_response_code(404);
            echo "500";
            exit;
        }
        $costs = $this->deliveryService->getCostsForWeight($this->weight);

        $this->render('home', [
            'title' => 'Результаты расчёта',
            'data' => [
                'weight' => $this->weight,
                'costs' => $costs
            ]
        ]);
    }
}
