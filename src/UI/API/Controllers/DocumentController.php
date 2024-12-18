<?php

declare(strict_types=1);

namespace AdminKit\Documents\UI\API\Controllers;

use AdminKit\Documents\Models\Document;
use AdminKit\Documents\Models\DocumentCategory;
use AdminKit\Documents\UI\API\Data\DocumentData;
use Illuminate\Http\JsonResponse;
use Spatie\LaravelData\PaginatedDataCollection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class DocumentController extends Controller
{
    public function index(): PaginatedDataCollection
    {
        $locale = app()->getLocale();

        $documents = QueryBuilder::for(Document::class)
            ->allowedFilters([
                AllowedFilter::scope('year'),
                AllowedFilter::scope('category_id'),
            ])
            ->whereNotNull("title->$locale")
            ->whereNot("title->$locale", '')
            ->paginate();

        return DocumentData::collection($documents);
    }

    public function years(): JsonResponse
    {
        $years = Document::query()
            ->selectRaw('extract(year FROM published_at) AS year')
            ->distinct()
            ->wherenotnull('published_at')
            ->orderBy('year', 'desc')
            ->pluck('year');

        return response()->json($years);
    }

    public function categories(): JsonResponse
    {
        $locale = app()->getLocale();

        $categories = DocumentCategory::query()
            ->selectRaw("id, title->'$locale' as title")
            ->orderBy('sort')
            ->get()
            ->toArray();

        return response()->json($categories);
    }
}
