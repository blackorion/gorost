<?php namespace AppBundle\Utility;

class LuckyNumbersCalculator
{
    /**
     * @var array
     */
    private $cache = [];

    /**
     * @param int $number_of_digits
     *
     * @return int
     */
    public function amount($number_of_digits)
    {
        $half = $number_of_digits / 2;
        $maximal_possible_summary_number = $half * 9;

        $total = 1;

        for ( $k = 1; $k <= $maximal_possible_summary_number; $k++ )
        {
            $t = self::countTimesTheNumberOccursForBase($k, $half);
            $total += pow($t, 2);
        }

        return $total;
    }

    /**
     * @param int $number
     * @param int $base
     *
     * @return int
     */
    private function countTimesTheNumberOccursForBase($number, $base)
    {
        if ( $number === 0 )
            return 1;

        if ( $base === 1 )
            return $number < 10 ? 1 : 0;

        if ( $this->isNotCached($number, $base) )
            $this->cache[$base][$number] = $this->calculateTotalForAllNestedNumbers($number, $base);

        return $this->cache[$base][$number];
    }

    /**
     * @param $number
     * @param $base
     *
     * @return int
     */
    private function calculateTotalForAllNestedNumbers($number, $base)
    {
        $total = 0;

        for ( $k = $number; $k >= max([0, $number - 9]); $k-- )
            $total += self::countTimesTheNumberOccursForBase($k, $base - 1);

        return $total;
    }

    /**
     * @param int $number
     * @param int $base
     *
     * @return bool
     */
    private function isNotCached(&$number, &$base)
    {
        return !isset($this->cache[$base][$number]);
    }
}