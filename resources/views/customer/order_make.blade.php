@extends('layouts.customer')

@section('content')
    <h1 class="h3 mb-4 text-gray-600">Order</h1>
    <div class="row">
        <div class="col-lg-6">
            <div class="card  border-left-info">
                <div class="card-body">
                    <div class="d-flex">
                        <h1>{{$product->name}} </h1><span>Tsh {{$product->price}}</span>
                    </div>
                   <hr class="m-1">
                    <p>{{$product->desc}}</p><br>
                    <form action="/customer/order/{{$product->id}}" method="post">
                        @csrf
                         <div class="col-12">
                            <label for="inputNanme4" class="form-label">Payment Method</label>
                           <select class="form-control" name="payment_method" id="payment_method">
                            <option value="">--Choose--</option>
                            <option value="cash">Cash</option>
                            <option value="card">Card</option>
                           </select>
                            @error('payment_method')
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>
                         <div id="showCardFields">
                            
                           </div>
                          <div class="col-12 mt-3">
                            <button type="submit" class="btn btn-sm btn-info">Place your order</button>
                          </div>
                    </form>
                </div>
            </div>
        </div>
       
    </div>
 @endsection 

 @section('scripts')
 @if ($errors->has('billing_address') || $errors->has('card_number'))
<script type="text/javascript">
  $( document ).ready(function() {
    $('#showCardFields').html('\
          <div class="col-12">\
                                <label for="inputNanme4" class="form-label">Billing Address</label>\
                                <input type="text" class="form-control" value="{{ old("billing_address") }}"  name="billing_address">\
                                @error("billing_address")\
                                  <span class="text-danger">{{ $message }}</span>\
                                @enderror\
                              </div>\
                              <div class="col-12">\
                                <label for="inputNanme4" class="form-label">Card Number</label>\
                                <input type="text" class="form-control" value="{{ old("card_number") }}"  name="card_number">\
                                @error("card_number")\
                                  <span class="text-danger">{{ $message }}</span>\
                                @enderror\
                              </div>');
  });
</script>
@endif
<script>

 $(document).ready(function () {

    $('#payment_method').on('change', function () {
        var payment_method = $('#payment_method :selected').val();
        if (payment_method == 'card') {
          $('#showCardFields').html('\
          <div class="col-12">\
                                <label for="inputNanme4" class="form-label">Billing Address</label>\
                                <input type="text" class="form-control" value="{{ old("billing_address") }}"  name="billing_address">\
                                @error("billing_address")\
                                  <span class="text-danger">{{ $message }}</span>\
                                @enderror\
                              </div>\
                              <div class="col-12">\
                                <label for="inputNanme4" class="form-label">Card Number</label>\
                                <input type="text" class="form-control" value="{{ old("card_number") }}"  name="card_number">\
                                @error("card_number")\
                                  <span class="text-danger">{{ $message }}</span>\
                                @enderror\
                              </div>');
        } else {
            $('#showCardFields').html('');
        }
        console.log(payment_method);
    });
});
</script>
@endsection