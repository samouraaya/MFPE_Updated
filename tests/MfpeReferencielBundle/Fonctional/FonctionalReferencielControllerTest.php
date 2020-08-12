<?php

namespace Mfpe\ReferencielBundle\Fonctional;

use Symfony\Component\HttpFoundation\JsonResponse;
use GuzzleHttp\Client;

class FonctionalReferencielControllerTest extends \PHPUnit_Framework_TestCase
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

    public function testGetRefencielWithoutToken()
    {
        $response = $this->client->get('/api/referenciel/', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'X-Auth-Client' => "mzr2qe4qeweqwe",
                'X-Auth-Token' => "nokrq2131qweqrqrqew"
            ]
        ]);
        $response = $this->client->getResponse();
        $this->assertJsonResponse($response, 401);

    }


}