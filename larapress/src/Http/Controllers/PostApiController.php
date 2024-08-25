<?php

namespace LaraPressCMS\LaraPress\Http\Controllers;

use LaraPressCMS\LaraPress\Models\Post;
use Illuminate\Http\Request;

class PostApiController extends Controller
{
    public function index()
    {
        return Post::all();
    }

    public function store()
    {
        $validate = request()->validate([
            'user_id'       => '',
            'category_id'   => '',
            'title'         => 'required',
            'content'       => '',
            'excerpt'       => '',
            'thumbnail_path' => '',
            'status'        => '', 
        ]);

        return Post::create(
            [
                'user_id'       => request('user_id'),
                'category_id'   => request('category_id'),
                'title'         => request('title'),
                'content'       => request('content'),
                'excerpt'       => request('excerpt'),
                'thumbnail_path' => request('thumbnail_path'),
                'status'        => request('status'),
            ]
        );
    }

    public function update(Post $post)
    {
        $validate = request()->validate([
            'user_id'       => '',
            'category_id'   => '',
            'title'         => 'required',
            'content'       => '',
            'excerpt'       => '',
            'thumbnail_path' => '',
            'status'        => '',
        ]);

        $success = $post->update($validate);

        return [
            'success' => $success
        ];
    }

    public function destroy(Post $post)
    {
        $success = $post->delete();

        return [
            'success' => $success
        ];
    }

    public function versionControll()
    {
       // return response()->json(['status' => 'success']);
        return [
            'success' => 'success'
        ];
    }
}