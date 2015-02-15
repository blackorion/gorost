<?php namespace AppBundle\Utility;

class LuckyNumbersGenerator
{
    /**
     * @param int $number_of_digits
     * @return array
     */
    public static function generate($number_of_digits)
    {
        $result = [sprintf("%0{$number_of_digits}d", 0)];

        if ( $number_of_digits === 2 )
        {
            for ( $i = 1; $i < 10; $i++ )
                $result[] = sprintf("%d%d", $i, $i);

            return $result;
        }

        $half = $number_of_digits / 2;
        $max = pow(10, $half);

        for ( $i = 1; $i < $max; $i++ )
        {
            $i = self::convertToFormattedString($i, $half);
            $i_sum = self::countNumberSum($i);

            for ( $j = 1; $j < $max; $j++ )
            {
                $j = self::convertToFormattedString($j, $half);

                if ( $i_sum === self::countNumberSum($j) )
                    $result[] = "{$j}{$i}";
            }
        }

        return $result;
    }

    /**
     * @param int $num
     * @return int
     */
    protected static function countNumberSum($num)
    {
        $total = 0;
        $len = strlen($num);

        for ( $i = 0; $i < $len; $i++ )
            $total += $num[$i];

        return $total;
    }

    /**
     * @param int $num
     * @param int $half
     * @return string
     */
    private static function convertToFormattedString($num, $half)
    {
        return sprintf("%0{$half}d", $num);
    }
}