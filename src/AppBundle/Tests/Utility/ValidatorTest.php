<?php namespace AppBundle\Tests\Utility;

use AppBundle\Utility\Validator;

class ValidatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function Validate_EmptyString_ReturnFalse()
    {
        $result = Validator::isValid("");

        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function Validate_NotANumber_ReturnsFalse()
    {
        $result = Validator::isValid("test");

        $this->assertFalse($result);
        $this->assertEquals("Только числа", Validator::$lastError);
    }

    /**
     * @test
     */
    public function Validate_NumberAsString_ReturnsTrue()
    {
        $result = Validator::isValid("16");

        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function Validate_GreaterThanZeroEvenNumber_ReturnsTrue()
    {
        $cases = [2, 6, 10, 22, 90];

        foreach ( $cases as $test_case )
        {
            $result = Validator::isValid($test_case);

            $this->assertTrue($result, "Number is greater than 0 and even must return true.");
        }
    }

    /**
     * @test
     */
    public function Validate_GreaterThanZeroOddNumber_ReturnsFalse()
    {
        $cases = [1, 5, 11, 81, 19];

        foreach ( $cases as $test_case )
        {
            $result = Validator::isValid($test_case);

            $this->assertFalse($result, "Number is greater than 0 but odd must return false.");
            $this->assertEquals("Число должно быть четным", Validator::$lastError);
        }
    }

    /**
     * @test
     */
    public function Validate_ZeroNumber_ReturnsFalse()
    {
        $result = Validator::isValid(0);

        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function Validate_NegativeNumber_ReturnsFalse()
    {
        $result = Validator::isValid(-10);

        $this->assertFalse($result);
        $this->assertEquals("Число должно быть больше 1", Validator::$lastError);
    }

    /**
     * @test
     */
    public function Validate_LargeNumber_ReturnsFalse()
    {
        $result = Validator::isValid(110);

        $this->assertFalse($result);
        $this->assertEquals("Число может быть 90 или меньше", Validator::$lastError);
    }
}
