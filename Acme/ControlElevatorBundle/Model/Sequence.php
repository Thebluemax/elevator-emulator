<?php
namespace Acme\ControlElevatorBundle\Model;

use Acme\ControlElevatorBundle\Controller\ControlElevators;

/**
 * Simple class thats reoresenta a sequence of the elevators usage
 */
class Sequence
{
    private $start;
    private $end;
    private $delay;
    private $initFloor;
    private $floors;
    private $time = 0;
    /**
     * Constructor of the class
     *
     * @param int $start time to start the sequence
     * @param int $end  time to stop the sequence
     * @param int $delay delay value between action
     * @param array $initFloor the floor from elevator is called/taked
     * @param array $floors the list of floor to go
     */
    public function __construct($start, $end, $delay, $initFloor, $floors)
    {
        $this->start = $start;
        $this->end = $end;
        $this->delay = $delay;
        $this->floors = $floors;
        $this->initFloor = $initFloor;
        $this->time = $delay;
    }
    /**
     *  if the sequence is active
     *
     * @param int $time current time
     * @return boolean
     */
    public function canExecute($time)
    {
        return $this->end >= $time && $this->start <= $time;
    }
    /**
     * tic-tac for the internal time for delays
     *
     * @return void
     */
    public function tic()
    {
        if ($this->time <= $this->delay) {
            $this->time += .5;
        } else {
            $this->time = 1;
        }
    }
    /**
     * if can execute the sequence
     *
     * @return boolean
     */
    public function doAction()
    {
        return $this->time == $this->delay ? true : false;
    }
    /**
     * get the current time from the internal class timer
     *
     * @return int
     */
    public function getTime()
    {
        return $this->time;
    }
    /**
     * execute a movement of elevators if
     *
     * @param ControlElevators $controlElevator
     * @return void
     */
    public function elevatorMove(ControlElevators $controlElevator)
    {
        $elevators = [];
        foreach ($this->initFloor as $initFor) {
            $elevator = $controlElevator->isElevatorInFloor($initFor);
            if (!$elevator) {
                $elevator = $controlElevator->callElevator($initFor);
            }
            $elevators[] = $elevator;
        }
        $this->tic();
        $i = 0;
        foreach ($elevators as $elevator) {
            foreach ($this->floors as $floorTo) {
                $elevator->toFloor($floorTo);
            }
        }
        $this->tic();
    }
    /**
     * returns the initial floor
     *
     * @return void
     */
    public function getInitFloor()
    {
        return $this->initFloor;
    }
    /**
     * Factory that generate an array of sequences
     *
     * @param array $sequencies
     * @return void
     */
    public static function factorySequencies($sequencies)
    {
        $sequenciesArray = [];
        foreach ($sequencies as $sequence) {
            $sequenciesArray[] =  new Sequence(
                $sequence['start'],
                $sequence['end'],
                $sequence['delay'],
                $sequence['initFloor'],
                $sequence['floors']
            );
        }
        return $sequenciesArray;
    }
}
