<?php namespace AppBundle\Utility;

class LuckyNumbersCalculator
{
    public static function amount($number_of_digits)
    {
        $half = $number_of_digits / 2;
        $max = $half * 9;

        $total = 1;

        for ( $k = 0; $k < $max; $k++ )
        {
            $t = self::countNumber($k, $half);
            echo "{$k} - {$t}\n";
            $total += $t;
        }

        return $total;
    }

    private static function countNumber($number, $base)
    {
        if ( $number === 0 )
            return 1;

        if ( $base === 1 )
            return $number < 10 ? 1 : 0;

        $total = 0;
        $base--;

        for ( $k = $number; $k >= max([0, $k - 10]); $k-- )
            $total += self::countNumber($k, $base);

        return $total;
    }
}