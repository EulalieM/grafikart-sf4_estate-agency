<?php

namespace App\Service;

class PropertyHeatHelper
{

    const HEAT = [
        'Gaz' => 'HEAT_GAS_LABEL',
        'Électrique' => 'HEAT_ELECTRIC_LABEL',
        'Bois' => 'HEAT_WOOD_LABEL'
    ];

    /**
     * @return array[]
     */
    public function getHeats(): array
    {
        return self::HEAT;
    }

}