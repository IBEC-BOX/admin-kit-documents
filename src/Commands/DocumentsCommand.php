<?php

namespace AdminKit\Documents\Commands;

use Illuminate\Console\Command;

class DocumentsCommand extends Command
{
    public $signature = 'admin-kit-documents';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
