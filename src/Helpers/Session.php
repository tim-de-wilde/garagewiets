<?php
namespace garagewiets\src\Helpers;

use SessionLock\SessionLockQuery;

/**
 * Class Session
 *
 * @package tdewmain\src\Helpers
 */
class Session
{
    public static function create(): void
    {
        session_start();
        if (!array_key_exists('id', $_SESSION)) {
            $_SESSION['id'] = Token::generateToken();
            $_SESSION['login_attempts'] = 0;
            $_SESSION['modifiable_tables'] = [];
        }
    }

    /**
     * @param \DateTime $expireDate
     *
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public static function lock(\DateTime $expireDate): void
    {
        $lock = SessionLockQuery::create()
            ->filterBySession($_SESSION['id'])
            ->filterByIsExpired(false)
            ->findOneOrCreate();

        $lock->setExpires($expireDate->getTimestamp());
        $lock->save();
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public static function isLocked(): bool
    {
        $id = $_SESSION['id'];

        $lock = SessionLockQuery::create()
            ->findOneBySession($id);

        if ($lock !== null) {
            if (!$lock->isExpired() && new \DateTime() > $lock->getExpires()) {
                static::setLoginAttempts(0);
                $lock->setIsExpired(true);
                $lock->save();
                return false;
            }
            return true;
        }
        return false;
    }

    /**
     * @return mixed
     */
    public static function getLoginAttempts()
    {
        return $_SESSION['login_attempts'];
    }

    /**
     * @param mixed $loginAttempts
     */
    public static function setLoginAttempts($loginAttempts): void
    {
        $_SESSION['login_attempts'] = $loginAttempts;
    }
}
