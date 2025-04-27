<?php $base_url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Create</title>
    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body class="bg-gradient-primary">
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                   <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12 formDB">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Create LaraPress CMS!</h1>
                                </div>
                                <form action="" method="POST" class="user">                                    
                                    <div class="form-group">
                                        <input type="text" name="dbname" class="form-control form-control-user" id="exampleFirstName"
                                                placeholder="Database name" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="dbuser" class="form-control form-control-user" id="exampleInputEmail"
                                            placeholder="DB Username" required>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="text" name="dbpass" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="DB Password">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" name="blogurl" class="form-control form-control-user" value="<?php echo $base_url;?>"
                                                id="exampleRepeatPassword" placeholder="Domain name">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block"> Register </button>
                                </form>                
                            </div>
                        </div>
                    </div>
					<div class="col-lg-12">
						<div class="p-5">
                            <div class="text-center">
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
							 
								$ret = file_put_contents('.env', $envData, FILE_APPEND | LOCK_EX);
								
								if($ret === false) {

									echo '<br/>Please create .env file of root directory and paste the below content: <br/><br/>';

									echo "<pre>";
									print_r($envData);
									echo "</pre>";

									echo '<br/><a href="/public/migrate">Click Install</a>';
								}else{                                    
									echo "<div class=\"alert alert-success\" role=\"alert\">Successfully Created. $ret bytes written to file</div>";
									echo '<br/><p>For database setup </p><a href="'.$_SERVER['REQUEST_URI'].'migrate" class="btn btn-success">Click Install</a>';                                    
								}
					}else{
						die('<div class="alert alert-danger" role="alert">If Process Broken Please Contact andministrator! or try again</div>');
					}
					echo "<style>.formDB{display:none}</style>";
					?>				
                                    
                        </div>        
                    </div>
				</div>
            </div>
        </div>
    </div>
</body>
</html>
<?php exit;?>