<?php

require_once '../../src/model/UserRepository.php';
require_once '../../src/model/UserRepositoryPDO.php';
require_once '../../src/model/User.php';

use model\User;
use model\UserRepositoryPDO;

class UserRepositoryPDOTest extends PHPUnit\Framework\TestCase
{
    public function setUp()
    {
        $this->mockPDO = $this->getMockBuilder('PDO')
            ->disableOriginalConstructor()
            ->getMock();
        $this->mockPDOStatement =
            $this->getMockBuilder('PDOStatement')
                ->disableOriginalConstructor()
                ->getMock();
        $this->pdoRepository = new UserRepositoryPDO($this->mockPDO);
    }

    public function testFindTechnicians_Exists_TechniciansObject()
    {
        $technician1 = new User(1, "spapenybe@hotmail.com", "Ybe", null, null);
        $technician2 = new User(2, "robbekimpen@hotmail.com", "Robbe", null, null);
        $allTechnicians = Array($technician1, $technician2);
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('execute');
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('fetchAll')
            ->will($this->returnValue(
                [
                    ['id' => $technician1->getId(),
                        'email' => $technician1->getEmail(),
                        'name' => $technician1->getName(),
                        'role' => null,
                        'password' => null
                    ],
                    ['id' => $technician2->getId(),
                        'email' => $technician2->getEmail(),
                        'name' => $technician2->getName(),
                        'role' => null,
                        'password' => null
                    ]
                ]));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $actualTechnicians =
            $this->pdoRepository->getTechnicians();
        $this->assertEquals($allTechnicians, $actualTechnicians);
    }

    public function testFindTechnicians_noTechnicians_Null()
    {
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('execute');
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('fetchAll')
            ->will($this->returnValue([]));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $actualTechnicians = $this->pdoRepository->getTechnicians();
        $this->assertEquals($actualTechnicians, '');
    }

    public function testFindTechnicians_exeptionThrownFromPDO_Null()
    {
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $actualTechnicians = $this->pdoRepository->getTechnicians();
        $this->assertEquals($actualTechnicians, '');
    }

    public function testAddTechnician_TechnicianObjectIsCorrect_ReturnsObject()
    {
        $technician = new User(null, "spapenybe@hotmail.com", "Ybe", "ROLE_TECHNICIAN", "password123");
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('bindParam');
        $this->mockPDOStatement->expects($this->atLeastOnce())
            ->method('execute')
            ->will($this->returnValue($technician));
        $this->mockPDO->expects($this->atLeastOnce())
            ->method('prepare')
            ->will($this->returnValue($this->mockPDOStatement));
        $actualTechnician = $this->pdoRepository->addTechnician($technician->getEmail(), $technician->getName(), $technician->getRole(), $technician->getPassword());
        $this->assertEquals($technician, $actualTechnician);
    }

    public function tearDown()
    {
        $this->mockPDO = null;
        $this->mockPDOStatement = null;
        $this->pdoRepository = null;
    }
}