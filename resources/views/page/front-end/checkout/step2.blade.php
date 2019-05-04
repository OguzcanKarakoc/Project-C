@extends('layout.app')

@section('content')
  <div class="container">
    <div class="row">
      @include('component.flash-message')
        @if (Session::has('message1'))
            <div class="alert alert-success" style="margin-top: 10px">{{ Session::get('message1') }}</div>
        @endif
        @if (Session::has('message2'))
            <div class="alert alert-danger" style="margin-top: 10px">{{ Session::get('message2') }}</div>
        @endif
    </div>
    <div class="row">
      <div class="col-12">
        <h2>Choose your shipping address</h2>
        <form action="{{ route('order.store') }}" method="post">
          @csrf

          @foreach($user->addresses as $address)
            <div class="card bg-light mb-3">
              <div class="card-body">
                <h5 class="card-title">
                  <label>
                    <input type="radio" value="{{ $address->id }}" name="address_id" required>
                  </label>
                </h5>
                <table class="table">
                  <tr>
                    <th>postcode</th>
                    <th>city</th>
                    <th>street</th>
                    <th>house number</th>
                  </tr>
                  <tr>
                    <td>{{ $address->postcode }}</td>
                    <td>{{ $address->city }}</td>
                    <td>{{ $address->street }}</td>
                    <td>{{ $address->house_number }}</td>
                  </tr>
                </table>
              </div>
            </div>
          @endforeach

          <div class="form-group">
            <label for="shipment">Shipment</label>
            <select class="form-control" name="shipment_id" id="shipment" required>
              @foreach($shipments as $shipment)
                <option value="{{ $shipment->id }}">{{ $shipment->name }}
                  , € {{ $shipment->price }}</option>
              @endforeach
            </select>
          </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary" value="Submit">Purchase</button>
            </div>
          {{--<input type="submit" class="btn btn-primary" value="submit">--}}
        </form>
      </div>
    </div>
  </div>
@endsection