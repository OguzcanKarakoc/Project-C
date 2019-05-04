@extends('layout.app')

@section('content')

  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"><strong>Order summary - {{ $order->id }}</strong></h3>
        </div>
        <div class="panel-body">
          <div class="table-responsive">
            <table class="table table-condensed">
              <thead>
                <tr>
                  <td><strong>Item</strong></td>
                  <td class="text-center"><strong>Price</strong></td>
                  <td class="text-center"><strong>Quantity</strong></td>
                  <td class="text-right"><strong>Totals</strong></td>
                </tr>
              </thead>
              <tbody>
                @php($total = 0)
                @foreach($result as $item)
                  <tr>
                    <td>{{ $item['product']->title }}</td>
                    <td class="text-center">€ {{ $item['product']->price }}</td>
                    <td class="text-center">{{ $item['quantity'] }}</td>
                    <td class="text-right">
                      € {{ $subtotal = $item['product']->price * $item['quantity'] }}</td>
                  </tr>
                  @php($total = $total + $subtotal)
                @endforeach
                <tr>
                  <td class="no-line"></td>
                  <td class="no-line"></td>
                  <td class="no-line text-center"><strong>Total</strong></td>
                  <td class="no-line text-right">€ {{ $total }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection