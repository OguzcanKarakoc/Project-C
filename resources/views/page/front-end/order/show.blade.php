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
@endsection

@section('content')
  <div class="container profile">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title" style="padding-top: 10px"><strong>Order summary</strong></h3>
        </div>
        <div class="panel-body">
          <div class="table-responsive">
            <table class="table col-6">
              <tr>
                <th>Postcode</th>
                <td>
                  {{ $order->address->postcode }}
                </td>
              </tr>
              <tr>
                <th>City</th>
                <td>
                  {{ $order->address->city }}
                </td>
              </tr>
              <tr>
                <th>Street</th>
                <td>
                  {{ $order->address->street }}
                </td>
              </tr>
              <tr>
                <th>Housenumber</th>
                <td>
                  {{ $order->address->house_number }}
                </td>
              </tr>
              <tr>
                <th>Shipment</th>
                <td>
                  {{ $order->shipment->name }}, € {{ $order->shipment->price }}
                </td>
              </tr>
            </table>
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
                  <td class="no-line text-right">€ {{ $total + $order->shipment->price }}</td>
                </tr>
              </tbody>
            </table>
            <a class="btn btn-primary" href="{{ route('profile.index') }}"
               style="float: right; font-size: 15px;">
              Go to profile
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <style>
    .profile {
      padding: 3%;
      margin-top: 3%;
      margin-bottom: 3%;
      border-radius: 0.5rem;
      background: #fff;
    }
  </style>
@endsection