@extends('layouts.business')

@section('content')
    <h1 class="h3 mb-4 text-gray-600">Products/Edit</h1>
    <div class="card pt-4">
        <div class="card-body">
          <!-- Vertical Form -->
          <form action="/business/{{$product->id}}" method="POST" class="row g-3">
            @method('PUT')
            @csrf
            <div class="col-12">
              <label for="inputNanme4" class="form-label">Name</label>
              <input type="text" class="form-control" value="{{$product->name}}"  name="name">
              @error('name')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="col-12">
              <label for="inputNanme4" class="form-label">Price</label>
              <input type="number" class="form-control" value="{{$product->price}}"  name="price">
              @error('price')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="col-12">
              <label for="inputNanme4" class="form-label">Description</label>
              <textarea name="desc" class="form-control" rows="3">{{$product->desc}}</textarea>
              @error('desc')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="col-12 mt-2">
                <button type="submit" class="btn btn-success btn-sm ">Save</button>
            </div>
              
      
          </form><!-- Vertical Form -->
      
        </div>
      </div>
 @endsection 
