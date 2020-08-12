<?php

namespace Mfpe\ReferencielBundle\Unit;

use Symfony\Component\HttpFoundation\JsonResponse;
use GuzzleHttp\Client;


class ReferencielControllerTest extends \PHPUnit_Framework_TestCase
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

    public function testPostReferenciel()
    {
        $response = $this->client->post('/api/referenciel/new', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'X-Auth-Client' => "mzr2qe4qeweqwe",
                'X-Auth-Token' => "nokrq2131qweqrqrqew"
            ],
            'json' => [
                "intitulear" => "test REF",
                "intitulefr" => "test REF",
                "categorie" => "RefGouvernorat",
                "code" => "UNIT-TEST-55"
            ],
        ]);

        $this->assertEquals(201, $response->getStatusCode());

    }
    public function testPutReferenciel()
    {
        $response = $this->client->put('/api/referenciel/2', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'X-Auth-Client' => "mzr2qe4qeweqwe",
                'X-Auth-Token' => "nokrq2131qweqrqrqew"
            ],
            'json' => [
                "intitulear" => "test REF1",
                "intitulefr" => "test REF1",
                "categorie" => "RefGouvernorat",
                "code" => "UNIT-TEST-555"
            ],
        ]);

        $this->assertEquals(202, $response->getStatusCode());

    }

    public function testGetAllReferenciel()
    {
        $response = $this->client->get('/api/referenciel/', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'X-Auth-Client' => "mzr2qe4qeweqwe",
                'X-Auth-Token' => "nokrq2131qweqrqrqew"
            ]
        ]);

        $this->assertEquals(200, $response->getStatusCode());

    }
}