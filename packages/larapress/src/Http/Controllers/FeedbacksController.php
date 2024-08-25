<?php

namespace LaraPressCMS\LaraPress\Http\Controllers;

use Illuminate\Http\Request;
use LaraPressCMS\LaraPress\Models\Feedback;
use Illuminate\Support\Str;
use LaraPressCMS\LaraPress\Models\Settings; 
use LaraPressCMS\LaraPress\Models\Posttype;
use DB;

class FeedbacksController extends Controller
{
    //--login system
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $feedbacks = Feedback::all();
        $settingsAdmin = Settings::get()->first();
        $posttypes = Posttype::orderBy('id','DESC')->get();
        $posttypesD = DB::table('posttypes')->select('menu_icon')->distinct()->get();
        return view('admin.feedbacks.index',compact('feedbacks','settingsAdmin','posttypes','posttypesD')); 
    }

    
    public function show($id)
    {
        $categories = Feedback::find($id);
        $settingsAdmin = Settings::get()->first();
        $posttypes = Posttype::orderBy('id','DESC')->get();
        $posttypesD = DB::table('posttypes')->select('menu_icon')->distinct()->get();
        return view('admin.categories.show',compact('categories','settingsAdmin','posttypes','posttypesD'));
    }

    public function destroy($id)
    {
        Feedback::destroy($id); 
        session()->flash('messageDestroy','Data Delete successfully');
        return redirect('/dashboard/feedbacks');
    }
}
