<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function viewAllProducts(){
        $products = Product::all();
        return view('products.viewAll' , compact('products') );

    }

    public function create(){
        return view('products.create');
    }


    public function store(Request $request){

        $newProduct = Product::create([
            'name' => $request->product_name,
            'price' => $request->price,
        ]);

        return redirect('/products');


    }
}
