<?php

namespace App\Service;

class PropertyHeatHelper
{
    const GAS_KEY = 'gas';
    const GAS_LABEL = 'Gaz';

    const ELECTRIC_KEY = 'electric';
    const ELECTRIC_LABEL = 'Électrique';

    const WOOD_KEY = 'wood';
    const WOOD_LABEL = 'Bois';

    const VALUES = [
        self::GAS_KEY => self::GAS_LABEL,
        self::ELECTRIC_KEY => self::ELECTRIC_LABEL,
        self::WOOD_KEY => self::WOOD_LABEL,
    ];

    /**
     * @return array[]
     */
    public static function getChoices(): array
    {
        return array_flip(self::VALUES);
    }

    /**
     * @param string $key
     * @return string
     */
    public static function getLabel(string $key): string
    {
        if (array_key_exists($key, self::VALUES)) {
            return self::VALUES[$key];
        }
        return $key;
    }

}