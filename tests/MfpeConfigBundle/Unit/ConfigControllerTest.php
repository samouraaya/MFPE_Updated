<?php

namespace Mfpe\ConfigBundle\Unit;

use Symfony\Component\HttpFoundation\JsonResponse;
use GuzzleHttp\Client;


class ConfigControllerTest extends \PHPUnit_Framework_TestCase
{
    protected $client;

    protected function setUp()
    {
        $baseServiceURL = 'http://127.0.0.1:8000';
        $this->client = New \GuzzleHttp\Client([
            'base_uri' => $baseServiceURL,
            'exceptions' => true,
            'http_errors' => false
        ]);
    }

    public function testLogin()
    {
        $response = $this->client->post('/api/user/auth/login', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],

            'json' => [
                "username" => "admin",
                "password" => "admin",
            ],
        ]);
        $content = json_decode($response->getBody(), true);
        $this->assertInternalType('array', $content);
        $this->assertArrayHasKey('Token', $content);
        $this->assertArrayHasKey('expirationDate', $content);
        $this->assertEquals(200, $response->getStatusCode());
        $token = $content['Token'];
        return $token;
    }

    public function test_get_demande()
    {
        $token = $this->testLogin();
        $response = $this->client->get('/api/demande/', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json'
            ],
        ]);

        $this->assertEquals(200, $response->getStatusCode());

    }


}