<?php

namespace AdminKit\Documents\Commands;

use AdminKit\Documents\Models\Document;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use PhpParser\Comment\Doc;

class SyncReportsFromErgkz extends Command
{
    protected $signature = 'admin-kit-documents:sync-reports-from-ergkz';

    protected $description = 'Команда для синхронизации документов из erg.kz';

    public function handle()
    {
        $this->info('Синхронизация документов из erg.kz');

        $data = $this->getData(perPage: 2);

        // заканчиваем, если получили пустой массив
        if ($data->isEmpty()) {
            $this->info('Синхронизация завершена');
            $this->newLine();
            return 0;
        }

        $this->withProgressBar($data, function ($item) {
            DB::transaction(function () use ($item) {
                // пропускаем, если с таким айди уже был
                if (Document::query()->where('ergkz_id', $item['id'])->exists()) {
                    return;
                }

                // пропускаем, если файл по ссылке отсутствует
                $url = $this->customUrlEncode($item['path']);
                if (!$this->urlExists($url)) {
                    return;
                }

                /** @var Document $document */
                $document = Document::query()->create([
                    'title' => [$item['locale'] => $item['name']],
                    'link' => $item['extension'] === 'link' ? $item['path'] : null,
                    'published_at' => !empty($item['pub_date']) ? $item['pub_date'] : null,
                    'ergkz_id' => $item['id'],
                ]);

                if ($item['extension'] !== 'link') {
                    $document->addMediaFromUrl($url)->toMediaCollection();
                }
            });
        });

        $this->newLine();
        $this->info('Синхронизация завершена');

        return 0;
    }

    private function getData(int $page = 1, int $perPage = 10): Collection
    {
        $response = Http::get(config('services.reports_from_ergkz.url.' . app()->environment()), [
            'start_above_id' => Document::query()->max('ergkz_id') ?? 1,
            'enterprise_id' => config('services.reports_from_ergkz.enterprise_id'),
            'category_id' => config('services.reports_from_ergkz.category_id'),
            'page' => $page,
            'per_page' => $perPage,
        ]);

        if ($response->failed()) {
            $this->error('Не удалось синхронизировать документы из erg.kz');
            throw new \Exception('Не удалось синхронизировать документы из erg.kz. Ошибка запроса: ' . $response->body());
        }

        return $response->collect('data');
    }

    private function customUrlEncode($string)
    {
        // Define characters to skip encoding
        $reservedChars = ['-', '_', '.', '~', ':', '/', '?', '&', '=', '#', '[', ']'];

        // Encode everything, then decode reserved characters
        $encoded = rawurlencode($string);
        foreach ($reservedChars as $char) {
            $encoded = str_replace(rawurlencode($char), $char, $encoded);
        }

        return $encoded;
    }

    private function urlExists($url)
    {
        $headers = @get_headers($url);
        if ($headers) {
            $statusCode = substr($headers[0], 9, 3); // Extract status code
            return $statusCode == '200';
        }

        return false;
    }
}
