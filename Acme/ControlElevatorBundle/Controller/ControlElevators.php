<?php

namespace Acme\ControlElevatorBundle\Controller;

use Acme\ControlElevatorBundle\Model\Elevator;

/**
 * The elevators Controller's Class, manage the elevators in the building.
 */
class ControlElevators
{
    private $elevators = [];
    private $floors = [];
    private $callElevator = [];
    private $prefix = 'ele-';
    private $lastElevator = [];
    /**
     * The constructor of the class
     *
     * @param int $numFloors the numbers of floors
     * @param int $numElevators the number of elevators
     */
    public function __construct($numFloors, $numElevators)
    {
        for ($i = 0; $i < $numElevators; $i++) {
            $this->elevators[ ] = new Elevator($this->prefix.$i, 0);
        }
        for ($e=0; $e < $numFloors; $e++) {
            $this->floors[] = $i;
        }
    }
    /**
     * Find a unused elevator in the floor. If not, returns null
     *
     * @param int $floor the floor
     * @return Elevator
     */
    public function isElevatorInFloor($floor): ?Elevator
    {
        $isInFloor = null;
        foreach ($this->elevators as $elevator) {
            if ($elevator->floor() === $floor && !$elevator->isBusy() && !in_array($elevator->getName(), $this->lastElevator)) {
                $isInFloor = $elevator;
                $elevator->setBusy(true);
                break;
            }
            
            if ($isInFloor != null) {
               
                $this->registerUsage($elevator);
            }
        }
        return $isInFloor;
    }
    /**
     * Calls a unused elevator. If not returns null
     *
     * @param int $floor
     * @return Elevator
     */
    public function callElevator($floor): ?Elevator
    {
        $tempElevator = null;
        foreach ($this->elevators as $elevator) {
            if (!$elevator->isBusy() && !in_array($elevator->getName(), $this->lastElevator)) {
                $elevator->toFloor($floor);
                $elevator->setBusy(true);
                $tempElevator = $elevator;
                break;
            }
        }
        if ($tempElevator != null) {
            
            $this->registerUsage($elevator);
        }
            
        return $tempElevator;
    }
    /**
     * Method for control the register for the 
     * the elevators order optimization .
     *
     * @param Elevator $elevator
     * @return void
     */
    private function registerUsage($elevator)
    {
        if (count($this->lastElevator) >= count($this->elevators) - 1) {
            $this->lastElevator = [];
        }
        $this->lastElevator[] = $elevator->getName();
    }
    /**
     * Get floor array
     *
     * @return array
     */
    public function getFloors(): array
    {
        return $this->floors;
    }
    /**
     * Get all elevators
     *
     * @return array
     */
    public function getElevators(): array
    {
        return $this->elevators;
    }
    /**
     * Get a elevator by they name 
     *
     * @param string $name the elevator name
     * @return Elevator
     */
    public function getElevator($name): Elevator
    {
        return $this->elevators[$name];
    }
    /**
     * Crete an array with the information of all elevators and
     * reset the counters
     *
     * @return array
     */
    public function getElevatorSFloorsArray(): array
    {
        $tempArray = [];
        foreach ($this->elevators as $elevator) {
            $tempArray[] = [$elevator->getName(), $elevator->floor(), $elevator->getCount()];
            $elevator->resetCount();
        }
        return $tempArray;
    }
    /**
     * Returns an array of strings with the names of all elevators.
     *
     * @return array
     */
    public function getElevatorsName(): array
    {
        $nameList = [];
        foreach ($this->elevators as $elevator) {
            $nameList[] = $elevator->getName();
        }
        return $nameList;
    }
}
