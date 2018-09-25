<?php
/**
 * Created by PhpStorm.
 * User: dashouney
 * Date: 6/8/18
 * Time: 4:26 PM
 */

namespace App\DataFixtures\Faker\Provider;

/**
 * Class ChatStatusProvider
 * @package App\DataFixtures\Faker\Provider
 *
 *
 */
class ChatStatusProvider
{
    const CHAT_STATUS=["active", "inactive", "open", "closed"];

    /**
     * Generate a random status for the chat
     * @return string
     */
    public static function chatStatus(): string
    {
        return array_rand(self::CHAT_STATUS);
    }
}