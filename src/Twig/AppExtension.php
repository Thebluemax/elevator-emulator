<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;
/**
 * A custom collection of filters and functions
 */
class AppExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
            new TwigFilter('hour',[$this, 'formatHour']),
        ];
    }
/**
 * Default function generated
 *
 * @return array
 */
    public function getFunctions(): array
    {
       return [
           new TwigFunction('function_name', [$this, 'doSomething']),
        ];
    }
/**
 * Give a human format to the time
 *
 * @param int $hour
 * @return string
 */
    public function formatHour ($hour)
    {
        $stringTime = '';
        if($hour < 1000){
            $stringTime = '0'.$hour;
        } else {
            $stringTime = ''.$hour;
        }
        $stringHour = substr($stringTime,0,2);
        $stringMinute = substr($stringTime,2,2);
        return $stringHour.':'.$stringMinute;
    }
    /**
     * TODO: do a function
     *
     * @return void
     */
    public function doSomething()
    {
        # code...
    }
}
