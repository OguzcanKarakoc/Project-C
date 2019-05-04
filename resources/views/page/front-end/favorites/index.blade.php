@extends('layout.app')

@section('scripts')
  @if (Session::has('message4'))
    <script type="application/javascript">
      swal({
        icon: 'success',
        text: "<?= Session::get('message4') ?>",
      });
    </script>
  @endif
@endsection

@section('content')
  <br>

  <h1>My Favorites</h1>
  <div class="row">
    @foreach($products as $product)
      @php($product = \App\Product::find($product->id))
      {{--Change controller for product images (and in stock?)--}}
      <div class="col-md-4 col-sm-6 mb-3">
        <div class="product-grid3">
          <div class="product-image3">
            <a href="{{ route('products.show', $product->id) }}">
              @if($product->productImages->take(2)->get(0) !== null)
                <img class="pic-1"
                     src="{{ $product->productImages->take(2)->get(0)->url }}">
              @endif
              @if($product->productImages->take(2)->get(1) !== null)
                <img class="pic-2"
                     src="{{ $product->productImages->take(2)->get(1)->url }}">
              @endif
            </a>
            <ul class="social">
              <li><a href="{{ route('products.show', $product->id) }}"><i
                      class="fa fa-shopping-bag"></i></a></li>
              @if( true )
                <li><a class="add-cart" data-product-id="{{ $product->id }}" href="#"><i
                        class="fa fa-shopping-cart"></i></a></li>
              @endif
            </ul>
            @if( false )
              <span class="product-new-label">{{ $product->title == "Out of stock" }}</span>
            @endif

          </div>
          <div class="product-content">
            <h3 class="title"><a
                  href="{{ route('products.show', $product->id) }}">{{ $product->title }}</a>
            </h3>
            <div class="price">
              €{{ $product->price }}
              {{-- TODO:: SALE <span>€{{ $product->price }}</span>--}}
            </div>
          </div>
          <a href="{{ route('favorite.delete', $product->id) }}">
            <button type="submit" class="btn btn-danger">
              <i class="fa fa-trash"></i>
            </button>
          </a>
        </div>
      </div>
    @endforeach
  </div>
@endsection

