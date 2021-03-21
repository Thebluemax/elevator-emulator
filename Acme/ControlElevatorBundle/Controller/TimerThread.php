<?php
namespace Acme\ControlElevatorBundle\Controller;

use Acme\ControlElevatorBundle\Controller\ControlElevators;

//use Setting;

class TimerThread
{
    private $controlElevator;
    private $sequences;
    private $timeList;
    private $sequencesList;
    /**
     * Constructor of the class
     *
     * @param int $elevators the number of elevators
     * @param int $floors the number of floors
     * @param array $sequences the array with the sequences
     */
    public function __construct($elevators, $floors, $sequences)
    {
        $this->controlElevator = new ControlElevators($floors, $elevators);
        $this->sequences = $sequences;
        $this->timeList= array();
        $this->sequencesList = [];
    }
    /**
     * Run the machine
     *
     * @param int $open
     * @param int $close
     * @return array
     */
    public function run($open, $close)
    {
        $time = $open;
        
        $t = 0;
        $report = [];
        while ($time <= $close) {
            $this->timeList[$t]= $time;
            $report[] = $this->controlElevator->getElevatorSFloorsArray();
            $this->sequencesList[$t] = [];
            for ($i=0;$i < count($this->sequences);$i++) {
                $flag = $this->sequences[$i]->canExecute($time);

                if ($flag) {
                    $doAction = $this->sequences[$i]->doAction();
                    if ($doAction) {
                        $this->sequences[$i]->elevatorMove($this->controlElevator);
                        $this->sequencesList[$t][] = $i+1;
                    } else {
                        $this->sequences[$i]->tic();
                        $this->sequences[$i]->tic();
                    }
                }
            }
            $time = $this->ticTac($time);
            $t++;
        }
        return $report;
    }
    /**
     * the watch of the class
     *
     * @param int $time
     * @return void
     */
    private function ticTac($time)
    {
        $time ++;
        if ($time % 100 === 60) {
            $time = ($time - 60) + 100 ;
        }

        return $time;
    }
    /**
     * Returns an array of int with the hour of each minute
     *
     * @return array
     */
    public function getTimeList()
    {
        return $this->timeList;
    }
    /**
     * Gets an array from the instance of ControlElevators with
     * the name of all elevators
     *
     * @return array
     */
    public function getNameList()
    {
        return $this->controlElevator->getElevatorsName();
    }
    
    public function getSequencesInLoop()
    {
        return $this->sequencesList;
    }
}
