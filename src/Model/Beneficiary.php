<?php

namespace App\Model;

class Beneficiary
{
    public function __construct(
        public string $nome,
        public int $idade,
        public string $registro
    ) {}
}