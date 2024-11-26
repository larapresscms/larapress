<?php

namespace LaraPressCMS\LaraPress\Http\Controllers;

use Illuminate\Http\Request;
use LaraPressCMS\LaraPress\Models\User;
use Config\auth;
use LaraPressCMS\LaraPress\Models\Post;
use LaraPressCMS\LaraPress\Models\Media;
use LaraPressCMS\LaraPress\Models\Category;
use LaraPressCMS\LaraPress\Models\Settings;
use LaraPressCMS\LaraPress\Models\Posttype;
use DB;
use Artisan;
use Log;
use File;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;
use LaraPressCMS\LaraPress\LaraServiceProvider;


class AdminController extends Controller
{
    //--login system
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function clearCache()
    { 
        try {
            Artisan::call('cache:clear');
            Artisan::call('config:clear'); 
            //Artisan::call('config:cache');   
            Artisan::call('route:clear');  
            Artisan::call('view:clear');
            
            return redirect()->back()->with('message', 'Cache cleared successfully.');
        } catch (\Exception $e) {
            // Handle any exceptions that might occur during cache clearing
            return redirect()->back()->with('error', 'Failed to clear cache: ' . $e->getMessage());
        }
    }
    
    //admin dashboard
    public function dashboard(){
        $posts = Post::get();
        $media = Media::get();
        $categories = Category::get();
        $users = User::get();
        $settingsAdmin = Settings::get()->first();
        $posttypes = Posttype::all();
        $posttypes_inDash = Posttype::orderBy('id', 'ASC')->where('status', '1')->where('in_dashboard', '1')->get();
        $posttypesD = DB::table('posttypes')->select('menu_icon')->distinct()->get();
        return view('admin.index',compact('posts','categories','users','settingsAdmin','posttypes','posttypesD','media','posttypes_inDash'));
    }

    //all user create
    public function showUser()
    {
        $users = User::all();        
        $settingsAdmin = Settings::get()->first();
        $posttypes = Posttype::all();
        $posttypesD = DB::table('posttypes')->select('menu_icon')->distinct()->get();
        return view('admin.user.backend.index',compact('users','settingsAdmin','posttypes','posttypesD'));
    }
    //delete
    public function destroy($id)
    {
        User::destroy($id); 
        session()->flash('messageDestroy','Data Delete successfully');
        return redirect('/dashboard/showUser');
    }
    //create
    public function create()
    {

        $settingsAdmin = Settings::get()->first();
        $posttypes = Posttype::all();
        $posttypesD = DB::table('posttypes')->select('menu_icon')->distinct()->get();
        return view('admin.user.backend.create',compact('settingsAdmin','posttypes','posttypesD'));        

    }
    public function singleUser($id)
    {
        $user = User::find($id);
        $settingsAdmin = Settings::get()->first();
        $posttypes = Posttype::all();
        $posttypesD = DB::table('posttypes')->select('menu_icon')->distinct()->get();
        return view('admin.user.backend.show',compact('user','settingsAdmin','posttypes','posttypesD'));        

    }
    public function edit($id)
    {
        $posts = Post::all();
        $user = User::find($id);
        $settingsAdmin = Settings::get()->first();
        $posttypes = Posttype::all();
        $posttypesD = DB::table('posttypes')->select('menu_icon')->distinct()->get();
        return view('admin.user.backend.edit',compact('user','settingsAdmin','posttypes','posttypesD','posts'));        

    }
    public function update(Request $request, $id)
    {
        //validation
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'confirmed',
            'role' => '',
            'categories' => '',
            'feedbacks' => '',
            'media' => '',
            'menus' => '',
            'posts_id' => '',
            'posttypes_id' => '',
            'admin_pt_menu' => '',
            'create' => '',
            'update' =>'',
            'delete'=>''
            
        ]);
       
                
        $posts_id = isset($request->posts_id) && is_array($request->posts_id) ? $request->posts_id : [];
        $input['posts_id'] = implode(",",$posts_id); 
        
        // $pages_id = isset($request->pages_id) && is_array($request->pages_id) ? $request->pages_id : [];
        // $input['pages_id'] = implode(",",$pages_id);
        
        $posttypes_id = isset($request->posttypes_id) && is_array($request->posttypes_id) ? $request->posttypes_id : [];
        $input['posttypes_id'] = implode(",",$posttypes_id);

        $admin_pt_menu = isset($request->admin_pt_menu) && is_array($request->admin_pt_menu) ? $request->admin_pt_menu : [];
        $input['admin_pt_menu'] = implode(",",$admin_pt_menu);

        $input['categories'] = $request->input('categories');
        $input['feedbacks'] = $request->input('feedbacks');
        $input['media'] = $request->input('media');
        $input['menus'] = $request->input('menus');
                
        $input['create'] = $request->input('create');
        $input['update'] = $request->input('update');
        $input['delete'] = $request->input('delete');

        if($request->role == 111){
            $input['categories'] = null;
            $input['feedbacks'] = null;
            $input['media'] = null;
            $input['menus'] = null; 
            $input['posts_id'] = null;
            $input['posttypes_id'] = null;
            $input['admin_pt_menu'] = null;            
            $input['create'] = null;
            $input['update'] = null;
            $input['delete'] = null;
        }

        if(auth()->user()->role == 112){ 
            $input['categories'] = auth()->user()->categories;
            $input['feedbacks'] = auth()->user()->feedbacks;
            $input['media'] = auth()->user()->media;
            $input['menus'] = auth()->user()->menus; 
            $input['posts_id'] =  auth()->user()->posts_id;
            $input['posttypes_id'] = auth()->user()->posttypes_id;
            $input['admin_pt_menu'] = auth()->user()->admin_pt_menu;                   
            $input['create'] = auth()->user()->create;;
            $input['update'] = auth()->user()->update;;
            $input['delete'] = auth()->user()->delete;;
        }

        if($request->password != '' || $request->password != null){
            $input['password'] = bcrypt($request->input('password'));
        }else{
            $usr = User::find($id);
            $input['password'] = $usr->password;
        }
        
        $data = [
            'name' => $request->input('name'),
            'email' => strtolower($request->input('email')),
            'password' => $input['password'],
            'role' => $request->input('role'),
            'categories' => $input['categories'],
            'feedbacks' => $input['feedbacks'],
            'media' => $input['media'],
            'menus' => $input['menus'], 
            'posts_id' => $input['posts_id'],
            'posttypes_id' => $input['posttypes_id'],
            'admin_pt_menu' => $input['admin_pt_menu'],            
            'create' => $input['create'],
            'update' => $input['update'],
            'delete' => $input['delete']
        ];


        try{

           // User::create($data);

            $user = User::find($id);
            $user->update($data);

            session()->flash('message',$user->name.' update successfully');
            return redirect('/dashboard/user/'.$user->id.'/edit');



        }catch(Exeption $e){
            $this->setErrorMessage($e->getMessage());

            return redirect()->back();
        }
    }
    public function profile()
    {
        $settingsAdmin = Settings::get()->first();
        $posttypes = Posttype::all();
        $posttypesD = DB::table('posttypes')->select('menu_icon')->distinct()->get();
        return view('admin.user.backend.profile',compact('settingsAdmin','posttypes','posttypesD'));        

    }

    //----------------
    // public function search(Request $request)
    // {
    //     $cari = $request->get('search');
    //     $Title = Post::where('title', 'LIKE', '%' .$cari . '%')->paginate(10);
    //    dd($Title);
    // }
    
    public function aboutLaraPress(){   
        $filePath = storage_path('update_status.txt');
            if (File::exists($filePath)) {
                // Open the file in write mode, which will clear its contents
                file_put_contents($filePath, '');
            }   
        $settingsAdmin = Settings::get()->first();
        $posttypes = Posttype::all();
        $posttypesD = DB::table('posttypes')->select('menu_icon')->distinct()->get();
        return view('admin.about',compact('settingsAdmin','posttypes','posttypesD'));       
    }

    public function updateLaraPress(){ 
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

        $settingsAdmin = Settings::get()->first();
        $posttypes = Posttype::all();
        $posttypesD = DB::table('posttypes')->select('menu_icon')->distinct()->get();
        return view('admin.update',compact('settingsAdmin','posttypes','posttypesD'));       
    }


    public function updateLarapressCore()
    {
        try {

            $filePath = storage_path('update_status.txt');
            if (File::exists($filePath)) {
                // Open the file in write mode, which will clear its contents
                file_put_contents($filePath, '');
            }

            $this->info('Downloading the latest version of LaraPress...');

            // Step 1: Download the latest LaraPress version
            $zipFile = base_path('latest-larapress.zip');
            file_put_contents($zipFile, fopen('https://larapress.org/latest/latest-larapress.zip', 'r'));

            $this->info('Extracting the downloaded LaraPress...');

            // Step 2: Extract the downloaded file
            $extractPath = base_path('latest-larapress');
            $zip = new \ZipArchive;
            if ($zip->open($zipFile) === TRUE) {
                $zip->extractTo($extractPath);
                $zip->close();
            } else {  
                $this->info('Failed to extract LaraPress files.');              
                return redirect()->back()->with('error', 'Failed to extract LaraPress files.');
                // return response()->json(['error' => 'Failed to extract LaraPress files.'], 500);
            }

            $this->info('Replacing core LaraPress files...');

            // Step 3: Define files/folders to skip
            $skipFiles = [
                'resources',
                'vendor',
                'public'                
                // Add more paths as needed
            ];

            // Step 4: Replace LaraPress core files with skipping logic
            $this->replaceCoreFiles($extractPath.'/latest-larapress', base_path(), $skipFiles);

            // Step 5: Clean up
            unlink($zipFile);
            File::deleteDirectory($extractPath);

            $this->info('LaraPress core has been successfully updated.');
            return redirect()->back()->with('message', 'LaraPress core has been successfully updated.');
            //return response()->json(['success' => 'LaraPress core has been successfully updated.']);
        } catch (\Exception $e) {
            Log::error('Error updating LaraPress core: ' . $e->getMessage());
            $this->info('Error updating LaraPress core.');
            return redirect()->back()->with('error', 'Error updating LaraPress core.' . $e->getMessage());
            //return response()->json(['error' => 'Error updating LaraPress core.'], 500);
        }
    }

    private function replaceCoreFiles($source, $destination, $skipFiles)
    {
        $directory = new \RecursiveDirectoryIterator($source, \RecursiveDirectoryIterator::SKIP_DOTS);
        $iterator = new \RecursiveIteratorIterator($directory, \RecursiveIteratorIterator::SELF_FIRST);

        foreach ($iterator as $file) {
            $destPath = $destination . DIRECTORY_SEPARATOR . $iterator->getSubPathName();

            // Skip files/folders if they match the skip list
            if ($this->shouldSkip($iterator->getSubPathName(), $skipFiles)) {
                $this->info('Skipping ' . $iterator->getSubPathName());
                continue;
            }

            if ($file->isDir()) {
                if (!is_dir($destPath)) {
                    mkdir($destPath, 0755, true);
                }
            } else {
                copy($file, $destPath);
            }
        }
    }

    private function shouldSkip($path, $skipFiles)
    {
        foreach ($skipFiles as $skip) {
            if (strpos($path, $skip) !== false) {
                return true;
            }
        }
        return false;
    }

    private function info($message)
    {
        // You can use Laravel's log or any other logging mechanism here
        $statusFile = storage_path('update_status.txt');
        Log::info($message);
        file_put_contents($statusFile, $message. "\n", FILE_APPEND);
    }     
    public function getStatus()
    {
        $statusFile = storage_path('update_status.txt');
        $status = file_exists($statusFile) ? file_get_contents($statusFile) : ' ';
        
        $status = explode("\n", trim($status));

        return response()->json(['status' => $status]);
    } 
    
    public function uploadTemplate(Request $request){

        if ($request->hasFile('templateZip')) {
            $file = $request->file('templateZip');
            $zip = new \ZipArchive;
            if ($zip->open($file->getPathname()) === TRUE) {
                $zip->extractTo(resource_path('views/front/template'));
                $zip->close();
                return redirect()->back()->with('message', 'Template installed successfully!'); 
            } else {
                return redirect()->back()->with('message', 'Failed to install template.');
            }
        } 
    }

    public function deleteTemplate($folderName) {    
        // Build the full path to the template directory
        $templatePath = resource_path('views/front/template/' . $folderName);
    
        // Check if the directory exists
        if (File::exists($templatePath)) {
            // Recursively delete the directory and all its contents
            File::deleteDirectory($templatePath);
            return redirect()->back()->with('message', 'Template deleted successfully.');              
        } else {
            return redirect()->back()->with('message', 'Permission Denied.'); 
        }
    }
    
}
