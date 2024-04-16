<?php

namespace AdminKit\Documents\UI\API\Data;

use AdminKit\Documents\Models\Document;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class DocumentData extends Data
{
    public function __construct(
        public string $title,
        public ?string $link,
        public ?array $file,
        public string $createdAt,
    ) {
    }

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
            createdAt: $document->created_at,
        );
    }
}
