<?php

namespace App\Http\Controllers\Interno;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Product;
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
        $productsList = Product::all();
        return view("categories.form", ["item"=>new Category(),
                                        "productsList"=>$productsList]);
    }

    #abre o formulario de edição
    public function edit(Category $category){
        $productsList = Product::all();

        $products = Product::join("category_products","category_products.product_id","=","products.id")
                    ->where("category_id",$category->id)->paginate(2);
        return view("categories.form",["item"=>$category, 
                                        "productsList"=>$productsList, "products"=>$products]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'    => 'required|string|max:255',
            'product_id' => 'exclude_if:product_id,null|exists:products,id',
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

        $products = Product::find($request["product_id"]);
        if ($products != null){
            #na documentação consta esse método
            #funciona, mas não insere os timestamps
            #$category->productss()->attach($products);
            CategoryProduct::create(["product_id"=>$products->id,"category_id"=>$category->id]);
        }

        return redirect()->back()->with("success","Data updated!");
    }
    
}
