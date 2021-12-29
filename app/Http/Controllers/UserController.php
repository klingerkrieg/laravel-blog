<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request) {
        return view("User");
    }


    public function list(Request $request){

        $pagination = User::orderBy("name");
        
        if (isset($request->search))
            $pagination->where("name","like","%$request->search%");
        
        
        #$pagination->dd();
        #$pagination->dump();
        return view("users.list", ["list"=>$pagination->paginate(3)]);
    }

    #cria o obj item vazio
    public function create(){
        return view("users.form", ["item"=>new User()]);
    }

    #abre o formulario de edição
    public function edit(User $user){
        $posts = Post::where("user_id",$user->id)->paginate(2);
        return view("users.form",["item"=>$user,"posts"=>$posts]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            #'name' => ['required', 'string', 'max:255'],
            #'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            #'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function store(Request $request){
        $this->validator($request->all())->validate();
        
        $data = $request->all();
        $User = User::create($data);
        return redirect(route("user.edit",$User))->with("success","Data saved!");
    }

    public function destroy(User $user){
        $user->delete();
        return redirect(route("user.list"))->with("success","Data deleted!");
    }

    

    #salva as edições
    public function update(User $User, Request $request) {
        $this->validator($request->all())->validate();
        $data = $request->all();
        $User->update($data);
        return redirect()->back()->with("success","Data updated!");
    }
    
}
