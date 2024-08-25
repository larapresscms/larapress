<?php

namespace LaraPressVendor\LaraPress;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File; // Example of a common import
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Http;
use LaraPressVendor\LaraPress\Console\DownloadLatestLaraPressCommand;
use Illuminate\Http\Client\ConnectionException;
use LaraPressVendor\LaraPress\Http\Controllers\Controller; 

class LaraServiceProvider extends ServiceProvider
{
    // Static variable to hold the value
    protected static $currentLaraVersion = '0.9';

    public function boot()
    {        
        $this->loadRoutesFrom(__DIR__.'/Routes/api.php');
        $this->loadRoutesFrom(__DIR__.'/Routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/Database/Migrations');
        // $this->loadViewsFrom(__DIR__.'/Resources/views', 'larapress');
        View::addLocation(base_path('packages/larapress/src/Resources/views'));

        // $this->publishes([
        //     __DIR__.'/../config/yourconfig.php' => config_path('yourconfig.php'),
        // ]);

        // Publish the public assets
        $this->publishes([
            __DIR__.'/../public' => public_path(),
        ], 'public');

        // Register the command
        if ($this->app->runningInConsole()) {
            $this->commands([
                DownloadLatestLaraPressCommand::class,
            ]);
        }
        
        // Share a static version value across all views 
        view()->share('CurrentLaraPressVersion', self::$currentLaraVersion);    

        try {  

            //old
            // $apiUrl = 'https://larapress.org/version-controll';
            // $response = Http::get($apiUrl); 
            // if ($response->successful()) {
            //     $data = $response->json();
            //     $currentVersion = self::$currentLaraVersion;
            //     $apiVersion = $data['version'] ?? 'unknown'; 
            //     $versionMessage = $data['version_message'] ?? 'No message';
            //     $lara_status = $data['status'] ?? 'unknown'; 
            //     $lara_version = version_compare($apiVersion, $currentVersion, '>') ? $apiVersion . ' ' . $versionMessage : 'LaraPress is up-to-date.';                         
            // } else {
            //     $lara_version = "LaraPress is up-to-date.";
            //     $lara_status = false;
            // } 

            //new
            // Define the cache key and timeout
            $cacheKey = 'larapress_version';
            $cacheTime = 60; // Time in minutes
            // Try to get the cached data
            $versionData = Cache::get($cacheKey);

            if (!$versionData) {
                // Define the API URL
                $apiUrl = 'https://larapress.org/version-controll';

                // Make a GET request to the API
                $response = Http::get($apiUrl);

                // Check if the request was successful
                if ($response->successful()) {
                    // Decode the JSON response
                    $data = $response->json();

                    // Prepare version data for caching
                    $versionData = [
                        'currentVersion' => self::$currentLaraVersion,  // The version you're comparing against
                        'apiVersion' => $data['version'] ?? 'unknown',  // Get the version from the API
                        'versionMessage' => $data['version_message'] ?? 'No message',  // Get the version message from the API
                        'laraStatus' => $data['status'] ?? false,  // Get the status from the API
                    ];

                    // Cache the data
                    Cache::put($cacheKey, $versionData, $cacheTime);
                } else {
                    // Handle error responses
                    $versionData = [
                        'currentVersion' => self::$currentLaraVersion,
                        'apiVersion' => 'unknown',
                        'versionMessage' => 'No message',
                        'laraStatus' => false,
                    ];
                }
            }
            $lara_status = $versionData['laraStatus'];
            // Compare versions
            $lara_version = version_compare($versionData['apiVersion'], $versionData['currentVersion'], '>') ? $versionData['apiVersion'] . ' ' . $versionData['versionMessage'] : 'LaraPress is up-to-date.';
            //$lara_version = version_compare($apiVersion, $currentVersion, '>') ? $apiVersion . ' ' . $versionMessage : 'LaraPress is up-to-date.';   

        } catch (ConnectionException $e) {
            
            // Handle connection-related exceptions
            $lara_version = "LaraPress is up-to-date.";
            $lara_status = false;

            //$controller = app(Controller::class);
            // Call a method from the controller
            //$controller->setErrorMessage('Your Internet connection is down.'); 
           // return response()->json(['error' => 'Internet connection is down or the host is unreachable']);            
        }

        
        view()->share('lara_version', $lara_version);
        view()->share('lara_status', $lara_status);   


    }

    public function register()
    {
        // Binding classes into the service container.
        // $this->mergeConfigFrom(__DIR__.'/../config/yourconfig.php', 'yourconfig');

    }
    // Method to access the global variable
    public static function getCurrentLaraVersion()
    {
        return self::$currentLaraVersion;
    }
}
