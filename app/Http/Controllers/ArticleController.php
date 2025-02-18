<?php

namespace App\Http\Controllers;

use App\Factory\ArticleQueryFactory;
use App\Http\Requests\ArticleRequest;
use Illuminate\Http\Response;
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
        $articles = $query->paginate($request->input('per_page', 15));
        return response()->json([
            'status' => 'success',
            'message' => 'Articles retrieved successfully',
            'data' => $articles->items(),
            'meta' => [
                'current_page' => $articles->currentPage(),
                'last_page' => $articles->lastPage(),
                'per_page' => $articles->perPage(),
                'total' => $articles->total()
            ]
        ], Response::HTTP_OK);
    }
}
