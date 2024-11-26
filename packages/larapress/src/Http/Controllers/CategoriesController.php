<?php

namespace LaraPressCMS\LaraPress\Http\Controllers;

use Illuminate\Http\Request;
use LaraPressCMS\LaraPress\Models\Category;
use Illuminate\Support\Str;
use LaraPressCMS\LaraPress\Models\Settings;
use LaraPressCMS\LaraPress\Models\Posttype;
use LaraPressCMS\LaraPress\Models\Post;
use LaraPressCMS\LaraPress\Models\Menu;
use DB;

class CategoriesController extends Controller
{
    //--login system
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $posts = Post::all();
        $menus = Menu::all();
        $settingsAdmin = Settings::get()->first();
        $posttypes = Posttype::orderBy('id','DESC')->get();
        $posttypesD = DB::table('posttypes')->select('menu_icon')->distinct()->get();
        return view('admin.categories.index',compact('categories','settingsAdmin','posttypes','posttypesD','posts','menus')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $settingsAdmin = Settings::get()->first();
        $posttypes = Posttype::orderBy('id','DESC')->get();
        $posttypesD = DB::table('posttypes')->select('menu_icon')->distinct()->get();
        return view('admin.categories.create',compact('settingsAdmin','posttypes','posttypesD'));        

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|min:5', 
            'slug' => 'unique:posts', 
            'status' => 'required', 
        ]);

        //$slug = Str::slug($request->name, '-');
        $slug= $this->createSlug($request->name);
        
        $input = $request->all();
        $input['slug'] = "$slug";

        //check Editor
        $user = auth()->user();
        if ($user->role == 112 && $user->create == NULL) {
            session()->flash('messageDestroy', 'You are not allowed to create.');
            return redirect('/dashboard/categories');
        }

        Category::create($input);

        session()->flash('message','Data insert successfully');
        return redirect('/dashboard/categories');
    }

    // create diffrent slug
    public function createSlug($title, $id = 0)
    {
        $slug = Str::slug($title);
        $allSlugs = $this->getRelatedSlugs($slug, $id);
        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }

        $i = 1;
        $is_contain = true;
        do {
            $newSlug = $slug . '-' . $i;
            if (!$allSlugs->contains('slug', $newSlug)) {
                $is_contain = false;
                return $newSlug;
            }
            $i++;
        } while ($is_contain);
    }
    protected function getRelatedSlugs($slug, $id = 0)
    {
        return Category::select('slug')->where('slug', 'like', $slug.'%')
        ->where('id', '<>', $id)
        ->get();
    }
    // slug---

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categories = Category::find($id);
        $settingsAdmin = Settings::get()->first();
        $posttypes = Posttype::orderBy('id','DESC')->get();
        $posttypesD = DB::table('posttypes')->select('menu_icon')->distinct()->get();
        return view('admin.categories.show',compact('categories','settingsAdmin','posttypes','posttypesD'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::find($id);
        $settingsAdmin = Settings::get()->first();
        $posttypes = Posttype::orderBy('id','DESC')->get();
        $posttypesD = DB::table('posttypes')->select('menu_icon')->distinct()->get();
        return view('admin.categories.edit',compact('categories','settingsAdmin','posttypes','posttypesD'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //check Editor
        $user = auth()->user();
        if ($user->role == 112 && $user->update == NULL) {
            session()->flash('messageDestroy', 'You are not allowed to update.');
            return redirect('/dashboard/categories');
        }

        $categories = Category::find($id);
        $categories->update($request->all());

        session()->flash('message','Data update successfully');
        return redirect('/dashboard/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //check Editor
        $user = auth()->user();
        if ($user->role == 112 && $user->delete == NULL) {
            session()->flash('messageDestroy', 'You are not allowed to delete.');
            return redirect('/dashboard/categories');
        }
        Category::destroy($id); 
        session()->flash('messageDestroy','Data Delete successfully');
        return redirect('/dashboard/categories');
    }
}
