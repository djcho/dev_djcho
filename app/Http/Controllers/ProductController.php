<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

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
        $products = $this->product->latest()->paginate(10);
        // produce/index.blade 에 $products 를 보내준다.
        return view('products.index', compact('products'));
    }

    public function create(){
        return view('products.create');
    }

    public function store(Request $request){
        $request = $request->validate([
            'name' => 'required',
            'content' => 'required'
        ]);

        $this->product->create($request);
        return redirect()->route('products.index');
    }
}
