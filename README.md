<p align="center"><a href="https://larapress.org" target="_blank"><img src="packages/larapress/src/Assets/admin/img/larapress.svg" width="400" alt="LaraPress Logo"></a></p>

## About LaraPress 

Experience the future of content management with LaraPress, a powerful and intuitive CMS built on Laravel. Designed to bring simplicity and flexibility to your fingertips, LaraPress is perfect for developers, businesses, and content creators alike.

LaraPress is accessible, powerful, and provides tools required for large, robust applications.

## Learning LaraPress

LaraPress has the most extensive and thorough [documentation](https://larapress.org/documentation) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

## Important things

1. Composer.json

** Add -- 

"autoload": {
        "psr-4": {
            "LaraPressCMS\\LaraPress\\": "packages/larapress/src/"
        }
    }

** Remove

"scripts": {        
        "post-update-cmd": [
            "@php artisan vendor:publish --tag=laravel-assets --ansi --force"
        ],
        "post-root-package-install": [
            "@php -r \"file_exists('.env') || copy('.env.example', '.env');\""
        ],
        "post-create-project-cmd": [
            "@php artisan key:generate --ansi",
            "@php -r \"file_exists('database/database.sqlite') || touch('database/database.sqlite');\"",
            "@php artisan migrate --graceful --ansi"
        ]
    },

2. bootstrap->provider

** Add --

LaraPressCMS\LaraPress\LaraServiceProvider::class  

3. database

** Remove .gitignor
** add -> database.sqlite

4. Remove .env

5. Default route change

Route::get('/shahin', function () {
    return view('welcome');
});

## License

The LaraPress is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
