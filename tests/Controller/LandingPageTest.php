<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LandingPageTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $client->setServerParameter('HTTP_HOST', 'medinfo.test:46569');
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Usługi dla pracowników służby zdrowia');
    }
}
