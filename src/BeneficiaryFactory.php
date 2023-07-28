<?php

namespace App;

use App\Model\Beneficiary;

class BeneficiaryFactory
{
    public function __construct(
        public $beneficiarios,
    ){}

    /**
     * Build Array of Beneficiary objects.
     *
     * @return Beneficiary[] Array of Beneficiary objects.
     */
    public function buildBeneficiaries($nomes, $idades, $registro)
    {
        $beneficiaries = [];
        for ($i = 0; $i < $this->beneficiarios; $i++) {
            $beneficiary = new Beneficiary(
                $nomes[$i],
                $idades[$i],
                $registro
            );
            $beneficiaries[] = $beneficiary;
        }

        return $beneficiaries;
    }

}