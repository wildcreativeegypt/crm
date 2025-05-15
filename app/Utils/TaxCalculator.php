<?php

namespace App\Utils;

class TaxCalculator
{
    // Define the tax rate as a constant (14% in this case).
    private const TAX_RATE = 0.14;

    /**
     * Calculate the net amount available for ads (excluding tax).
     *
     * @param float $fundsAdded Amount added (inclusive of tax).
     * @return float Net amount available (excluding tax).
     */
    public static function calculateNetAmount(float $fundsAdded): float
    {
        return $fundsAdded / (1 + self::TAX_RATE);
    }

    /**
     * Calculate the total cost (ad cost + tax).
     *
     * @param float $adCost Ad cost (excluding tax).
     * @return float Total cost (including tax).
     */
    public static function calculateTotalCost(float $adCost): float
    {
        return $adCost * (1 + self::TAX_RATE);
    }
}