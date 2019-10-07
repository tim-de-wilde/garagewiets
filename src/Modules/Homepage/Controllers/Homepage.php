<?php
namespace garagewiets\src\Modules\Homepage\Controllers;

use garagewiets\src\Helpers\AbstractController;
use garagewiets\src\Helpers\PageResponse;

/**
 * Class Homepage
 *
 * @package garagewiets\src\Modules\Homepage\Controllers
 */
class Homepage extends AbstractController
{

    /**
     * @return PageResponse
     */
    public function show(): PageResponse
    {
        return new PageResponse('homepage.twig', []);
    }
}
