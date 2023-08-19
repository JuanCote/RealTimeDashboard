<?php


namespace App\Helpers;


class MemoryHelper
{
    public function getMemoryInfo(): array
    {
        $ramInfo = $this->getRAMInfo();
        $dickInfo = $this->getDiskMemoryInfo();
        return [
            'RAMInfo' => $ramInfo,
            'diskInfo' => $dickInfo
        ];
    }

    private function getDiskMemoryInfo(): array
    {
        $freeSpace = floatval(number_format(disk_free_space('/') / (1024 * 1024 * 1024), 2));
        $totalSpace = floatval(number_format(disk_total_space('/') / (1024 * 1024 * 1024), 2));
        $usedMemory = floatval(number_format($totalSpace - $freeSpace, 2));
        return [
            'totalSpace' => $totalSpace,
            'freeSpace' => $freeSpace,
            'usedMemory' => $usedMemory
        ];
    }

    private function getRAMInfo(): array
    {
        // Get memory information using the 'free' command
        $memoryInfo = shell_exec('free');
        $memoryInfo = (string) trim($memoryInfo);
        $memoryLines = explode("\n", $memoryInfo);
        $memoryValues = explode(" ", $memoryLines[1]);
        $memoryValues = array_filter($memoryValues);
        $memoryValues = array_merge($memoryValues);

        // Used memory
        $usedMemory = $memoryValues[2];
        $usedMemoryInGB = floatval(number_format($usedMemory / 1048576, 2));

        // Percentage of used memory
        $usedMemoryPercentage = round($memoryValues[2] / $memoryValues[1] * 100);

        // Total memory
        $fh = fopen('/proc/meminfo', 'r');
        $totalMemory = 0;
        while ($line = fgets($fh)) {
            $pieces = array();
            if (preg_match('/^MemTotal:\s+(\d+)\skB$/', $line, $pieces)) {
                $totalMemory = $pieces[1];
                break;
            }
        }
        fclose($fh);
        $totalMemoryInGB = floatval(number_format($totalMemory / 1048576, 2));

        return [
            'totalMemoryInGB' => $totalMemoryInGB,
            'usedMemoryInGB' => $usedMemoryInGB,
            'usedMemoryPercentage' => $usedMemoryPercentage
        ];
    }
}