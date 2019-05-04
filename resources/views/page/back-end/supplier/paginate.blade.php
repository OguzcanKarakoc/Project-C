<div class="col-12">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">full name</th>
        <th scope="col">email</th>
        <th scope="col">actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($suppliers as $supplier)
        <tr>
          <td>{{ $supplier->id }}</td>
          <td>{{ $supplier->full_name }}</td>
          <td>{{ $supplier->email }}</td>
          <td>
            <div class="btn-group" role="group" aria-label="Basic example">
              <a href="{{ route('suppliers.edit', $supplier->id )  }}" class="btn btn-info">Edit</a>
              <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="post">
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
  <div class="col-12">{!! $suppliers->render() !!}</div>
</div>