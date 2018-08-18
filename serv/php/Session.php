<?php

class Session
{

    public static function start_session($login, $input_passwd, $self_passwd = "123456")
    {
        if ($_SESSION === NULL)
        {
            session_start();
            if ($self_passwd === $input_passwd)
            {
                $_SESSION["passwd"] = $input_passwd;
                return true;
            }
            else
            {
                session_destroy();
                return false;
            }
        }
    }

}