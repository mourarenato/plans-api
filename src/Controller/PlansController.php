<?php

namespace App\Controller;

use App\Model\BeneficiaryPlan;
use App\PlanFactory;
use App\BeneficiaryFactory;
use App\PlanPriceFactory;
use Exception;

class PlansController
{
    public function __construct(
        public $registro,
        public $beneficiarios,
        public $idades,
        public $nomes
    ){}

    public function buildJson()
    {
        try {
            $beneficiaryFactory = new BeneficiaryFactory($this->beneficiarios);
            $beneficiaries = $beneficiaryFactory->buildBeneficiaries($this->nomes, $this->idades, $this->registro);

            $planFactory = new PlanFactory('files/plans.json');
            $plans = $planFactory->getPlans();

            $planPriceFactory = new PlanPriceFactory('files/prices.json');
            $priceOfPlans = $planPriceFactory->getPriceOfPlans();

            $plansOfBeneficiaries = $this->getPlansOfBeneficiaries($beneficiaries, $plans, $priceOfPlans);

            $precoBeneficiarios = [];
            $precoTotal = 0;
            $index = 1;

            foreach ($plansOfBeneficiaries as $beneficiaryPlan) {
                $nome = $beneficiaryPlan->beneficiary->nome;
                $idade = $beneficiaryPlan->beneficiary->idade;
                $preco = $beneficiaryPlan->getFaixa();
                $precoBeneficiarios["beneficiario" . $index] = ['nome' => $nome, 'preco' => $preco, 'idade' => $idade];
                $precoTotal += $preco;
                $index += 1;
            }

            $data = [
                'precoBeneficiarios' => $precoBeneficiarios,
                'precoTotal' => $precoTotal
            ];

            $json = json_encode($data);
            file_put_contents('files/proposta.json', $json);

            http_response_code(200);
            header('Content-Type: application/json');
            echo $json;
        } catch (Exception $e) {
            http_response_code(500);
            $errorMessage = ['error' => 'Ocorreu um erro no servidor'];
            $jsonError = json_encode($errorMessage);
            header('Content-Type: application/json');
            echo $jsonError;
        }
    }

    public function getPlansOfBeneficiaries($beneficiaries, $plans, $priceOfPlans)
    {
        $plansOfBeneficiaries = [];
        foreach ($beneficiaries as $beneficiary) {
            foreach ($plans as $plan) {
                foreach ($priceOfPlans as $pricePlan) {
                    if ($beneficiary->registro === $plan->registro) {
                        if ($plan->codigo === $pricePlan->codigo) {
                            $beneficiaryPlan = new BeneficiaryPlan($beneficiary, $plan, $pricePlan);
                            if ($beneficiary->idade <= 17) {
                                $beneficiaryPlan->setFaixa($pricePlan->faixa1);
                            }
                            if ($beneficiary->idade >= 18 && $beneficiary->idade <= 40) {
                                $beneficiaryPlan->setFaixa($pricePlan->faixa2);
                            }
                            if ($beneficiary->idade > 40) {
                                $beneficiaryPlan->setFaixa($pricePlan->faixa3);
                            }
                            $plansOfBeneficiaries[] = $beneficiaryPlan;
                        }
                    }
                }
            }
        }
        return $plansOfBeneficiaries;
    }
}