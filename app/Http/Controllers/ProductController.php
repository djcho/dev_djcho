<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    //
    private $product;

    //Laravel 의 IoC
    public function __construct(Product $product){
        $this->product = $product;
    }

    public function index(){

        //Products의 데이터를 최신순으로 페이징해서 가져온다.
        $products = Product::paginate(10);
        // produce/index.blade 에 $products 를 보내준다.
        return view('products.index', compact('products'));
    }

    public function create(){
        return view('products.create');
    }

    public function store(StoreProductRequest $request){
        $validated = $request->validated();
        $this->product->create($validated);
        return redirect()->route('products.index');
    }

    public function show(Product $product){
        return view('products.show', compact('product'));
    }

    public function edit(Product $product){
        return view('products.edit', compact('product'));
    }

    public function update(StoreProductRequest $request, Product $product){
        $validated = $request->validated();
        //$product는 수정할 모델 값이므로 바로 업데이트 해준다.
        $product->update($validated);
        return redirect()->route('products.index', $product);
    }

    public function destroy(Product $product){
        $product->delete();
        return redirect()->route('products.index');
    }
}
