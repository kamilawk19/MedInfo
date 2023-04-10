<?php

namespace App\Test\Controller;

use App\Entity\Appointment;
use App\Repository\AppointmentRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AppointmentControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private AppointmentRepository $repository;
    private string $path = '/appointment/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Appointment::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Appointment index');

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
            'appointment[Has_Happened]' => 'Testing',
            'appointment[Start]' => 'Testing',
            'appointment[End]' => 'Testing',
            'appointment[ID_Patient]' => 'Testing',
            'appointment[ID_Dialysis]' => 'Testing',
        ]);

        self::assertResponseRedirects('/appointment/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Appointment();
        $fixture->setHas_Happened('My Title');
        $fixture->setStart('My Title');
        $fixture->setEnd('My Title');
        $fixture->setID_Patient('My Title');
        $fixture->setID_Dialysis('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Appointment');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Appointment();
        $fixture->setHas_Happened('My Title');
        $fixture->setStart('My Title');
        $fixture->setEnd('My Title');
        $fixture->setID_Patient('My Title');
        $fixture->setID_Dialysis('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'appointment[Has_Happened]' => 'Something New',
            'appointment[Start]' => 'Something New',
            'appointment[End]' => 'Something New',
            'appointment[ID_Patient]' => 'Something New',
            'appointment[ID_Dialysis]' => 'Something New',
        ]);

        self::assertResponseRedirects('/appointment/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getHas_Happened());
        self::assertSame('Something New', $fixture[0]->getStart());
        self::assertSame('Something New', $fixture[0]->getEnd());
        self::assertSame('Something New', $fixture[0]->getID_Patient());
        self::assertSame('Something New', $fixture[0]->getID_Dialysis());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Appointment();
        $fixture->setHas_Happened('My Title');
        $fixture->setStart('My Title');
        $fixture->setEnd('My Title');
        $fixture->setID_Patient('My Title');
        $fixture->setID_Dialysis('My Title');

        $this->repository->save($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/appointment/');
    }
}
