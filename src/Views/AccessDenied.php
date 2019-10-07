<?php
namespace garagewiets\src\Views;

use garagewiets\src\Helpers\AbstractController;
use garagewiets\src\Helpers\PageResponse;

/**
 * Class AccessDenied
 *
 * @package tdewmain\src\Views
 */
class AccessDenied extends AbstractController
{
    /**
     * @return PageResponse
     */
    public function show(): PageResponse
    {
        return new PageResponse('accessDenied.twig', []);
    }
}
