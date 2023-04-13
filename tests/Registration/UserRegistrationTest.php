<?php

use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\BrowserKit\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserRegistrationTest extends WebTestCase
{
    public function testSubmitRegistrationForm()
    {
        $client = static::createClient();
        $client->setServerParameter('HTTP_HOST', 'medinfo.test:46569');

        $crawler = $client->request(Request::METHOD_GET, '/register');
        $submitButton = $crawler->selectButton('Zarejestruj');

        $form = $submitButton->form();

        $form['user[First_Name]'] = 'John';
        $form['user[Second_Name]'] = 'Doe';
        $form['user[Last_Name]'] = 'Smith';
        $form['user[username]'] = 'jodo45';
        $form['user[Licensure_Number]'] = '112233A';
        $form['user[password][first]'] = 'Password_123';
        $form['user[password][second]'] = 'Password_123';

        $client->submit($form);
        $responseContent = $client->getResponse()->getContent();
        $this->assertStringContainsString('Zostałeś zarejestrowany. Twój przełożony musi aktywować twoje konto!', $responseContent);
    
    }


     public function testUserCannotRegisterWithInvalidData()
    {
        $client = static::createClient();
        $client->setServerParameter('HTTP_HOST', 'medinfo.test:46569');
        $crawler = $client->request(Request::METHOD_GET, '/register');
        $submitButton = $crawler->selectButton('Zarejestruj');

        $form = $submitButton->form();

        $form['user[First_Name]'] = 'John';
        $form['user[Second_Name]'] = 'Doe';
        $form['user[Last_Name]'] = 'Smith';
        $form['user[username]'] = 'johnd';
        $form['user[Licensure_Number]'] = '112233A';
        $form['user[password][first]'] = 'Password';
        $form['user[password][second]'] = 'Password';

        $client->submit($form);
        
        var_dump($client->getResponse()->getContent());

        $responseContent = $client->getResponse()->getContent();
        $this->assertStringContainsString('Zostałeś zarejestrowany. Twój przełożony musi aktywować twoje konto!', $responseContent);
    } 
}
