<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ArticleController extends Controller
{
    public function create(Request $request)
    {
        $article = Article::create($request->all());
        Cache::put('article_' . $article->id, $article, 3600);
        Cache::forget('articles_latest');
        return response()->json($article, 201);
    }

    public function index(Request $request)
    {
        $cacheKey = 'articles_latest_' . md5($request->query('query') . '_' . $request->query('author'));

        $articles = Cache::remember($cacheKey, 3600, function () use ($request) {
            $query = Article::query();

            if ($request->has('query')) {
                $query->where('title', 'like', '%' . $request->query('query') . '%')
                    ->orWhere('body', 'like', '%' . $request->query('query') . '%');
            }

            if ($request->has('author')) {
                $query->where('author', $request->query('author'));
            }

            return $query->orderBy('created_at', 'desc')->get();

        });

        return response()->json($articles);
    }

    public function show($id)
    {
        $article = Cache::remember('article_' . $id, 3600, function () use ($id) {
            return Article::findOrFail($id);
        });
        return response()->json($article);
    }
}
