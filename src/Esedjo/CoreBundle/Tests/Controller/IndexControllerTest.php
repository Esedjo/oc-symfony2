<?php

namespace Esedjo\CoreBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class IndexControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');
    }

    public function testContact()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/Contact');
    }

}
