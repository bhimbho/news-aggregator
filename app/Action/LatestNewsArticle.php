<?php
namespace App\Action;

use App\Enum\PlatformEnum;
use App\Models\Article;


class LatestNewsArticle
{
    public function execute(PlatformEnum $platformType)
    {
        return Article::where('platform', $platformType->value)
        ->latest('publishedAt')->first();
    }
}