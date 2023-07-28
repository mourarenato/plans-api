<?php

namespace App\Model;

class PlanPrice
{
    public function __construct(
        public int $codigo,
        public int $minimo_vidas,
        public float $faixa1,
        public float $faixa2,
        public float $faixa3
    ){}
}