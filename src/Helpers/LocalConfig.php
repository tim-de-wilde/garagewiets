<?php
namespace garagewiets\src\Helpers;

use Twig\Environment;

/**
 * Class Config
 *
 * @package tdewmain\src\Helpers
 */
class LocalConfig
{
    private static $config = __DIR__ . '/../../../garagewietsconfig/local_config.php';
    private static $twigEnvironment;

    /**Twig environment**/

    public static function getTwigEnvironment()
    {
        return static::$twigEnvironment;
    }

    /**
     * @param Environment $twigEnvironment
     */
    public static function setTwigEnvironment(Environment $twigEnvironment): void
    {
        static::$twigEnvironment = $twigEnvironment;
    }

    /**Local environment**/

    private static function getLocalConfig(): array
    {
        if (file_exists(static::$config)) {
            include static::$config;
            return get();
        }
        throw new \LogicException('Local config not set');
    }
}
