<div class="col-12">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Quantity</th>
        <th scope="col">image</th>
        <th scope="col">title</th>
        <th scope="col">description</th>
        <th scope="col">price</th>
        <th scope="col">supplier</th>
        <th scope="col">status</th>
        <th scope="col">actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($products as $product)
        @if($product->quantity <= 10)
          <tr class="table-danger">
        @elseif ($product->quantity <= 30)
          <tr class="table-warning">
        @else
          <tr>
            @endif
            <td>{{ $product->quantity }}</td>
            <td><img src="{{ URL::asset($product->productImages->first()->url) }}" alt=""
                     style="max-width: 100px"></td>
            <td>{{ $product->title }}</td>
            <td>{{ \Illuminate\Support\Str::words($product->description, 10) }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->supplier->full_name }}</td>
            <td>{{ $product->productStatus->name }}</td>
            <td>
              <div class="btn-group" role="group" aria-label="Basic example">
                <a href="{{ route('products.edit', $product->id )  }}" class="btn btn-info">Edit</a>
                <form action="{{ route('products.destroy', $product->id) }}" method="post">
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
  <div class="col-12">{!! $products->render() !!}</div>
</div>