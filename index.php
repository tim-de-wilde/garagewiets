<?php
namespace garagewiets;

use garagewiets\src\Helpers\AutoRoute;
use garagewiets\src\Helpers\Functions;
use garagewiets\src\Helpers\LocalConfig;
use garagewiets\src\Helpers\Session;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

include __DIR__ . '/src/Helpers/Session.php';
include __DIR__ . '/src/Helpers/Token.php';
Session::create();

include __DIR__ . '/vendor/autoload.php';

//setup Propel
include __DIR__ . '/bin/generated-conf/config.php';

// global functions
include __DIR__ . '/src/Helpers/Functions.php';

// global constants
include __DIR__ . '/src/Helpers/constants.php';

// router
include __DIR__ . '/vendor/altorouter/altorouter/AltoRouter.php';
$altoRouter = new \AltoRouter();
$altoRouter->setBasePath('/garagewiets');

include __DIR__ . '/src/Modules/Homepage/Controllers/Homepage.php';
$altoRouter->map('POST|GET', '/', function () {
    Functions::internRedirect('Home');
    die();
});

include __DIR__ . '/src/Helpers/AutoRoute.php';
$autoRoute = new AutoRoute($altoRouter);

include __DIR__ . '/vendor/twig/twig/src/Loader/FilesystemLoader.php';
include __DIR__ . '/vendor/twig/twig/src/Environment.php';

$twigLoader = new FilesystemLoader(__DIR__ . '/src/Templates');
$twig = new Environment(
    $twigLoader
//    [
//        'cache' => __DIR__ . '/src/Templates/compilation_cache'
//    ]
);

include __DIR__ . '/src/Helpers/LocalConfig.php';
LocalConfig::setTwigEnvironment($twig);

$autoRoute->route();
