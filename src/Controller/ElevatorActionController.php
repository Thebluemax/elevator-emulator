<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\TwigFilter;

use Acme\ControlElevatorBundle\Controller\TimerThread;
use Acme\ControlElevatorBundle\Model\Sequence;
use App\Setting;
/**
 * A simple controller for the report pages
 */
class ElevatorActionController extends AbstractController
{
    /**
+      *  @Route("/")
+      */
    public function report(): Response
    {
        $sequences = Sequence::factorySequencies(Setting::$SEQUENCES);
        $thread = new TimerThread(Setting::$ELEVATORS, Setting::$FLOORS, $sequences);
        $report = $thread->run(Setting::$OPEN, Setting::$CLOSE);
       
        $data = [
            'title' => 'Elevators Emulator',
            'cardTitle' => 'Report Elevator Usage',
            'timeList' => $thread->getTimeList(),
            'sequenceList' => $thread->getSequencesInLoop(),
            'report' => $report,
            'headerElevators' => $thread->getNameList(),
        ];
        
        return $this->render( 'report.html.twig', $data );
    }
  
}