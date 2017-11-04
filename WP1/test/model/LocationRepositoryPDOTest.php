<?php

require_once '../../src/model/LocationRepository.php';
require_once '../../src/model/LocationRepositoryPDO.php';
require_once '../../src/model/Location.php';

use model\Location;
use model\LocationRepositoryPDO;

class LocationRepositoryPDOTest extends PHPUnit\Framework\TestCase
{
    public function setUp() {
        $this->mockPDO = $this->getMockBuilder('PDO')
            ->disableOriginalConstructor()
            ->getMock();
        $this->mockPDOStatement =
            $this->getMockBuilder('PDOStatement')
                ->disableOriginalConstructor()
                ->getMock();
        $this->pdoRepository = new LocationRepositoryPDO($this->mockPDO);
    }

    public function testFindLocations_Exists_LocationsObject()
    {
        $location1 = new Location(1, "Gent");
        $location2 = new Location(2, "Hasselt");
        $allLocations= Array($location1, $location2);
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('execute');
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('fetchAll')
            ->will($this->returnValue(
                [
                    [ 'id' => $location1->getId(),
                        'name' => $location1->getName()
                    ],
                    [ 'id' => $location2->getId(),
                        'name' => $location2->getName()
                    ]
                ]));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $actualLocations =
            $this->pdoRepository->getLocations();
        $this->assertEquals($allLocations, $actualLocations);
    }

    public function testFindLocations_noLocations_Null()
    {
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('execute');
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('fetchAll')
            ->will($this->returnValue([]));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $actualEvenement = $this->pdoRepository->getLocations();
        $this->assertEquals($actualEvenement, '');
    }

    public function testFindLocations_exeptionThrownFromPDO_Null()
    {
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $actual£Location = $this->pdoRepository->getLocations();
        $this->assertEquals($actual£Location, '');
    }

    public function testAddLocation_LocationObjectIsCorrect_ReturnsObject()
    {
        $location = new Location(null, "EB500");
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('bindParam');
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('execute')
            ->will($this->returnValue($location));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $actualLocation = $this->pdoRepository->setLocation($location->getName());
        $this->assertEquals($location, $actualLocation);
    }

    public function tearDown()
    {
        $this->mockPDO = null;
        $this->mockPDOStatement = null;
        $this->pdoRepository = null;
    }
}