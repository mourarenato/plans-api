<?php

namespace App\Model;

class Plan
{
    public function __construct(
        public string $registro,
        public string $nome,
        public int $codigo,
    ){}
}