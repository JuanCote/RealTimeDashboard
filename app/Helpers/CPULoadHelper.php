<?php


namespace App\Helpers;

class CPULoadHelper
{
    public function getCPULoadInfo(): array
    {
        $cpuLoad = sys_getloadavg()[0];
        return [
            'CPULoad' => $cpuLoad,
            'totalCPU' => 100
        ];
    }
}