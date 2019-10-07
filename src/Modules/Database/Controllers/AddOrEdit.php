<?php

namespace garagewiets\src\Modules\Database\Controllers;

use garagewiets\src\Helpers\AbstractController;
use garagewiets\src\Helpers\Authenticator;
use garagewiets\src\Helpers\DatabaseTable;
use garagewiets\src\Helpers\Functions;
use garagewiets\src\Helpers\PageResponse;
use Map\UserTableMap;
use User\User;
use User\UserQuery;

/**
 * Class Edit
 *
 * @package garagewiets\src\Modules\Database\Controllers
 */
class AddOrEdit extends AbstractController
{
    /**
     * @return PageResponse
     */
    public function show(): PageResponse
    {
        /**@var array $pageVars * */
        $pageVars = $this->pageVars;
        $tableName = $pageVars['tableName'];
        if (!empty($tableName) && \in_array($tableName, Authenticator::getModifiableTables(), true)) {
            $table = null;
            $availableTables = (new Tables())->tables();
            foreach ($availableTables as $availableTable) {
                if ($availableTable instanceof DatabaseTable && $availableTable->getName() === $tableName) {
                    $table = $availableTable;
                }
            }


            if ($table instanceof DatabaseTable) {
                /**@var User $baseClass**/
                 $baseClass = $table->getBaseClass();
                /**@var UserTableMap $tableMapClass**/
                $tableMapClass = $table->getTableMapClass();
                /**@var UserQuery $queryClass**/
                $queryClass = $table->getQueryClass();

                $fieldNames = $tableMapClass::getFieldNames();

                if (isset($pageVars['id']) && \is_numeric($pageVars['id'])) {
                    $value = $queryClass::create()
                        ->filterByPrimaryKey($pageVars['id'])
                        ->findOne();
                } else {
                    $value = new $baseClass();
                }

                if ($value !== null) {
                    if (isset($pageVars['submit'])) { // if form is submitted
                        foreach ($pageVars as $key => $var) {
                            if (\in_array($key, $fieldNames, true)) {
                                $value->setByName($key, $var);
                            }
                        }

                        $value->save();
                    } else { // form is not submitted
                        return new PageResponse(
                            'addOrEdit.twig',
                            [
                                'row' => \array_slice(
                                    $value->toArray(),
                                    1
                                )
                            ]
                        );//remove 'id' & send
                    }
                }
            }
        }

        Functions::internRedirect('Database', true);
        die();
    }
}
