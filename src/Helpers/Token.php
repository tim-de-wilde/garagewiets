<?php
namespace garagewiets\src\Helpers;

/**
 * Class Token
 *
 * @package tdewmain\src\Helpers
 */
class Token
{
    /**
     * @return string
     * @throws \Exception
     */
    public static function generateToken(): string
    {
        return bin2hex(random_bytes(64));
    }
}
