<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request) {
        return view("post");
    }


    public function list(Request $request){

        $pagination = Post::orderBy("subject");

        if (isset($request->subject))
            $pagination->where("subject","like","%$request->subject%");
        if (isset($request->text))
            $pagination->where("text","like","%$request->text%");
        if (isset($request->publish_date)) 
            $pagination->whereDate("publish_date",$request->publish_date);

        #$pagination->dd();
        #$pagination->dump();
        return view("posts.list", ["list"=>$pagination->paginate(3)]);
    }

    #cria o obj item vazio
    public function create(){
        return view("posts.form", ["item"=>new Post()]);
    }

    #abre o formulario de edição
    public function edit(Post $post){
        return view("posts.form",["item"=>$post]);
    }

    public function store(PostRequest $request){
        $validated = $request->validated();
        $path = $request->file('image')->store('posts',"public");

        $validated["image"] = $path;

        $post = Post::create($validated);
        return redirect(route("post.edit",$post))->with("success","Data saved!");
    }

    public function destroy(Post $post){
        $post->delete();
        return redirect(route("post.list"))->with("success","Data deleted!");
    }

    

    #salva as edições
    public function update(Post $post, PostRequest $request) {
        $validated = $request->validated();
        #necessário, pois não é obrigatório atualizar a imagem
        if ($request->file('image') != null){
            $path = $request->file('image')->store('posts',"public");
            $validated["image"] = $path;
        }

        $post->update($validated);
        return redirect()->back()->with("success","Data updated!");
    }
    
}
