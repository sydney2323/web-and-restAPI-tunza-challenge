<?php

namespace App\Http\Controllers\WebApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('product.index',compact('products'));
    }

    public function create(){
        return view('product.create');
    }

    public function store(Request $request){
        Product::create(request()->validate([
            'name' => 'required',
            'price' => 'required',
            'desc' => 'required'
        ]));

        return redirect('/business');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('product.edit',compact('product'));
    }

    public function update(Request $request){
        $product = Product::findOrFail($request->id);
        $product->update(request()->validate([
            'name' => 'required',
            'price' => 'required',
            'desc' => 'required'
        ]));

        return redirect('/business');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect('/business');
    }
}
