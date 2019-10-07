<?php

namespace garagewiets\src\Helpers;

use Twig\Environment;

/**
 * Class AbstractPage
 *
 * @package Helpers
 */
abstract class AbstractController
{
    public $pageVars;

    /**
     * @return PageResponse
     */
    abstract public function show(): PageResponse;

    public function render(): void
    {
        $response = $this->show();

        /**@var Environment $twig * */
        $twig = LocalConfig::getTwigEnvironment();

        echo $twig->render(
            $response->getTwig(),
            array_merge(
                $response->getVariables(),
                [
                    'breadcrumbs' => $this->getBreadcrumb(),
                    'menu_items' => Menu::getItems(),
                    'logged_in' => Authenticator::loggedIn(),
                    'user' => Authenticator::getUserArray(),
                    'ROOT' => LOCAL_ROOT
                ]
            )
        );
    }

    /**
     * @return array
     */
    private function getBreadcrumb(): array
    {
        $url = explode('/', $_SERVER['REQUEST_URI']);

        $linked = \array_slice($url, 1);

        $breadcrumbs = [];
        foreach ($linked as $key => $name) {
            if (!empty($name)) {
                $localLink = implode('/', \array_slice($linked, 0, $key+1));
                $link = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $localLink;

                $breadcrumbs[$key]['name'] = $name;
                $breadcrumbs[$key]['link'] = $link;
            }
        }

        return $breadcrumbs;
    }
}
