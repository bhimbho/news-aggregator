<?php
namespace App\Action;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProcessArticle
{

    public function execute(array $articles)
    {
        print "-- Article Processing --\n";
        $count = 0;
        try {
            DB::transaction(function () use ($articles, &$count) {
                foreach ($articles as $article) {
                    $this->saveArticle($article);
                    $count++;
                }
            });
            print "-- {$count} Article Processed --\n";
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            print "error occurred while processing article\n";
        }
    }

    private function saveArticle(array $article): void
    {
        Article::Create($article);
    }
}