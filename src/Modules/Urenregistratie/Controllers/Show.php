<?php


namespace garagewiets\src\Modules\Urenregistratie\Controllers;


use garagewiets\src\Helpers\AbstractController;
use garagewiets\src\Helpers\PageResponse;
use Schedule\Schedule;
use Schedule\ScheduleQuery;
use User\UserQuery;

/**
 * Class Show
 *
 * @package garagewiets\src\Modules\Urenregistratie\Controllers
 */
class Show extends AbstractController
{

    /**
     * @return PageResponse
     */
    public function show(): PageResponse
    {
        $data = [];
        $pageVars = $this->pageVars;

        $data['employees'] = UserQuery::create()->find()->toArray();

        if (\array_key_exists('employee_id', $pageVars)) {// if employee is selected
            $schedule = ScheduleQuery::create()
                ->filterByUserId($pageVars['employee_id'])
                ->findOneOrCreate();

            if ($schedule instanceof Schedule) {
                $data['schedule'] = $schedule->getData();

                if (\array_key_exists('submitData', $pageVars)) {// if a new schedule is submitted
                    $data = explode(',', $pageVars['submitData']);
                    if (array_filter($data, '\is_numeric')) {
                        $schedule->setData($data);
                        $schedule->save();
                        echo 'true';
                    }
                    die();
                }
            }
        }

        $data['days'] = [
            'Maandag',
            'Dinsdag',
            'Woensdag',
            'Donderdag',
            'Vrijdag'
        ];

        $data['times'] = [
            '08:00',
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

        return new PageResponse('urenregistratie.twig', ['data' => $data]);
    }
}