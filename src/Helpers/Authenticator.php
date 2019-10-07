<?php
namespace garagewiets\src\Helpers;

use Propel\Runtime\Exception\LogicException;
use User\Map\UserTableMap;
use User\User;
use User\UserQuery;

/**
 * Class Authenticator
 */
class Authenticator
{
    /**
     * @return User|null
     */
    public static function getUser(): ?User
    {
        $userSession = static::getUserSession();

        if ($userSession !== null) {
            return UserQuery::create()
                ->filterByUsername($userSession->getUsername())
                ->findOne();
        }
        return null;
    }

    /**
     * @return array|null
     */
    public static function getUserArray(): ?array
    {
        $user = static::getUser();
        if ($user !== null) {
            return $user->toArray();
        }
        return null;
    }

    /**
     * @param String $username
     * @param String $password
     *
     * @return bool
     */
    public static function login(String $username, String $password): bool
    {
        if (static::checkCredentials($username, $password)) {
            static::createSession($username);
            return true;
        }
        return false;
    }

    /**
     * @return UserSession
     */
    public static function getUserSession(): ?UserSession
    {
        if (static::loggedIn()) {
            return new UserSession();
        }
        return null;
    }

    /**
     * @return bool
     */
    public static function loggedIn() : bool
    {
        return !empty($_SESSION['token']) && !empty($_SESSION['username']);
    }

    public static function breakSession() : void
    {
        session_destroy();
    }

    /**
     * @param String $permissions
     *
     * @return bool
     */
    public static function isPermitted(String $permissions): bool
    {
        if (static::loggedIn()) {
            $userPerms = static::getUser()->getPermissions();

            return $userPerms === UserTableMap::COL_PERMISSIONS_ADMIN
                || $permissions === UserTableMap::COL_PERMISSIONS_GUEST
                || $userPerms === $permissions;
        }
        return $permissions === UserTableMap::COL_PERMISSIONS_GUEST;
    }

    /**
     * @param array $tables
     */
    public static function setModifiableTables(array $tables): void
    {
        $_SESSION['modifiable_tables'] = [];
        foreach ($tables as $table) {
            if ($table instanceof Table) {
                $_SESSION['modifiable_tables'][] = $table->getName();
            }
        }
    }

    /**
     * @return DatabaseTable[]|null
     */
    public static function getModifiableTables(): array
    {
        if (array_key_exists('modifiable_tables', $_SESSION)) {
            return $_SESSION['modifiable_tables'];
        }
        return [];
    }

    /**
     * @param String $username
     * @param String $password
     *
     * @return bool
     */
    private static function checkCredentials(String $username, String $password): bool
    {
        $user = UserQuery::create()
            ->filterByUsername($username)
            ->findOne();

        if ($user !== null) {
            return password_verify($password, $user->getPassword());
        }
        return false;
    }

    /**
     * @param String $username
     *
     * @return void
     */
    private static function createSession(String $username): void
    {
        if (!static::loggedIn()) {
            $_SESSION['username'] = $username;
            $_SESSION['token'] = '';
            return;
        }
        throw new LogicException('Trying to create session while a session is still active');
    }
}
