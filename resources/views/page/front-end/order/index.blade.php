@extends('layout.app')

@section("content")
  <section>
    @include('component.flash-message')

    <div class="container">
      <div class="row">
        <div class="col-12">
          <h1 class="separator-left">Orders</h1>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="row" id="{{--ajax_container--}}">
            <div class="col-12">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Order</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($orders as $order)
                    <tr>
                      <td>{{ $order->id }}</td>
                      <td>{{ $order->orderStatus->name }}</td>
                      <td><a href="{{ route('order.show', $order->id) }}">show</a></td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection