@extends('layout.adminLayout.admin_design')

@section("content")
  <div id="content">
    <section>
      @include ('component.flash-message')
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h1 class="separator-left">Edit Order</h1>
          </div>
        </div>
      </div>


      <form action="{{ route('orders.update', $order->id) }}" method="post">
        @csrf
        @method('PUT')

        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="form-group">

                <input type="hidden" name="order" value="{{ $order->id }}">

                <label for="name">OrderStatus</label>
                <select name="orderStatus" id="orderStatus">
                  @foreach($orderStatuses as $orderStatus)
                    @if($orderStatus->id == $order->orderStatus->id)
                      <option value="{{ $orderStatus->id }}"
                              selected>{{ $orderStatus->name }}</option>
                    @else
                      <option value="{{ $orderStatus->id }}">{{ $orderStatus->name }}</option>
                    @endif
                  @endforeach
                </select>

              </div>
            </div>
            <div class="col-12 cell">
              <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
              </div>
            </div>
          </div>
        </div>
      </form>

    </section>
  </div>

@endsection
