<?php

namespace Mfpe\CollectDataBundle\Unit;

use Symfony\Component\HttpFoundation\JsonResponse;
use GuzzleHttp\Client;


class CollectDataControllerTest extends \PHPUnit_Framework_TestCase
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

    public function testPost_inscription()
    {
        $response = $this->client->post('/api/users/inscription', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'X-Auth-Client' => "mzr2qe4qeweqwe",
                'X-Auth-Token' => "nokrq2131qweqrqrqew"
            ],

            'json' => [
                "nationalite" => [
                    "id" => 54
                ],
                "num_cin" => 47474747,
                "date_delivrance_cin" => "19-06-2019",
                "num_passport" => "0021655888999",
                "date_delivrance_passport" => "19-06-2019",
                "num_carte_sejour" => 55894555,
                "date_validite_sejour" => "19-06-2019",
                "nom" => "lamine",
                "prenom" => "lamine",
                "date_naissance" => "19-06-1990",
                "gouvernorat" => [
                    "id" => 15
                ],
                "delegation" => [
                    "id" => 40
                ],
                "lieu_naissance" => "Tunis",
                "tel" => [
                    "countryCode" => "tn",
                    "dialCode" => 216,
                    "name" => "Tunisia",
                    "number" => 22100200
                ],
                "email" => "admin-GFI@gfi-tunisie.com",
                "sexe" => "Homme",
                "personne_besoin_specifique" => 0,
                "nature_besoin_specifique" => [
                    "id" => 58
                ],
                "niveau_etude" => [
                    "id" => 64
                ],
                "preview" => true
            ],
        ]);
        $this->assertEquals(201, $response->getStatusCode());

    }
}