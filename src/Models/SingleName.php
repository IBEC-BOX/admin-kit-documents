<?php

namespace VendorName\Skeleton\Models;

use AdminKit\Core\Abstracts\Models\AbstractModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;
use VendorName\Skeleton\Database\Factories\SingleNameFactory;

class SingleName extends AbstractModel
{
    use HasFactory;
    use HasTranslations;

    protected $table = 'migration_table_name';

    protected $fillable = [
        'title',
    ];

    protected $casts = [
        //
    ];

    protected $translatable = [
        'title',
    ];

    protected static function newFactory(): SingleNameFactory
    {
        return new SingleNameFactory();
    }
}
