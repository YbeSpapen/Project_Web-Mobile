<?php
/**
 * Created by PhpStorm.
 * User: brecht
 * Date: 26/10/2017
 * Time: 09:13
 */

namespace AppBundle\Tests\Controller;

use AppBundle\Entity\Issue;
use AppBundle\Entity\Location;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class DoctrineQuerryTest extends KernelTestCase
{

    private $em;

    protected function setUp()
    {
        self::bootKernel();

        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    //LOCATIONS
    public function testFindAllLocations()
    {
        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $locations = $this->em->getRepository(Location::class)->findAll();

        $this->assertContainsOnlyInstancesOf(Location::class, $locations);
    }


    public function testFindAllIssues()
    {
        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $issues = $this->em->getRepository(Issue::class)->findAll();

        $this->assertContainsOnlyInstancesOf(Issue::class, $issues);
    }
}
