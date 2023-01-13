@extends('layouts.customer')

@section('content')
    <h1 class="h3 mb-4 text-gray-600">All Products</h1>
    <div class="row">
        
        @foreach ($products as $product)
        <div class="col-lg-4">
            <div class="card  border-left-info">
                <div class="card-body">
                    <div class="d-flex">
                        <h1>{{$product->name}} </h1><span>Tsh {{$product->price}}</span>
                    </div>
                   <hr class="m-1">
                    <p>{{$product->desc}}</p>
                    <a href="/customer/order/{{$product->id}}" class="btn btn-sm btn-info">Order</a>
                </div>
            </div>
        </div>
        @endforeach
       
    </div>
 @endsection 
