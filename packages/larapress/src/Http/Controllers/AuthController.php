<?php

namespace LaraPressCMS\LaraPress\Http\Controllers;

use Illuminate\Http\Request;
use LaraPressCMS\LaraPress\Models\User;
use Config\auth;
use LaraPressCMS\LaraPress\Models\Settings;
use LaraPressCMS\LaraPress\Models\Posttype; 
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;
use LaraPressCMS\LaraPress\LaraServiceProvider;

class AuthController extends Controller
{
    
    //register
    public function showRegisterForm(){
        $settingsAdmin = Settings::get()->first();
        return view('admin.user.front.create',compact('settingsAdmin'));
    }
    public function prosessRegister(Request $request){
      //  return 1;
        //validation
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role' => ''
        ]);
        $users = User::all();

        if($users->count() == 0){
            $users->role = 111;

            // by default setting set 
            $settingsdata = [
                'site_title' => 'LaraPress', 
                'site_logo' => '',
                'sub_title' => '', 
                'fav_icon' => '',  
                'dashboard_color' => '', 
                'text_color' => '', 
                'text_hover' => '', 
                'theme_url' => 'default',
                'home_url' => '',
                'editor' => 'classic',
                'header' => 'header',
                'footer' => 'footer'
            ];
            Settings::create($settingsdata);

            // by default posttype set 
            $posttypedata = [
                'user_id' => '1',
                'name' => 'Posts', 
                'slug' => 'posts', 
                'status' => '1',
                'category_id' => 'Categories',
                'title'=> 'Title',
                'content'=> 'Description', 
                'excerpt'=> 'Excerpt',
                'thumbnail_path'=> 'Thumbnails', 
                'option_1'=> 'Option 1',
                'option_2'=> 'Option 2',
                'option_3'=> 'Option 3',
                'option_4'=> 'Option 4',
                'more_option_1'=> 'Extra Fields',
                'more_option_2'=> 'Extra Fields',
                'gallery_img'=> 'Gallery',
                'trash'=> '0',
                'in_menu_swh'=> '1',
                'menu_icon'=> '',
                'category_main_id' => '0',
                'in_dashboard' => '1',                
                'pt_content' => '',
                'pt_content_css' => '',
                'pt_thumbnail_path' => '',
                'paginate' => '100',
                'template' => 1
            ];
            Posttype::create($posttypedata);            
            
            try {  
                // Define the API URL
                $apiUrl = 'https://larapress.org/version-controll';
                // Get the client's IP address
                $ipAddress = url('/').' - '.$_SERVER['REMOTE_ADDR'].' - V: '.(LaraServiceProvider::getCurrentLaraVersion() ?? "Not Available");            
                // Log the referrer and IP address
                $version = $ipAddress. PHP_EOL; 
                Http::post($apiUrl, ['version' => $version]);
            } catch (ConnectionException $e) {            
                // Handle connection-related exceptions            
                //return response()->json(['error' => 'Internet connection is down or the host is unreachable']);            
            }

        }else{
            $users->role = 0;
        }
        $data = [
            'name' => $request->input('name'),
            'email' => strtolower($request->input('email')),
            'password' => bcrypt($request->input('password')),
            'role' => $users->role
        ];
        try{
            $input = User::create($data);
            $this->setSuccessfullyMessage('User account created.');   

            // dd(session()->all());
            //dd(session('message'));
            //dd(session()->all());

            if(optional(auth()->user())->role == 111){
                //for new users form admin 
                session()->flash('message'.$input->id,'success');  
                return redirect('/dashboard/showUser');
            }else{
                // for new user 
                if($input->role == 0){
                    auth()->logout();
                    return redirect()->route('login');
                }
            }

            auth()->logout();
            return redirect()->route('login');
            

        }catch(Exeption $e){
            $this->setErrorMessage($e->getMessage());
            return redirect()->back();
        }

     }
    //login
    public function showLoginForm(){
        
        $settingsAdmin = Settings::get()->first();
        return view('admin.user.front.login',compact('settingsAdmin'));
        // return view('admin.user.front.login',compact('settingsAdmin'), [
        //     'errors' => session('errors') ? session('errors')->getBag('default') : new \Illuminate\Support\MessageBag()
        // ]); 
    }
    public function processLogin(Request $request){

         //validation
         $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $credentials = $request->except(['_token']);

       // dd(auth()->attempt($credentials));
        if (auth()->attempt($credentials)){
            //return redirect()->route('/dashboard');
            //return redirect('/dashboard');

             //user login check if usr is active
            if( optional(auth()->user())->role == 0){ 
                auth()->logout();
                $this->setErrorMessage('User approval is pending...'); 
                return redirect()->back();
            }else{
                return redirect('/dashboard');
            }
 
        }            
        $this->setErrorMessage('Invalid credential'); 
        return redirect()->back();      
    }

    public function logout(){
        
        auth()->logout();

        $this->setSuccessfullyMessage('User has been logged-out.');
        return redirect()->route('login');
    }

    
}
