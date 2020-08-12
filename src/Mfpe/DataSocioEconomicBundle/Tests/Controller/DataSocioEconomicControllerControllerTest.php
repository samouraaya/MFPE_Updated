<?php

namespace Mfpe\DataSocioEconomicBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DataSocioEconomicControllerControllerTest extends WebTestCase
{
    public function testPost()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/post');
    }

}
