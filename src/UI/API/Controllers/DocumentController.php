<?php

declare(strict_types=1);

namespace AdminKit\Documents\UI\API\Controllers;

use AdminKit\Documents\Models\Document;
use AdminKit\Documents\UI\API\Data\DocumentData;
use Illuminate\Http\JsonResponse;
use Spatie\LaravelData\PaginatedDataCollection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class DocumentController extends Controller
{
    public function index(): PaginatedDataCollection
    {
        $documents = QueryBuilder::for(Document::class)
            ->allowedFilters([
                AllowedFilter::scope('year'),
            ])
            ->paginate();

        return DocumentData::collection($documents);
    }

    public function years(): JsonResponse
    {
        $years = Document::query()
            ->selectRaw('extract(year FROM created_at) AS year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        return response()->json($years);
    }
}
