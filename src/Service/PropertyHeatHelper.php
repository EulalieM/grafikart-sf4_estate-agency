<?php

namespace App\Service;

class PropertyHeatHelper
{

//    const HEAT = [
//        'Gaz' => 'HEAT_GAS_LABEL',
//        'Électrique' => 'HEAT_ELECTRIC_LABEL',
//        'Bois' => 'HEAT_WOOD_LABEL'
//    ];

    const HEAT = [
        'Gaz' => 'Gaz',
        'Électrique' => 'Électrique',
        'Bois' => 'Bois'
    ];

    /**
     * @return array[]
     */
    public function getHeats(): array
    {
        return self::HEAT;
    }

//    public function getHeatsKey()
//    {
//        $heats = self::HEAT;
//        $output = [];
//        foreach ($heats as $k => $v) {
//            $output[$v] = $k;
//        }
//        return $output;
//    }

}