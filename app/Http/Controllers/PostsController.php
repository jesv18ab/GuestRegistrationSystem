<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use test\Mockery\Adapter\Phpunit\MockeryPHPUnitIntegrationTest;
use App\Post;



class PostsController extends Controller
{
    public function show($slug){
     //   $post = Post::where('slug', $slug)->first();
        return view('post', ['post' => Post::where('slug', $slug)->firstOrFail()]);
    }
}
