<?php namespace AppBundle\Tests\Utility;

use AppBundle\Utility\LuckyNumbersGenerator;

class LuckyNumbersGeneratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function GenerateNumbers_2DigitsLong_Returns10NumbersArray()
    {
        $generator = new LuckyNumbersGenerator();
        $result = $generator->generate(2);

        $this->assertCount(10, $result);
        $expected = ["00", "11", "22", "33", "44", "55", "66", "77", "88", "99"];

        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     */
    public function GenerateNumbers_4DigitsLong_ReturnsArray()
    {
        $generator = new LuckyNumbersGenerator();
        $result = $generator->generate(4);

        $this->assertContains("1010", $result);
        $this->assertContains("1111", $result);
        $this->assertContains("0505", $result);

        $this->assertNotContains("2120", $result);
    }

    /**
     * @test
     */
    public function GenerateNumbers_6DigitsLong_ReturnsArray()
    {
        $generator = new LuckyNumbersGenerator();
        $result = $generator->generate(6);

        $this->assertContains("000000", $result);
        $this->assertContains("001001", $result);
        $this->assertContains("011002", $result);

        $this->assertNotContains("000001", $result);
    }

    /**
     * @test
     */
    public function GenerateNumbers_4Digits_ReturnsArrayWithFirstHundredNumbers()
    {
        $generator = new LuckyNumbersGenerator();
        $result = $generator->generate(4);

        $this->assertCount(100, $result);
        $this->assertEquals("0000", $result[0]);
    }

    /**
     * @test
     */
    public function GenerateNumbers_SecondSliceOf4Digits_ReturnsArrayWithFirstHundredNumbers()
    {
        $generator = new LuckyNumbersGenerator();
        $result = $generator->generate(4, 918);

        $this->assertCount(100, $result);
        $this->assertEquals("1818", $result[0]);
    }

    /**
     * @test
     */
    public function GenerateNumbers_OutOfRangeSliceOf4Digits_ReturnsEmptyArray()
    {
        $generator = new LuckyNumbersGenerator();
        $result = $generator->generate(4, 9999);

        $this->assertCount(0, $result);
    }
}
