<?php

namespace garagewiets\src\Views;

use garagewiets\src\Helpers\AbstractController;
use garagewiets\src\Helpers\PageResponse;
use User\UserQuery;

/**
 * Class PageNotFound
 *
 * @package tdewmain\src\Views
 */
class PageNotFound extends AbstractController
{
    /**
     * @return PageResponse
     */
    public function show(): PageResponse
    {
        return new PageResponse('notFound.twig', []);
    }
}
