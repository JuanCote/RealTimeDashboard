<?php


namespace App\Helpers;

class CPULoadHelper
{
    public static function getCPULoadInfo(): array
    {
        $cpuLoad = sys_getloadavg()[0] . '% / 100%';
        return ['cpuLoad' => $cpuLoad];
    }
}