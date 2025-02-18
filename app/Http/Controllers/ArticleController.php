<?php

namespace App\Http\Controllers;

use App\Factory\ArticleQueryFactory;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Cache;

class ArticleController extends Controller
{
    public function __construct(private ArticleQueryFactory $queryFactory)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(ArticleRequest $request)
    {
        $query = $this->queryFactory->makeQuery($request->validated());
        $articles = Cache::remember('articles.' . md5(json_encode($request->validated())), 
            now()->addMinutes(10), function() use ($query, $request) {
                return $query->paginate($request->input('per_page', 15));
            });

        return response()->json([
            'data' => $articles->items(),
            'meta' => [
                'current_page' => $articles->currentPage(),
                'last_page' => $articles->lastPage(),
                'per_page' => $articles->perPage(),
                'total' => $articles->total()
            ]
        ]);
    }
}
