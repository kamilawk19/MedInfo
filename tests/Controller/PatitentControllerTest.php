<?php

namespace App\Test\Controller;

use App\Entity\Patitent;
use App\Repository\PatitentRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PatitentControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private PatitentRepository $repository;
    private string $path = '/patitent/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Patitent::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Patitent index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'patitent[PESEL]' => 'Testing',
            'patitent[Document_Number]' => 'Testing',
            'patitent[Document_Name]' => 'Testing',
            'patitent[First_Name]' => 'Testing',
            'patitent[Second_Name]' => 'Testing',
            'patitent[Last_Name]' => 'Testing',
            'patitent[Sex]' => 'Testing',
            'patitent[Dialing_Code]' => 'Testing',
            'patitent[Phone_Number]' => 'Testing',
            'patitent[Contact_Dialing_Code]' => 'Testing',
            'patitent[Contact_Phone_Number]' => 'Testing',
            'patitent[Additional_info]' => 'Testing',
            'patitent[ID_Address]' => 'Testing',
        ]);

        self::assertResponseRedirects('/patitent/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Patitent();
        $fixture->setPESEL('My Title');
        $fixture->setDocument_Number('My Title');
        $fixture->setDocument_Name('My Title');
        $fixture->setFirst_Name('My Title');
        $fixture->setSecond_Name('My Title');
        $fixture->setLast_Name('My Title');
        $fixture->setSex('My Title');
        $fixture->setDialing_Code('My Title');
        $fixture->setPhone_Number('My Title');
        $fixture->setContact_Dialing_Code('My Title');
        $fixture->setContact_Phone_Number('My Title');
        $fixture->setAdditional_info('My Title');
        $fixture->setID_Address('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Patitent');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Patitent();
        $fixture->setPESEL('My Title');
        $fixture->setDocument_Number('My Title');
        $fixture->setDocument_Name('My Title');
        $fixture->setFirst_Name('My Title');
        $fixture->setSecond_Name('My Title');
        $fixture->setLast_Name('My Title');
        $fixture->setSex('My Title');
        $fixture->setDialing_Code('My Title');
        $fixture->setPhone_Number('My Title');
        $fixture->setContact_Dialing_Code('My Title');
        $fixture->setContact_Phone_Number('My Title');
        $fixture->setAdditional_info('My Title');
        $fixture->setID_Address('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'patitent[PESEL]' => 'Something New',
            'patitent[Document_Number]' => 'Something New',
            'patitent[Document_Name]' => 'Something New',
            'patitent[First_Name]' => 'Something New',
            'patitent[Second_Name]' => 'Something New',
            'patitent[Last_Name]' => 'Something New',
            'patitent[Sex]' => 'Something New',
            'patitent[Dialing_Code]' => 'Something New',
            'patitent[Phone_Number]' => 'Something New',
            'patitent[Contact_Dialing_Code]' => 'Something New',
            'patitent[Contact_Phone_Number]' => 'Something New',
            'patitent[Additional_info]' => 'Something New',
            'patitent[ID_Address]' => 'Something New',
        ]);

        self::assertResponseRedirects('/patitent/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getPESEL());
        self::assertSame('Something New', $fixture[0]->getDocument_Number());
        self::assertSame('Something New', $fixture[0]->getDocument_Name());
        self::assertSame('Something New', $fixture[0]->getFirst_Name());
        self::assertSame('Something New', $fixture[0]->getSecond_Name());
        self::assertSame('Something New', $fixture[0]->getLast_Name());
        self::assertSame('Something New', $fixture[0]->getSex());
        self::assertSame('Something New', $fixture[0]->getDialing_Code());
        self::assertSame('Something New', $fixture[0]->getPhone_Number());
        self::assertSame('Something New', $fixture[0]->getContact_Dialing_Code());
        self::assertSame('Something New', $fixture[0]->getContact_Phone_Number());
        self::assertSame('Something New', $fixture[0]->getAdditional_info());
        self::assertSame('Something New', $fixture[0]->getID_Address());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Patitent();
        $fixture->setPESEL('My Title');
        $fixture->setDocument_Number('My Title');
        $fixture->setDocument_Name('My Title');
        $fixture->setFirst_Name('My Title');
        $fixture->setSecond_Name('My Title');
        $fixture->setLast_Name('My Title');
        $fixture->setSex('My Title');
        $fixture->setDialing_Code('My Title');
        $fixture->setPhone_Number('My Title');
        $fixture->setContact_Dialing_Code('My Title');
        $fixture->setContact_Phone_Number('My Title');
        $fixture->setAdditional_info('My Title');
        $fixture->setID_Address('My Title');

        $this->repository->save($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/patitent/');
    }
}
