<?php

namespace LaraPressCMS\LaraPress\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class DownloadLatestLaraPressCommand extends Command
{
    protected $signature = 'larapress:update-core';
    protected $description = 'Download and replace the latest LaraPress version';

    public function handle()
    {
        $this->info('Downloading the latest version of LaraPress...');

        // Step 1: Download the latest LaraPress version
        $zipFile = base_path('latest-larapress.zip');
        // file_put_contents($zipFile, fopen('https://github.com/laravel/laravel/archive/refs/heads/master.zip', 'r'));
        file_put_contents($zipFile, fopen('https://larapress.org/latest/latest-larapress.zip', 'r'));

        $this->info('Extracting the downloaded LaraPress...');

        // Step 2: Extract the downloaded file
        $extractPath = base_path('latest-larapress');
        $zip = new \ZipArchive;
        if ($zip->open($zipFile) === TRUE) {
            $zip->extractTo($extractPath);
            $zip->close();
        } else {
            $this->error('Failed to extract LaraPress files.');
            return;
        }

        $this->info('Replacing core LaraPress files...');

         // Step 3: Define files/folders to skip
        $skipFiles = [
            'resources',
            'vendor',
            'public'
            // Add more paths as needed
        ];

        // Step 3: Replace LaraPress core files
        // File::copyDirectory($extractPath.'/latest-larapress', base_path());

        // Step 4: Replace LaraPress core files with skipping logic
        $this->replaceCoreFiles($extractPath.'/latest-larapress', base_path(), $skipFiles);

        // Step 4: Clean up
        unlink($zipFile);
        File::deleteDirectory($extractPath);

        $this->info('LaraPress core has been successfully updated.');
    }

    private function replaceCoreFiles($source, $destination, $skipFiles)
    {
        $directory = new \RecursiveDirectoryIterator($source, \RecursiveDirectoryIterator::SKIP_DOTS);
        $iterator = new \RecursiveIteratorIterator($directory, \RecursiveIteratorIterator::SELF_FIRST);

        foreach ($iterator as $file) {
            $destPath = $destination . DIRECTORY_SEPARATOR . $iterator->getSubPathName();

            // Skip files/folders if they match the skip list
            if ($this->shouldSkip($iterator->getSubPathName(), $skipFiles)) {
                $this->info('Skipping ' . $iterator->getSubPathName());
                continue;
            }

            if ($file->isDir()) {
                if (!is_dir($destPath)) {
                    mkdir($destPath, 0755, true);
                }
            } else {
                copy($file, $destPath);
            }
        }
    }

    private function shouldSkip($path, $skipFiles)
    {
        foreach ($skipFiles as $skip) {
            if (strpos($path, $skip) !== false) {
                return true;
            }
        }
        return false;
    }
}
