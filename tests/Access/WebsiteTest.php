<?php
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\User;
use App\Repository\UserRepository;

class WebsiteTest extends WebTestCase
{
    /* public function testUnauthenticatedUserCanAccessHomepage()
    {
        $kernel = static::createKernel();
        $kernel->boot();

        $client = static::createClient(array(), array(
            'HTTP_HOST' => 'medinfo.test:46569',
        ));

        $client->request(Request::METHOD_GET, '/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    } */

    public function testAuthenticatedUserWithRoleUserCanAccessPharmacySupply()
    {
        $client = static::createClient(array(), array(
            'HTTP_HOST' => 'medinfo.test:46569',
        ));
        $userRepository = static::getContainer()->get(UserRepository::class);

        // retrieve the test user
        $testUser = $userRepository->findOneByUsername('JaNo1243');

        // simulate $testUser being logged in
        $client->loginUser($testUser);

        // test e.g. the profile page
        $client->request('GET', '/pharmacysupply/');
        $this->assertResponseIsSuccessful();
    }

    public function testAuthenticatedUserWithRoleUserCanAccessMedicalProcedureNEW()
    {
        //should fail
        $client = static::createClient(array(), array(
            'HTTP_HOST' => 'medinfo.test:46569',
        ));
        $userRepository = static::getContainer()->get(UserRepository::class);

        // retrieve the test user
        $testUser = $userRepository->findOneByUsername('JaNo1243');

        // simulate $testUser being logged in
        $client->loginUser($testUser);

        $client->request('GET', '/medical-procedure/new');
        $this->assertResponseIsSuccessful();
    }
}
