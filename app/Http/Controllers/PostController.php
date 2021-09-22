<?php

namespace App\Http\Controllers;

use App\Models\Post;  
use App\Models\Parcel;  
use Illuminate\Http\Request;
use Validator;

class PostController extends Controller
{
    const RESULTS_IN_PAGE = 5;
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::orderBy('code', 'ASC')->paginate(self::RESULTS_IN_PAGE)->withQueryString();
        return view('post.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'post_town' => ['required', 'regex:/^([\p{L}]*)$/u', 'min:3', 'max:55'],
            'post_capacity' => ['required','numeric', 'min:1', 'max:255'],
            'post_code' => ['required',  'max:20'],
        ]);
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        $post = new Post;
        
        
        $post->town = mb_convert_case($request->post_town, MB_CASE_TITLE, 'UTF-8');
        $post->capacity = $request->post_capacity;
        $post->code = $request->post_code;
        $post->save();
        return redirect()->route('post.index')->with('success_message', 'Successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('post.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $validator = Validator::make($request->all(),
        [
            'post_town' => ['required', 'regex:/^([\p{L}]*)$/u', 'min:3', 'max:55'],
            'post_capacity' => ['required','numeric', 'min:1', 'max:255'],
            'post_code' => ['required',  'max:20'],
        ]);
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        
        $post->town = mb_convert_case($request->post_town, MB_CASE_TITLE, 'UTF-8');
        $post->capacity = $request->post_capacity;
        $post->code = $request->post_code;
        $post->save();
        return redirect()->route('post.index')->with('success_message', 'Successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->getPercels->count()){
            return redirect()->back()->with('info_message', 'Not allowed, post has members');
        }
        $post->delete();
        return redirect()->route('post.index')->with('success_message', 'Successfully removed.');
    }
}