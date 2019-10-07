<?php
namespace garagewiets\src\Helpers;

/**
 * Class DatabaseTable
 *
 * @package garagewiets\src\Helpers
 */
class DatabaseTable extends Table
{
    public $tableMapClass;
    public $queryClass;
    public $baseClass;

    /**
     * Table constructor.
     *
     * @param String $tableMapClass
     * @param String $queryClass
     * @param String $baseClass
     */
    public function __construct(String $tableMapClass, String $queryClass, String $baseClass)
    {
        if (class_exists($queryClass) && class_exists($tableMapClass)) {
            $this->tableMapClass = $tableMapClass;
            $this->queryClass = $queryClass;
            $this->baseClass = $baseClass;

            $name = $tableMapClass::getTableMap()->getPhpName();
            $headers = $tableMapClass::getFieldNames();
            $content = $queryClass::create()
                ->find()->toArray();
        } else {
            throw new \LogicException('Table map or query class does not exist');
        }

        parent::__construct($name, $headers, $content);
    }

    /**
     * @return String
     */
    public function getBaseClass(): String
    {
        return $this->baseClass;
    }

    /**
     * @return String
     */
    public function getTableMapClass(): String
    {
        return $this->tableMapClass;
    }

    /**
     * @return String
     */
    public function getQueryClass(): String
    {
        return $this->queryClass;
    }
}
