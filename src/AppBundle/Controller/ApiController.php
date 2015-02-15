<?php namespace AppBundle\Controller;

use AppBundle\Utility\LuckyNumbersGenerator;
use AppBundle\Utility\Validator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiController extends Controller
{
    /**
     * @Route("/api/luckynumbers/{number_of_digits}")
     * @param mixed $number_of_digits
     * @return string
     */
    public function luckyNumbersIndex($number_of_digits)
    {
        if ( !Validator::isValid($number_of_digits) )
            return JsonResponse::create(['error' => Validator::$lastError]);

        return JsonResponse::create(["count" => LuckyNumbersGenerator::generate($number_of_digits)]);
    }
}