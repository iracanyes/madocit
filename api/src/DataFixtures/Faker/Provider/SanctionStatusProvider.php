<?php
/**
 * Created by PhpStorm.
 * User: dashouney
 * Date: 6/8/18
 * Time: 4:21 PM
 */

namespace App\DataFixtures\Faker\Provider;

/**
 * Class SanctionStatusProvider
 * @package App\DataFixtures\Faker\Provider
 *
 * Generate the status of the sanction
 */
class SanctionStatusProvider
{
    const SANCTION_STATUS = ["active","finished","banned"];

    public static function sanctionStatus(): string
    {
        // Return a random element of the array of sanction status
        return array_rand(self::SANCTION_STATUS);
    }
}