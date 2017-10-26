<?php

require_once '../../src/model/IssueRepository.php';
require_once '../../src/model/IssueRepositoryPDO.php';
require_once '../../src/model/Issue.php';

use model\Issue;
use model\IssueRepositoryPDO;

class IssueRepositoryPDOTest extends PHPUnit\Framework\TestCase
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

    public function testFindIssuesByLocationId_idExists_IssueObject()
    {
        $issue1 = new Issue(1, 1, "Verstopte WC", "2017-10-08 00:00:00", 0, 1);
        $issue2 = new Issue(2, 1, "Gebroken lavabo", "2017-10-06 00:00:00", 1, 1);
        $allIssues = array($issue1, $issue2);
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('bindParam');
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('execute');
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('fetchAll')
            ->will($this->returnValue(
                [
                    [ 'id' => $issue1->getId(),
                        'location_id' => $issue1->getLocationId(),
                        'problem' => $issue1->getProblem(),
                        'date' => $issue1->getDate(),
                        'handled' => $issue1->getHandled(),
                        'technician_id' => $issue1->getTechnicianId()
                    ],
                    [ 'id' => $issue2->getId(),
                        'location_id' => $issue2->getLocationId(),
                        'problem' => $issue2->getProblem(),
                        'date' => $issue2->getDate(),
                        'handled' => $issue2->getHandled(),
                        'technician_id' => $issue2->getTechnicianId()
                    ]
                ]));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new IssueRepositoryPDO($this->mockPDO);
        $actualIssues =
            $pdoRepository->getIssuesByLocationId($issue1->getLocationId());
        $this->assertEquals($allIssues, $actualIssues);
    }

    public function testFindIssuesByLocationId_idDoesNotExist_Null()
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
        $pdoRepository = new IssueRepositoryPDO($this->mockPDO);
        $actualIssues = $pdoRepository->getIssuesByLocationId(24);
        $this->assertEquals($actualIssues, '');
    }

    public function testFindIssuesByLocationId_exeptionThrownFromPDO_Null()
    {
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('bindParam')->will(
                $this->throwException(new Exception()));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new IssueRepositoryPDO($this->mockPDO);
        $actualIssues = $pdoRepository->getIssuesByLocationId(24);
        $this->assertEquals($actualIssues, '');
    }

    public function testFindIssueById_idExists_IssueObject()
    {
        $issue = new Issue(1, 1, "Verstopte WC", "2017-10-08 00:00:00", 0, 1);
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('bindParam');
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('execute');
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('fetchAll')
            ->will($this->returnValue(
                [
                    [ 'id' => $issue->getId(),
                        'location_id' => $issue->getLocationId(),
                        'problem' => $issue->getProblem(),
                        'date' => $issue->getDate(),
                        'handled' => $issue->getHandled(),
                        'technician_id' => $issue->getTechnicianId()
                    ]
                ]));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new IssueRepositoryPDO($this->mockPDO);
        $actualIssue =
            $pdoRepository->getIssueById($issue->getId());
        $this->assertEquals($issue, $actualIssue);
    }

    public function testFindIssueById_idDoesNotExist_Null()
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
        $pdoRepository = new IssueRepositoryPDO($this->mockPDO);
        $actualIssue = $pdoRepository->getIssueById(24);
        $this->assertEquals($actualIssue, '');
    }

    public function testFindIssueById_exeptionThrownFromPDO_Null()
    {
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('bindParam')->will(
                $this->throwException(new Exception()));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new IssueRepositoryPDO($this->mockPDO);
        $actualIssues = $pdoRepository->getIssueById(24);
        $this->assertEquals($actualIssues, '');
    }

    public function testFindIssuesByTechnicianId_idExists_IssueObject()
    {
        $issue1 = new Issue(1, 1, "Verstopte WC", "2017-10-08 00:00:00", 0, 1);
        $issue2 = new Issue(2, 1, "Gebroken lavabo", "2017-10-06 00:00:00", 1, 1);
        $allIssues = array($issue1, $issue2);
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('bindParam');
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('execute');
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('fetchAll')
            ->will($this->returnValue(
                [
                    [ 'id' => $issue1->getId(),
                        'location_id' => $issue1->getLocationId(),
                        'problem' => $issue1->getProblem(),
                        'date' => $issue1->getDate(),
                        'handled' => $issue1->getHandled(),
                        'technician_id' => $issue1->getTechnicianId()
                    ],
                    [ 'id' => $issue2->getId(),
                        'location_id' => $issue2->getLocationId(),
                        'problem' => $issue2->getProblem(),
                        'date' => $issue2->getDate(),
                        'handled' => $issue2->getHandled(),
                        'technician_id' => $issue2->getTechnicianId()
                    ]
                ]));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new IssueRepositoryPDO($this->mockPDO);
        $actualIssues =
            $pdoRepository->getIssuesBytechnicianId($issue1->getTechnicianId());
        $this->assertEquals($allIssues, $actualIssues);
    }

    public function testFindIssuesByTechnicianId_idDoesNotExist_Null()
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
        $pdoRepository = new IssueRepositoryPDO($this->mockPDO);
        $actualIssues = $pdoRepository->getIssuesBytechnicianId(24);
        $this->assertEquals($actualIssues, '');
    }

    public function testFindIssuesByTechnicianId_exeptionThrownFromPDO_Null()
    {
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('bindParam')->will(
                $this->throwException(new Exception()));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $pdoRepository = new IssueRepositoryPDO($this->mockPDO);
        $actualIssues = $pdoRepository->getIssuesBytechnicianId(24);
        $this->assertEquals($actualIssues, '');
    }

    public function tearDown()
    {
        $this->mockPDO = null;
        $this->mockPDOStatement = null;
    }
}