<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LandingPageTest extends WebTestCase
{
    public function testButtonWithLoginExist(): void
    {
        $client = static::createClient();
        $client->setServerParameter('HTTP_HOST', 'medinfo.test:46569');
        $crawler = $client->request('GET', '/');

        $this->assertSelectorExists('button:contains("Zaloguj się")');
    }

    public function testButtonWithRegisterExist(): void
    {
        $client = static::createClient();
        $client->setServerParameter('HTTP_HOST', 'medinfo.test:46569');
        $crawler = $client->request('GET', '/');

        $this->assertSelectorExists('button:contains("Zarejestruj się")');
    }
}
