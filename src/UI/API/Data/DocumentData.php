<?php

namespace AdminKit\Documents\UI\API\Data;

use AdminKit\Documents\Models\Document;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Concerns\WithDeprecatedCollectionMethod;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class DocumentData extends Data
{
    use WithDeprecatedCollectionMethod;

    public function __construct(
        public string $title,
        public ?string $link,
        public ?array $file,
        public ?string $publishedAt,
        public ?array $category,
    ) {}

    public static function fromModel(Document $document): DocumentData
    {
        $media = $document->getFirstMedia();

        return new self(
            title: $document->title,
            link: $document->link,
            file: $media ? [
                'url' => $media->getUrl(),
                'mime' => $media->mime_type,
                'size' => $media->size,
            ] : null,
            publishedAt: $document->published_at,
            category: $document->category?->only('id', 'title'),
        );
    }
}
