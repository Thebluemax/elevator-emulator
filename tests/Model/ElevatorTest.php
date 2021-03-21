<?php

namespace App\Tests\Model;

use Acme\ControlElevatorBundle\Model\Elevator;
use PHPUnit\Framework\TestCase;

class ElevatorTest extends TestCase
{
    private $elevator;
    /**
 * @before
 */
    public function setUp():void
    {
        $this->elevator = new Elevator('1', 0);
    }
    /**
     * @test
     */
    public function test_floor_move()
    {

        $this->assertEquals($this->elevator->floor(), 0 );
       // $this->assertTrue(true);
       $this->elevator->toFloor( 3 );

       $this->assertEquals($this->elevator->floor() ,3);

    }
    /** @test */

    public function test_count()
    {
       // $this->elevator = new Elevator('1', 0);

        $this->assertEquals($this->elevator->getCount(), 0);
        $this->elevator->toFloor( 3 );
        $this->assertEquals($this->elevator->getCount(), 3);
        $this->elevator->toFloor( 1 );
        $this->assertEquals($this->elevator->getCount(), 5);

    }
    /** @test */
    public function test_direction()
    {
       // $this->elevator = new Elevator('1', 0);
        $this->assertEquals($this->elevator->getDirection(), Elevator::$STAND);

        $this->elevator->toFloor(2);

        $this->assertEquals($this->elevator->getDirection(), Elevator::$UP);

        $this->elevator->toFloor(1);

        $this->assertEquals($this->elevator->getDirection(), Elevator::$DOWN);
    }
}
