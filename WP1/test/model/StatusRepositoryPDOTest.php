<?php

require_once '../../src/model/StatusRepository.php';
require_once '../../src/model/StatusRepositoryPDO.php';
require_once '../../src/model/Status.php';

use model\Status;
use model\StatusRepositoryPDO;

class StatusRepositoryPDOTest extends PHPUnit\Framework\TestCase
{
    public function setUp() {
        $this->mockPDO = $this->getMockBuilder('PDO')
            ->disableOriginalConstructor()
            ->getMock();
        $this->mockPDOStatement =
            $this->getMockBuilder('PDOStatement')
                ->disableOriginalConstructor()
                ->getMock();
    }

    public function testFindStatusesByLocationId_idExists_StatusObject()
    {
        $status1 = new Status(1, 1, "goed", "2017-10-08 00:00:00");
        $status2 = new Status(2, 1, "goed", "2017-10-09 00:00:00");
        $allStatuses = array($status1, $status2);
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('bindParam');
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('execute');
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('fetchAll')
            ->will($this->returnValue(
                [
                    [ 'id' => $status1->getId(),
                        'locationId' => $status1->getLocationId(),
                        'status' => $status1->getStatus(),
                        'date' => $status1->getDate()
                    ],
                    [ 'id' => $status2->getId(),
                        'locationId' => $status2->getLocationId(),
                        'status' => $status2->getStatus(),
                        'date' => $status2->getDate()
                    ]
                ]));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new StatusRepositoryPDO($this->mockPDO);
        $actualStatuses =
            $pdoRepository->getStatusesByLocationId($status1->getLocationId());

        $this->assertEquals($allStatuses, $actualStatuses);
    }

    public function testFindStatusesByLocationId_idDoesNotExist_Null()
    {
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('bindParam');
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('execute');
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('fetchAll')
            ->will($this->returnValue([]));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new StatusRepositoryPDO($this->mockPDO);
        $actualStatuses = $pdoRepository->getStatusesByLocationId(24);
        $this->assertEquals($actualStatuses, '');
    }

    public function testFindStatusesByLocationId_exeptionThrownFromPDO_Null()
    {
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('bindParam')->will(
                $this->throwException(new Exception()));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new StatusRepositoryPDO($this->mockPDO);
        $actualStatuses = $pdoRepository->getStatusesByLocationId(24);
        $this->assertEquals($actualStatuses, '');
    }

    public function tearDown()
    {
        $this->mockPDO = null;
        $this->mockPDOStatement = null;
    }
}