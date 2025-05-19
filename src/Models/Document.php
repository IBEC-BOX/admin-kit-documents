<?php

namespace AdminKit\Documents\Models;

use AdminKit\Core\Abstracts\Models\AbstractModel;
use AdminKit\Documents\Database\Factories\DocumentFactory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Document extends AbstractModel implements HasMedia
{
    use HasFactory;
    use HasTranslations;
    use InteractsWithMedia;

    protected $table = 'admin_kit_documents';

    protected $fillable = [
        'title',
        'link',
        'published_at',
        'ergkz_id',
        'category_id',
    ];

    protected $translatable = [
        'title',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(DocumentCategory::class);
    }

    public function getCustomTitleAttribute(): string
    {
        $title = $this->getTranslations('title');

        return $title['ru'] ?? $title['kk'] ?? $title['en'] ?? '-';
    }

    public function scopeYear(Builder $query, $year): Builder
    {
        $date = Carbon::createFromDate($year);

        return $query
            ->where('published_at', '>=', $date->copy()->startOfYear())
            ->where('published_at', '<=', $date->copy()->endOfYear());
    }

    public function scopeCategoryId(Builder $query, $categoryId): Builder
    {
        return $query
            ->whereHas('category', fn ($query) => $query->where('id', $categoryId));
    }

    protected static function newFactory(): DocumentFactory
    {
        return new DocumentFactory;
    }
}
