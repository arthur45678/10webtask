<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use voku\helper\HtmlDomParser;
use voku\helper\SimpleHtmlDom;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(10);
        return view('posts',compact('posts'));

    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('show',compact('post'));
    }



}
