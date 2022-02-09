<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryPost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(Request $request) {
        return view("category");
    }

    public function list(Request $request){

        $pagination = Category::orderBy("name");
        
        if (isset($request->search))
            $pagination->where("name","like","%$request->search%");
        
        
        #$pagination->dd();
        #$pagination->dump();
        return view("categories.list", ["list"=>$pagination->paginate(3)]);
    }

    #cria o obj item vazio
    public function create(){
        $postsList = Post::all();
        return view("categories.form", ["item"=>new Category(),
                                        "postsList"=>$postsList]);
    }

    #abre o formulario de edição
    public function edit(Category $category){
        $postsList = Post::all();

        $posts = Post::join("category_posts","category_posts.post_id","=","posts.id")
                    ->where("category_id",$category->id)->paginate(2);
        return view("categories.form",["item"=>$category, 
                                        "postsList"=>$postsList, "posts"=>$posts]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'    => 'required|string|max:255',
            'post_id' => 'exclude_if:post_id,null|exists:posts,id',
        ]);
    }

    public function store(Request $request){
        $this->validator($request->all())->validate();
        
        $data = $request->all();
        $Category = Category::create($data);
        return redirect(route("category.edit",$Category))->with("success","Data saved!");
    }

    public function destroy(Category $category){
        $category->delete();
        return redirect(route("category.list"))->with("success","Data deleted!");
    }

    

    #salva as edições
    public function update(Category $category, Request $request) {
        $this->validator($request->all())->validate();
        $data = $request->all();
        $category->update($data);

        $post = Post::find($request["post_id"]);
        if ($post != null){
            #na documentação consta esse método
            #funciona, mas não insere os timestamps
            #$category->posts()->attach($post);
            CategoryPost::create(["post_id"=>$post->id,"category_id"=>$category->id]);
        }

        return redirect()->back()->with("success","Data updated!");
    }
    
}
