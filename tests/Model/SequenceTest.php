<?php

namespace App\Tests\Model;

use PHPUnit\Framework\TestCase;
use Acme\ControlElevatorBundle\Model\Sequence as Sequence;
use Acme\ControlElevatorBundle\Controller\ControlElevators;

class SequenceTest extends TestCase
{
    private $start = 900;
    private $end = 1000;
    private $delay = 5;
    private $floors = [1,2];
    private $startFloor = [0];
    private $sequence;
    private $control;

    public function setUp():void
    {
        $this->control = new ControlElevators(2, 3);
        $this->sequence = new Sequence($this->start,
                        $this->end,$this->delay,$this->startFloor, $this->floors);
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_sequence()
    {
        $this->assertTrue(true);
    }

    function test_can_execute()
    {
        $time1 = 900;
        $time2 = 1000;

        $this->assertTrue($this->sequence->canExecute($time1));
        $this->assertTrue($this->sequence->canExecute($time2));

    }

    function test_can_not_execute()
    {
        $time1 = 1001;
        $time2 = 899;

        $this->assertFalse($this->sequence->canExecute($time1));
        $this->assertFalse($this->sequence->canExecute($time2));
    }

    public function test_can_do_action_in_init()
    {
        $this->assertTrue($this->sequence->doAction());
    }

    public function test_delay_false()
    {
        $this->sequence->tic();

        $this->assertFalse($this->sequence->doAction());
    }

    public function test_is_start_true(Type $var = null)
    {
        $this->assertTrue($this->sequence->doAction());
    }

    public function test_tic_delay()
    {

        $ticToDelay =  ($this->delay / .5) ;

        for ($i=0; $i < $ticToDelay; $i++) {
            $this->sequence->tic();
        }
        $this->assertEquals($this->sequence->getTime(),5.0);

        $this->assertTrue($this->sequence->doAction());
        $this->sequence->tic();
        $this->assertFalse($this->sequence->doAction());

    }

    public function test_elevator_movement()
    {
        foreach ($this->control->getElevators() as $elevator) {
            $this->assertEquals(0, $elevator->floor());
        }
        $this->sequence->elevatorMove($this->control);
        $elevators = $this->control->getElevators();
        $this->assertEquals(2, $elevators[0]->floor());
        $this->assertEquals(0, $elevators[1]->floor());

    }
}
