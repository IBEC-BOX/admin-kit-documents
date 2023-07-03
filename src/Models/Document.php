<?php

namespace AdminKit\Documents\Models;

use AdminKit\Core\Abstracts\Models\AbstractModel;
use AdminKit\Documents\Database\Factories\DocumentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class Document extends AbstractModel
{
    use HasFactory;
    use HasTranslations;

    protected $table = 'admin_kit_documents';

    protected $fillable = [
        'title',
    ];

    protected $casts = [
        //
    ];

    protected $translatable = [
        'title',
    ];

    protected static function newFactory(): DocumentFactory
    {
        return new DocumentFactory();
    }
}
