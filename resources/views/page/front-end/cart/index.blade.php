@extends('layout.app')


@section('scripts')
  @if (Session::has('message1'))
    <script type="application/javascript">
      swal({
        icon: 'success',
        text: "<?= Session::get('message1') ?>",
      });
    </script>
  @endif
  @if (Session::has('message2'))
    <script type="application/javascript">
      swal({
        icon: 'error',
        text: "<?= Session::get('message2') ?>",
      });
    </script>
  @endif
@endsection

@section('content')
  <div class="container">
    <table id="cart" class="table table-hover table-sm" style="margin-top: 20px;">
      <thead>
        <tr>
          <th style="width:50%">Product</th>
          <th style="width:10%">Price</th>
          <th style="width:8%">Quantity</th>
          <th style="width:22%" class="text-center">Subtotal</th>
          <th style="width:10%"></th>
        </tr>
      </thead>
      <tbody>
      @php($total = 0)
      @php ($i = 0)
      @foreach($products as $item)
          <tr>
            <td data-product-id="{{ $item['product']->id }}">
              <div class="row">
                <div class="col-md-2 hidden-xsd-none d-sm-block">
                  <img src="{{ $item['product']->productImages->take(2)->get(0)->url }}" alt="..."
                       class="img-fluid">
                </div>
                <div class="col-md-10">
                  <h4 class="nomargin">{{ $item['product']->title }}</h4>
                  <p>{{ \Illuminate\Support\Str::words($item['product']->description, 25) }}</p>
                </div>
              </div>
            </td>
            <td data-th="Price">€ {{ $item['product']->price }}</td>
            <td data-th="Quantity">
              <input type="number" value="{{ $item['quantity'] }}" name="quantity"
                     class="update-cart quantity"
                     data-product-id="{{ $item['product']->id }}">
            </td>
            <td data-th="Subtotal"
                class="text-center subtotal">{{ $subtotal = $item['product']->price * $item['quantity'] }}</td>
            <td class="actions" data-th="">
              <button class="btn btn-danger btn-sm cart-delete"
                      data-product-id="{{$item['product']->id}}"><i class="fas fa-trash-alt"></i>
              </button>
            </td>
          </tr>
          @php($total = $total + $subtotal)
          @php($i = $i + 1)
        @endforeach
      </tbody>
      <tfoot>
        <tr class="d-block d-sm-none">
          <td class="text-center"><strong class="total">Total € {{ $total }}</strong>
          </td>
        </tr>
        <tr>
          <td><a href="{{ route('ajax-paginate') }}" class="btn btn-warning"><i
                  class="fa fa-angle-left"></i> Continue Shopping</a>
          </td>
          <td colspan="2"></td>
          <td class="hidden-xsd-none d-sm-block text-center"><strong class="total">Total € {{ $total }}</strong>
          </td>
          <td><a href="{{ route('order.index') }}" class="btn btn-success btn-block">Checkout <i
                  class="fa fa-angle-right"></i></a>
          </td>
        </tr>
      </tfoot>
    </table>
    @if ($i === 0)
    <br><br><br><br><br><br><br><br>
    <h1 style="text-align: center"><i>U heeft nog geen producten in uw winkelwagentje.</i></h1>
    @endif
    <br><br><br><br><br><br><br><br>
  </div>

@endsection