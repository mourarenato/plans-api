<?php

namespace App;

use App\Model\Plan;

class PlanFactory
{
    public function __construct(
        public $jsonPath,
    ){}

    /**
     * Get the plans from the JSON file.
     *
     * @param string $jsonPath The path to the JSON file containing the plans.
     * @return Plan[] Array of Plan objects.
     */
    public function getPlans()
    {
        $jsonData = file_get_contents($this->jsonPath);
        $plansArray = json_decode($jsonData, true);
        $plans = [];

        foreach ($plansArray as $planData) {
            $plan = new Plan(
                $planData['registro'],
                $planData['nome'],
                $planData['codigo']
            );
            $plans[] = $plan;
        }

        return $plans;
    }

}