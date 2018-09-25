<?php
/**
 * Created by PhpStorm.
 * User: dashouney
 * Date: 6/8/18
 * Time: 4:02 PM
 */

namespace App\DataFixtures\Faker\Provider;


/**
 * Class SanctionTypeProvider
 * @package App\DataFixtures\Faker\Provider
 *
 * Generate a random type of sanction
 */
class SanctionTypeProvider
{
    const SANCTION_TYPE=["Warning","Temporary exclusion","Definitive exclusion"];

    public static function sanctionType(): string
    {
        return array_rand(self::SANCTION_TYPE);
    }
}