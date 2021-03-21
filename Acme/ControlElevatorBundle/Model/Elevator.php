<?php

namespace Acme\ControlElevatorBundle\Model;

class Elevator
{
    public static $UP = 'up';
    public static $DOWN = 'down';
    public static $STAND = 'stand';

    private $floor;
    private $isBusy;
    private $isEmpty;
    private $name;
    private $direction;

    private $floorCount;
    /**
     * Constructor de la clase
     *
     * @param $floor the initial floor number
     */
    public function __construct($name, $floor)
    {
        $this->name = $name;
        $this->floor = $floor;
        $this->floorCount = 0;
        $this->isBusy = false;
        $this->isEmpty = false;
        $this->direction = Elevator::$STAND;
    }

    public function floor()
    {
        return $this->floor;
    }
    /**
     * Go to the floor given
     *
     * @parem $floor the number of the floor to go
     */
    public function toFloor($floor)
    {
        if ($floor > $this->floor) {
            $this->direction = Elevator::$UP;
        } else {
            $this->direction = Elevator::$DOWN;
        }
        $this->floorCount += abs($this->floor - $floor);
        $this->floor = $floor;
        $this->isBusy =  false;
    }
/**
 * Set a elevator as busy
 *
 * @param boolean $isBusy
 * @return void
 */
    public function setBusy($isBusy)
    {
        $this->isBusy = $isBusy;
    }
/**
 * Get the elevator's busy staus
 *
 * @return boolean
 */
    public function isBusy()
    {
        return $this->isBusy;
    }
/**
 * Get the count of floors traveled
 *
 * @return int
 */
    public function getCount()
    {
        return $this->floorCount;
    }
/**
 * Get the actual direcction of the elevator
 *
 * @return string
 */
    public function getDirection()
    {
        return $this->direction;
    }
/**
 * Get the elevator's name
 *
 * @return string
 */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Reset the floor's traveled counter
     *
     * @return void
     */
    public function resetCount()
    {
        $this->floorCount = 0;
    }
}
