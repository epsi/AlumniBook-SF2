<?php
// src/Iluni\BookBundle/DataFixtures/ORM/LoadReligionData.php
namespace Iluni\BookBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Iluni\BookBundle\DataFixtures\LoadBookData;
use Iluni\BookBundle\Entity\Category\Religion;

/**
 * Load data fixtures for a category entity
 *
 * @author E.R. Nurwijayadi <epsi.rns@gmail.com>
 */
class LoadReligionData extends LoadBookData implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $fixtures = $this->getModelFixtures();
        $items = $fixtures['Religion'];

        // generator: { strategy: AUTO }
        $this->setForceId($em, new Religion());

        // Now iterate over all fixtures
        foreach ($items as $ref => $item) {
            $fixture = new Religion();
            $fixture
                ->setId($item['religion_id'])
                ->setName($item['religion']);

            $em->persist($fixture);

            // Add a reference to be able to use this object in others entities loaders
            $this->addReference('religion-'. $ref, $fixture);
        }

        $em->flush();
    }

    /**
    *  The main fixtures file for this loader.
    */
    public function getModelFile()
    {
        return 'Category/010_religion';
    }

    public function getOrder()
    {
        return 10; // the order in which fixtures will be loaded
    }
}

