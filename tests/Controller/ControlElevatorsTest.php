<?php

namespace App\Tests\Unit;

use Acme\ControlElevatorBundle\Controller\ControlElevators;
use Acme\ControlElevatorBundle\Model\Elevator;
use PHPUnit\Framework\TestCase;


class ControlElevatorsTest extends TestCase
{
    private $controlElevators;
    private $numFloors = 3;
    private $numElevators = 4;

    public function setUp():void
    {
        # code...
        $this->controlElevators = new ControlElevators($this->numFloors, $this->numElevators);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_floors_elevators()
    {
        $this->assertCount( $this->numElevators, $this->controlElevators->getElevators());
        $this->assertCount( $this->numFloors, $this->controlElevators->getFloors());
    }

    public function test_created_elevators()
    {

        $this->assertCount($this->numElevators,$this->controlElevators->getElevators());
        $this->assertContainsOnlyInstancesOf(Elevator::class,$this->controlElevators->getElevators());
        $this->assertContains('ele-1',$this->controlElevators->getElevatorsName());
    }
    public function test_if_is_in_floor(){

        $this->assertIsObject($this->controlElevators->isElevatorInFloor(0));
    }

    public function test_is_not_in_foor()
    {
        $this->assertNull( $this->controlElevators->isElevatorInFloor(1) );
    }

    public function test_move_elevators()
    {
        $this->assertNull( $this->controlElevators->isElevatorInFloor(1) );
        $this->controlElevators->callElevator(1);
        $this->assertIsObject( $this->controlElevators->callElevator(1));

    }
}
