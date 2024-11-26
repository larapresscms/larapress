<?php
namespace LaraPressCMS\LaraPress\Http\Controllers; 
use Illuminate\Http\Request;
use LaraPressCMS\LaraPress\Models\Category;
use Illuminate\Support\Str;
use LaraPressCMS\LaraPress\Models\Settings;
use LaraPressCMS\LaraPress\Models\Posttype;
use LaraPressCMS\LaraPress\Models\Menu;
use LaraPressCMS\LaraPress\Models\Post;
use LaraPressCMS\LaraPress\Models\Page;
use LaraPressCMS\LaraPress\Models\User;
use DB;

class MenuController extends Controller
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
        $menus = Menu::all();
        $users = User::all();
        $categories = Category::all();
        $settingsAdmin = Settings::get()->first();
        $posttypes = Posttype::orderBy('id','DESC')->get();
        $posttypesD = DB::table('posttypes')->select('menu_icon')->distinct()->get();

        return view('admin.menu.index',compact('categories','settingsAdmin','posttypes','posttypesD','menus','users')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $posts = Post::all(); 
        $users = User::all();
        $settingsAdmin = Settings::get()->first();
        $posttypes = Posttype::orderBy('id','DESC')->get();
        $posttypesD = DB::table('posttypes')->select('menu_icon')->distinct()->get();
        $categories = Category::all();
        $menus = Menu::orderBy('position','ASC')->orderBy('created_at','ASC')->get();
        return view('admin.menu.create',compact('settingsAdmin','posttypes','posttypesD','categories','menus','posts','users'));        

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
            'user_id' => '', 
            'category_id' => '',
            'position' => '',
            'sub_menu_id' => '',
            'title' => 'required',    
            'status' => '',
            'url' => '',
            'target' => ''
        ]); 

        //check Editor
        $user = auth()->user();
        if ($user->role == 112 && $user->create == NULL) {
            session()->flash('messageDestroy', 'You are not allowed to create.');            
            return redirect('/dashboard/menu/create');
        } 

        $menu_id = Menu::create($validated);
        session()->flash('message'.$menu_id->id,'success');  

        session()->flash('message','Data insert successfully');
        return redirect('/dashboard/menu/create');
    } 

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menu = Menu::find($id);
        $categories = Category::all();
        $users = User::all();
        $menus = Menu::all();
        $settingsAdmin = Settings::get()->first();
        $posttypes = Posttype::orderBy('id','DESC')->get();
        $posttypesD = DB::table('posttypes')->select('menu_icon')->distinct()->get();
        return view('admin.menu.show',compact('categories','settingsAdmin','posttypes','posttypesD','menu','menus','users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posts = Post::all();
        $menu = Menu::find($id);
        $menus = Menu::orderBy('position','ASC')->orderBy('created_at','ASC')->get();
        $users = User::all();
        $categories = Category::all();;
        $settingsAdmin = Settings::get()->first();
        $posttypes = Posttype::orderBy('id','DESC')->get();
        $posttypesD = DB::table('posttypes')->select('menu_icon')->distinct()->get();
        return view('admin.menu.edit',compact('categories','settingsAdmin','posttypes','posttypesD','menu','menus','posts','users'));
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
            return redirect('/dashboard/menu/'.$id.'/edit/');
        }

        $categories = Menu::find($id);
        $categories->update($request->all());

        session()->flash('message'.$categories->id,'success'); 
        session()->flash('message','Data update successfully');
        return redirect('/dashboard/menu/'.$id.'/edit/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Menu::destroy($id); 
        //submenu position
        $menu_all = $request->all();
        $fMenu_id = Menu::where('sub_menu_id', $id)->get();
        foreach($fMenu_id as $menu){
            $submenu_id = Menu::find($menu->id);
            $submenu_id['sub_menu_id'] = 0;            
            $submenu_id->update($menu_all);
        }

        session()->flash('messageDestroy','Data Delete successfully');
        return redirect('/dashboard/menu/create');
    }
}
