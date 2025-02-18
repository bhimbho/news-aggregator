<?php

namespace App\Console\Commands;

use App\Service\GuardianApiService;
use App\Service\NewsApiService;
use App\Service\NYTimesApiService;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\Isolatable;

class SourceNewsCommand extends Command implements Isolatable
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:source-news {keyword}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get News From Multiple Source';

    protected $newsService = [];

    public function __construct()
    {
        parent::__construct();
        $this->newsService = [
            // app(NewsApiService::class),
            // app(GuardianApiService::class),
            app(NYTimesApiService::class),
        ];
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $keyword = $this->argument('keyword');
        collect($this->newsService)->each(fn ($service) => $service->getNews($keyword));
    }
}
