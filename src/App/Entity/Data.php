<?php

namespace App\Entity;

/**
 * Class Data.
 */
abstract class Data
{
    /**
     * @param float $value
     *
     * @return float
     */
    protected function round($value)
    {
        return round($value, 2);
    }
}
