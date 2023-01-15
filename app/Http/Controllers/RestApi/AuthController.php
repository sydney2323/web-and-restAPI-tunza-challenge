<?php

namespace App\Http\Controllers\RestApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
    	$input = $request->all();
    	$validator = Validator::make($input, [
    		'username' => 'required',
    		'password' => 'required',
    	]);
    	if ($validator->fails()) {
    		return response()->json($validator->errors(), 417);
    	}
    	$credentials = $request->only(['username', 'password']);
    	if (Auth::attempt($credentials)) {
			
			$user = Auth::user();
			$user['token'] = $user->createToken('TunzaApp',[$user->role])->accessToken;
			return response()->json([
                'user' => $user,
            ], 200);
		}
		else {
			return response()->json(['error' => 'Unauthorized'], 401);
		}
    }

    public function productList(Request $request)
    {
    	$products = Product::paginate(5);
    	return response()->json(['products' => $products], 200);
    }

    public function customerOrderStore(Request $request)
    {
		$input = $request->all();
		$validator = Validator::make($input, [
			'product_id' => 'required',
			'payment_method' => 'required',
		]);
		if ($validator->fails()) {
    		return response()->json($validator->errors(), 417);
    	}
		$product = Product::find($request->product_id);
		if (!$product) {
			return response([
				'error' => 'Product not found'
			],404);
		}
		if ($request->payment_method === 'card') {
			$validator = Validator::make($input, [
				'billing_address' => 'required',
				'card_number' => 'required',
			]);
			if ($validator->fails()) {
				return response()->json($validator->errors(), 417);
			}
			$order = Order::create([
				'product_id' => $request->product_id,
                'customer_username' => Auth::user()->username,
				'payment_method' => $request->payment_method,
				'billing_address' => $request->billing_address,
				'card_number' => $request->card_number,
			]);
			return response()->json([
				'message' => 'Order created successful',
				'order' => $order
			], 200);
		}elseif ($request->payment_method === 'cash') {
			$order = Order::create([
				'product_id' => $request->product_id,
                'customer_username' => Auth::user()->username,
				'payment_method' => $request->payment_method
			]);
			return response()->json([
				'message' => 'Order created successful',
				'order' => $order
			], 200);
		} else {
			return response()->json(['error' => 'payment_method should be cash or card'], 404);
		}
    }

// 	public function adminLogin(Request $request)
// 	{
// 		$input = $request->all();
// 		$validator = Validator::make($input, [
// 			'email' => 'required|email',
// 			'password' => 'required',
// 		]);
// 		if ($validator->fails()) {
			
// 			return response()->json($validator->errors(), 417);
// 		}
// 		$credentials = $request->only(['email', 'password']);
// 		if (Auth::attempt($credentials)) {
			
// 			$user = Auth::user();
// 			$success['token'] = $user->createToken('MyApp', ['*'])->accessToken;
// 			return response()->json(['success' => $success], 200);
// 		}
// 		else {
// 			return response()->json(['error' => 'Unauthorized'], 401);
// 		}
// 	}
// 	/**
// 	 * admin register API
// 	 * @return \Illuminate\Http\Response
// 	 */
// 	public function adminRegister(Request $request)
// 	{
// 		$validator = Validator::make($request->all(), [
// 			'name' => 'required',
// 			'email' => 'required|email',
// 			'password' => 'required',
// 			'c_password' => 'required|same:password',
// 		]);
// 		if ($validator->fails()) {
			
// 			return response()->json($validator->errors(), 417);
// 		}
// 		$user = User::create([
// 			'name' => $request->name,
// 			'email' => $request->email,
// 			'password' => bcrypt($request->password),
// 		]);
// 		$success['name'] = $user->name;
// 		$success['token'] = $user->createToken('MyApp', ['*'])->accessToken;
// 		return response()->json(['success' => $success], 200);
// 	}
}
