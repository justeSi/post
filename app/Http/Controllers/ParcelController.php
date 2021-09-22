<?php

namespace App\Http\Controllers;

use App\Models\Parcel;
use App\Models\Post;
use Illuminate\Http\Request;
use Validator;

class ParcelController extends Controller
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
        $parcels = Parcel::orderBy('weight', 'DESC')->paginate(self::RESULTS_IN_PAGE)->withQueryString();
        $posts = Post::orderBy('code', 'ASC')->get();
        if ($request->filter && 'post' == $request->filter) {
            $parcels = Parcel::where('post_id', $request->post_id)->paginate(self::RESULTS_IN_PAGE)->withQueryString();
        }
        return view('parcel.index', ['parcels' => $parcels, 'posts' => $posts, 'post_id' => $request->post_id ?? '0']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $posts = Post::orderBy('town')->get();
        return view('parcel.create', ['posts' => $posts]);
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
            
            'parcel_weight' => ['required', 'numeric'],
            'parcel_phone' => ['required', 'min:12', 'max:12'],
            'parcel_info' => ['required', 'max:400'],
            'post_id' => ['required', 'integer', 'min:1'],
        ]);
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        $parcel = new Parcel;
        
        
        
        $parcel->weight = $request->parcel_weight;
        $parcel->phone = $request->parcel_phone;
        $parcel->info = $request->parcel_info;
        $parcel->post_id = $request->post_id;

        $posts = Post::all();
        foreach ($posts as $post) {
            if ($post->id == $request->post_id) {
                if ($post->getParcels->count() == 20) {
                    return redirect()->back()->with('info_message', 'This post have no space');
                }
                else {
                    $parcel->save();
                    return redirect()->route('parcel.index')->with('success_message', 'Successfully created.');
                }
                
            }     
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Parcel  $parcel
     * @return \Illuminate\Http\Response
     */
    public function show(Parcel $parcel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Parcel  $parcel
     * @return \Illuminate\Http\Response
     */
    public function edit(Parcel $parcel)
    {
        $posts = Post::all();
        return view('parcel.edit', ['parcel' => $parcel, 'posts' => $posts]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Parcel  $parcel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Parcel $parcel)
    {   
        $validator = Validator::make($request->all(),
        [
            
            'parcel_weight' => ['required', 'numeric'],
            'parcel_phone' => ['required', 'min:12', 'max:12'],
            'parcel_info' => ['required', 'max:400'],
            'post_id' => ['required', 'integer', 'min:1'],
        ]);
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        $parcel->weight = $request->parcel_weight;
        $parcel->phone = $request->parcel_phone;
        $parcel->info = $request->parcel_info;
        $parcel->post_id = $request->post_id;
        
        $posts = Post::all();
        foreach ($posts as $post) {
            if ($post->id == $request->post_id) {
                if ($post->getParcels->count() == 20) {
                    return redirect()->back()->with('info_message', 'This post have no space');
                }
                else {
                    $parcel->save();
                    return redirect()->route('parcel.index')->with('success_message', 'Successfully updated.');
                }
                
            }     
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Parcel  $parcel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parcel $parcel)
    {
        $parcel->delete();
        return redirect()->route('parcel.index')->with('success_message', 'Successfully removed.');
    }
}