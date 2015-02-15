<?php namespace AppBundle\Tests\Utility;

use AppBundle\Utility\LuckyNumbersCalculator;

class LuckyNumbersCalculatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function Amount_NumberOfDigits_ReturnsAmountOfPossibleLuckyNumbers()
    {
        $cases = [
//            [2, 10],
            [4, 670],
//            [6, 55252],
//            [8, 4816030]
        ];

        foreach ( $cases as $test_case )
        {
            $result = LuckyNumbersCalculator::amount($test_case[0]);

            $this->assertEquals($test_case[1], $result);
        }
    }
}
