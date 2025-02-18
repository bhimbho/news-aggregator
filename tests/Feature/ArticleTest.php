<?php

namespace Tests\Feature;

use App\Enum\PlatformEnum;
use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ProcessArticleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_api_returns_correct_data_without_query_params(): void
    {
        $this->createNewsApiArticles(5, [
            'platform' => PlatformEnum::NEWSAPI->value,
        ]);

        $this->createGuardianApiArticles(5, [
            'platform' => PlatformEnum::NEWSAPI->value,
        ]);
        
        $response = $this->get('/api/articles');

        $response->assertStatus(200);
        $response->assertSuccessful();
        $response->assertJsonCount(10, 'data');
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'type',
                    'source',
                    'author',
                    'title',
                    'description',
                    'url',
                    'urlToImage',
                    'content',
                    'publishedAt',
                    'category',
                    'platform',
                    'created_at',
                    'updated_at',
                ],
            ],
        ]);
    }

    public function test_api_filters_correctly_by_category(): void
    {
        $this->createNewsApiArticles(5, [
            'category' => 'technology',
        ]);
        $this->createGuardianApiArticles(5, [
            'category' => 'business',
        ]);

        $response = $this->get('/api/articles?category=technology');
        $response->assertStatus(200);
        $response->assertJsonCount(5, 'data');
    }

    public function test_api_filters_correctly_by_source(): void
    {
        $this->createNewsApiArticles(5, [
            'source' => 'Jb Town',
        ]);
        $this->createGuardianApiArticles(5, [
            'source' => 'The Guardian',
        ]);

        $response = $this->get('/api/articles?source=The%20Guardian');    
        $response->assertJsonCount(5, 'data');
    }

    public function test_api_filters_correctly_by_platform(): void
    {
        $this->createNewsApiArticles(5, [
            'platform' => 'guardian',
        ]);
        $this->createGuardianApiArticles(5, [
            'platform' => 'new york times',
        ]);

        $response = $this->get('/api/articles?platform=guardian');
        $response->assertJsonCount(5, 'data');
    }

    public function test_api_filters_correctly_by_search(): void
    {
        $this->createNewsApiArticles(5, [
            'title' => 'The quick brown fox',
        ]);
        $this->createGuardianApiArticles(5, [
            'title' => 'The quick brown fox',
        ]);

        $response = $this->get('/api/articles?search=quick');
        $response->assertJsonCount(10, 'data');
    }

    public function test_api_filters_correctly_by_date_range(): void
    {
        $this->createNewsApiArticles(5, [
            'publishedAt' => '2022-02-01 12:00:00',
        ]);
        $this->createGuardianApiArticles(5, [
            'publishedAt' => '2022-02-01 12:00:00',
        ]);

        $response = $this->get('/api/articles?from_date=2022-02-01&to_date=2022-02-01');
        $response->assertJsonCount(10, 'data');
    }

    private function createNewsApiArticles(int $count, ?array $data = null): void
    {
        Article::factory()->count($count)->create($data);
    }

    private function createGuardianApiArticles(int $count, ?array $data = null): void
    {
        Article::factory()->count($count)->create($data);
    }
}
