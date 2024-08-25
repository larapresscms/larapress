<?php
namespace LaraPressVendor\LaraPress\Http\Controllers;

use LaraPressVendor\LaraPress\Models\Feedback;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use LaraPressVendor\LaraPress\Models\Post;
use LaraPressVendor\LaraPress\Models\Settings;
use Artisan;
use File;
use DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailable;
use Exception;
use LaraPressVendor\LaraPress\Rules\Recaptcha;
use LaraPressVendor\LaraPress\Models\Posttype;
use LaraPressVendor\LaraPress\Models\Category;
use LaraPressVendor\LaraPress\Models\Menu;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{    
    // setup
    public function migrate(){  
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
    public function index(){ 
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
            return view('front.themes.'.$themeName.'.page',compact('page','posts','categories','menus'));
       }else{
            return view('front.themes.'.$themeName.'.index',compact('posts','categories','menus'));
       }
    }
    public function single($slug){ 
        $post = Post::where('slug',$slug)->first();
        $posts = Post::all();
        $menus = Menu::orderBy('id','ASC')->get();
        $categories = Category::all();   
        //set as home page
        $setting = Settings::all();
        if($setting->count() == 0){
            $themeName = "default";
        }else{
            foreach($setting as $sttingsVlue){
                $themeName = $sttingsVlue->theme_url;
            }
        }
        return view('front.themes.'.$themeName.'.single',compact('post','posts','menus','categories'));
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
       // dd($themeName); 
        return view('front.themes.'.$themeName.'.'.$post_type.'',compact('posts','posttype','categories','menus','postD'));        
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
        $categories = Category::all();
        $menus = Menu::orderBy('id','ASC')->get();         
        $posts = Post::all(); 
       // dd($request->search);        
        $search_posts = Post::where('content','LIKE','%'.$request->search.'%')->where('status','1')->get();       

        //set as home page
        $setting = Settings::all();
        if($setting->count() == 0){
            $themeName = "default";
        }else{
            foreach($setting as $sttingsVlue){
                $themeName = $sttingsVlue->theme_url;
            }
        }
        return view('front.themes.'.$themeName.'.search',compact('posts','categories','menus','search_posts'));
    }
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

        //dd($request);

        $validated = $request->validate([
            'fname'         => '',
            'fsubject'      => '',
            'femail'        => '',
            'fphone'        => '',
            'fmessage'      => '',
            'fattachemnt'   => ''
        ]);
        
        $this -> validate($request, [
            'g-recaptcha-response' => ['required', new Recaptcha()]
        ]);
        
  
        // Recaptcha passed, do what ever you need
        Feedback::create($validated);

        session()->flash('message','Sent successfully');
        return redirect($request->mailurl);
    }

   

}
