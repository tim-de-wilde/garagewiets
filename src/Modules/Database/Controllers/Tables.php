<?php
namespace garagewiets\src\Modules\Database\Controllers;

use Customer\Customer;
use Customer\CustomerQuery;
use Customer\Map\CustomerTableMap;
use garagewiets\src\Helpers\DatabaseTable;
use garagewiets\src\Helpers\AbstractOverview;
use garagewiets\src\Helpers\Table;
use Maintenance\Maintenance;
use Maintenance\MaintenanceQuery;
use Maintenance\Map\MaintenanceTableMap;
use Purchase\Map\PurchaseTableMap;
use Purchase\Purchase;
use Purchase\PurchaseQuery;
use Vehicle\Map\VehicleTableMap;
use Vehicle\Vehicle;
use Vehicle\VehicleQuery;

/**
 * Class Tables
 *
 * @package garagewiets\src\Modules\Database\Controllers
 */
class Tables extends AbstractOverview
{
    /**
     * @return mixed
     */
    public function module(): String
    {
        return 'Database';
    }

    /**
     * @return Table[]
     */
    public function tables(): array
    {
        return [
            new DatabaseTable(
                CustomerTableMap::class,
                CustomerQuery::class,
                Customer::class
            ),
            new DatabaseTable(
                VehicleTableMap::class,
                VehicleQuery::class,
                Vehicle::class
            ),
            new DatabaseTable(
                MaintenanceTableMap::class,
                MaintenanceQuery::class,
                Maintenance::class
            ),
            new DatabaseTable(
                PurchaseTableMap::class,
                PurchaseQuery::class,
                Purchase::class
            )
        ];
    }
}
