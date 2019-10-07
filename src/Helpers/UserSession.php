<?php
namespace garagewiets\src\Helpers;

/**
 * Class Session
 *
 * @package Helpers
 */
class UserSession
{
    /**@var String $username**/
    private $username;
    /**@var String $token**/
    private $token;

    public function __construct()
    {
        $this->username = $_SESSION['username'];
        $this->token = $_SESSION['token'];
    }

    /**
     * @return String
     */
    public function getUsername(): String
    {
        return $this->username;
    }

    /**
     * @param String $username
     */
    public function setUsername(String $username): void
    {
        $this->username = $username;
    }

    /**
     * @return String
     */
    public function getToken(): String
    {
        return $this->token;
    }

    /**
     * @param String $token
     */
    public function setToken(String $token): void
    {
        $this->token = $token;
    }
}
