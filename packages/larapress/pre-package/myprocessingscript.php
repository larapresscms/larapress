<!DOCTYPE html>
<html>
<head>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Create</title>
</head>
  
<body>
    <div class="container">
    <h3>Create manualy</h3>
    <pre>
        <code>
        <?php
if( isset($_POST['dbname']) && isset($_POST['dbuser']) && isset($_POST['dbpass']) && isset($_POST['blogurl'])) {
    

    $envData =
'APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:d1gxirZZWFKA4QwIVdmYZPijpU/h+/RAI9y/u5M2ymQ=
APP_DEBUG=true
APP_URL='.$_POST['blogurl'].'

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
DB_DATABASE='.$_POST['dbname'].'
DB_USERNAME='.$_POST['dbuser'].'
DB_PASSWORD='.$_POST['dbpass'].'

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

 
    $ret = file_put_contents('../../.env', $envData, FILE_APPEND | LOCK_EX);
    
    if($ret === false) {

        echo '<br/>Please create .env file of root directory and paste the below content: <br/><br/>';

        echo "<pre>";
        print_r($envData);
        echo "</pre>";

        echo '<br/><a href="/public/migrate">Click Install</a>';
    }
    else {
        echo "$ret bytes written to file";
    }
}
else {
   die('no post data to process');
}

?>
        </code>
    </pre>
  
    <h3>Create .htaccess file and paste below content of root directory.</h3>
      
    <pre class="pre-scrollable">
        <code>
        <xmp>
            <IfModule mod_rewrite.c>
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
            </IfModule>
            </xmp>

        </code>
    </pre>
    </div>
</body>
</html>  