<?php

namespace LaraPressCMS\LaraPress\Http\Controllers;

use Illuminate\Http\Request;
use LaraPressCMS\LaraPress\Models\User;
use LaraPressCMS\LaraPress\Models\Settings;
use LaraPressCMS\LaraPress\Models\Posttype; 
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;
use LaraPressCMS\LaraPress\LaraServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Cache;
use DB;

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
            // 'password' => 'required|min:6|confirmed',
            'password' => [
                'required','confirmed',
                'string',
                'min:8',
    
                // at least one number
                'regex:/[0-9]/',
    
                // at least one special character
                'regex:/[@$!%*#?&]/',
    
                // NOT same as email
                function ($attribute, $value, $fail) use ($request) {
                    if ($value === $request->email) {
                        $fail('Password cannot be same as email.');
                    }
                },
            ],
            
            'role' => ''
        ],[
            'password.regex' => 'Password must contain at least one number and one special character.',
        ]);
       

        $users = User::all();

        if($users->count() == 0){
            $users->role = 111;
            $users->email_verified_at = now();

            // by default setting set 
            $settingsdata = [
                'site_title' => 'LaraPress', 
                'site_logo' => '',
                'sub_title' => '', 
                'fav_icon' => '',  
                'dashboard_color' => '#1d2327', 
                'text_color' => '#00da00', 
                'text_hover' => '#fff', 
                'theme_url' => 'default',
                'home_url' => '',
                'editor' => 'classic',
                'header' => 'header',
                'footer' => 'footer',
                'twofa' => '0'
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
                'excerpt'=> [
                'type' => 'none',
                'label' => 'none',
                'values' => 'none',
                'required' => '1'
                ],
                'thumbnail_path'=> 'Thumbnails', 
                'option_1'=> [
                    'type' => 'none',
                    'label' => 'none',
                    'values' => 'none',
                    'required' => '1'
                ],
                'option_2'=>  [
                    'type' => 'none',
                    'label' => 'none',
                    'values' => 'none',
                    'required' => '1'
                ],
                'option_3'=>  [
                    'type' => 'none',
                    'label' => 'none',
                    'values' => 'none',
                    'required' => '1'
                ],
                'option_4'=>  [
                    'type' => 'none',
                    'label' => 'none',
                    'values' => 'none',
                    'required' => '1'
                ],
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
                'template' => 'single'
            ];
            Posttype::create($posttypedata);            
            
            try {  
                // Define the API URL
                $apiUrl = 'https://larapress.org/en/version-controll';
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
            $users->email_verified_at = null;
        }
        $data = [
            'name' => $request->input('name'),
            'email' => strtolower($request->input('email')),
            'password' => bcrypt($request->input('password')),
            'role' => $users->role,
            'email_verified_at'=> $users->email_verified_at
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
            'password' => 'required|min:8'
        ]);
        
        $email = $request->email;
        // user locked system start
        $cacheKey   = 'login_attempts_' . md5($email);
        $lockoutKey = 'login_lockout_' . md5($email);
        $maxAttempts = 10;
        $lockoutMinutes = 5;
    
        // ── Check if account is currently locked out ──────────────────────
        if (Cache::has($lockoutKey)) {
            $secondsLeft = Cache::get($lockoutKey) - time();
            $minutesLeft = max(1, ceil($secondsLeft / 60));
    
            $this->setErrorMessage(
                'Your account has been locked temporarily due to exceeding the maximum ' .
                'number of failed log-on attempts. Please try again after ' . $minutesLeft . ' minute(s).'
            );
            return redirect()->back()->withInput($request->only('email'));
        }
        // user locked system end
        
        
        // Every attempt (success or fail) count
        $this->pushLog($email, [
            'action' => 'attempt',
            'ip'     => $request->ip(),
            'time'   => now()->format('d M Y, h:i A'),
        ]);

        $credentials = $request->except(['_token']);
        
        if (auth()->attempt($credentials)){
            
            // ── Successful login — clear failed attempt counters ──────────
            Cache::forget($cacheKey);
            Cache::forget($lockoutKey);
             
            //otp-------------- 
            $settingsAdmin = Settings::get()->first();     
            if($settingsAdmin->twofa == '1'){ 
                // Clear session
                session()->forget(['2fa_otp', '2fa_user_id', '2fa_expires_at']);
                $user = auth()->user();                
                // Generate OTP
                $otp = rand(100000, 999999);
                // Store in session (NO DATABASE)
                session([
                    '2fa_user_id' => $user->id,
                    '2fa_otp' => $otp,
                    '2fa_expires_at' => now()->addMinutes(2)->timestamp
                ]);    
                // Send OTP (email example)
                mail($user->email, "OTP Code", "Your OTP is: $otp");                 
                // Logout AFTER setting session
                Auth::logout();  
                return view('admin.user.front.verification',compact('settingsAdmin'));
            }               
            //otp--------------

             //user login check if usr is active----------------useless part
            if( optional(auth()->user())->role == 0){ 
                auth()->logout();
                $this->setErrorMessage('User approval is pending...'); 
                return redirect()->back();
            }else{
                
                return redirect('/dashboard');
            }
 
        } 
        
        // Failed login
        $this->pushLog($email, [
            'action' => 'failed',
            'ip'     => $request->ip(),
            'time'   => now()->format('d M Y, h:i A'),
        ]);
        
        
        // Increment attempt counter (stored for 10 minutes to auto-expire)
        $attempts = Cache::get($cacheKey, 0) + 1;
        Cache::put($cacheKey, $attempts, now()->addMinutes(10));
    
        if ($attempts >= $maxAttempts) {
            // Set lockout expiry timestamp (used to display remaining time)
            Cache::put($lockoutKey, time() + ($lockoutMinutes * 60), now()->addMinutes($lockoutMinutes));
            Cache::forget($cacheKey); // Reset counter
    
            $this->setErrorMessage(
                'Your account has been locked temporarily due to exceeding the maximum ' .
                'number of failed log-on attempts. Please try again after 5 minutes.'
            );
            return redirect()->back()->withInput($request->only('email'));
        }
    
        $remaining = $maxAttempts - $attempts;
        $this->setErrorMessage("Invalid credential. You have {$remaining} attempt(s) remaining before your account is locked.");
        return redirect()->back()->withInput($request->only('email'));
        
        
        // $this->setErrorMessage('Invalid credential'); 
        // return redirect()->back();      
    }

    public function logout(Request $request){
        
        $user  = Auth::user();
        $email = $user->email;

        // Logout
        $this->pushLog($email, [
            'action' => 'logout',
            'ip'     => $request->ip(),
            'time'   => now()->format('d M Y, h:i A'),
        ]);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // auth()->logout();

        $this->setSuccessfullyMessage('User has been logged-out.');
        return redirect()->route('login');
    }
    
    //otp----------
    public function verifyOtp(Request $request)
    {
        $sessionOtp = session('2fa_otp');
        $expiresAt = session('2fa_expires_at');
        $userId = session('2fa_user_id');
    
        if (!$sessionOtp || !$userId) {
            //return redirect('/login');
            $this->setErrorMessage('OTP expired. Try again.'); 
            return redirect()->back(); 
        }
    
        // Expired check->timestamp
        if (now()->timestamp > $expiresAt) {
            session()->forget(['2fa_otp', '2fa_user_id', '2fa_expires_at']);
    
            return back()->withErrors(['otp' => 'OTP expired']);
        }
    
        $user = \App\Models\User::find($userId);
        // Validate OTP
        if ($request->otp == $sessionOtp) {
            
            if( $user->role == 0){ 
                auth()->logout();
                $this->setErrorMessage('User approval is pending...'); 
                return redirect()->back();
            }
    
            Auth::login($user);
    
            // Clear session
            session()->forget(['2fa_otp', '2fa_user_id', '2fa_expires_at']);
            
            //last login
            // ✅ Save to cache with user id as key
            cache()->put('last_login_' . Auth::id(), [
                'ip'  => $request->ip(),
                'at'  => now()->format('d M Y, h:i A'),
            ], now()->addDays(30)); // keep for 30 days
            
            //Success login
            $this->pushLog($user->email, [
                'action' => 'login',
                'ip'     => $request->ip(),
                'time'   => now()->format('d M Y, h:i A'),
            ]);
    
            return redirect('/dashboard');
        }
    
        //return back()->withErrors(['otp' => 'Invalid OTP']);
        // Failed login
        $this->pushLog($user->email, [
            'action' => 'failed',
            'ip'     => $request->ip(),
            'time'   => now()->format('d M Y, h:i A'),
        ]);
        
        $this->setErrorMessage('Invalid OTP'); 
        return redirect()->back(); 
    }
    
    // Push new log entry into cache array
    private function pushLog(string $email, array $data): void
    {
        $key  = 'user_log_' . md5($email);
        $logs = Cache::get($key, []);

        array_unshift($logs, $data); // latest first

        // Keep only last 100 entries per user
        $logs = array_slice($logs, 0, 100);

        Cache::put($key, $logs, now()->addDays(60));
    }
    
}
