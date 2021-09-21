<?php

namespace App\Enums;

class DurationTypes{
    public static $types = array(
        '1' => 'Hours',
        '2' => 'Days',
        '3' => 'Months',
        '4' => 'Years',
    );

    public static $typesReverse = array(
        'Hours' => '1',
        'Days' => '2',
        'Months' => '3',
        'Years' => '4',
    );
}
