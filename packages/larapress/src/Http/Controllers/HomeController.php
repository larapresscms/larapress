<?php
namespace LaraPressCMS\LaraPress\Http\Controllers;

use LaraPressCMS\LaraPress\Models\Feedback;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use LaraPressCMS\LaraPress\Models\Post;
use LaraPressCMS\LaraPress\Models\Settings;
use Artisan;
use File;
use DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailable;
use Exception;
use LaraPressCMS\LaraPress\Rules\Recaptcha;
use LaraPressCMS\LaraPress\Models\Posttype;
use LaraPressCMS\LaraPress\Models\Category;
use LaraPressCMS\LaraPress\Models\Menu;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{    
    //======================================= Dont Touch ====================================
    public function migrate(){  

        $dbName = env('DB_DATABASE');
        $dbUser = env('DB_USERNAME');
        if (empty($dbName) || empty($dbUser)) {
            return view('admin.install.setup');
        } 

        // Capture the output of the migrate command
        Artisan::call('migrate');
        $migrateOutput = Artisan::output(); // Get the output
        // Log the output to see the error details
        \Log::error('Migration Output:', ['output' => $migrateOutput]);

        // Check if the migration executed successfully
        if (Artisan::call('migrate') === 0) {
            Artisan::call('vendor:publish', ['--tag' => 'public']);
            $this->setSuccessfullyMessage('Migration successfully.');            
        } else {
            $this->setErrorMessage('Migration failed. Check log for details or <a href="'.url('/migrate').'">Try Again</a>');
        }    
        return view('admin.user.front.create');       
    }

    /**
     * Update environment variables permanently in .env file
     */
    public function updateEnv($key, $value)
    {
        $path = base_path('.env');

        if (!File::exists($path)) {
            return false;
        }

        $escaped = preg_quote("{$key}=", '/');
        $content = File::get($path);

        // Replace existing key or append if not found
        if (preg_match("/^{$escaped}.*/m", $content)) {
            $content = preg_replace("/^{$escaped}.*/m", "{$key}={$value}", $content);
        } else {
            $content .= "\n{$key}={$value}";
        }

        File::put($path, $content);

        return true;
    }

    /**
     * Save DB credentials to .env and test connection
     */
    public function saveDatabaseConfig(Request $request)
    {
        $request->validate([
            'db_host' => 'required|string',
            'db_database' => 'required|string',
            'db_username' => 'required|string',
            'db_password' => 'nullable|string',
        ]);

        // 1️⃣ Write new values into .env
        $this->updateEnv('DB_CONNECTION', 'mysql');
        $this->updateEnv('DB_HOST', $request->db_host);
        $this->updateEnv('DB_PORT', '3306');
        $this->updateEnv('DB_DATABASE', $request->db_database);
        $this->updateEnv('DB_USERNAME', $request->db_username);
        $this->updateEnv('DB_PASSWORD', $request->db_password);        

        // 2️⃣ Clear cache so Laravel picks up the new .env
        \Artisan::call('config:clear');
        \Artisan::call('cache:clear');

        try {
            // 3️⃣ Try connecting to MySQL *without selecting DB first*
            $pdo = new \PDO(
                "mysql:host={$request->db_host}",
                $request->db_username,
                $request->db_password,
                [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]
            );

            // 4️⃣ Check if the database already exists
            $stmt = $pdo->query("
                SELECT SCHEMA_NAME 
                FROM INFORMATION_SCHEMA.SCHEMATA 
                WHERE SCHEMA_NAME = '{$request->db_database}'
            ");

            $exists = $stmt->fetchColumn();

            if ($exists) {
                // return response()->json([
                //     'status' => 'exists',
                //     'message' => "Database already exists: {$request->db_database}",
                // ]);
            }else{

                // 5️⃣ Create the database if it doesn’t exist
                $pdo->exec("CREATE DATABASE `{$request->db_database}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");

                // 6️⃣ Update Laravel config dynamically and reconnect
                config([
                    'database.connections.mysql.host' => $request->db_host,
                    'database.connections.mysql.database' => $request->db_database,
                    'database.connections.mysql.username' => $request->db_username,
                    'database.connections.mysql.password' => $request->db_password,
                ]);

                \DB::purge('mysql');
                \DB::reconnect('mysql');
                \DB::connection('mysql')->getPdo();

                // return response()->json([
                //     'status' => 'created',
                //     'message' => "Database created and connected successfully: {$request->db_database}",
                // ]);
            }
            
            return redirect('/migrate'); 
            
        } catch (\PDOException $e) {
            // return response()->json([
            //     'status' => 'error',
            //     'message' => 'Database connection failed: ' . $e->getMessage(),
            // ]);
            $this->setErrorMessage('Database connection failed');            
            return view('admin.install.setup');
        }
    }

    

    //=======================================Dont Touch==========================================


    public function index(){
        //check env------------------------------        
        $dbName = env('DB_DATABASE');
        $dbUser = env('DB_USERNAME');
        if (empty($dbName) || empty($dbUser)) {
            return view('admin.install.setup');
        }
        try {
            // 3️⃣ Try connecting to MySQL *without selecting DB first*
            $pdo = new \PDO(
                "mysql:host=" . env('DB_HOST') . ";port=" . env('DB_PORT'),
                env('DB_USERNAME'),
                env('DB_PASSWORD'),
                [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]
            );
            // 4️⃣ Check if the database already exists
            $stmt = $pdo->query("
                SELECT SCHEMA_NAME 
                FROM INFORMATION_SCHEMA.SCHEMATA 
                WHERE SCHEMA_NAME = " . $pdo->quote($dbName)
            );
            $exists = $stmt->fetchColumn();
            if ($exists) {
                // return response()->json([
                //     'status' => 'exists',
                //     'message' => "Database already exists",
                // ]);
            }                        
        
            //-----------Main Query---------------        

            $posts = Post::orderBy('position', 'ASC')->where('status', '1')->get();
            $categories = Category::all();
            $menus = Menu::orderBy('id','ASC')->get();
            //set as home page
            $setting = Settings::all();
            if($setting->count() == 0){
                $themeName = "default";
            }else{
                foreach($setting as $sttingsVlue){
                    $themeName = $sttingsVlue->theme_url;
                    $homeUrl = $sttingsVlue->home_url;
                }
            }
            // dd($themeName);
            if($homeUrl){
                    $page = Post::find($homeUrl);             
                    $post = Post::orderBy('position', 'ASC')->where('post_type', $page->post_type)->where('status', '1')->first();
                    return view('front.themes.'.$themeName.'.single',compact('posts','categories','menus','post'));
            }else{
                    return view('front.themes.'.$themeName.'.index',compact('posts','categories','menus'));
            }
        //-----------Main Query End---------------

       } catch (\PDOException $e) {
            // return response()->json([
            //     'status' => 'error',
            //     'message' => 'Database connection failed: ' . $e->getMessage(),
            // ]);

            $this->setErrorMessage('Database connection failed');            
            return view('admin.install.setup');
        }

    } 
    public function handleDynamicRoute(Request $request)
    {
        try{
            $pathSegments = explode('/', $request->path());
            // Assuming the first segment is the post type
            $post_type = $pathSegments[0];
            $slug = null;
    
            // If there's a second segment, it's a single post
            if (isset($pathSegments[1])) {
                $slug = $pathSegments[1];
            }
    
            if ($slug !== null) {
                // It's a single post
                return $this->postTypeSingle($post_type, $slug);
            } else {
                // It's a post type listing
                return $this->postType($post_type);
            }
            
        }catch (\Exception $e) {
            // Handle the exception
            Log::error($e->getMessage());
            // If the exception is a NotFoundHttpException, it means the route is not found
            if ($e instanceof NotFoundHttpException) {
                // Return a 404 response
                return redirect('404');
            }
            return redirect('404');
            
        }
    } 

    public function postType($post_type){
        $posttype = Posttype::where('slug',$post_type)->first();
        //dd($posttype);
        $posts = Post::orderBy('position','ASC')->where('status','1')->where('post_type',$post_type)->paginate($posttype->paginate);         
        $categories = Category::all(); 
        //$postD = DB::table('posts')->select('category_id')->distinct()->pluck('category_id');
        $postD = DB::table('posts')->where('post_type', $post_type)->select('category_id')->distinct()->pluck('category_id');

        $menus = Menu::orderBy('id','ASC')->get();

        //set as home page
        $setting = Settings::all();
        if($setting->count() == 0){
            $themeName = "default";
        }else{
            foreach($setting as $sttingsVlue){
                $themeName = $sttingsVlue->theme_url;
                $homeUrl = $sttingsVlue->home_url;
            }
        }        
        
        // Check if a view file for the specific post type exists
        $viewExists = View::exists('front.themes.' . $themeName . '.' . $post_type);
    
        // If the view for the specific post type exists, return it
        if ($viewExists) {
            return view('front.themes.'.$themeName.'.'.$post_type.'',compact('posts','posttype','categories','menus','postD'));   
        } else {
            return view('front.themes.'.$themeName.'.posts',compact('posts','posttype','categories','menus','postD'));   
        }
    }
    public function postTypeSingle($post_type, $slug){
        $post = Post::orderBy('id','DESC')->where('status','1')->where('post_type',$post_type)->where('slug',$slug)->first();        
        $posttype = Posttype::where('slug',$slug)->first();
        $categories = Category::all(); 
        $menus = Menu::orderBy('id','ASC')->get();
        $posts = Post::orderBy('id','DESC')->where('status','1')->where('post_type',$post_type)->paginate(3); 

        //set as home page
        $setting = Settings::all();
        if($setting->count() == 0){
            $themeName = "default";
        }else{
            foreach($setting as $sttingsVlue){
                $themeName = $sttingsVlue->theme_url;
                $homeUrl = $sttingsVlue->home_url;
            }
        }
       // dd($themeName); 
       // return view('front.themes.'.$themeName.'.single_'.$post_type.'',compact('post','posttype','categories','menus','posts'));        
        
         // Check if a view file for the specific post type exists
        $viewExists = View::exists('front.themes.' . $themeName . '.single_' . $post_type);
    
        // If the view for the specific post type exists, return it
        if ($viewExists) {
            return view('front.themes.' . $themeName . '.single_' . $post_type, compact('post', 'posttype', 'categories', 'menus', 'posts'));
        } else {
            // If the view doesn't exist, return a default view (e.g., single.blade.php)
            return view('front.themes.' . $themeName . '.single', compact('post', 'posttype', 'categories', 'menus', 'posts'));
        }
        
    } 
     
    //search all
    public function searchAll(Request $request)
    {  
        $post_type = 'search';
        $posttype = Posttype::where('slug',$post_type)->first();
        $categories = Category::all();
        $menus = Menu::orderBy('position','ASC')->get();  

        $posts = Post::where('title','LIKE','%'.$request->name.'%')->where('status','1')->paginate($posttype->paginate);  
        // $search = Post::where('status', 1)->when($request->name, function($q) use ($request) {$q->where('title', 'LIKE', '%' . $request->name . '%'); })->get();

        //set as home page
        $setting = Settings::all();
        if($setting->count() == 0){
            $themeName = "default";
        }else{
            foreach($setting as $sttingsVlue){
                $themeName = $sttingsVlue->theme_url;
            }
        }                 
        
        // Check if a view file for the specific post type exists
        $viewExists = View::exists('front.themes.' . $themeName . '.' . $post_type);        
    
        // If the view for the specific post type exists, return it
        if ($viewExists) {
            return view('front.themes.'.$themeName.'.'.$post_type.'',compact('posts','posttype','categories','menus'));   
        } else {
            return view('front.themes.'.$themeName.'.posts',compact('posts','posttype','categories','menus'));   
        }
    }
    // public function searchAll(Request $request)
    // {  
    //     $categories = Category::all();
    //     $menus = Menu::orderBy('id','ASC')->get();         
    //     $posts = Post::all();       
    //     $search_posts = Post::where('content','LIKE','%'.$request->search.'%')->where('status','1')->get();       

    //     //set as home page
    //     $setting = Settings::all();
    //     if($setting->count() == 0){
    //         $themeName = "default";
    //     }else{
    //         foreach($setting as $sttingsVlue){
    //             $themeName = $sttingsVlue->theme_url;
    //         }
    //     }
    //     return view('front.themes.'.$themeName.'.search',compact('posts','categories','menus','search_posts'));
    // }
    //mail all
    public function sendmail(Request $request)
    {    
        $data = [
            'fname'         => $request->input('fname'),
            'fsubject'      => $request->input('phone'),
            'femail'        => $request->input('email'),
            'fphone'        => $request->input('industry'),
            'fmessage'      => $request->input('date').'-'.$request->input('time').'-'.$request->input('message'),
            'fattachemnt'   => ''
        ];
        //Feedback::create($data);
        //session()->flash('message','success');  
        //return redirect('/pages/contact-us');

        // for email 

        $data = [
            'name' => $request->all()
        ];

        try {
            // Attempt to send the email
            Mail::send('admin.email.mailbody',$data, function($message) {
            $message->to('shahinalam6644@gmail.com', 'New Message')->subject
            ('New Mail');
            $message->from('testershahin042@gmail.com',config('app.name'));
            }); 
    
            // If the email is successfully sent, proceed
            if ($request->form_name == 'Download Request') {
                $postss = "Your download link is on its way to your inbox. Please check your email to get started."; 
            } else {
                $postss = ""; 
            }
        } catch (Exception $e) {
            // If there is an exception, handle it
            $postss = "Failed to submit, please try again.";
            // Optionally, log the error or notify the admin
            \Log::error('Failed to send email: ' . $e->getMessage());
        }

        // Mail::send('admin.email.mailbody',$data, function($message) {
        //     $message->to('shahinalam6644@gmail.com', 'New Message')->subject
        //     ('New Mail');
        //     $message->from('testershahin042@gmail.com',config('app.name'));
            
        // });   
               
        // if(count(Mail::failures()) > 0){
        //     $postss = "Failed to submit, please try again."; 
        // }else{
        //     if($request->form_name == 'Download Reguest'){
        //         $postss = "Your download link is on its way to your inbox. Please check your email to get started."; 
        //     }else{
        //         $postss = ""; 
        //     }
        // }

        //set as home page
        $setting = Settings::all();
        if($setting->count() == 0){
            $themeName = "default";
        }else{
            foreach($setting as $sttingsVlue){
                $themeName = $sttingsVlue->theme_url;
            }
        }
        return view('admin.email.mail',compact('postss','themeName'));
    }   

    // feedback create
    public function feedbacksstore(Request $request)
    {       

        $validated = $request->validate([
            'fname'         => '',
            'fsubject'      => '',
            'femail'        => '',
            'fphone'        => '',
            'fmessage'      => '',
            'fattachemnt'   => ''
        ]);
        
        // $this -> validate($request, [
        //     'g-recaptcha-response' => ['required', new Recaptcha()]
        // ]);   
        
        // Exclude non-form fields
        $inputs = $request->except('_token', 'g-recaptcha-response');     

        // Save in DB
        $dataM = [
            'fname' => $request->form_name,
            'fmessage' => json_encode($inputs) // store inputs as JSON//implode(",<br/>", $formattedData) // field name + value together
        ];

        Feedback::create($dataM);
        session()->flash('message','Application successfully submited!');
        return back();
    }  

}