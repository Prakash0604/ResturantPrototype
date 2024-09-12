@extends('LandingPage.user-index')
@section('content')
<section id="chefs" class="chefs">
    <div class="container">

      <div class="section-title">
        <h2>Kitch Chef <span>Items</span></h2>
        <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas atque vitae autem.</p>
      </div>

      <form id="storeFoodItems">
      <div class="row">
        @csrf
          @foreach ($menu as $menu)
          <div class="col-lg-4 col-md-6">
          <div class="member">
            <div class="pic mb-3"><a href=""><img src="{{ asset('storage/food/'.$menu->images) }}" class="img-fluid" alt=""></a></div>
            <hr>
            <div class="member-info">
              <h4>{{ $menu->name }}</h4>
              <span>{{ $menu->description }}</span>
              <span>Rs.{{ $menu->price }}</span>
              {{-- <input
              class="form-check-input addTocart"
              type="checkbox"
              name="foodItems[]"
              value="{{ $menu->id }}"
          /> --}}
          <a href="{{ route('show.items',$menu->id) }}" class="btn btn-primary">Buy</a>
            </div>
          </div>
        </div>
        @endforeach
        <button type="submit" class="btn btn-primary mt-4" id="addCartbtn">Place Order</button>
    </div>
</form>

    </div>
  </section><!-- End Chefs Section -->

@endsection
