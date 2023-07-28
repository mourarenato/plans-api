<?php

namespace App;

use App\Model\PlanPrice;

class PlanPriceFactory
{
    public function __construct(
        public $jsonPath,
    ){}

    /**
     * Get the plans from the JSON file.
     *
     * @param string $jsonPath The path to the JSON file containing the plans.
     * @return PlanPrice[] Array of Plan objects.
     */
    public function getPriceOfPlans()
    {
        $jsonData = file_get_contents($this->jsonPath);
        $arrayData = json_decode($jsonData, true);
        $priceOfPlans = [];

        foreach ($arrayData as $pricePlan) {
            $planPrice = new PlanPrice(
                $pricePlan['codigo'],
                $pricePlan['minimo_vidas'],
                $pricePlan['faixa1'],
                $pricePlan['faixa2'],
                $pricePlan['faixa3']
            );
            $priceOfPlans[] = $planPrice;
        }

        return $priceOfPlans;
    }
}