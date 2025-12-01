<?php
namespace LaraPressCMS\LaraPress\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\StreamedResponse;
use LaraPressCMS\LaraPress\Models\Settings;
use LaraPressCMS\LaraPress\Models\Posttype;
use DB;

class FileEditorController extends Controller
{
    protected $baseDir;
    protected $backupDir;
    protected $allowed;

    //--login system    
    public function __construct()
    {
        $this->middleware('auth');

        // $this->middleware(function ($request, $next) {
        //     $user = Auth::user();
        //     if (!$user || !($user->is_admin ?? false)) {
        //         abort(403, 'Unauthorized.');
        //     }
        //     return $next($request);
        // });

        $this->baseDir = realpath(resource_path('views'));
        $this->backupDir = storage_path('app/cms_backups');
        $this->allowed = ['php','html','htm','css','js','json','txt','md'];

        if (!is_dir($this->backupDir)) mkdir($this->backupDir, 0755, true);
    }

    public function index()
    {
        //dd($this->baseDir);
        //set as home page
        $settingsAdmin = Settings::get()->first();
        $posttypes = Posttype::all();
        $posttypes_inDash = Posttype::orderBy('id', 'ASC')->where('status', '1')->where('in_dashboard', '1')->get();
        $posttypesD = DB::table('posttypes')->select('menu_icon')->distinct()->get();

        return view('admin.editor.index',compact('settingsAdmin','posttypes','posttypesD'), [
            'basePath' => $this->baseDir,
        ]);
    }

    protected function resolvePath($path, $mustExist=true)
    {
        if (!$path) return null;
        if (!Str::startsWith($path, DIRECTORY_SEPARATOR) && !preg_match('#^[A-Za-z]:\\\\#', $path)) {
            $candidate = $this->baseDir . DIRECTORY_SEPARATOR . ltrim($path, DIRECTORY_SEPARATOR);
        } else $candidate = $path;

        $real = realpath($candidate);
        if ($real === false) return $mustExist ? null : $this->normalizePath($candidate);
        if (!Str::startsWith($real, $this->baseDir)) return null;
        return $real;
    }

    protected function normalizePath($path)
    {
        $parts=[]; $segments=preg_split('#[\\\\/]#',$path);
        foreach($segments as $seg){
            if($seg===''||$seg==='.') continue;
            if($seg==='..') array_pop($parts); else $parts[]=$seg;
        }
        return DIRECTORY_SEPARATOR.ltrim(implode(DIRECTORY_SEPARATOR,$parts),DIRECTORY_SEPARATOR);
    }

    protected function makeBackup($path)
    {
        if (!is_file($path)) return;
        $rel = ltrim(str_replace($this->baseDir,'',$path),DIRECTORY_SEPARATOR);
        $dir = $this->backupDir.DIRECTORY_SEPARATOR.dirname($rel);
        if(!is_dir($dir)) mkdir($dir,0755,true);
        $bakFile=$dir.DIRECTORY_SEPARATOR.basename($path).'.bak_'.time();
        copy($path,$bakFile);
    }

    protected function getTree($dir)
    {
        $tree=[];
        foreach(scandir($dir) as $item){
            if($item==='.'||$item==='..') continue;
            $path=$dir.DIRECTORY_SEPARATOR.$item;
            if(is_dir($path)){
                $tree[]=['name'=>$item,'path'=>$path,'is_dir'=>true,'children'=>$this->getTree($path)];
            }else{
                $tree[]=['name'=>$item,'path'=>$path,'is_dir'=>false];
            }
        }
        return $tree;
    }

    public function tree(){ return response()->json($this->getTree($this->baseDir)); }

    public function readFile(Request $request){
        $file=$request->query('file'); $path=$this->resolvePath($file);
        if(!$path||!is_file($path)) return response()->json(['error'=>'Invalid file'],400);
        return response()->json(['content'=>file_get_contents($path),'path'=>$path]);
    }

    public function saveFile(Request $request){
        $file=$request->post('file'); $content=$request->post('content');
        $path=$this->resolvePath($file);
        if(!$path||!is_file($path)) return response()->json(['error'=>'Invalid file'],400);
        $ext=strtolower(pathinfo($path,PATHINFO_EXTENSION));
        if(!in_array($ext,$this->allowed)) return response()->json(['error'=>'File type not allowed'],403);
        $this->makeBackup($path);
        file_put_contents($path,$content);
        return response()->json(['success'=>true]);
    }

    public function createFile(Request $request){
        $dir=$request->post('dir',$this->baseDir); $name=$request->post('name');
        $fullDir=$this->resolvePath($dir); if(!$fullDir||!is_dir($fullDir)) return response()->json(['error'=>'Invalid dir'],400);
        $newPath=$fullDir.DIRECTORY_SEPARATOR.basename($name);
        $ext=strtolower(pathinfo($newPath,PATHINFO_EXTENSION));
        if($ext && !in_array($ext,$this->allowed)) return response()->json(['error'=>'Extension not allowed'],403);
        if(file_exists($newPath)) return response()->json(['error'=>'File exists'],400);
        file_put_contents($newPath,''); return response()->json(['success'=>true,'path'=>$newPath]);
    }

    public function createDir(Request $request){
        $dir=$request->post('dir',$this->baseDir); $name=$request->post('name');
        $fullDir=$this->resolvePath($dir); if(!$fullDir||!is_dir($fullDir)) return response()->json(['error'=>'Invalid dir'],400);
        $newPath=$fullDir.DIRECTORY_SEPARATOR.basename($name);
        if(file_exists($newPath)) return response()->json(['error'=>'Already exists'],400);
        mkdir($newPath,0755,true); return response()->json(['success'=>true,'path'=>$newPath]);
    }

    public function delete(Request $request)
    {
        $path = $request->input('path');

        if (!$path) {
            return response()->json(['error' => 'Path is required']);
        }

        $fullPath = $path;

        // Prevent deleting project root
        $projectRoot = realpath(base_path());
        if (realpath($fullPath) === $projectRoot) {
            return response()->json(['error' => 'Cannot delete the project root folder.']);
        }

        if (!file_exists($fullPath)) {
            return response()->json(['error' => 'File or folder not found']);
        }

        try {
            if (is_dir($fullPath)) {
                // Recursively delete folder contents
                $this->deleteDirectory($fullPath);
            } else {
                unlink($fullPath);
            }
            return response()->json(['success' => true]);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Delete failed: ' . $e->getMessage()]);
        }
    }

    private function deleteDirectory($dir)
    {
        $items = scandir($dir);
        foreach ($items as $item) {
            if ($item === '.' || $item === '..') continue;
            $path = $dir . DIRECTORY_SEPARATOR . $item;
            if (is_dir($path)) {
                $this->deleteDirectory($path);
            } else {
                unlink($path);
            }
        }
        rmdir($dir);
    }


    public function rename(Request $request)
    {
        $oldPath = $request->input('pathN');
        $newName = $request->input('newName');

        //return response()->json(['error' => $oldPath ]);

        if (!$oldPath || !$newName) {
            return response()->json(['error' => 'Invalid input']);
        }

        $fullPath = $oldPath; // base_path();
        
        //return response()->json(['error' => $fullPath ]);

        if (!file_exists($oldPath)) {
            return response()->json(['error' => 'File or folder not found']);
        }

        $dir = dirname($fullPath);
        $newPath = $dir . DIRECTORY_SEPARATOR . $newName;

        if (file_exists($newPath)) {
            return response()->json(['error' => 'A file or folder with that name already exists']);
        }

        try {
            rename($fullPath, $newPath);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Rename failed: ' . $e->getMessage()]);
        }
    }


    public function download(Request $request){
        $file=$request->query('file'); $path=$this->resolvePath($file);
        if(!$path||!is_file($path)) abort(404);
        return new StreamedResponse(function() use($path){ readfile($path); },200,['Content-Type'=>mime_content_type($path),'Content-Disposition'=>'attachment; filename="'.basename($path).'"']);
    }

    public function breadcrumbs(Request $request){
        $path=$request->query('path',$this->baseDir); $full=$this->resolvePath($path);
        if(!$full) return response()->json(['error'=>'Invalid path'],400);
        $rel=ltrim(str_replace($this->baseDir,'',$full),DIRECTORY_SEPARATOR);
        $parts=explode(DIRECTORY_SEPARATOR,$rel); $breadcrumbs=[]; $current=$this->baseDir;
        foreach($parts as $part){ if($part==='') continue; $current.='/'.$part; $breadcrumbs[]=['name'=>$part,'path'=>$current]; }
        return response()->json($breadcrumbs);
    }

    public function preview(Request $request){
        $file=$request->query('file'); $path=$this->resolvePath($file);
        if(!$path||!is_file($path)) abort(404);
        return response(file_get_contents($path))->header('Content-Type','text/html');
    }
}
