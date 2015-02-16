<?php namespace AppBundle\Utility;

class LuckyNumbers
{
    /**
     * @param int $number_of_digits
     *
     * @return \string[]
     */
    public static function generate($number_of_digits)
    {
        $generator = new LuckyNumbersGenerator();

        return $generator->generate($number_of_digits);
    }

    /**
     * @param int $number_of_digits
     *
     * @return int
     */
    public static function amount($number_of_digits)
    {
        $calculator = new LuckyNumbersCalculator();

        return $calculator->amount($number_of_digits);
    }
}