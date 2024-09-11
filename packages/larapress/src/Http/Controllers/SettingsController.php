<?php

namespace LaraPressCMS\LaraPress\Http\Controllers;

use Illuminate\Http\Request;
use LaraPressCMS\LaraPress\Models\Post;
use LaraPressCMS\LaraPress\Models\Settings;
use LaraPressCMS\LaraPress\Models\Media;
use LaraPressCMS\LaraPress\Models\Posttype;
use DB;

class SettingsController extends Controller
{
    //settings
    public function index()
    {         
        $settings = Settings::all();
        $settingsAdmin = Settings::get()->first();
        $posttypes = Posttype::orderBy('id','DESC')->get();
        $posttypesD = DB::table('posttypes')->select('menu_icon')->distinct()->get();
        return view('admin.settings.index',compact('settings','settingsAdmin','posttypes','posttypesD'));
    }

    public function create()
    {
        $medies = Media::orderBy('id','DESC')->get();
        $settingsAdmin = Settings::get()->first();
        $posts = Post::all();
        $posttypes = Posttype::orderBy('id','DESC')->get();
        $posttypesD = DB::table('posttypes')->select('menu_icon')->distinct()->get();
        return view('admin.settings.create',compact('medies','settingsAdmin','posts','posttypes','posttypesD'));
    }

    /**  temporary depreceted trun off
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'site_title' => '', 
            'sub_title' => '', 
            'fav_icon' => '', 
            'site_logo' => '', 
            'dashboard_color' => '', 
            'text_color' => '', 
            'text_hover' => '', 
            'theme_url' => '',
            'home_url' => '',
            'editor' => '',
            'header' => '',
            'footer' => '',
        ]);
        Settings::create($validated);
        session()->flash('message','Home page set successfully');
        return redirect('/dashboard/settings/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $settings = Settings::find($id);
        $medies = Media::orderBy('id','DESC')->get();
        $settingsAdmin = Settings::get()->first();
        $posts = Post::all();
        $posttypes = Posttype::orderBy('id','DESC')->get();
        $posttypesD = DB::table('posttypes')->select('menu_icon')->distinct()->get();
        return view('admin.settings.edit',compact('settings','medies','settingsAdmin','posts','posttypes','posttypesD'));
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
        $Settings = Settings::find($id);
        $Settings->update($request->all());

        session()->flash('message','Data update successfully');
        return redirect('/dashboard/settings');
    }

    /**
     * temporary depreceted
     */
    // public function destroy($id)
    // {
    //     Settings::destroy($id); 
    //     session()->flash('messageDestroy','Data Delete successfully');
    //     return redirect('/dashboard/settings');
    // }
}
