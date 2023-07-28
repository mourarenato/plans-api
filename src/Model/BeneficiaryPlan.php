<?php

namespace App\Model;

class BeneficiaryPlan
{
    protected float $faixa;

    public function __construct(
        public Beneficiary $beneficiary,
        public Plan $plano,
        public PlanPrice $precoPlano,
    ){}

    public function setFaixa($faixa) {
        $this->faixa = $faixa;
    }

    public function getFaixa() {
        $faixa = $this->faixa;
        return $faixa;
    }
}