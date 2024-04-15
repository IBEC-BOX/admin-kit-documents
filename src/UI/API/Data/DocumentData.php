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
        public string $file,
        public string $fileMime,
        public int $fileSize,
        public string $createdAt,
    ) {
    }

    public static function fromModel(Document $document): DocumentData
    {
        $media = $document->getFirstMedia();

        return new self(
            title: $document->title,
            file: $media->getUrl(),
            fileMime: $media->mime_type,
            fileSize: $media->size,
            createdAt: $document->created_at,
        );
    }
}
