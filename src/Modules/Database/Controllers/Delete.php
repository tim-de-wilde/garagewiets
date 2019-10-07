<?php
namespace garagewiets\src\Modules\Database\Controllers;

use Customer\CustomerQuery;
use garagewiets\src\Helpers\AbstractController;
use garagewiets\src\Helpers\Authenticator;
use garagewiets\src\Helpers\DatabaseTable;
use garagewiets\src\Helpers\Functions;
use garagewiets\src\Helpers\PageResponse;
use User\UserQuery;

/**
 * Class Delete
 *
 * @package garagewiets\src\Modules\Database\Controllers
 */
class Delete extends AbstractController
{

    /**
     * @return PageResponse
     */
    public function show(): PageResponse
    {
        $pageVars = $this->pageVars;

        if (!empty($pageVars['tableName'])
            && !empty($pageVars['id'])
            && \in_array($pageVars['tableName'], Authenticator::getModifiableTables(), true)) {
            $tableName = $pageVars['tableName'];

            $table = null;
            $availableTables = (new Tables())->tables();
            foreach ($availableTables as $availableTable) {
                if ($availableTable instanceof DatabaseTable && $availableTable->getName() === $tableName) {
                    $table = $availableTable;
                }
            }

            if ($table instanceof DatabaseTable) {
                /**@var UserQuery $queryClass**/
                $queryClass = $table->getQueryClass();

                $queryClass::create()
                    ->filterByPrimaryKey($pageVars['id'])
                    ->delete();
            }
        }

        Functions::internRedirect('Database', true);
        die();
    }
}
