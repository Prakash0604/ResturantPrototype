@extends('LandingPage.user-index')
@section('content')
<div class="container">
        <section class="h-100 gradient-custom">
            <div class="container py-5 h-100">
              <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-10 col-xl-8">
                    <form action="{{ route('payment.process') }}" method="POST">
                  <div class="card" style="border-radius: 10px;">
                    <div class="card-body">
                      <div class="d-flex justify-content-between align-items-center mb-4">
                        <p class="lead fw-normal mb-0" style="color: #a8729a;">Item</p>
                        <p class="small text-muted mb-0">Order Items</p>
                        <input type="hidden" name="menu_item" value="{{ $data->id }}">
                      </div>
                      <div class="card shadow-0 border mb-4">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-2">
                              <img src="{{ asset('storage/food/'.$data->images) }}"
                                class="img-fluid" alt="Phone">
                            </div>
                            <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                              {{-- <input type="text" class="form-control"  value="{{  $data->name }}"> --}}
                              <p class="text-muted mb-0">Item Name: {{  $data->name }}</p>
                            </div>
                            <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                              <p class="text-muted mb-0 small"></p>
                            </div>
                            <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                              <p class="text-muted mb-0 small">Item Category: {{ $data->category->name }}</p>
                              {{-- <input type="text" name="" class="form-control"  value="{{ $data->category->name }}"> --}}
                            </div>
                            <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                              {{-- <p class="text-muted mb-0 small">Price: </p> --}}
                              <input type="number" name="amt" class="form-control" id="" value="{{ $data->price }}" readonly>
                            </div>
                          </div>
                          <hr class="mb-4" style="background-color: #e0e0e0; opacity: 1;">
                          <div class="row d-flex align-items-center">
                            <div class="col-md-2">
                              <p class="text-muted mb-0 small">Confirm Order</p>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="d-flex justify-content-between">
                        <p class="text-muted mb-0">Description : {{ $data->description }}</p>
                      </div>
                      <div class="d-flex justify-content-between">
                        <p class="text-muted mb-0">Order Date : {{ now() }}</p>
                      </div>
                    </div>
                    <div class="card-footer border-0 px-4 py-5"
                      style="background-color: #042d3a; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                      <h5 class="d-flex align-items-center justify-content-end text-white text-uppercase mb-0">Tax Amount: <span class="h2 mb-0 ms-2">20</span></h5>
                      <h5 class="d-flex align-items-center justify-content-end text-white text-uppercase mb-0">
                        @php
                            $tax=20;
                            $amount= $data->price;
                            $total=$tax+$amount;
                        @endphp

                        Total
                        Amount: <span class="h2 mb-0 ms-2">{{ $total }}</span></h5>
                    </div>
                        @csrf
                        <button type="submit" class="btn btn-success">Pay with eSewa</button>
                    </div>
                </form>
                </div>
              </div>
            </div>
          </section>





</div>
    {{-- <script>
        $(document).ready(function(){
            $('.removeItem').on('click', function(){
                var item = $(this).data('item');
                $(this).parent().remove();
                $.ajax({
                    // url: "{{ route('remove.item') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        item: item
                    },
                    success: function(response){
                        console.log('Item removed');
                    }
                });
            });

            $('#saveItems').on('click', function(){
                var items = [];
                $('#itemList li').each(function(){
                    items.push($(this).text().replace(' X', ''));
                });

                $.ajax({
                    // url: "{{ route('save.items') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        items: items
                    },
                    success: function(response){
                        alert('Items saved successfully');
                    }
                });
            });
        });
    </script> --}}

@endsection
