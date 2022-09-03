<?php

namespace App\Http\Controllers\Interno;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    public function index(Request $request) {
        #Gate::authorize('viewAny', Product::class);
        return view("interno.product");
    }


    public function list(Request $request){
        #Gate::authorize('viewAny', Product::class);

        $pagination = Product::orderBy("name");

        if (isset($request->name))
            $pagination->where("name","like","%$request->name%");
        if (isset($request->text))
            $pagination->where("text","like","%$request->text%");
        if (isset($request->publish_date)) 
            $pagination->whereDate("publish_date",$request->publish_date);

        #$pagination->dd();
        #$pagination->dump();
        return view("products.list", ["list"=>$pagination->paginate(3)]);
    }

    #cria o obj item vazio
    public function create(){
        #Gate::authorize('create', Product::class);
        return view("products.form", ["data"=>new Product()]);
    }

    #abre o formulario de edição
    public function edit(Product $product){
        #Gate::authorize('view', $product);
        return view("products.form",["data"=>$product]);
    }

    public function store(ProductRequest $request){
        #Gate::authorize('create', Product::class);
        $validated = $request->validated();
        $path = $request->file('image')->store('products',"public");

        $data = $request->all();
        $data["image"] = $path;
        $data["user_id"] = Auth::user()->id;

        $product = Product::create($data);
        return redirect(route("product.edit",$product))->with("success","Data saved!");
    }

    public function destroy(Product $product){
        #Gate::authorize('delete', $product);
        $product->delete();
        return redirect(route("products.list"))->with("success","Data deleted!");
    }

    

    #salva as edições
    public function update(Product $product, ProductRequest $request) {
        #Gate::authorize('update', $product);

        $validated = $request->validated();
        
        $data = $request->all();
        #necessário, pois não é obrigatório atualizar a imagem
        if ($request->file('image') != null){
            $path = $request->file('image')->store('products',"public");
            $data["image"] = $path;
        }

        $product->update($data);
        return redirect()->back()->with("success","Data updated!");
    }
    
}
