<?php

namespace Application\Components;

class Auth
{
    private $login;
    private $password;

    function __construct()
	{
        session_start();
	}

    /**
     * Load parameters
     * 
     * @param string $login
     * @param string $password
     * 
     * @return boolean
     */
    public function load($login, $password)
    {
        if (!isset($login) || $login == '' || !isset($password) || $password == '') {
            if ($login == '') {
                $this->addErrorMessage('Поле "Логин" обязательное для заполнения');
            }

            if ($password == '') {
                $this->addErrorMessage('Поле "Пароль" обязательное для заполнения');
            }
            
            return false;
        } else {
            $this->login    = $login;
            $this->password = $password;

            return true;
        }
    }

    /**
     * Check login params
     * 
     * @return boolean
     */
    public function login()
    {
        if ($this->login == 'admin' && $this->password == 123) {
            $_SESSION['login'] = $this->login;

            return true;
        } else {
            $this->addErrorMessage('Неверный логин или пароль');
            
            return false;
        }
    }

    /**
     * Make logout
     */
    static function logout()
    { 
        session_start();

        session_unset('login');
    }

    /**
     * Return login
     * 
     * @return string
     */
    public function getLogin()
    {
        session_start();

        return $_SESSION['login'];
    }

    /**
     * Check is logged
     * 
     * @return boolean
     */
    static function isLogged()
    {
        session_start();

        if (isset($_SESSION['login'])) {
            return true;
        } else {
            return false;
        }
    }
}