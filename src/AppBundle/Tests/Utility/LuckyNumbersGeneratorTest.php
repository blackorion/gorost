<?php namespace AppBundle\Tests\Utility;

use AppBundle\Utility\LuckyNumbersGenerator;

class LuckyNumbersGeneratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function GenerateNumbers_2DigitsLong_Returns10NumbersArray()
    {
        $result = LuckyNumbersGenerator::generate(2);

        $expected = ["00", "11", "22", "33", "44", "55", "66", "77", "88", "99"];
        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     */
    public function GenerateNumbers_4DigitsLong_ReturnsArray()
    {
        $result = LuckyNumbersGenerator::generate(4);

        $this->assertContains("1120", $result);
        $this->assertContains("5555", $result);
        $this->assertContains("1524", $result);

        $this->assertNotContains("2120", $result);
    }

    /**
     * @test
     */
    public function GenerateNumbers_6DigitsLong_ReturnsArray()
    {
        $result = LuckyNumbersGenerator::generate(6);

        $this->assertContains("011200", $result);
        $this->assertContains("555555", $result);
        $this->assertContains("055505", $result);

        $this->assertNotContains("1524", $result);
    }
}
