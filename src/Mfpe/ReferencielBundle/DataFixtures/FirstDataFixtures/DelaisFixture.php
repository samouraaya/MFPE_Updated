<?php
namespace Mfpe\ReferencielBundle\DataFixtures\FirstDataFixtures;

use Mfpe\AttestationBundle\Entity\Delais;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class DelaisFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /****************************** Insert data delais ******************************/
        $faker = Faker\Factory::create('fr_FR');
        $delais  = New Delais();
        $delais->setNbDelaisExamen(3);
        $delais->setNbDelaisPv(10);
        $delais->setCreatedAt(new \DateTime());
        $manager->persist($delais);
        $manager->flush();
    }

}