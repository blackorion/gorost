<?php namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiControllerTest extends WebTestCase
{
    /**
     * @test
     */
    public function LuckyNumbers_AnyRequest_ReturnsJSON()
    {
        $client = static::createClient();
        $client->request('GET', '/api/luckynumbers/1');
        $response = $client->getResponse();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/json', $response->headers->get('Content-Type'));
        $this->assertNotEmpty($client->getResponse()->getContent());
        $this->assertJson($response->getContent());
    }

    /**
     * @test
     */
    public function LuckyNumbers_OddNumberOfDigits_ReturnsError()
    {
        $client = static::createClient();
        $client->request('GET', '/api/luckynumbers/1');
        $response = $client->getResponse();

        $this->assertJsonHasKey("error", $response->getContent());
    }

    /**
     * @test
     */
    public function LuckyNumbers_RightNumberOfDigits_ReturnsTotalPossibilities()
    {
        $client = static::createClient();
        $client->request('GET', '/api/luckynumbers/2');
        $response = $client->getResponse();

        $this->assertJsonNotHasKey("error", $response->getContent());
        $this->assertJsonHasKey("count", $response->getContent());
    }

    /**
     * @test
     */
    public function LuckyNumbers_TextAsParameter_ReturnsError()
    {
        $client = static::createClient();
        $client->request('GET', '/api/luckynumbers/text');
        $response = $client->getResponse();

        $this->assertJsonHasKey("error", $response->getContent());
        $this->assertJsonNotHasKey("count", $response->getContent());
    }

    /**
     * @param mixed $key
     * @param string $json
     */
    private function assertJsonHasKey($key, $json)
    {
        $this->assertArrayHasKey($key, json_decode($json, true));
    }

    /**
     * @param $key
     * @param $json
     */
    private function assertJsonNotHasKey($key, $json)
    {
        $this->assertArrayNotHasKey($key, json_decode($json, true));
    }
}
