@extends('layouts.customer')

@section('content')
    <h1 class="h3 mb-4 text-gray-600">Your order List</h1>
    <div class="row">

      @foreach ($orders as $order)
      <div class="col-lg-12 mb-3">
        <div class="card  border-left-info">
            <div class="card-body">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Payment method</th>

                        @if($order->payment_method === 'card')
                        <th>Billing Address</th>
                        <th>Card Number</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    <tr>
                      <td>{{$order->id }}</td>
                      <td>{{$order->name }}</td>
                      <td>{{$order->price }}</td>
                      <td>{{$order->payment_method }}</td>

                      @if($order->payment_method === 'card')
                      <td>{{$order->billing_address }}</td>
                      <td>{{$order->card_number }}</td>
                      @endif
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
    </div>
      @endforeach

    </div>
 @endsection 