<?php

namespace App\Http\Controllers\WebApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Auth;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('customer.index',compact('products'));
    }

    public function orderList(){
        $orders = DB::table('products')
        ->join('orders','orders.product_id','=','products.id')
        ->where('orders.customer_username', '=', Auth::user()->username)
        ->get();
        return view('customer.order_list',compact('orders'));
    }

    public function customerOrder($id){
        $product = Product::where('id', '=', $id)->first();
        return view('customer.order_make',compact('product'));
    }

    public function customerOrderStore(Request $request){
        $request->validate([
            'payment_method'   => 'required'
        ]);
        $product = Product::findOrFail($request->product_id);
        if ($product) {
            if ($request->payment_method === 'cash') {
                Order::create([
                    'payment_method' => $request->payment_method,
                    'product_id' => $request->product_id,
                    'customer_username' => Auth::user()->username,
                ]);
                return redirect('/customer-order');
            }elseif ($request->payment_method === 'card') {
                $data = $request->validate([
                    'billing_address'   => 'required',
                    'card_number'   => 'required',
                ]);
                $data['customer_username'] = Auth::user()->username;
                $data['product_id'] = $request->product_id;
                $data['payment_method'] = $request->payment_method;
                Order::create($data);   
                return redirect('/customer-order');       
            }
        }
    }
}
