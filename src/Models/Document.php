<?php

namespace AdminKit\Documents\Models;

use AdminKit\Core\Abstracts\Models\AbstractModel;
use AdminKit\Documents\Database\Factories\DocumentFactory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
    ];

    protected $translatable = [
        'title',
    ];

    public function scopeYear(Builder $query, $year): Builder
    {
        $date = Carbon::createFromDate($year);

        return $query
            ->where('published_at', '>=', $date->copy()->startOfYear())
            ->where('published_at', '<=', $date->copy()->endOfYear());
    }

    protected static function newFactory(): DocumentFactory
    {
        return new DocumentFactory();
    }
}
