<?php


class Utils
{
    public static function debug($array)
    {
        static $num = 0;
        $calc_space = function ($num) {
            $str = "";
            for ($i = 0; $i < $num; $i++)
            {
                $str .= "  ";
            }
            return $str;
        };

        foreach($array as $key => $value) {
            if (gettype($value) === 'array') {
                echo $calc_space($num).$key.' => ['.PHP_EOL;
                $num++;
                Utils::debug($value);
                $num--;
                echo $calc_space($num).']'.PHP_EOL;
            }
            else {
                echo $calc_space($num).$key.' => '.$value.','.PHP_EOL;
            }
        }
    }

    public static function fetchParse()
    {
        $body = file_get_contents('php://input');

        if ($body === FALSE) {
            exit ;
        }
        return json_decode($body, true);
    }

    public static function dd($input)
    {
        echo '<br>';
        var_dump($input);
        echo '<br>';
        die();
    }
}