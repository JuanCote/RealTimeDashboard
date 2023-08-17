<?php

namespace App\Jobs;


use App\Events\NewLoadData;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;


class SendLoadDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $loadAnalysisResults;

    /**
     * Create a new job instance.
     */
    public function __construct(array $loadAnalysisResults)
    {
        $this->loadAnalysisResults = $loadAnalysisResults;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        event(new NewLoadData($this->loadAnalysisResults));
    }
}