<?php

namespace App\Console\Commands;

use App\Helpers\CPULoadHelper;
use App\Helpers\DBLoadHelper;
use App\Helpers\MemoryHelper;
use App\Jobs\SendLoadDataJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class LoadAnalyzeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'loadAnalyze:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load analyze Command';
    /**
     * Execute the console command.
     */

    private $memoryHelper;
    private $CPULoadHelper;
    private $DBLoadHelper;

    public function __construct(

        MemoryHelper $memoryHelper,
        CPULoadHelper $CPULoadHelper,
        DBLoadHelper $DBLoadHelper
    ) {
        parent::__construct();
        $this->memoryHelper = $memoryHelper;
        $this->CPULoadHelper = $CPULoadHelper;
        $this->DBLoadHelper = $DBLoadHelper;
    }

    public function handle()
    {
        $loadAnalysisResults = [
            'memoryLoad' => $this->memoryHelper->getMemoryInfo(),
            'cpuLoad' => $this->CPULoadHelper->getCPULoadInfo(),
            'DBLoad' => $this->DBLoadHelper->getDBLoadInfo()
        ];
        SendLoadDataJob::dispatch($loadAnalysisResults);
    }
}