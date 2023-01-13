@extends('layouts.business')

@section('content')
    <h1 class="h3 mb-4 text-gray-600">Products</h1>
    <a href="business/create" class="btn-sm btn btn-success mb-1">Add</a>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Desc</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($products as $product)
                          <tr>
                            <td>{{$product->id}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->desc}}</td>
                            <td>
                                <form action="/business/{{$product->id}}" method="POST">
                                    <a href="/business/{{$product->id}}/edit" class="btn btn-success btn-circle btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-circle btn-sm"> <i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                          </tr>
                      @endforeach  
                    </tbody>
                </table>
            </div>

 @endsection 
