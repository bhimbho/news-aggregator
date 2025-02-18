<?php

namespace App\Http\Controllers;

use App\Factory\ArticleQueryFactory;
use App\Http\Requests\ArticleRequest;

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
        
        $articles = cache()->remember('articles.' . $request->getRequestUri(), now()->addHour(), function() use ($query, $request) {
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
