<?php
namespace com;

class cfun
{
    static function sqlsafe($value)
    {
        $value = htmlspecialchars($value, ENT_QUOTES);
        $value = addslashes($value);
        return $value;
    }

    static function verifysess($key = 'sess_user')
    {
        session_start();
        return isset ($_SESSION[$key]);
    }

}