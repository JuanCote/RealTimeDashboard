<?php


namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Laravel\Telescope\Telescope;


class DBLoadHelper
{
    public function getDBLoadInfo()
    {
        $totalQueries = DB::getQueryLog();
        $queryCount = count($totalQueries);
        $totalTime = array_sum(array_column($totalQueries, 'time'));
        return [
            'queryCount' => $queryCount,
            'totalTime' => $totalTime
        ];
    }

}