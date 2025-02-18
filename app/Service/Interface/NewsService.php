<?php
namespace App\Service\Interface;

use Illuminate\Http\Client\Response;

interface NewsService 
{
    public function getNews(string $keyword): void;
    public function transform(Response $response): array;
}