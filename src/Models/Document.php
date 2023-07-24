<?php

namespace AdminKit\Documents\Models;

use AdminKit\Core\Abstracts\Models\AbstractModel;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class Document extends AbstractModel
{
    use Sluggable;
    use HasFactory;
    use HasTranslations;

    protected $table = 'admin_kit_documents';

    //    protected $appends = ['url', 'url_client', 'url_reverse_proxy'];

    protected $fillable = [
        'name',
        'file',
        'slug',
    ];

    public array $translatable = [
        'name',
        'file',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name.ru',
            ],
        ];
    }

    protected $guarded = [];

    public function getUrlAttribute($value)
    {
        $urls = [];

        $locales = config('admin-kit.locales');

        foreach ($locales as $key => $locale) {
            $original_file_name = $this->getTranslation('file', $locale);
            if ($original_file_name != '') {
                dd($original_file_name);
                $urls = array_merge($urls, [$locale => asset('storage/documents/files/'.$original_file_name)]);
            }
        }

        return $urls;
    }

    public function getUrlClientAttribute($value)
    {
        $urls = [];

        $locales = config('admin-kit.locales');

        foreach ($locales as $key => $locale) {
            $original_file_name = $this->getTranslation('file', $locale);
            $client_file_name = $this->getTranslation('file', $locale);
            if ($original_file_name != '') {
                $urls = array_merge($urls, [$locale => asset("sk/document/$this->id/$locale/$client_file_name")]);
            }
        }

        return $urls;
    }

    public function getUrlReverseProxyAttribute($value)
    {
        $urls_reverse_proxy = [];

        $locales = config('admin-kit.locales');

        foreach ($locales as $key => $locale) {
            $original_file_name = $this->getTranslation('file', $locale);
            if ($original_file_name != '') {
                $urls_reverse_proxy = array_merge($urls_reverse_proxy, [$locale => '/public/documents/files/'.$original_file_name]);
            }
        }

        return $urls_reverse_proxy;
    }
}
