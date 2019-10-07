<?php
namespace garagewiets\src\Modules\Urenregistratie\Controllers;


use garagewiets\src\Helpers\AbstractController;
use garagewiets\src\Helpers\PageResponse;

/**
 * Class Urenregistratie
 *
 * @package garagewiets\src\Modules\Urenregistratie\Controllers
 */
class Urenregistratie extends AbstractController
{

    //overview shit

    /**
     * @return PageResponse
     */
    public function show(): PageResponse
    {
        $data = [];

        $data['days'] = [
            'Maandag',
            'Dinsdag',
            'Woensdag',
            'Donderdag',
            'Vrijdag'
        ];

        $data['times'] = [
            '09:00',
            '10:00',
            '11:00',
            '12:00',
            '13:00',
            '14:00',
            '15:00',
            '16:00',
            '17:00'
        ];

        $data['employees'] = [
            ['name' => 'Tim', 'id' => 1],
            ['name' => 'Henk', 'id' => 2],
            ['name' => 'Jan', 'id' => 3]
        ];

        return new PageResponse('urenregistratie.twig', ['data' => $data]);
    }
}