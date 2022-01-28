<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function index(Request $request) {
        #Gate::authorize('viewAny', Post::class);
        return view("post");
    }


    public function list(Request $request){
        #Gate::authorize('viewAny', Post::class);

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
        #Gate::authorize('create', Post::class);
        return view("posts.form", ["data"=>new Post()]);
    }

    #abre o formulario de edição
    public function edit(Post $post){
        #Gate::authorize('view', $post);
        return view("posts.form",["data"=>$post]);
    }

    public function store(PostRequest $request){
        #Gate::authorize('create', Post::class);
        $validated = $request->validated();
        $path = $request->file('image')->store('posts',"public");

        $data = $request->all();
        $data["image"] = $path;
        $data["user_id"] = Auth::user()->id;

        $post = Post::create($data);
        return redirect(route("post.edit",$post))->with("success","Data saved!");
    }

    public function destroy(Post $post){
        #Gate::authorize('delete', $post);
        $post->delete();
        return redirect(route("post.list"))->with("success","Data deleted!");
    }

    

    #salva as edições
    public function update(Post $post, PostRequest $request) {
        #Gate::authorize('update', $post);

        $validated = $request->validated();
        
        $data = $request->all();
        #necessário, pois não é obrigatório atualizar a imagem
        if ($request->file('image') != null){
            $path = $request->file('image')->store('posts',"public");
            $data["image"] = $path;
        }

        $post->update($data);
        return redirect()->back()->with("success","Data updated!");
    }
    
}
