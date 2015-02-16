<?php namespace AppBundle\Controller;

use AppBundle\Utility\LuckyNumbers;
use AppBundle\Utility\Validator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiController extends Controller
{
    /**
     * @Route("/api/luckynumbers/{number_of_digits}/amount")
     * @param mixed $number_of_digits
     *
     * @return string
     */
    public function luckyNumbersAmount($number_of_digits)
    {
        if ( !Validator::isValid($number_of_digits) )
            return JsonResponse::create(['error' => Validator::$lastError]);

        return JsonResponse::create(["count" => LuckyNumbers::amount($number_of_digits)]);
    }

    /**
     * @Route("/api/luckynumbers/{number_of_digits}/list")
     * @param mixed $number_of_digits
     *
     * @return string
     */
    public function luckyNumbersList($number_of_digits)
    {
        if ( !Validator::isValid($number_of_digits) )
            return JsonResponse::create(['error' => Validator::$lastError]);

        return JsonResponse::create(["list" => LuckyNumbers::generate($number_of_digits)]);
    }
}