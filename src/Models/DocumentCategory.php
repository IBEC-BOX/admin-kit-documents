<?php

namespace AdminKit\Documents\Models;

use AdminKit\Core\Abstracts\Models\AbstractModel;
use Spatie\Translatable\HasTranslations;

class DocumentCategory extends AbstractModel
{
    use HasTranslations;

    protected $table = 'admin_kit_document_categories';

    protected $fillable = [
        'title',
    ];

    protected $translatable = [
        'title',
    ];
}
