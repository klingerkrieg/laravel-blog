<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request) {
        return view("post");
    }


    public function list(Request $request){
        return view("posts.list", ["list"=>Post::paginate(3)]);
    }

    public function create(){
        return view("posts.form");
    }

    public function store(Request $request){
        Post::create($request->all());
        return redirect()->back()->with("success","Data saved!");
    }

    public function destroy(Post $post){
        $post->delete();
        return redirect(route("post.list"))->with("success","Data deleted!");
    }

    #abre o formulario de edição
    public function edit(Post $post){
        return view("posts.edit",["item"=>$post]);
    }

    #salva as edições
    public function update(Post $post, Request $request) {
        $post->update($request->all());
        return redirect()->back()->with("success","Data updated!");
    }
    
}
