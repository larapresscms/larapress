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

    <!-- <div class="container"> -->
        <div class="card o-hidden border-0 shadow-lg">
            <div class="card-body p-5">
                   <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Install LaraPress CMS!</h1>
                                </div>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            
                                @if(session()->has('message'))
                                    <div class="alert alert-{{ session('type') }}">
                                        {!! session('message') !!}
                                    </div>
                                @endif
                                <form method="POST" action="{{ url('/setup/save-database') }}" class="user text-end">      
                                    @csrf                              
                                    <div class="form-group mb-3">
                                        <input type="text" name="db_database" class="form-control form-control-user" id="exampleFirstName"
                                                placeholder="Database name" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="text" name="db_username" class="form-control form-control-user" id="exampleInputEmail"
                                            placeholder="DB Username" required>
                                    </div>
                                    <div class="form-group mb-3">                                        
                                        <input type="text" name="db_password" class="form-control form-control-user" id="exampleInputPassword" placeholder="DB Password">
                                    </div>

                                    <div class="form-group mb-3">
                                        <input type="text" name="db_host" class="form-control form-control-user" value="127.0.0.1"
                                                 placeholder="DB Host">
                                    </div> 

                                    <div class="form-group mb-3">
                                        <input type="text" name="blogurl" class="form-control form-control-user" value="{{ url('/') }}"
                                                id="exampleRepeatPassword" placeholder="Domain name">
                                    </div> 
                                    <button type="submit" class="btn btn-primary btn-user btn-block"> Register </button>
                                </form>                
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
</body>
</html>