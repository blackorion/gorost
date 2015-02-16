<?php namespace AppBundle\Utility;

class LuckyNumbersGenerator
{
    const RESULT_LIMIT = 100;

    /**
     * @param int        $number_of_digits
     * @param mixed|null $start_index
     *
     * @return \string[]
     */
    public function generate($number_of_digits, $start_index = null)
    {
        $result = [];

        if ( !$start_index )
            $result[] = sprintf("%0{$number_of_digits}d", 0);

        $half = $number_of_digits / 2;

        $indexes = $this->prepareStartIndexes($start_index, $half);

        foreach ( $this->getNumbers($half, $indexes) as $number )
        {
            if ( $start_index != $number )
                $result[] = $number;

            if ( count($result) === self::RESULT_LIMIT )
                break;
        }

        return $result;
    }

    /**
     * @param int   $half
     * @param array $indexes
     *
     * @return array
     */
    private function getNumbers($half, $indexes)
    {
        $max = pow(10, $half);

        for ( $i = $indexes['right']; $i < $max; $i++ )
        {
            $i_sum = self::countTotalSummaryOfNumberDigitValues($i);

            for ( $j = $indexes['left']; $j < $max; $j++ )
            {
                $j_sum = self::countTotalSummaryOfNumberDigitValues($j);

                if ( $i_sum === $j_sum )
                    yield $this->convertToFormattedString($half, $j, $i);
            }
        }
    }

    /**
     * @param int $number
     *
     * @return int
     */
    protected function countTotalSummaryOfNumberDigitValues($number)
    {
        $total = 0;
        $number = (string)$number;
        $len = strlen($number);

        for ( $i = 0; $i < $len; $i++ )
            $total += $number[$i];

        return $total;
    }

    /**
     * @param int $half_of_number_of_digits
     * @param int $first_number
     * @param int $second_number
     *
     * @return string
     */
    private function convertToFormattedString($half_of_number_of_digits, $first_number, $second_number)
    {
        return sprintf("%0{$half_of_number_of_digits}d%0{$half_of_number_of_digits}d", $first_number, $second_number);
    }

    /**
     * @param $start_from
     * @param $half
     *
     * @return array
     */
    private function prepareStartIndexes($start_from, $half)
    {
        $indexes = ['left' => 1, 'right' => 1];

        if ( !$start_from )
            return $indexes;

        $indexes['left'] = substr((string)$start_from, 0, count($start_from) - $half - 1);
        $indexes['right'] = substr((string)$start_from, (-1 * $half));

        return $indexes;
    }
}