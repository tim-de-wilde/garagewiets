<?php
namespace garagewiets\src\Helpers;

/**
 * Class Menu
 *
 * @package tdewmain\src\Helpers
 */
class Menu
{
    /**
     * @return array
     */
    public static function getItems(): array
    {
        return [
            [
                'link' => 'http://localhost/tdewmain/Photos',
                'icon' => 'camera',
                'condition' => Authenticator::loggedIn()
            ],
            [
                'link' => 'http://localhost/tdewmain/Home',
                'icon' => 'home',
                'condition' => 'none'
            ],
            [
                'link' => 'http://localhost/tdewmain/Logout',
                'icon' => 'sign-out',
                'condition' => Authenticator::loggedIn()
            ]
        ];
    }
}
