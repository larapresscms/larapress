<?php

namespace LaraPressCMS\LaraPress\Http\Controllers;

use Illuminate\Http\Request;
use LaraPressCMS\LaraPress\Models\Media;
use LaraPressCMS\LaraPress\Models\Settings;
use LaraPressCMS\LaraPress\Models\Posttype;
use LaraPressCMS\LaraPress\Models\User;
use DB;
use Image;


class MediaController extends Controller
{
	//--login system
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {   
        $medies = Media::orderBy('id','DESC')->paginate(15);
        $settingsAdmin = Settings::get()->first();
        $users = User::all();
        $posttypes = Posttype::all();
        $posttypesD = DB::table('posttypes')->select('menu_icon')->distinct()->get();
        return view('admin.media.index',compact('medies','settingsAdmin','posttypes','posttypesD','users')); 
    }

    public function create()
    {
        $settingsAdmin = Settings::get()->first();
        $posttypes = Posttype::all();
        $posttypesD = DB::table('posttypes')->select('menu_icon')->distinct()->get();
        return view('admin.media.create',compact('settingsAdmin','posttypes','posttypesD'));
    }
    public function store(Request $request)
    {
        //check Editor
        $user = auth()->user();
        if ($user->role == 112 && $user->create == NULL) {
            session()->flash('messageDestroy', 'You are not allowed to create.');
            return redirect('/dashboard/media');
        }

        $validated = $request->validate([
            'img_name' => 'required',
            'img_name.*' => 'mimes:jpeg,png,jpg,gif,svg,doc,docx,pdf,webp,xlsx|max:10240', 
        ]);
        if($request->hasfile('img_name'))
        {
            foreach ($request->file('img_name') as $imgName) {                

                $originalFileName = $imgName->getClientOriginalName();
                $getFileExt = uniqid().'_'.str_replace(' ', '_', $originalFileName);                   
                $extension = $imgName->getClientOriginalExtension();

                // Get the current year and month
                $year = date('Y');
                $month = date('m');
                // Define the directory path
                $directory = public_path("uploads/{$year}/{$month}");
                // Create the directory if it doesn't exist
                if (!file_exists($directory)) {
                    mkdir($directory, 0777, true);
                }
                $getFileExt = $year.'/'.$month.'/'.$getFileExt;
                // Move the uploaded file to the directory
                $imgName->move($directory, $getFileExt);

                //$imgName->move('public/uploads/', $getFileExt);
                //$imgName->move(public_path('uploads/'), $getFileExt);

                if (!in_array(strtoupper($extension), ['PDF', 'XLSX'])) {                    
                    // Compress the image after moving
                    //$this->compressImageFile(public_path('uploads/' . $getFileExt), 75);                    
                }
                
                $input = $request->all();
                $input['img_name'] = $getFileExt; 
                $input['uploaded_by'] = auth()->user()->id;
                Media::create($input);
            }              
         }  

        session()->flash('message','Data insert successfully');
        return redirect('/dashboard/media');
    }

    private function compressImageFile($filePath, $quality)
    {
        // Get the image type
        $imageType = exif_imagetype($filePath);

        // Load the original image based on its type
        switch ($imageType) {
            case IMAGETYPE_JPEG:
                $image = imagecreatefromjpeg($filePath);
                break;
            case IMAGETYPE_PNG:
                $image = imagecreatefrompng($filePath);
                break;
            case IMAGETYPE_GIF:
                $image = imagecreatefromgif($filePath);
                break;
            default:
                die('Unsupported image type');
        }

        if ($image === false) {
            die('Failed to load image');
        }

        // Save the image with compression
        imagejpeg($image, $filePath, $quality);

        // Free up memory
        imagedestroy($image);
    }

    public function destroy($id)
    {
        //check Editor
        $user = auth()->user();
        if ($user->role == 112 && $user->delete == NULL) {
            session()->flash('messageDestroy', 'You are not allowed to delete.');
            return redirect('/dashboard/media');
        }

        //img distroy
        $media = Media::find($id);
        if($media->img_name){
            unlink("public/uploads/".$media->img_name);
        }else{}
        Media::destroy($id); 
        session()->flash('messageDestroy','Data Delete successfully');
        return redirect('/dashboard/media');
    }

    //new ajx
    public function storemediaajx(Request $request)
    {   
        //check Editor
        $user = auth()->user();
        if ($user->role == 112 && $user->create == NULL) {            
            return 'failed'; 
        } 

        $validated = $request->validate([
            'img_name' => 'required',
            'img_name.*' => 'mimes:jpeg,png,jpg,gif,svg,doc,docx,pdf,webp,xlsx|max:10240', 
        ]);
        if($request->hasfile('img_name'))
        {
            foreach ($request->file('img_name') as $imgName) {
                

                $originalFileName = $imgName->getClientOriginalName();
                $getFileExt = uniqid().'_'.str_replace(' ', '_', $originalFileName);  
                
                $extension = $imgName->getClientOriginalExtension();

                // Get the current year and month
                $year = date('Y');
                $month = date('m');
                // Define the directory path
                $directory = public_path("uploads/{$year}/{$month}");
                // Create the directory if it doesn't exist
                if (!file_exists($directory)) {
                    mkdir($directory, 0777, true);
                }
                $getFileExt = $year.'/'.$month.'/'.$getFileExt;
                // Move the uploaded file to the directory
                $imgName->move($directory, $getFileExt);

                //$imgName->move('public/uploads/', $getFileExt);
                //$imgName->move(public_path('uploads/'), $getFileExt);

                if (!in_array(strtoupper($extension), ['PDF', 'XLSX'])) {                    
                    // Compress the image after moving
                    //$this->compressImageFile(public_path('uploads/' . $getFileExt), 75);                    
                }

                $input = $request->all();
                $input['img_name'] = $getFileExt; 
                $input['uploaded_by'] = auth()->user()->id;
                Media::create($input);
            }              
         } 
         
        return 'success';   
        
    }
    //mediamanager    
    public function mediamanager()
    {   
        $medies = Media::orderBy('id','DESC')->limit(12)->get();
        $settingsAdmin = Settings::get()->first();
        return view('admin.media.mediamanager',compact('medies','settingsAdmin')); 
    }
    public function dashboardMediaManager(Request $request)
    {
        // Your logic to fetch data 
        $data = Media::orderBy('id', 'DESC')->get();
        // Return the data as JSON response
        return response()->json($data);
    }
    //bulkAction--------------
     public function bulkActionMedia(Request $request)
    {
        //dd($request->all());

        $ids = $request->ids ?? [];
        $action = $request->action;   
        $user = auth()->user();
        

        if (empty($ids)) {
            return back()->with('messageDestroy', 'No media selected.');
        }

        switch ($action) {
            case 'delete':
                DB::table('media')->whereIn('id', $ids)->delete();
                return back()->with('messageDestroy', 'Selected Media deleted.');                      
            default:
                return back()->with('messageDestroy', 'Invalid action.');
        }


    }
    public function edit($id){
        //dd('test');
        $media = Media::find($id);
        $users = User::all();
        $settingsAdmin = Settings::get()->first();
        $posttypes = Posttype::all();
        $posttypesD = DB::table('posttypes')->select('menu_icon')->distinct()->get();
        return view('admin.media.edit',compact('media','settingsAdmin','posttypes','posttypesD','users')); 
    }

     public function update(Request $request, $id)
    {
        //check Editor
        $user = auth()->user();
        if ($user->role == 112 && $user->update == NULL) {
            session()->flash('messageDestroy', 'You are not allowed to update.');
            return redirect('/dashboard/media/'.$id.'/edit/');
        }

        $media = Media::find($id);
        $media->update($request->all());

        session()->flash('message'.$media->id,'success'); 
        session()->flash('message','Data update successfully');
        return redirect('/dashboard/media/'.$id.'/edit/');
    }

}
