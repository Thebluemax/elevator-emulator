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
    private $timerThread;
    private $numElevators = 2;

    public function setUp():void
    {
        //$this->control = new ControlElevators(2, 3);
        $this->sequence = new Sequence(
            $this->start,
            $this->end,
            $this->delay,
            $this->startFloor,
            $this->floors
        );
        $this->timerThread = new TimerThread($this->numElevators,3,$this->sequence);
    
    }

    public function Test_timer_list()
    {
        $init = 300;
        $end = $init * 2;

        $this->assertCount(0, $this->timeThread->getTimeList);
        $this->timeThread->run($init, $end);
        $this->assertCount($init, $this->timeThread->getTimeList);
    }
    public function Test_timer_list_content()
    {
        $init = 300;
        $end = $init * 2;

       // $this->assertCount(0, $this->timeThread->getTimeList);
        $this->timeThread->run($init, $end);
        $this->assertContains([$init, $end], $this->timeThread->getTimeList);
    }
    public function Test_time_list_content()
    {
        $init = 300;
        $end = $init * 2;

        $this->assertCount($init, $this->timeThread->getTimeList);
        $this->timeThread->run($init, $end);
        $this->assertContains([$init, $end], $this->timeThread->getTimeList);
    }
    public function Test_time_list_minutes()
    {
        $init = 300;
        $end = $init * 2;

       // $this->assertCount(0, $this->timeThread->getTimeList);
        $this->timeThread->run($init, $end);
        $this->assertEquals($init + 59, $this->timeThread->getTimeList[59]);
        $this->assertEquals($init + 100, $this->timeThread->getTimeList[60]);
    }
    public function Test_time_report()
    {
        $init = 300;
        $end = $init * 2;

       // $this->assertCount(0, $this->timeThread->getTimeList);
        $report = $this->timeThread->run($init, $end);
        $this->assertCount($init , $report);
        $this->assertCount($this->numElevators, $report[0]);
    }

}