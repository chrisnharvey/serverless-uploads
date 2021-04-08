<?php

namespace App\Console\Commands;

use App\Models\File;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class PurgeExpiredFiles extends Command
{
    protected $signature = 'files:purge';

    protected $description = 'Purge expired files';

    public function handle()
    {
        $files = File::whereNotNull('file_expires')
            ->where('file_expires', '<', now())
            ->get();

        foreach ($files as $file) {
            Storage::delete($file->path);

            $file->delete();
        }

        $this->info("Deleted {$files->count()} expired files");

        $files = File::whereNull('path')
            ->where('link_expires', '<', now())
            ->get();

        foreach ($files as $file) {
            $file->delete();
        }

        $this->info("Deleted {$files->count()} expired links");
    }
}
