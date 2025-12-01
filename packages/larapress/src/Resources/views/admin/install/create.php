<?php $base_url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Install LaraPress CMS!</title>
    <link rel="icon" type="image/x-icon" href="packages/larapress/src/Assets/admin/img/fav.png">
    <link rel="stylesheet" href="packages/larapress/src/Assets/admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="packages/larapress/src/Assets/admin/css/vs2015.min.css">
    <script src="packages/larapress/src/Assets/admin/js/highlight.min.js"></script>
    <style>
        body {
            margin: 0;
            height: 100vh;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-family: Arial, sans-serif;
        }
        .code-box {
            background: #1e1e1e;
            color: #dcdcdc;
            padding: 15px;
            border-radius: 8px;
            font-family: monospace;
            max-height: 200px;
            overflow: auto;
            font-size: 12px;
            position: relative;
            box-shadow: 0 4px 10px rgba(0,0,0,0.4);
        }
        .copy-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #007acc;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
        }
        .copy-btn:hover { background: #005fa3; }
        pre { margin: 0; }
    /* body{overflow-x: hidden;height: 100%;background-image: url("https://wallpapers.com/images/featured/macbook-background-wau3hbzesd62okno.jpg");background-repeat: no-repeat;background-size: 100% 100%} */
    
    </style>    
    <script>
    window.onload = function() {
        // Random image from Picsum (fast and free)
        const randomUrl = `https://picsum.photos/seed/${Math.random()}/1600/900`;
        document.body.style.backgroundImage = `url(${randomUrl})`;
        };
    </script>
</head>
<body class="bg-gradient-primary bg-gradient-primary bg-light d-flex justify-content-center align-items-center min-vh-100"> 
    <div class="card o-hidden border-0 shadow-lg">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
					<?php 					
$envData =
'APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:d1gxirZZWFKA4QwIVdmYZPijpU/h+/RAI9y/u5M2ymQ=
APP_DEBUG=true
APP_URL=https://localhost

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file
# APP_MAINTENANCE_STORE=database

PHP_CLI_SERVER_WORKERS=4

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=file
# CACHE_PREFIX=

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=log
MAIL_SCHEME=null
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"';

$htass = 
'<xmp><IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
    
</IfModule></xmp>';
							 
								$ret = file_put_contents('.env', $envData, FILE_APPEND | LOCK_EX);
								//$ret = false;
								if($ret === false) { ?>
                                    <p>Please create .env file of root directory and paste the below content: </p>
                                    <div class="code-box mb-3">
                                        <button class="copy-btn" onclick="copyCode()">Copy</button>
                                        <pre><code id="envCode" class="language-ini text-start"><?php print_r($envData);?></code></pre>
                                    </div>	
                                    <p>Create .htaccess file and paste below content of root directory.</p>			
                                    <div class="code-box mb-3">
                                        <button class="copy-btn" onclick="copyCodeHt()">Copy</button>
                                        <pre><code id="envCodeHt" class="language-ini text-start"><?php print_r($htass);?></code></pre>
                                    </div>	                                    	
									<?php
									// echo '<br/><a href="'.$_SERVER['REQUEST_URI'].'migrate" class="btn btn-success d-none">Click Install</a>';
								}else{                                    
									echo "<div class=\"alert alert-success\" role=\"alert\">Successfully created .env $ret bytes written to file</div>";
									// echo '<br/><p>For database setup </p><a href="'.$_SERVER['REQUEST_URI'].'migrate" class="btn btn-success">Click Install</a>';                                    
								}?>				
                                <button onclick="location.reload();" class="btn btn-success">Click Install</button>		   
                        </div>        
                    </div>
				</div>
            </div>
        </div>
    </div> 

    <div class="end-0 bottom-0 position-absolute">
        <div class="text-white me-5 mb-4">
            <h1 class="mb-1">LaraPress CMS</h1>
            <p>Copyright 2021 - <?php echo date('Y');?> © <a href='https://larapress.org' class="text-white">larapress.org</a> <span class="fw-medium"></span></p>
        </div>
    </div>   
    <script>
        hljs.highlightAll();
        function copyCode() {
        const code = document.getElementById("envCode").innerText.trim();
        navigator.clipboard.writeText(code);
        alert("✅ .env content copied! You can now paste it into your new .env file.");
        }

        function copyCodeHt() {
        const codeHt = document.getElementById("envCodeHt").innerText.trim();
        navigator.clipboard.writeText(codeHt);
        alert("✅ content copied! You can now paste it into your new .htaccess file.");
        }
    </script>   
</body>
</html>
<?php exit;?>