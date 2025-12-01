<?php

use LaraPressCMS\LaraPress\Models\Post;
use LaraPressCMS\LaraPress\Models\Posttype;
use LaraPressCMS\LaraPress\Models\Settings;
use LaraPressCMS\LaraPress\Models\Menu;
use LaraPressCMS\LaraPress\Models\Media;

//post data
if (!function_exists('insertDummyData')) {
    /**
     * Get the content of a post by its slug.
     *
     * @param string $slug
     * @return string
     */
    function insertDummyData($post_type_name = 'Posts' , $numberOfPost = 0, $Post_title = 'Dummy Post', $post_content = '')
    {     
        $slug = Str::slug($post_type_name);
        $posttype = Posttype::select('slug')->where('slug', $slug)->first();
        if($posttype){
            return; // 'Post Type already exist. Please try another name.';
        }else{
            $slug = createSlug($post_type_name, 0, Posttype::class);
            $posttype = Posttype::create([
            'user_id' => 1,
            'name' => $post_type_name,  
            'slug' => $slug,
            'status' => 1, 
            'title'=> 'Title',
            'content'=> 'Content', 
            'excerpt'=> 'Excerpt',
            'thumbnail_path'=> 'Thumbnail', 
            'option_1'=> 'Optional Field',
            'option_2'=> 'Optional Field',
            'option_3'=> 'Optional Field',
            'option_4'=> 'Optional Field',
            'more_option_1'=> 'Optional Field',
            'more_option_2'=> 'Optional Field',
            'gallery_img'=> 'Gallery',
            'category_main_id' => 0,
            'category_id' => 'Categories',
            'in_menu_swh' => 1,
            'in_dashboard' => 0,

            ]);      

            for($i = 1; $i <= $numberOfPost; $i++){
                $slug = createSlug($Post_title, 0, Post::class);
                Post::create([
                    'title' => $Post_title,
                    'slug' => $slug,
                    'user_id' => '1',
                    'content' => $post_content,
                    'post_type' => $posttype->slug,
                    'status' => 1, 
                    'template' => 'single',
                ]);
            };             
        }        

        return;
    }
}

// create diffrent slug
function createSlug($title, $id = 0, $model)
{
    $slug = Str::slug($title);
    $allSlugs = getRelatedSlugs($slug, $id, $model);    
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
function getRelatedSlugs($slug, $id = 0, $model)
{
    return $model::select('slug')->where('slug', 'like', $slug.'%')
    ->where('id', '<>', $id)
    ->get();
}
// slug---
//get post type post
if (!function_exists('getPostsByType')) {
    /**
     * Get the content of a post by its slug.
     *
     * @param string $slug
     * @return string
     */
    function getPostsByType($post_type)
    {
        $posttype = Posttype::where('slug',$post_type)->first();
        // Ensure the Post model is imported or use the fully qualified class name
        //$post = Post::where('post_type', $post_type)->where('status', 1)->get();
        $post = Post::orderBy('position','ASC')->where('status','1')->where('post_type',$post_type)->paginate($posttype->paginate);
        return $post ? $post : '';
    }
}
//get setting
if (!function_exists('getSetting')) {
    /**
     * Get the content of a post by its slug.
     *
     * @param string $slug
     * @return string
     */
    function getSetting($name)
    {
        // Ensure the Post model is imported or use the fully qualified class name
        $setting = Settings::get()->first();
        return $setting ? $setting->$name : '';
    }
}
//get menu
if (!function_exists('getMenus')) {
    /**
     * Get the content of a post by its slug.
     *
     * @param string $slug
     * @return string
     */
    function getMenus()
    {
        // Ensure the Post model is imported or use the fully qualified class name
        $menu = Menu::where('status', 1)->get();
        return $menu ? $menu : '';
    }
}
if (!function_exists('getContentBySlug')) {
    /**
     * Get the content of a post by its slug.
     *
     * @param string $slug
     * @return string
     */
    function getContentBySlug($slug)
    {
        // Ensure the Post model is imported or use the fully qualified class name
        $post = Post::where('slug', $slug)->where('status', 1)->first();
        return $post ? $post : '';
    }
}

if (!function_exists('getPostTypeBySlug')) {
    /**
     * Get the content of a post by its slug.
     *
     * @param string $slug
     * @return string
     */
    function getPostTypeBySlug($slug)
    {
        // Ensure the Post model is imported or use the fully qualified class name
        
        $posttype = Posttype::where('slug',$slug)->where('status', 1)->first(); 
        return $posttype ? $posttype : '';
    }
}
//get gallery by post
if (!function_exists('getGalleryBySlug')) {
    /**
     * Get the content of a post by its slug.
     *
     * @param string $slug
     * @return string
     */
    function getGalleryBySlug($slug)
    {         
        $post = Post::where('slug', $slug)->where('status', 1)->first();
        if (!$post || empty($post->gallery_img)) {
            return [];
        }
        $paths = explode(",", $post->gallery_img);
        // Media model assumed -> columns: path, caption
        $mediaItems = Media::whereIn('img_name', $paths)->get()->keyBy('img_name');   
        $result = [];
        foreach ($paths as $path) {
            $result[] = [
                'path' => $path,
                'caption' => $mediaItems[$path]->caption ?? '' // null safe
            ];
        }
        return $result;
    }
}
// End Helper Function 