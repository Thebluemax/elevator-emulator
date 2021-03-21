<?php
namespace  App;
/**
 * A simple static class with the settings.
 */
class Setting
{
    public static $OPEN = 900;
    public static $CLOSE = 2000;

    public static $FLOORS = 4;
    public static $ELEVATORS = 3;

    public static $SEQUENCES = [
        [
            'delay' => 5,
            'start' => 900,
            'end' => 1100,
            'initFloor' => [0],
            'floors' => [2]
        ],
        [
            'delay' => 5,
            'start' => 900,
            'end' => 1100,
            'initFloor' => [0],
            'floors' => [3]
        ],
        [
            'delay' => 10,
            'start' => 900,
            'end' => 1000,
            'initFloor' => [0],
            'floors' => [1]
        ],
        [
            'delay' => 20,
            'start' => 1100,
            'end' => 1832,
            'initFloor' => [0],
            'floors' => [1,2,3]
        ],
        [
            'delay' => 4,
            'start' => 1400,
            'end' => 1500,
            'initFloor' => [1,2,3],
            'floors' => [0]
        ],
        [
            'delay' => 7,
            'start' => 1500,
            'end' => 1600,
            'initFloor' => [2,3],
            'floors' => [0]
        ],
        [
            'delay' => 7,
            'start' => 1500,
            'end' => 1600,
            'initFloor' => [0],
            'floors' => [1,3]
        ],
        [
            'delay' => 3,
            'start' => 1800,
            'end' => 2000,
            'initFloor' => [0],
            'floors' => [1,3]
        ]

    ];
}
