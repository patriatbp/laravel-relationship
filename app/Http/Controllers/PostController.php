<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Post;
use App\Tag;
use Auth;


class PostController extends Controller
{

    public function __construct(){
        $this->middleware('auth')->only(['create', 'store', 'delete','edit','show', 'update']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        
        $post = $user->posts;
        return view('post.index', compact('post'));
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
        $this->validate($request, [
            'title'=>'required',
            'body'=>'required'
        ]);

        //explode untuk mengubah request tags menjadi array
        $tags_arr = explode(',', $request["tags"]);
        
        // looping ke array tags tadi
        // setiap looping lakukan pengecekan apakah sudah ada tags
        // kalo sudah ada ambil id nya
        // kalo belum ada simpan tags, lalu ambil idnya
        // buat array penampung

        $tag_ids = [];
        foreach($tags_arr as $tag_name){
            $tag = Tag::firstOrCreate(["tag_name" => $tag_name]);

            $tag_ids[] = $tag->id;
            // if($tag){
            //     $tag_ids[] = $tag->id;
            // }else{
            //     $row_tag = Tag::create(["tag_name" => $tag_name]);
            //     $tag_ids[] = $row_tag->id;
            // }
        }
    
        $post = Post::create([
            "title"=>$request["title"],
            "body"=>$request["body"],           
            "user_id" => Auth::id()
        ]);

        $post->tags()->sync($tag_ids);

        // $user = Auth::user();
        // $user->posts()->associate($post);

        // $user->save();

        // $user = Auth::id();
        // $user->post()->save($post);
        // $post = $user->posts()->create([
        //     "title"=>$request["title"],
        //     "body"=>$request["body"]    
        // ]);


        return redirect('/post');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        // $data_tag = [];
        // foreach($post->tags as $tag){
        // echo  $tag->tag_name." ";
        // }
        
        // dd($data_tag);
        return view('post.edit', compact('post'));
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
        $request->validate([
            'title'=>'required',
            'body'=>'required'
        ]);

        $tags_arr = explode(',', $request["tags"]);

        $tag_ids = [];
        foreach($tags_arr as $tag_name){
            $tag = Tag::firstOrCreate(["tag_name" => $tag_name]);
            $tag_ids[] = $tag->id;

        }

        $post = Post::find($id);
        $post->title = $request->title;
        $post->body = $request->body;
        $post->update();
        $post->tags()->sync($tag_ids);

        return redirect('/post');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect('/post');
    }
}
