<?php

namespace App\Console\Commands;

use App\Helpers\MemoryHelper;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test Command';
    /**
     * Execute the console command.
     */

    private $memoryHelper;

    public function __construct(

        MemoryHelper $memoryHelper
    ) {
        parent::__construct();
        $this->memoryHelper = $memoryHelper;
    }

    public function handle()
    {
        Log::info(json_encode($this->memoryHelper->getMemoryInfo()));
    }
}