<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ImportLocalImages extends Command
{
    protected $signature = 'images:import {sourceFolder}';
    protected $description = 'Import images from a local folder into the public folder and database';

    public function handle()
    {
        $sourceFolder = $this->argument('sourceFolder');

        if (!File::isDirectory($sourceFolder)) {
            $this->error("The specified folder does not exist: $sourceFolder");
            return 1;
        }

        $destinationFolder = public_path('images');
        if (!File::isDirectory($destinationFolder)) {
            File::makeDirectory($destinationFolder, 0755, true);
        }

        $files = File::files($sourceFolder);
        $this->info('Found ' . count($files) . ' images to process...');

        foreach ($files as $file) {
            try {
                $fileName = $file->getFilename();
                $newPath = $destinationFolder . '/' . $fileName;

                // Copy the file to the public folder
                File::copy($file->getPathname(), $newPath);

                // Add a database record
                DB::table('images')->insert([
                    'file_path' => 'images/' . $fileName, // Relative to public
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $this->info("Processed: {$fileName}");
            } catch (\Exception $e) {
                $this->error("Failed to process {$file->getFilename()}: " . $e->getMessage());
            }
        }

        $this->info('Image import completed!');
        return 0;
    }
}
