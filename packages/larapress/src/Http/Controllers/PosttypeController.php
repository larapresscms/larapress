<?php

namespace LaraPressCMS\LaraPress\Http\Controllers;

use Illuminate\Http\Request;
use LaraPressCMS\LaraPress\Models\Posttype;
use Illuminate\Support\Str;
use DB;
use LaraPressCMS\LaraPress\Models\Post;
use LaraPressCMS\LaraPress\Models\Category;
use LaraPressCMS\LaraPress\Models\User;
use LaraPressCMS\LaraPress\Models\Media; 
use LaraPressCMS\LaraPress\Models\Settings;

class PosttypeController extends Controller
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
        //insert media library
       $medies = Media::orderBy('id','DESC')->get();
       $posttypes = Posttype::orderBy('id','DESC')->get();
       $settingsAdmin = Settings::get()->first();
       $users = User::get();
       $posttypesD = DB::table('posttypes')->select('menu_icon')->distinct()->get();
       $categories = Category::all();
       return view('admin.posttypes.index',compact('posttypes','settingsAdmin','users','medies','posttypesD','categories')); 
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
       //insert media library
       $medies = Media::orderBy('id','DESC')->get();
       $settingsAdmin = Settings::get()->first();
       $posttypes = Posttype::all();
       $posttypesD = DB::table('posttypes')->select('menu_icon')->distinct()->get();
       $categories = Category::all();
       return view('admin.posttypes.create',compact('settingsAdmin','medies','posttypes','posttypesD','categories'));       

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
           'name' => 'required|min:3', 
           'slug' => 'unique:posts', 
           'status' => 'required',
           'category_id' => '',
           'title'=> '',
           'content'=> '', 
           'excerpt'=> '',
           'thumbnail_path'=> '', 
           'option_1'=> '',
           'option_2'=> '',
           'option_3'=> '',
           'option_4'=> '',
           'more_option_1'=> '',
           'more_option_2'=> '',
           'gallery_img'=> '',
           'trash'=> '',
           'in_menu_swh'=> '',
           'menu_icon'=> '',
           'category_main_id' => '',
           'in_dashboard' => '',
           'pt_content' => '',
           'pt_content_css' => '',
           'pt_thumbnail_path' => '',
           'paginate' => '',
           'template' => ''
       ]);       

       //$slug = Str::slug($request->name, '-');
       $slug= $this->createSlug($request->name);
       
       $input = $request->all();
       $input['slug'] = "$slug";

       //check checkbox is empty
       $input['in_menu_swh'] = $request->in_menu_swh == null ? '0' : '1';
       $input['in_dashboard'] = $request->in_dashboard == null ? '0' : '1';
       $input['template'] = $request->template == 0 || $request->template == 1 || $request->template == null ? 'single' : $request->template;

       Posttype::create($input);

       session()->flash('message','Data insert successfully');
       return redirect('/dashboard/posttypes');
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
       return Posttype::select('slug')->where('slug', 'like', $slug.'%')
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
   public function show($post_type)
   {
       $posts = DB::table('posts')->where('post_type', $post_type)->orderBy('id','DESC')->paginate(15);
       //dd($posts);
       $categories = Category::all();
       $posttypes = Posttype::all();
       $settingsAdmin = Settings::get()->first();
       $users = User::get();
       $medies = Media::orderBy('id','DESC')->get();
       $posttypesD = DB::table('posttypes')->select('menu_icon')->distinct()->get(); 
       return view('admin.posttypes.show',compact('posts','categories','posttypes','settingsAdmin','users','medies','posttypesD'));
   }

    public function searchpost(Request $request)
    {
        $post_type = $request->input('post_type'); // replace with actual post type
        $search = $request->input('search');

        //dd($search);

        $posts = DB::table('posts')
            ->where('post_type', $post_type)
            ->where('status', 1)
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $columns = [
                        'title',
                        'slug',
                        'content',
                        'excerpt',
                        'post_type',
                        'option_1',
                        'option_2',
                        'option_3',
                        'option_4',
                        'more_option_1',
                        'more_option_2',
                    ]; // list all searchable columns
                    foreach ($columns as $column) {
                        $q->orWhere($column, 'like', "%{$search}%");
                    }
                });
            })
            ->orderBy('id', 'DESC')
            ->paginate(15)
            ->appends(['search' => $search]); // keep search term in pagination links

        $categories = Category::all();
        $posttypes = Posttype::all();
        $settingsAdmin = Settings::get()->first();
        $users = User::get();
        $medies = Media::orderBy('id','DESC')->get();
        $posttypesD = DB::table('posttypes')->select('menu_icon')->distinct()->get(); 
        return view('admin.posttypes.show',compact('posts','categories','posttypes','settingsAdmin','users','medies','posttypesD','search'));
    }

   

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function edit($id)
   {
       $posttype = Posttype::find($id);
       $settingsAdmin = Settings::get()->first();
       $medies = Media::orderBy('id','DESC')->get();
       $posttypes = Posttype::all();
       $posttypesD = DB::table('posttypes')->select('menu_icon')->distinct()->get();
       $categories = Category::all();
       return view('admin.posttypes.edit',compact('posttype','settingsAdmin','medies','posttypes','posttypesD','categories'));
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

    //dd($request->template);
       $posttypes = Posttype::findOrFail($id); 

       $input = $request->all();
       //check checkbox is empty
       $input['in_menu_swh'] = $request->in_menu_swh == null ? '0' : '1';
       $input['in_dashboard'] = $request->in_dashboard == null ? '0' : '1';
       $input['template'] = $request->template == 0 || $request->template == 1 || $request->template == null ? 'single' : $request->template;

    if($request->template !== NULL){
        if($request->template_force){
        //update all post template
        // If template switch is ON → use given template, else use 'single'
            $templateValue = $request->filled('template') ? $request->template : 'single';
            $input['template'] = $templateValue;
            // ✅ Update only related posts with matching post_type
            Post::where('post_type', $posttypes->slug)->update([
                'template' => $templateValue
            ]);
        }
    }

       $posttypes->update($input);

       session()->flash('message','Data update successfully');
       return redirect()->back();
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy($id)
   {   
        $user = auth()->user();
        if ($user->role == 112 && $user->delete == NULL) {
            session()->flash('messageDestroy', 'You are not allowed to delete.');
            return redirect('/dashboard/posttypes/');
        } 
    
       $posttype = Posttype::where('id',$id)->first();
       Post::where('post_type', $posttype->slug)->delete();

       Posttype::destroy($id); 
       session()->flash('messageDestroy','All Delete successfully');
       return redirect('/dashboard/posttypes');
   }
   
   //underposttype-------------
   public function createppost($post_type)
    {
        $posttypeSlug = Posttype::where('slug', $post_type)->first();     
        //insert media library
        $medies = Media::orderBy('id','DESC')->limit(12)->get();
        //insert category and user 
        $categories = Category::all();
        $settingsAdmin = Settings::get()->first(); 
        $posttypes = Posttype::orderBy('id','DESC')->get();
        //get posttype table cat
        $post_ids = Post::where('post_type', $post_type)->get()->map(function ($post) {
            return explode(',', $post->category_id);
        });         
        $specificCatOnly = Category::whereIn('id', $post_ids->flatten())->get();  

        $posttypesD = DB::table('posttypes')->select('menu_icon')->distinct()->get();
        return view('admin.posttypes.underposttype.createppost',compact('categories','medies','settingsAdmin','posttypeSlug','posttypes','posttypesD','specificCatOnly'));        

    }
    public function storeposttype(Request $request)
    { 
        
        $validated = $request->validate([            
            'user_id' => '',
            'position' => 'nullable',
            'category_id' => 'nullable',
            'title' => 'required',
            'slug' => 'unique:posts',
            'content' => 'nullable',
            'excerpt' => 'nullable',
            'thumbnail_path' => 'nullable',
            'post_type' => 'nullable',
            'option_1' => 'nullable',
            'option_2' => 'nullable',
            'option_3' => 'nullable',
            'option_4' => 'nullable',
            'more_option_1' => 'nullable',
            'more_option_2' => 'nullable',
            'gallery_img'   => 'nullable',
            'status' => '',
            'template' => ''
        ]); 

        $validated = $request->all();

        // set default template 
        //$validated['template'] = 'single';

        //check Editor
        $user = auth()->user();
        if ($user->role == 112 && $user->create == NULL) {
            session()->flash('messageDestroy', 'You are not allowed to create.');            
            return redirect('/dashboard/posttypes/'.$request->post_type);
        } 

        $category_id = isset($request->category_id) && is_array($request->category_id) ? $request->category_id : [];
        $validated['category_id'] = implode(",",$category_id); 

        //$slug = Str::slug($request->name, '-');
       $slug = $this->createSlugPost($request->title);
       $validated['slug'] = "$slug";         

        $gallery_img = isset($request->gallery_img) && is_array($request->gallery_img) ? $request->gallery_img : [];
        $validated['gallery_img'] = implode(",",$gallery_img); 

        //create category
        if($request->categori_name != NULL )
        {
            $slug = $this->createSlugCat($request->categori_name);
            $data = [
                'name' =>$request->categori_name,
                'slug' => $slug ,
                'status' => 1
            ];
            $this_cat = Category::create($data);
            $validated['category_id'] = $validated['category_id'].','.$this_cat->id;
        }

        //$validated['gallery_img'] = implode(",",$request->gallery_img);      
        $this_post = Post::create($validated);
        
        //return $this_post->id;

        //when editor new post they will access this page
        if(auth()->user()->role == 112){ 
            $user = User::find($request->user_id);               
            $input['posts_id'] = $user->posts_id.','.$this_post->id;            
            $data = [
                'posts_id' => $input['posts_id'] 
            ];
            $user->update($data);
        }

        //insertDummyData('shahin55',5);

        /* Store $imageName name in DATABASE from HERE */
        session()->flash('message',$request->post_type.' insert successfully');
        return redirect('/dashboard/posttypes/'.$request->post_type);
    }

    // create diffrent slug post
   public function createSlugPost($title, $id = 0)
   {
       $slug = Str::slug($title);
       $allSlugs = $this->getRelatedSlugsPost($slug, $id);
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
   protected function getRelatedSlugsPost($slug, $id = 0)
   {
       return Post::select('slug')->where('slug', 'like', $slug.'%')
       ->where('id', '<>', $id)
       ->get();
   }
   // slug---
    public function editppost($id, $post_type)
    {
        $posttypeSlug = Posttype::where('slug', $post_type)->first();  
        $posts = Post::find($id);
        $categories = Category::all(); //show all category from db    
        $users = User::all();
        //insert media library
        $medies = Media::orderBy('id','DESC')->limit(12)->get();
        $settingsAdmin = Settings::get()->first();
        $posttypes = Posttype::all();

       // $allPostOnlyType = Post::where('post_type', $post_type)->get(); 

        $post_ids = Post::where('post_type', $post_type)->get()->map(function ($post) {
            return explode(',', $post->category_id);
        });         
        $specificCatOnly = Category::whereIn('id', $post_ids->flatten())->get();        


        $posttypesD = DB::table('posttypes')->select('menu_icon')->distinct()->get();
        return view('admin.posttypes.underposttype.editunderposttype',compact('posts','categories','medies','posttypes','settingsAdmin','posttypeSlug','specificCatOnly','posttypesD','users'));
    }
    
    public function updateppost(Request $request, $id)
    {    
        $posts = Post::find($id);
        $postsAll = $request->all();
        //gallery validation
        $gallery_img = isset($request->gallery_img) && is_array($request->gallery_img) ? $request->gallery_img : [];
        $postsAll['gallery_img'] = implode(",",$gallery_img); 

        $category_id = isset($request->category_id) && is_array($request->category_id) ? $request->category_id : [];
        $postsAll['category_id'] = implode(",",$category_id); 

        //create category
        if($request->categori_name != NULL )
        {
            $slug = $this->createSlugCat($request->categori_name);
            $data = [
                'name' =>$request->categori_name,
                'slug' => $slug ,
                'status' => 1
            ];
            $this_cat = Category::create($data);
            $postsAll['category_id'] = $postsAll['category_id'].','.$this_cat->id;
        }
        //check Editor
        $user = auth()->user();
        if ($user->role == 112 && $user->update == NULL) {
            session()->flash('messageDestroy', 'You are not allowed to update.');            
            return redirect('/dashboard/posts/posttype/'.$id.'/edit/'.$request->post_type); 
        } 

        $posts->update($postsAll);
        //session()->flash('message',$request->post_type.' update successfully');  
        return redirect()->back()->with('message','Update successfully!');
        //return redirect('/dashboard/posts/posttype/'.$id.'/edit/'.$request->post_type); 
    }

    // create diffrent cat slug
    public function createSlugCat($title, $id = 0)
    {
        $slug = Str::slug($title);
        $allSlugs = $this->getRelatedSlugsCat($slug, $id);
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
    protected function getRelatedSlugsCat($slug, $id = 0)
    {
        return Category::select('slug')->where('slug', 'like', $slug.'%')
        ->where('id', '<>', $id)
        ->get();
    }
    // slug---

    public function destroyppost(Request $request, $id)
    {
        // Check if user has role 112
        $user = auth()->user();
        if ($user->role == 112 && $user->delete == NULL) {
            session()->flash('messageDestroy', 'You are not allowed to delete.');
            return redirect('/dashboard/posttypes/'.$request->post_type);
        }

        Post::destroy($id); 
        session()->flash('messageDestroy',$request->post_type.' delete successfully');
        return redirect('/dashboard/posttypes/'.$request->post_type);
    }

    //bulkAction--------------
     public function bulkAction(Request $request)
    {
        //dd($request->all());

        $ids = $request->ids ?? [];
        $action = $request->action;        
        $old_type = $request->old_type;        
        $new_type = $request->new_type;
        // $user_id = $request->user_id;
        $user = auth()->user();
        

        if (empty($ids)) {
            return back()->with('messageDestroy', 'No '.$old_type.' selected.');
        }

        switch ($action) {
            case 'delete':
                DB::table('posts')->whereIn('id', $ids)->delete();
                return back()->with('messageDestroy', 'Selected '.$old_type.' deleted.');
            case 'publish':
                DB::table('posts')->whereIn('id', $ids)->update(['status' => '1','user_id'=> $user->id]);
                return back()->with('message', 'Selected '.$old_type.' published.');
            case 'unpublish':
                DB::table('posts')->whereIn('id', $ids)->update(['status' => '0','user_id'=> $user->id]);
                return back()->with('messageDestroy', 'Selected '.$old_type.' unpublished.');
            case 'change_type':
                DB::table('posts')->whereIn('id', $ids)->update(['post_type' => $new_type,'user_id'=> $user->id]);
                return back()->with('message', '<a href="'.url('/dashboard/posttypes',$new_type).'">Selected '.$old_type.' move to '.$new_type.' <i class="fa fa-arrow-right" aria-hidden="true"></i></a>');            
            default:
                return back()->with('messageDestroy', 'Invalid action.');
        }
    }
    public function duplicatePosttype($id){
        // Find the original post
        $originalPost = Posttype::findOrFail($id);
        // Create a new post instance with the original post's attributes
        $newPost = $originalPost->replicate(); // replicate() copies all attributes except the primary key
        $newPost->name = $originalPost->name . ' (Copy)'; // Optional: change the title
        $newPost->slug = $originalPost->slug . 'copy'; // Optional: change the title
        $newPost->save();
        return redirect()->back()->with('success', 'Post duplicated successfully!');
    }
   
}
