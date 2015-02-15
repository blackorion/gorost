<?php namespace AppBundle\Utility;

class Validator
{
    public static $lastError = "";

    /**
     * @param int $number
     * @return bool
     */
    public static function isValid($number)
    {
        if(!is_numeric($number))
        {
            self::$lastError = "Только числа";

            return false;
        }

        if ( !self::isPositiveNumber($number) )
        {
            self::$lastError = "Число должно быть больше 1";
            return false;
        }

        if( !self::isEven($number) )
        {
            self::$lastError = "Число должно быть четным";

            return false;
        }

        return true;
    }

    /**
     * @param $number
     * @return bool
     */
    protected static function isEven($number)
    {
        return $number % 2 === 0;
    }

    /**
     * @param $number
     * @return bool
     */
    protected static function isPositiveNumber($number)
    {
        return $number > 0;
    }
}