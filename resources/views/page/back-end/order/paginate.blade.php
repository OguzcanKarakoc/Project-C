<div class="col-12">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Order number</th>
        <th scope="col">User</th>
        <th scope="col">status</th>
        <th scope="col">actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($orders as $order)
        <tr>
          <td>{{ $order->id }}</td>
          <td>{{ $order->user->first_name }} {{ $order->user->last_name }}</td>
          <td>{{ $order->orderStatus->name }}</td>
          <td>
            <div class="btn-group" role="group" aria-label="Basic example">
              <a href="{{ route('orders.show', $order->id )  }}" class="btn btn-primary">Show</a>
              <a href="{{ route('orders.edit', $order->id )  }}" class="btn btn-info">Edit</a>
              <form action="{{ route('orders.destroy', $order->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
              </form>
            </div>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="row">
  <div class="col-12">{!! $orders->render() !!}</div>
</div>