<?php

namespace App\Jobs;

use App\Action\ProcessArticle;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessNewsArticlesJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(private array $articles)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(ProcessArticle $processor): void
    {
        $processor->execute($this->articles);
    }
}
